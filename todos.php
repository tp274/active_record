<?php

class todos extends collection {
	protected static $modelName = 'todo';

	static public function insert($todo){
	$conn = dbConnection::getConnection();
	$tableName = get_called_class();
	$sql = 'INSERT INTO ' . $tableName. '   (owneremail,ownerid,createddate,duedate,message,isdone) VALUES
	(:owneremail,:ownerid,:createddate,:duedate,:message,:isdone)';
	try{
	$conn->beginTransaction();  
	$update = $conn -> prepare($sql);
	$update -> bindValue(':owneremail', $todo->ownerEmail);
	$update -> bindValue(':ownerid', $todo->ownerId);
	$update -> bindValue(':createddate', $todo->createdDate);
	$update -> bindValue(':duedate', $todo->dueDate);
	$update -> bindValue(':message', $todo->message);
	$update -> bindValue(':isdone', $todo->isDone);
	$update -> execute();
	print $conn->lastInsertId(); 
	$conn-> commit();
	} catch(PDOExecption $e) { 
	  $conn->rollback(); 
	 print "Error!: " . $e->getMessage() . "</br>"; 
	} 

   
   }

}
