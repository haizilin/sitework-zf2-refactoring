<?php
namespace Project\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Project\Model;
class ProjectController extends AbstractActionController
{
    public function indexAction () {

        $prjModel = new Model\Project;
        $teasers = $prjModel->getTeaser()->find();

        $sidebar = new ViewModel();
        $sidebar->setVariable('project', $teasers);
        $sidebar->setTemplate('project/partials/sidebar.project.teaser.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');

        $content = new ViewModel();
        $content->setVariable('project', $teasers);

        return $content;
    }

    public function detailAction () {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $prjModel = new Model\Project;
        $project = $prjModel->getDetails($id);

        $sidebar = new ViewModel();
        $sidebar->setVariable('project', $project);
        $sidebar->setTemplate('project/partials/sidebar.project.detail.phtml');
        $this->layout()->addChild($sidebar, 'sidebar');

        $content = new ViewModel();
        $content->setVariable('project', $project);

        return $content;
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
