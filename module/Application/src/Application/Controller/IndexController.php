<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Contact\ContactForm;
use Application\Model;

class IndexController extends AbstractActionController
{
    public function indexAction() {
        $view = new ViewModel();
        $twitter = new Model\Twitter\Twitter($this->getServiceLocator()->get('config'));
        $timelineCollection = new Model\Twitter\TimelineCollection($twitter->statusUserTimeline('sitewalker', 1, 10), 'json');

        $sidebar = new ViewModel();
        $sidebar->setVariable('twitterCollection', $timelineCollection);
        $sidebar->setTemplate('application/partials/sidebar.index.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');

        return $view;
    }

    public function contactAction() {

        $sidebar = new ViewModel();
        $sidebar->setTemplate('application/partials/sidebar.contact.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');

        $form = new ContactForm();
        $form->prepareElements();

        $view = new ViewModel();
        $view->setVariable('form', $form);
        return $view;
    }

    public function imprintAction() {
        $sidebar = new ViewModel();
        $sidebar->setTemplate('application/partials/sidebar.contact.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');
        return new ViewModel();
    }

    public function disclaimerAction() {
        $sidebar = new ViewModel();
        $sidebar->setTemplate('application/partials/sidebar.contact.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');
        return new ViewModel();
    }

    public function twitterAction() {
        return new ViewModel();
    }
}
