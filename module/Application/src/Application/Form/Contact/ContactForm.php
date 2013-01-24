<?php
namespace Application\Form\Contact;

use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\Form\Form;

class ContactForm extends Form
{
    public function prepareElements() {

        $name = new Element\Text('name', array('label' => 'Your name'));
        $name->setAttributes(array('size' => 30));
        $name->setLabelAttributes(array('class' => 'txt name'));

        $email = new Element\Email('email', array('label' => 'Your email address'));
        $email->setAttributes(array('size' => 30));
        $email->setLabelAttributes(array('class' => 'txt email'));

        $sender = new Fieldset('sender');
        $sender->add($name);
        $sender->add($email);
        $this->add($sender);

        $date = new Element\Date('date', array('label' => 'Date'));
        $date->setLabelAttributes(array('class' => 'txt date'));
        $subject = new Element\Text('subject', array('label' => 'Subject'));
        $subject->setLabelAttributes(array('class' => 'txt subject'));

        $details = new Fieldset('details');
        $details->add($date);
        $details->add($subject);
        $this->add($details);

        $message = new Element\Textarea('message',array('label' => 'Message'));
        $message->setAttributes(array('rows' => 5, 'cols' => 34, 'class' => ''));
        $message->setLabelAttributes(array('class' => 'txt message'));
        $this->add($message);

        $submit = new Element\Button('submit');
        $submit->setLabel('Submit');
        //$submit->setEscape(false);
        $submit->setAttributes(array(
            'type' => 'submit'));
        $submit->setLabelAttributes(array('class' => 'btn'));
        $this->add($submit);
    }
}
