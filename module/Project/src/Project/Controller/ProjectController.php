<?php
namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model;
use Zend\Debug\Debug;

class ProjectController extends AbstractActionController
{
    public function indexAction () {
        $prjModel = new Model\Project;
        $projects = $prjModel->getQuery()->limit(10)->find();

        $sidebar = new ViewModel();
        $sidebar->setVariable('projectsCollection', $projects);
        $sidebar->setTemplate('project/partials/sidebar.project.teaser.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');

        $view = new ViewModel();
        $view->setVariable('projectsCollection', $projects);

        return $view;
    }

    public function detailsAction () {
        $prjModel = new Model\Project;
        $projects = $prjModel->getQuery()->find();

        $sidebar = new ViewModel();
        $sidebar->setVariable('projectsCollection', $projects);
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
