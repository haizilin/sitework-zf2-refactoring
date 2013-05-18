<?php
namespace Application\View\Helper;
use Zend\Di\ServiceLocator;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Helper\AbstractHelper;

class Assets extends AbstractHelper implements ServiceLocatorAwareInterface
{
    protected $_serviceLocator;
    protected $_assets = array();

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->_serviceLocator = $serviceLocator;
    }

    public function getServiceLocator() {
        return $this->_serviceLocator;
    }

    public function __invoke() {
        $this->_assets = (Array) $this->getServiceLocator()->getServiceLocator()->get('config');
        return $this;
    }

    public function css() {
        if (is_array($this->_assets) && array_key_exists('css', $this->_assets)) {
            return $this->_assets['css'];
        }
        return array();
    }

    public function js() {
        if (is_array($this->_assets) && array_key_exists('js', $this->_assets)) {
            return $this->_assets['js'];
        }
        return array();
    }
}
