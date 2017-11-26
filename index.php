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


Html :: getHeaderMessage('Record from accounts for ID = 1');
$id = 1;
$record = Accounts :: fetchById($id);
Htmltablerenderer :: displayTable($record);

Html :: getHeaderMessage('Record from todos for ID = 1');
$id = 1;
$record = todos :: fetchById($id);
Htmltablerenderer :: displayTable($record);


$records = Accounts :: findAll();
Html :: getHeaderMessage('All records from accounts:');
Htmltablerenderer :: displayTable($records);

$records = todos :: findAll();
Html :: getHeaderMessage('All records from todos:');
Htmltablerenderer :: displayTable($records);

//Updating record in todo
$todo = new Todo();
$todo->id = 3;
$todo->owneremail = 'update1new@yahoo.com' ;
$todo->ownerid = 2 ;
$todo->createddate = '2017-01-01 00:00:00' ;
$todo->duedate = '2017-02-01 00:00:00' ;
$todo->message = 'test' ;
$todo->isdone = 0;
Html :: getHeaderMessage('Updated Record in todos ');
$todo->save();

$todo = new Todo();
$todo->owneremail = 'test1@yahoo.com' ;
$todo->ownerid = 3 ;
$todo->createddate = '2017-04-01 00:00:00' ;
$todo->duedate = '2017-05-01 00:00:00' ;
$todo->message = 'test1' ;
$todo->isdone = 0;
Html :: getHeaderMessage('Added Record in todos ');
$todo->save();

$todo = new Todo();
$todo->owneremail = 'test2@yahoo.com' ;
$todo->ownerid = 4 ;
$todo->createddate = '2017-05-01 00:00:00' ;
$todo->duedate = '2017-06-01 00:00:00' ;
$todo->message = 'test2' ;
$todo->isdone = 0;
Html :: getHeaderMessage('Added Record in todos </br> ');
$idToDelete = $todo->save();
$records = todos :: findAll();
Html :: getHeaderMessage('All records from todos after adding new records:');
Htmltablerenderer :: displayTable($records);

todos :: deleteById($idToDelete);
#Accounts :: deleteById(13);
