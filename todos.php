<?php

class todos extends collection {
	protected static $modelName = 'todo';

	static public function save($todo){
	  $conn = dbConnection::getConnection();
	  $tableName = get_called_class();
	  if(isset($todo->id)){
	    self :: update($todo,$conn,$tableName);
	  }else {
	    self :: insert($todo,$conn,$tableName);
	  }
	}

	
	static public function update($todo,$conn,$tableName){
	 $sql = 'UPDATE ' . $tableName. '  set  owneremail = :owneremail,ownerid = :ownerid,createddate=:createddate,
	         duedate=:duedate,message= :message,isdone=:isdone  where id = :id';
echo $sql;
	try{
	$conn->beginTransaction();  
	$update = $conn -> prepare($sql);
	$update -> bindValue (':id', $todo->id);
	$update -> bindValue(':owneremail', $todo->ownerEmail);
	$update -> bindValue(':ownerid', $todo->ownerId);
	$update -> bindValue(':createddate', $todo->createdDate);
	$update -> bindValue(':duedate', $todo->dueDate);
	$update -> bindValue(':message', $todo->message);
	$update -> bindValue(':isdone', $todo->isDone);
	$update -> execute();
	print "Updated Successfully"; 
	$conn-> commit();
	} catch(PDOExecption $e) { 
	  $conn->rollback(); 
	 print "Error!: " . $e->getMessage() . "</br>"; 
	} 
   }

	static public function insert($todo,$conn,$tableName){
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
	    $update -> bindValue(':isdone',$todo->isDone);
	    $update -> execute();
	    print $conn->lastInsertId(); 
	    $conn-> commit();
	    }
	   catch(PDOExecption $e) {
	    $conn->rollback();	
	    print "Error!: " . $e->getMessage() . "</br>"; 
	    } 
         }

}
