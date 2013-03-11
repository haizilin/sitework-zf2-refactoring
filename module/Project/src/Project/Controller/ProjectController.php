<?php
namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model;
use Zend\Debug\Debug;

class ProjectController extends AbstractActionController
{
    public function indexAction () {
        $view = new ViewModel();
        $sidebar = new ViewModel();
        $prjModel = new Model\Project;
        $projects = $prjModel->getTeaser()->find();
        $sidebar->setVariable('projects', $projects);
        $sidebar->setTemplate('project/partials/sidebar.project.teaser.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');
        return $view;
    }

    public function detailsAction () {
        $view = new ViewModel();
        $sidebar = new ViewModel();
        $sidebar->setTemplate('project/partials/sidebar.project.details.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');
        return $view;
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
