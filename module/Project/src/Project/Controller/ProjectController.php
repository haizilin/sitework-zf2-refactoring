<?php
namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model;
class ProjectController extends AbstractActionController
{
    public function indexAction () {

        $view = new ViewModel();

        $sidebar = new ViewModel();
        $prjModel = new Model\Project;
        $teasers = $prjModel->getTeaser()->find();
        // \Zend\Debug\Debug::dump($teasers);die;
        $sidebar->setVariable('project', $teasers);
        $sidebar->setTemplate('project/partials/sidebar.project.teaser.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');




        return new ViewModel();
    }

    public function detailsAction () {
        $sidebar = new ViewModel();
        $sidebar->setTemplate('project/partials/sidebar.project.details.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');
        return new ViewModel();
    }

    public function addAction () {
        return new ViewModel();
    }

    public function editAction () {
        return new ViewModel();
    }

    public function deleteAction () {
        return new ViewModel();
    }
}
