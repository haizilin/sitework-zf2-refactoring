<?php
/**
 * Image resizing class
 * - works only with gd at the moment
 * - takes parameters for x or/and y target-size
 * - at least one taget-size parameter is required
 * - the method won't scale-up, parameters are used as max. dimension
 * - if x AND y is given, BOTH will be used as max.
 * - the method will try to scale proportional as possible
 * - additional parameters and options are
 *
 * @TODO: should work with imageready, if it finds available to increase scaling quality
 *
 * @param string $src = absolute path for image to resize
 * @param int $x = x-size to resize to, if x=0 and y!=0 resizing computes x
 * @param int $y = y-size to resize to, if x!=0 and y=0 resizing computes y
 * @param string $dstPath = absolute path to store resized image without trailing slash
 * @param array $options = some filename options, following options are acceppted:
 *                       exists = defines behavior, if a file with the same name, size and extension was found, uses class constants
 *                       name   = filename without directory and extension, use OPTION_RENAME_SIZE to set like 130x120.jpg
 *                       prefix = will be set prepending the name seperated by _, use OPTION_RENAME_SIZE to set like 130x120_picture.jpg
 *                       suffix = will be set appending the name seperated by _, use OPTION_RENAME_SIZE to set like picture_130x120.jpg
 *                       sep    = use a seperator of your choice, only used with parameter exists and/or prefix or/and suffix
 *                       ATTENTION: options will NOT be validated for any operating system requirements
 * @return generated image filename with full absolute path
 */
namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;

class Image extends AbstractHelper
{
    protected $_requiredExtensions = array('gd');
    protected $_supportedExtensions = array('gd', 'imagick');

    private static $_callbacks = array(
        IMAGETYPE_GIF  => array('output' => 'imagegif',  'create' => 'imagecreatefromgif'),
        IMAGETYPE_JPEG => array('output' => 'imagejpeg', 'create' => 'imagecreatefromjpeg'),
        IMAGETYPE_PNG  => array('output' => 'imagepng',  'create' => 'imagecreatefrompng'),
        IMAGETYPE_XBM  => array('output' => 'imagexbm',  'create' => 'imagecreatefromxbm'),
        IMAGETYPE_WBMP => array('output' => 'imagewbmp', 'create' => 'imagecreatefromxbm'),
    );

    // IMG Handle
    private $_src = null;
    private $_srcInfo = null;

    private $_srcFile = null;
    private $_srcX = 0;
    private $_srcY = 0;


    private $_dstFile = null;
    private $_dstX = 0;
    private $_dstY = 0;

    private $_imgUrl = null;

    private $_fileType = null;
    private $_mimeType = null;
    private $_error = null;

    private $_imgProc = 'gd';

    const OPTION_EXISTS_RENAME = 1;
    const OPTION_EXISTS_LEAVE = 2;
    const OPTION_RENAME_SIZE = 3;

    public function __invoke($src, $x = 0, $y = 0, $dstPath = null, $options = array()) {

        // prevent resizing of invalid files
        if (!is_file(BASE_PATH . '/public' . $src)) {
            return false;
        }

        // do not resize to 0
        if ($x == 0 && $y == 0) {
            return false;
        }

        // check source file
        $this->_srcFile = BASE_PATH . '/public' . $src;
        $this->_srcInfo = @getimagesize($this->_srcFile);
        if (empty($this->_srcInfo)) {
            return $src;
        }

        $this->_imgUrl = dirname($src);

        // set dimensions
        if (!$this->_dimensions($x, $y)) {
            return $src;
        }

        switch($this->_srcInfo[2]) {
            case 1:
                $this->_fileType = IMAGETYPE_GIF;
                break;

            case 2:
                $this->_fileType = IMAGETYPE_JPEG;
                break;

            case 3:
                $this->_fileType = IMAGETYPE_PNG;
                break;
            default:
                $this->_error = 'cannot resize ' . $this->_fileType;
                return $src;
        }

        // define image processor
        if (class_exists('Imagick')) {
            $this->_imgProc = 'imagick';
        }

        // set paths and file names for source and target
        $this->_setFiles($dstPath, $options);

        // create image at the defined place in filesystem
        try {
            switch ($this->_imgProc) {
                case 'imagick' :
                    $this->_renderWithImagick();
                    break;
                default :
                    $this->_renderWithGd();
            }

            chmod($this->_dstFile, 0777);
        } catch (Exception $e) {
            // @TODO: add some exception handling here
            $this->_error = 'could not create file. ' . $e->getMessage();
            return false;
        }

        return $this->_imgUrl;
    }

    /**
     * compute dimensions of target image
     * @param int $x
     * @param int $y
     * @return bool
     */
    private function _dimensions($x = 0, $y = 0) {
        $this->_srcX = $this->_srcInfo[0];
        $this->_srcY = $this->_srcInfo[1];
        $this->_mimeType = $this->_srcInfo['mime'];

        // do not resize images, that allready match the requirements
        if ((!$y && $x >= $this->_srcX) || (!$x && $y >= $this->_srcY) || ($x >= $this->_srcX && $y >= $this->_srcY)) {
            $this->_dstX = $x;
            $this->_dstY = $y;
            return false;
        }

        if (!$y) {
            $ty = round($x * $this->_srcY / $this->_srcX);
            $tx = $x;
        } else if (!$x) {
            $tx = round($y * $this->_srcX / $this->_srcY);
            $ty = $y;
        } else {
            $tx = $this->_srcX;
            $ty = $this->_srcY;
            while (($tx > $x || $ty > $y) && $tx > 0 && $ty > 0) {
                if ($tx > $x) {
                    $tx = $tx - 1;
                    $ty = round($tx * $this->_srcY / $this->_srcX);
                }
                if ($ty > $y) {
                    $ty = $ty - 1;
                    $tx = round($ty * $this->_srcX / $this->_srcY);
                }
            }
        }

        $this->_dstX = $tx;
        $this->_dstY = $ty;

        return true;
    }

