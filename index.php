<?php
//turn on debugging messages
ini_set('display_errors', 'true');
error_reporting(E_ALL);

//instantiate the program object
//Class to load classes it finds the file when the progrm starts to fail for calling a missing class
class Manage {

    public static function autoload($class) {
                //you can put any file name or directory here
	include strtolower($class) . '.php';
	}			 	
}

spl_autoload_register(array('Manage', 'autoload'));

//include config file with db information

require('./phpconfig.php');


Html :: getHeaderMessage('Record from Accounts for ID = 1');
$id = 1;
$record = Accounts :: getAccountsById($id);
AccountRenderer :: displayRecords($record);

$records = Accounts :: findAll();
Html :: getHeaderMessage('All records from Accounts:');
AccountRenderer :: displayRecords($records);

$records = todos :: findAll();
Html :: getHeaderMessage('All records from todos:');
#AccountRenderer :: displayRecords($records);


$todo = new Todo();
#$todo->id = 17;
$todo->ownerEmail = 'new@yahoo.com' ;
$todo->ownerId = 2 ;
$todo->createdDate = '2017-01-01 00:00:00' ;
$todo->dueDate = '2017-02-01 00:00:00' ;
$todo->message = 'test' ;
$todo->isDone = 0;
Html :: getHeaderMessage('Inserted Record in todos ');
todos :: save($todo);
//Can delete by id for accounts and todos
#todos :: deleteById(16);
#Accounts :: deleteById(13);
