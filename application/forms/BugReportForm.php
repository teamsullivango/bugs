<?php
class Form_BugReportForm extends Zend_Form
{
	public function init()
	{
		// author textbox
		$author = new Zend_Form_Element_Text('author');
		$author->setLabel('Enter your name:');
		$author->setRequired(TRUE);
		$author->setAttrib('size', 30);
		$this->addElement($author);
		
		// email textbox
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Enter your email');
		$email->setRequired(TRUE);
		$email->addValidator(new Zend_Validate_EmailAddress());
		$email->addFilters(array(
			new Zend_Filter_StringTrim(),
			new Zend_Filter_StringToLower()
		));
		$email->setAttrib('size', 40);
		$this->addElement($email);
		
		// date textbox
		$date = new Zend_Form_Element_Text('date');
		$date->setLabel('Date the issue occured (mm-dd-yyyy):');
		$date->setRequired(TRUE);
		$date->addValidator(new Zend_Validate_Date('MM-DD-YYYY'));
		$date->setAttrib('size', 40);
		$this->addElement($date);
		
		// url textbox
		$url = new Zend_Form_Element_Text('url');
		$url->setLabel('Issue URL:');
		$url->setRequired(TRUE);
		$url->setAttrib('size', 50);
		$this->addElement($url);
		
		// description textarea
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel('Issue Description:');
		$description->setRequired(TRUE);
		$description->setAttrib('cols', 50);
		$description->setAttrib('rows', 4);
		$this->addElement($description);
		
		// priority select box
		$priority = new Zend_Form_Element_Select('priority');
		$priority->setLabel('Issue Priority');
		$priority->setRequired(TRUE);
		$priority->addMultiOptions(array(
			'low'	=>	'Low',
			'med'	=>	'Medium',
			'high'	=>	'High',			
		));
		$this->addElement($priority);
		
		// status select box
		$status = new Zend_Form_Element_Select('status');
		$status->setLabel('Current status:');
		$status->setRequired(TRUE);
		$status->addMultiOption('new','New');
		$status->addMultiOption('in_progress','In Progress');
		$status->addMultiOption('resolved','Resolved');
		$this->addElement($status);
				
		// submit button
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Submit');
		$this->addElement($submit);
	}
}