<?php

abstract class CMS_Content_Item_Abstract 
{
	public $id;
	public $author;
	public $parent_id = 0;
	
	protected $_namespace = 'page';
	protected $_pageModel;

	const N0_SETTER = 'setter method does not exist';
	
	public function __construct($pageId = NULL) 
	{
		$this->_pageModel = new Page();
		if(null != $pageId)
		{
			$this->loadPageObject(intval($pageId));
		}
	}
	
	protected function _getInnerRow($id = null) 
	{
		if ($id == null) 
		{
			$id = $this->id;
		}
		return $this->_pageModel->find($id)->current();
	}
	
	protected function _getProperties() 
	{
		$propertyArray = array();
		$class = new Zend_Reflection_Class($this);
		$properties = $class->getProperties();
		foreach ( $properties as $property )
		 {
			if ($property->isPublic()) 
			{
				$propertyArray[] = $property->getName();
			}
		}
		return $propertyArray;
	}
	
	protected function _callSetterMethod ($property, $data)
	{
		$method = Zend_Filter::filterStatic($property, 'Word_UnderscoreToCamelCase');
		$methodName = '_set' . $method;
		if (method_exists($this, $methodName))
		{
			return $this->$methodName($data);
		}
		else {
			return self::N0_SETTER;
		}
	}
	
	public function loadPageObject($id)
	{
		$this->id = $id;
		$row = $this->_getInnerRow();
		if($row)
		{
			if ($row->name) 
			{
				;
			}
		}
	}
}