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
        $projects = $prjModel->getQuery()->limit(10)->find();
        $sidebar->setVariable('projects', $projects);
        $sidebar->setTemplate('project/partials/sidebar.project.teaser.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');
        return $view;
    }

    public function detailsAction () {

        $prjModel = new Model\Project;

        $sidebar = new ViewModel();
        $projects = $prjModel->getQuery()->find();
        $sidebar->setVariable('projects', $projects);
        $sidebar->setTemplate('project/partials/sidebar.project.teaser.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');

        $view = new ViewModel();
        $project = $prjModel->getQuery()->findOneBy('id', $this->getEvent()->getRouteMatch()->getParam('id', 1));
        $view->setVariable('project', $project);

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
