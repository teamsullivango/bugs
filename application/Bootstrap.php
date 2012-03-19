<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initView()
	{
		$view = new Zend_View();
		$view->doctype('XHTML1_STRICT');
		$view->headTitle('Zend CMS');
		$view->skin = 'blues';
		
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
			'ViewRenderer'
		);
		
		$viewRenderer->setView($view);
		return $view;
	}

	protected function _initAutoload()
	{
		$autoLoader = Zend_Loader_Autoloader::getInstance();
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
			'basePath'		=>	APPLICATION_PATH,
			'namespace'		=>	'',
			'resourceTypes'	=>	array(
				'form'	=>	array(
					'path'		=>	'forms/',
					'namespace'	=>	'Form_'
				)
			)
		));
		return $autoLoader;		
	}
}

