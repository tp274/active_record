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


Html :: getHeaderMessage('********* CRUD Operations on accounts table.********* </br> Record from accounts for ID = 1');
$id = 1;
$record = Accounts :: fetchById($id);
Htmltablerenderer :: displayTable($record);

$records = Accounts :: findAll();
Html :: getHeaderMessage('All records from accounts:');
Htmltablerenderer :: displayTable($records);


Html :: getHeaderMessage('Updating record in accounts');
$account = new account();
$account->id = 1;
$account->email="newmjlee@njit.edu";
$account->fname="Mike";
$account->lname="Lee";
$account->phone="987654321";
$account->birthday="25-10-1990";
$account->gender="male";
$account->password="12345";
$account->save();
echo 'Record Updated Successfully' ;

//Record 1
$account = new account();
$account->email="lisa@njit.edu";
$account->fname="Lisa";
$account->lname="Morris";
$account->phone="123465656";
$account->birthday="23-12-1985";
$account->gender="female";
$account->password="12345";
$account->save();

//Record 2
$account = new account();
$account->email="chip@njit.edu";
$account->fname="Chip";
$account->lname="Whitmer";
$account->phone="23456778888";
$account->birthday="20-11-1980";
$account->gender="male";
$account->password="12345789";
$lastId = $account->save();


$records = Accounts :: findAll();
Html :: getHeaderMessage('All records from accounts after adding new records');
Htmltablerenderer :: displayTable($records);

//Deleting Record
$account->deleteById($lastId);
$records = Accounts :: findAll();
Html :: getHeaderMessage('All records from accounts after deleting the last record');
Htmltablerenderer :: displayTable($records);


Html :: getHeaderMessage('*********Operations on todos table.********* </br> Record from todos for ID = 1');
$id = 1;
$record = todos :: fetchById($id);
Htmltablerenderer :: displayTable($record);

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
$todo->save();
Html :: getHeaderMessage('Updated Record in todos ');


//Record 1
$todo = new Todo();
$todo->owneremail = 'test1@yahoo.com' ;
$todo->ownerid = 3 ;
$todo->createddate = '2017-04-01 00:00:00' ;
$todo->duedate = '2017-05-01 00:00:00' ;
$todo->message = 'test1' ;
$todo->isdone = 0;
$todo->save();

//Record 2
$todo = new Todo();
$todo->owneremail = 'test2@yahoo.com' ;
$todo->ownerid = 4 ;
$todo->createddate = '2017-05-01 00:00:00' ;
$todo->duedate = '2017-06-01 00:00:00' ;
$todo->message = 'test2' ;
$todo->isdone = 0;
$idToDelete = $todo->save();

Html :: getHeaderMessage('All records from todos after adding new records:');
Htmltablerenderer :: displayTable($records);

//Deleting Record
$todo-> deleteById($idToDelete);
$records = todos :: findAll();
Html :: getHeaderMessage('All records from todos after deleting the last record');
Htmltablerenderer :: displayTable($records);

