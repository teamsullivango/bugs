<?php
class Model_Page extends Zend_Db_Table_Abstract
{
	protected $_name = 'pages';
	
	protected $_dependentTables = array('Model_ContentNode');
	
	protected $_referenceMap = array(
		'Page' => array(
			'columns'		=>	array('parent_id'),
			'refTableClass'	=>	'Model_Page',
			'refColumns'	=>	array('id'),
			'onDelete'		=>	self::CASCADE,
			'onUpdate'		=>	self::RESTRICT
		)
	);
	
	function createPage($name, $namespace, $parentId = 0) 
	{
		$row = $this->createRow();
		$row->name = $name;
		$row->namespace = $namespace;
		$row->parent_id = $parentId;
		$row->date_created = time();
		$row->save();
		
		//now fetch the id of the row you just created and return it
		$id = $this->_db->lastInsertId();
		return $id;
	}
	
	public function updatePage($id, $data) 
	{
		$row = $this->find($id)->current();
		if ($row) 
		{
			//update each of the columns taht are stored in the pages table
			$row->name = $data['name'];
			$row->parent_id = $data['parent_id'];
			$row->save();
			
			//unset each of the fields that are set in the content_nodes table
			if (count($data) > 0) 
			{
				$mdlContentNode = new Model_ContentNode();
				foreach ( $data as $key => $value )
				 {
					$mdlContentNode->setNode($id, $key, $value);
				}
			}
		}
		else
		{
			throw new Zend_Exception('Could not open page to update!');
		}
	}
	
	public function deletePage($id) 
	{
		$row = $this->find($id)->current();
		if ($row) 
		{
			$row->delete();
			return true;
		}
		else
		{
			throw new Zend_Exception('Delete function failed; could not find page');
		}
	}
	/*
	create table pages (
	id int(11) not null auto_increment,
	parent_id in(11) default null,
	namespace varchar(50) default null,
	name varchar(100) default null,
	date_created int(11) default null,
	primary key (id)
	) default charset=utf8;
	*/
}
