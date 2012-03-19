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
    	echo "we made a bugmodel successfully";
    	 
    	$formBugReport = new Form_BugReportForm();
    	$formBugReport->setAction('/bug/submit');
    	$formBugReport->setMethod('post');
    	if ($this->getRequest()->isPost())
    	{
    		if ($formBugReport->isValid($_POST))
    		{
    			try {
    				$bugModel = new Model_Bug();
    				$result = $bugModel->createBug(
    				$formBugReport->getValue('author'),
    				$formBugReport->getValue('email'),
    				$formBugReport->getValue('date'),
    				$formBugReport->getValue('url'),
    				$formBugReport->getValue('description'),
    				$formBugReport->getValue('priority'),
    				$formBugReport->getValue('status')
    				);
    				 
    				if($result)
    				{
    					$this->_forward('confirm');
    				}
    			} catch (Exception $e) {
    				echo "<pre>";
    				echo $e->getTraceAsString();
    				echo "</pre>";
    			}

    		}
    	}
    	$this->view->form = $formBugReport;
    }

    public function confirmAction()
    {
        // action body
    }


}







