<?php
class Model_ContentNode extends Zend_Db_Table_Abstract
{

	protected $_name = 'content_nodes';
	
	protected $_referenceMap = array(
		'Page' => array(
			'columns'		=>	array('page_id'),
			'refTableClass'	=>	'Model_Page',
			'refColumns'	=>	array('id'),
			'onDelete'		=> 	self::CASCADE,
			'onUpdate'		=>	self::RESTRICT
		)
	);
	
	function setNode($pageId, $node, $content) 
	{
		//fetch it if it exists
		$select = $this->select();
		$select->where('page_id = ?', $pageId);
		$select->where('node = ?', $node);
		$row = $this->fetchRow($select);
		
		//if it doesn't then create it
		if (!$row) 
		{
			$row = $this->createRow();
			$row->page_id = $pageId;
			$row->node = $node;
		}
		
		$row->content = $content;
		$row->save();		
	}
	
	/*
	 create table content_nodes (
	id int(11) not null auto_increment,
	page_id int(11) default null,
	node varchar(50) default null,
	content text,
	primary key (id)
	)default charset=utf8;
	*/
}