<?php
class Model_Bug extends Zend_Db_Table_Abstract
{
	/*
	create table bugs (
		id int(11) unsigned not null auto_increment comment 'Bug id number',
		author varchar(250) default null comment 'author of the bug',
		email varchar(250) default null comment 'email address of the author',
		date int(11) default null comment 'date the bug occured',
		url varchar(250) default null comment 'issue url',
		description text comment 'description of bug symptomes',
		priority varchar(50) default null comment 'the priority having this bug fixed',
		status varchar (50) default null commnet 'the stage of this fix for this bug',
		primary key (id)
	)
	*/
	
	
	protected $_name = 'bugs';
	
	public function createBug($author, $email, $date, $url, $description, $priority, $status) 
	{
		$row = $this->createRow();
		
		$row->author 		= 	$author;
		$row->email			=	$email;
		$dateObject			=	new Zend_Date($date);
		$row->date			=	$dateObject->get(Zend_Date::TIMESTAMP);
		$row->url			=	$url;
		$row->description	=	$description;
		$row->priority		=	$priority;
		$row->status		=	$status;
		
		$id = $row->save();
				
		return $id;
	}
	
	public function fetchPaginatorAdapter($filters = array(), $sortField = null, $limit = null, $page = 1) 
	{
		$select = $this->select();
		if (count($filters) > 0)
		{
			foreach ($filters as $field => $filter)
			{
				$select->where($field . '=?', $filter);
			}
		}
		
		if (null != $sortField)
		{
			$select->order($sortField);
		}
		
		$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
		return $adapter;
	}
	
	public function updateBug($id, $author, $email, $date, $url, $description, $priority, $status) 
	{
		$row = $this->find($id)->current();
		
		if ($row)
		{
			// set the row data
			$row->author = $author;
			$row->email = $email;
			$d = new Zend_Date($date);
			$row->date = $d;
			$row->url = $url;
			$row->description = $description;
			$row->priority = $priority;
			$row->status = $status;
			
			$row->save();			
		}
		else {
			// I reason that creating a row doesn't have much risk of failing, unless the db isn't connected, which
			// we wouldn't handle in the model anyway. but if we wanted to write to a specific row, but it didn't exist
			// that's possible, and we should handle that exception. I think.
			throw new Zend_Exception("Update function failed; could not find bug! Row not found.");
		}
	}

	public function deleteBug($id) 
	{
		$row = $this->find($id)->current();
		if ($row)
		{
			$row->delete();
			return true;
		}
		else
		{
			throw new Zend_Exception("Delete function failed; could not find bug! Row not found.");
		}
	}
}