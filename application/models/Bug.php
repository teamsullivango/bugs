<?php
class Model_Bug extends Zend_Db_Table_Abstract
{
// 	create table bugs (
// 		id int(11) unsigned not null auto_increment comment 'Bug id number',
// 		author varchar(250) default null comment 'author of the bug',
// 		email varchar(250) default null comment 'email address of the author',
// 		date int(11) default null comment 'date the bug occured',
// 		url varchar(250) default null comment 'issue url',
// 		description text comment 'description of bug symptomes',
// 		priority varchar(50) default null comment 'the priority having this bug fixed',
// 		status varchar (50) default null commnet 'the stage of this fix for this bug',
// 		primary key (id)
// 	)
	
	
	protected $_name = 'bugs';
	
	public function createBug($author, $email, $date, $url, $description, $priority, $status) {
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
}