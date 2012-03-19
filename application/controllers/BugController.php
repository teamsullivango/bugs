<?php

class BugController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function createAction()
    {
        // action body
    }

    public function submitAction()
    {
    	$formBugReport = new Form_BugReportForm();
    	$formBugReport->setAction('/bug/submit');
    	$formBugReport->setMethod('post');
    	$this->view->form = $formBugReport;
    }


}





