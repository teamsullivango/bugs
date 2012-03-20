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

    public function listAction()
    {
    	//get the filter form
    	$listToolsForm = new Form_BugReportListToolsForm();
    	$listToolsForm->setAction('/bug/list');
    	$listToolsForm->setMethod('post');
    	$this->view->listToolsForm = $listToolsForm;
    	 
    	//set default values to null
    	$sort = $this->_request->getParam('sort', null);
    	$filterField = $this->_request->getParam('filter_field',null);
    	$filterValue = $this->_request->getParam('filter');
    	
    	if (!empty($filterField))
    	{
    		$filter[$filterField] = $filterValue;
    	}
    	else
    	{
    		$filter = null;
    	}
    	
    	//now, manually set the control values
    	$listToolsForm->getElement('sort')->setValue($sort);
    	$listToolsForm->getElement('filter_field')->setValue($filterField);
    	$listToolsForm->getElement('filter')->setValue($filterValue);
    	
    	//now fetch the bug paginator
    	$bugModel = new Model_Bug();
    	$adapter = $bugModel->fetchPaginatorAdapter($filter, $sort);
    	$paginator = new Zend_Paginator($adapter);
    	
    	//show 10 bugs per page
    	$paginator->setItemCountPerPage(10);
    	
    	$page = $this->_request->getParam('page', 1);
    	$paginator->setCurrentPageNumber($page);

        $this->view->bugs = $paginator;
    }
}