    /**
     * define paths of source and target files
     * @param null $dstPath
     * @param array $options
     * @return bool|string
     * @throws Exception
     */
    private function _setFiles($dstPath = null, $options = array()) {

        // start resizing
        $pathinfo = pathinfo($this->_srcFile);

        // !important to have $srcName and $srcExt to handle options easy as possible
        $srcPath = $pathinfo['dirname'];
        $srcName = $pathinfo['filename'];
        $srcExt = '.' . $pathinfo['extension'];
        if (empty($srcExt) && preg_match('/(\.[a-z]{3,4})$/', $this->_srcFile, $match)) {
            $srcExt = $match[1];
        }

        if (empty($srcExt)) {
            $this->_error = 'Could not get file extensopm for uplaod';
            return false;
        }

        // path to store image
        if ($dstPath == null) {
            $dstPath = $srcPath;
        }
        $dstPath.= '/' . $this->_dstX . 'x' . $this->_dstY;
        $this->_imgUrl.= '/' . $this->_dstX . 'x' . $this->_dstY;

        // define default filename (without extension to handle eg. renaming easier)
        $dstName = $srcName;

        // option name
        if (isset($options['name'])) {
            if ($options['name'] == self::OPTION_RENAME_SIZE) {
                $dstName = $this->_dstX . 'x' . $this->_dstY;
            } else {
                $dstName = $options['name'];
            }
        }

        // seperator
        $sep = '.';
        if (isset($options['sep'])) {
            $sep = $options['sep'];
        }

        // option prefix
        if (isset($options['prefix'])) {
            if ($options['prefix'] == self::OPTION_RENAME_SIZE) {
                $dstName = $this->_dstX . 'x' . $this->_dstY . $sep . $dstName;
            } else {
                $dstName = $options['prefix'] . $sep . $dstName;
            }
        }

        // option suffix
        if (isset($options['suffix'])) {
            if ($options['suffix'] == self::OPTION_RENAME_SIZE) {
                $dstName =  $dstName . $sep . $this->_dstX . 'x' . $this->_dstY;
            } else {
                $dstName = $dstName . $sep . $options['suffix'];
            }
        }

        // option exists (default is overwrite)
        if (isset($options['exists'])) {
            if (is_file($dstPath . '/' . $dstName . $srcExt) && $options['exists'] == self::OPTION_EXISTS_LEAVE) {
                return $dstPath . '/' . $dstName . $srcExt;
            } else if (is_file($dstName.$srcExt) && $options['exists'] == self::OPTION_EXISTS_RENAME) {
                $i = 1;
                while(is_file($dstPath . '/' . $dstName . $sep . $i . $srcExt)) {
                    $i++;
                }
                $dstName.= $sep . $i;
            }
        }

        // create dir
        if (!is_dir($dstPath)) {
            try {
                mkdir($dstPath);
                chmod($dstPath, 0777);
            } catch (Exception $e) {
                // @TODO: add some exception handling here
                throw new Exception('Could not create directory ' . $dstPath);
            }
        } else if (!is_writable($dstPath)) {
            try {
                chmod($dstPath, 0777);
            } catch (Exception $e) {
                // @TODO: add some exception handling here
                throw new Exception($dstPath . ' is not writable.');
            }
        }

        // add extension and storage path to have a valid filename before processing
        $this->_imgUrl.= '/' . $dstName . $srcExt;
        $this->_dstFile = $dstPath . '/' . $dstName . $srcExt;
    }

    /**
     * Render target image with php gd
     */
    private function _renderWithGd() {
        $imgSrc = call_user_func($this->_getCallback('create'), $this->_srcFile);
        $imgDst = imagecreatetruecolor($this->_dstX, $this->_dstY);
        imagecopyresampled($imgDst, $imgSrc, 0, 0, 0, 0, $this->_dstX, $this->_dstY, $this->_srcX, $this->_srcY);
        call_user_func($this->_getCallback('output'), $imgDst, $this->_dstFile);
    }

    /**
     * Render target image with php imagick
     */
    private function _renderWithImagick() {
        $im = new \Imagick($this->_srcFile);
        $im->thumbnailImage($this->_dstX, $this->_dstY);
        $im->writeimage($this->_dstFile);
    }

    /**
     * execute gd callbacks depending of fileType
     * @param $callbackType
     * @return mixed
     * @throws Exception
     */
    private function _getCallback($callbackType) {
        if (empty(self::$_callbacks[$this->_fileType])) {
            throw new Exception('Unsupported file type: ' . $this->_fileType);
        }
        if (empty(self::$_callbacks[$this->_fileType][$callbackType])) {
            throw new Exception('No Method found to resize file type ' . $this->_fileType);
        }
        return self::$_callbacks[$this->_fileType][$callbackType];
    }

    public function getError() {
        return $this->_error;
    }
}
