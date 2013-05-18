<?php
namespace Application\Navigation\Service;
use Zend\Navigation\Navigation;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\AbstractNavigationFactory;

class SocialNavigationFactory extends AbstractNavigationFactory
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'social';
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $pages = $this->getPages($serviceLocator);
        return new Navigation($pages);
    }
}
