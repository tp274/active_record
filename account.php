<?php

class account extends model {
	public $id;
	public $email;
	public $fname;
	public $lname;
	public $phone;
	public $birthday;
	public $gender;
	public $password;

	public static function getTablename(){
          $tableName = 'accounts';
	  return $tableName;
	}
}
