<?php
namespace Project\Form;

use Zend\Form\Form;

class ProjectForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('project');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'started_at',
            'attributes' => array(
                'type' => 'date',
            ),
            'options' => array(
                'label' => 'Started',
            ),
        ));

        $this->add(array(
            'name' => 'finished_at',
            'attributes' => array(
                'type' => 'date',
            ),
            'options' => array(
                'label' => 'Finished',
            ),
        ));

        $this->add(array(
            'name' => 'contact_employer_id',
            'attributes' => array(
                'type' => 'select',
            ),
            'options' => array(
                'label' => 'Employer',
            ),
        ));

        $this->add(array(
            'name' => 'contact_client_id',
            'attributes' => array(
                'type' => 'select',
            ),
            'options' => array(
                'label' => 'Client',
            ),
        ));

        $this->add(array(
            'name' => 'url',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'textarea',
                'rows' => 5,
                'cols' => 50,
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));

        $this->add(array(
            'name' => 'state',
            'attributes' => array(
                'type' => 'checkbox',
                'value' => 1,
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));

        $e = new Zend_Form_Element_Button('submit', array(
                'type' => 'button',
                'value' => 'Submit'
        ));
        $this->add($e);

    }
}
