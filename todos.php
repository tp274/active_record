<?php

class todos extends collection {
	protected static $modelName = 'todo';

	static public function save($todo){
	  $conn = dbConnection::getConnection();
	  if(isset($todo->id)){
	    self :: update($todo,$conn);
	  }else {
	    return self :: insert($todo,$conn);
	  }
	}

	
	static public function update($todo,$conn){
	 $tableName = get_called_class();
	 $sql = 'UPDATE ' . $tableName. '  set  owneremail = :owneremail,ownerid = :ownerid,createddate=:createddate,
	         duedate=:duedate,message= :message,isdone=:isdone  where id = :id';
	try{
	$conn->beginTransaction();  
	$update = $conn -> prepare($sql);
	$update -> bindValue (':id', $todo->id);
	$update -> bindValue(':owneremail', $todo->owneremail);
	$update -> bindValue(':ownerid', $todo->ownerid);
	$update -> bindValue(':createddate', $todo->createddate);
	$update -> bindValue(':duedate', $todo->duedate);
	$update -> bindValue(':message', $todo->message);
	$update -> bindValue(':isdone', $todo->isdone);
	$update -> execute();
	print "Updated Successfully"; 
	$conn-> commit();
	} catch(PDOExecption $e) { 
	  $conn->rollback(); 
	 print "Error!: " . $e->getMessage() . "</br>"; 
	} 
   }

	static public function insert($todo,$conn){
	  $tableName = get_called_class();
          $sql = 'INSERT INTO ' . $tableName. '   (owneremail,ownerid,createddate,duedate,message,isdone) VALUES
  	   (:owneremail,:ownerid,:createddate,:duedate,:message,:isdone)';
	  try{
	    $conn->beginTransaction();  
	    $update = $conn -> prepare($sql);
	    $update -> bindValue(':owneremail', $todo->owneremail);
	    $update -> bindValue(':ownerid', $todo->ownerid);
	    $update -> bindValue(':createddate', $todo->createddate);
	    $update -> bindValue(':duedate', $todo->duedate);
	    $update -> bindValue(':message', $todo->message);
	    $update -> bindValue(':isdone',$todo->isdone);
	    $update -> execute();
	    $lastId = $conn->lastInsertId();
	    print 'Record inserted successfully with id :'. $lastId; 
	    $conn-> commit();
	    return $lastId;
	    }
	   catch(PDOExecption $e) {
	    $conn->rollback();	
	    print "Error!: " . $e->getMessage() . "</br>"; 
	    } 
         }

}
