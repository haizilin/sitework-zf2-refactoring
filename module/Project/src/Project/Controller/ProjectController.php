<?php
namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model;
use Propel;
use Zend\Debug\Debug;

Propel::autoload('Criteria');

class ProjectController extends AbstractActionController
{
    public function indexAction () {
        $prjModel = new Model\Project;
        $p1 = $prjModel->getQuery()->orderByFinishedAt('desc')->orderByStartedAt('desc');
        $p2 = $prjModel->getQuery()->orderByFinishedAt('desc')->orderByStartedAt('desc');
        $p3 = $prjModel->getQuery()->orderByFinishedAt('desc')->orderByStartedAt('desc');

        $sidebar = new ViewModel();
        $sidebar->setVariable('sidebarProjects', $p1->filterByFinishedAt(null, \Criteria::ISNOTNULL)->offset(3)->limit(5)->find());
        $sidebar->setTemplate('project/partials/sidebar.project.teaser.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');

        $view = new ViewModel();
        $view->setVariable('currentProjects', $p2->filterByFinishedAt(null, \Criteria::ISNULL)->limit(2)->find());
        $view->setVariable('rescentProjects', $p3->filterByFinishedAt(null, \Criteria::ISNOTNULL)->limit(2)->find());

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
