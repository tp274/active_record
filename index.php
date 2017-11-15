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
$records = Accounts :: findAll();
echo "<h1> All records from Accounts: <h1>";
AccountRenderer :: displayRecords($records);
echo "<h1> Record from Accounts for ID = 1 <h1>";
$id = 1;
$record = Accounts :: getAccountsById($id);
AccountRenderer :: displayRecords($record);

