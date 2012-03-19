<?php
class Form_BugReportListToolsForm extends Zend_Form
{
	public function init() {
		$options = array(
			'0'				=>	'None',
			'priority'		=>	'Priority',
			'status'		=>	'Status',
			'date'			=>	'Date',
			'url'			=>	'URL',	
			'author'		=>	'Submitter'
		);
		$sort = new Zend_Form_Element_Select('sort');
		$sort->setLabel('Sort Records');
		$sort->addMultiOptions($options);
		$this->addElement($sort);
		
		$filterField = new Zend_Form_Element_Select('filter_field');
		$filterField->setLabel('Filter Field');
		$filterField->addMultiOptions($options);
		$this->addElement($filterField);
		
		$filter = new Zend_Form_Element_Text('filter');
		$filter->setLabel('Filter Value:');
		$filter->setAttrib('size', 40);
		$this->addElement($filter);
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Update List');
		$this->addElement($submit);
		
		
	}
}