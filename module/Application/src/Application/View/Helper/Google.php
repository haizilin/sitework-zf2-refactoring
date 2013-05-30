<?php
namespace Application\View\Helper;
use Zend\Di\ServiceLocator;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Stdlib\Parameters;
use Zend\View\Helper\AbstractHelper;
use Zend\Http\Client\Adapter\Curl;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;

class Google extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected $map_key        = 'AIzaSyDd46CEoMqOQK_WJW7fJxSkJQ66BW_3zac';

    protected $map_static_url = 'http://maps.googleapis.com/maps/api/staticmap';
    protected $map_sensor     = 'false';
    protected $map_format     = 'png';
    protected $map_type       = 'roadmap';
    protected $map_div_id     = 'gmap';
    protected $map_div_class  = 'panel';
    protected $map_zoom       = 12;
    protected $map_lat        = 52.490873;
    protected $map_lon        = 13.404382;
    protected $map_markers    = array();
    protected $map_height     = 208;
    protected $map_width      = 360;
    protected $map_animation  = '';
    protected $map_icon       = '';
    protected $map_icons      = array();

    protected $map_valid_types = array(
        'roadmap', 'satellite', 'terrain', 'hybrid'
    );

    protected $adsense_valid_positions = array(
        'top', 'left', 'bottom', 'right'
    );

    protected $_serviceLocator;
    protected $_config = array();

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->_serviceLocator = $serviceLocator;
    }

    public function getServiceLocator() {
        return $this->_serviceLocator;
    }

    public function __invoke() {
        $this->_config = (Array) $this->getServiceLocator()->getServiceLocator()->get('config');
        return $this;
    }

    public function analytics($options = array())
    {

    }

    public function adSense($position = 'bottom', $options = array())
    {
        if (!in_array($position, $this->adsense_valid_positions)) {
            return;
        }
    }

    public function map($variant, $options = array())
    {
        $map = false;
        if (!empty($options['address'])) {
            $p['center'] = urlencode($options['address']);
        } else {
            $lon = (!empty($options['lon'])) ? $options['lon'] : $this->map_lon;
            $lat = (!empty($options['lat'])) ? $options['lat'] : $this->map_lat;
            $p['center'] = $lat . ',' . $lon;
        }

        $w = (!empty($options['w'])) ? $options['w'] : $this->map_width;
        $h = (!empty($options['h'])) ? $options['h'] : $this->map_height;

        $p['size']      = $w . 'x' . $h;
        $p['maptype']   = !empty($options['type']) && in_array($options['type'], $this->map_valid_types) ? $options['type'] : $this->map_type;
        $p['markers']   = !empty($options['markers']) ? $options['markers'] : 'color:red|label:S|' . $p['center'];
        $p['key']       = !empty($options['key'])     ? $options['key']     : $this->map_key;
        $p['zoom']      = !empty($options['zoom'])    ? $options['zoom']    : $this->map_zoom;
        $p['sensor']    = !empty($options['sensor'])  ? $options['zoom']    : $this->map_sensor;
        $p['format']    = !empty($options['format'])  ? $options['zoom']    : $this->map_format;
        $p['visible']   = !empty($options['visible']) ? $options['visible'] : $p['center'];

        if ($variant == 'static') {
            $path = APPLICATION_PATH . '/../public/gfx/map/';
            $file = md5(join('', $p)) . '.png';
            if (is_file($path . $file) || (!is_file($path . $file) && $this->fetchGoogleMap($path, $file, $p))) {
                $map = '<img src="/gfx/map/' . $file . '" width="' . $w . '" height="' . $h . '" alt="GMap" />';
            }
        } else {

        }

        if (!empty($map)) {
            return '<div id="gmap" class="panel">' . $map . '</div>';
        }
    }

    private function fetchGoogleMap($path, $file, $p) {
        $curl = new Curl();
        $curl->setCurlOption(CURLOPT_RETURNTRANSFER, true);
        $request = new Request();
        $request->setMethod(Request::METHOD_GET);
        $request->setUri($this->map_static_url);
        $request->setQuery(new Parameters($p));
        $httpClient = new Client();
        $httpClient->setAdapter($curl);
        $httpClient->setArgSeparator('&');
        $httpClient->setRequest($request);
        $response = $httpClient->send();
        return ($response->getStatusCode() == Response::STATUS_CODE_200 && @file_put_contents($path . $file, $response->getBody()));
    }
}
