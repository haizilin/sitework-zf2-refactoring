<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;

class Image extends AbstractHelper
{
    const PHP_GD = 'gd';
    const PHP_IMAGICK = 'imagick';

    private $_phpLib = null;

    private static $_gdCallbacks = array(
        IMAGETYPE_GIF  => array('output' => 'imagegif',  'create' => 'imagecreatefromgif'),
        IMAGETYPE_JPEG => array('output' => 'imagejpeg', 'create' => 'imagecreatefromjpeg'),
        IMAGETYPE_PNG  => array('output' => 'imagepng',  'create' => 'imagecreatefrompng'),
        IMAGETYPE_XBM  => array('output' => 'imagexbm',  'create' => 'imagecreatefromxbm'),
        IMAGETYPE_WBMP => array('output' => 'imagewbmp', 'create' => 'imagecreatefromxbm'),
    );

    private static $_supportedPhpLibs = array('gd', 'imagick');

    // IMG Handle
    private $_mimeType = null;
    private $_fileType = null;

    public function __invoke($options = array()) {

        $src = $options['src'];
        $x = !empty($options['x']) ? $options['x'] : 0;
        $y = !empty($options['y']) ? $options['y'] : 0;

    	if ($x == 0 && $y == 0) {
    		return $src;
    	}

    	$pathinfo = pathinfo($src);

    	$srcPath = $pathinfo['dirname'];
    	$srcName = $pathinfo['filename'];
    	$srcExt = $pathinfo['extension'];
    	$srcFile = $srcPath . '/' . $srcName . '.' . $srcExt;
		if (!is_file($srcFile)) {
			return $src;
		}
    	$srcInfo = getimagesize($srcFile);
    	switch($srcInfo[2]) {
    		case 1:
    			$this->_fileType = IMAGETYPE_GIF;
    			break;

    		case 2:
    			$this->_fileType = IMAGETYPE_JPEG;
    			break;

    		case 3:
    			$this->_fileType = IMAGETYPE_PNG;
    			break;
    		default: return $src;
    	}

    	// dimensions
    	$srcX = $srcInfo[0];
    	$srcY = $srcInfo[1];
    	$this->_mimeType = $srcInfo['mime'];

    	if ($y == 0) {
    		$y = round($x * $srcY / $srcX);
    	}

    	if ($x == 0) {
    		$x = round($y * $srcX / $srcY);
    	}

    	// don't create image twice
    	$dstPath = $srcPath . '/' . $x . 'x' . $y;
    	if (!is_dir($dstPath)) {
    		mkdir($dstPath);
    		chmod($dstPath, 0777);
    	}
    	$dstFile = $dstPath . '/' . $srcName . '.' . $srcExt;
    	$ret = $x . 'x' . $y . '/' . basename($dstFile);

    	if (is_file($dstFile)) {
    		return $ret;
    	}

        if (!empty($options['phpLib']) && in_array(self::PHP_IMAGICK, self::$_supportedPhpLibs)) {
            $this->_phpLib = $options['phpLib'];
        } else if (is_callable(self::PHP_IMAGICK)) {
            $this->_createUsingImagick($srcFile, $dstFile, $x, $y);
        } else if (is_callable($this->_getGdCallback('create'))) {
            $this->_createUsingGd($srcFile, $dstFile, $x, $y, $srcX, $srcY);
        } else {
            throw new \Exception('No PHP image extension found. Install at least gd. For better results install imagick');
        }

    	return $ret;
    }

	private function _getGdCallback($callbackType, $fileType = null, $unsupportedText = 'Unsupported image format.') {
        if (null === $fileType) {
            $fileType = $this->_fileType;
        }
        if (empty(self::$_gdCallbacks[$fileType])) {
            throw new \Exception($unsupportedText);
        }
        if (empty(self::$_gdCallbacks[$fileType][$callbackType])) {
            throw new \Exception('Callback not found.');
        }
        return self::$_gdCallbacks[$fileType][$callbackType];
    }

    private function _createUsingImagick($srcFile, $dstFile, $x, $y) {
        $im = new \Imagick($srcFile);
        $im->thumbnailImage($x, $y);
        $im->writeimage($dstFile);
    }

    private function _createUsingGd($srcFile, $dstFile, $x, $y, $srcX, $srcY) {
        $imgSrc = call_user_func($this->_getGdCallback('create'), $srcFile);
        $imgDst = imagecreatetruecolor($x, $y);
        imagecopyresampled($imgDst, $imgSrc, 0, 0, 0, 0, $x, $y, $srcX, $srcY);
        call_user_func($this->_getGdCallback('output'), $imgDst, $dstFile);
        chmod($dstFile, 0777);
    }
}
