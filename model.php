<?php

abstract class model {

protected $tableName;

	public function save(){
	  if (isset($this->id)) {
	    $sql = $this->update();
	  } else {
	    $sql = $this->insert();
	  }
	  $db = dbConnection::getConnection();
	  $statement = $db->prepare($sql);
	  $array = get_object_vars($this);
	  unset($array['tableName']);
	  foreach ($array as $key=>$value){
	    $statement->bindParam(":$key", $this->$key);
	  }
	  $statement->execute();
	  $id = $db->lastInsertId();
          return $id;
       }

	private function insert() {      
	  $modelName = get_called_class();
	  $tableName = $modelName::getTablename();
	  $array = get_object_vars($this);
	   unset($array['tableName']);
    	  $columnString = implode(',',array_keys($array));
	  $valueString = ':'.implode(',:', array_keys($array));
          $sql =  'INSERT INTO '.$tableName.' ('.$columnString.') VALUES ('.$valueString.')';
	  return $sql;
  	}

	private function update() {  
	  $modelName=get_called_class();
	  $tableName = $modelName::getTablename();
	  $array = get_object_vars($this);
	   unset($array['tableName']);
	  $comma = " ";
	  $sql = 'UPDATE '.$tableName.' SET ';
	  foreach ($array as $key=>$value){
	    if( ! empty($value)) {
	    $sql .= $comma . $key . ' = "'. $value .'"';
	    $comma = ", ";
	    }
	  }
	  $sql .= ' WHERE id='.$this->id;
	  return $sql;
	}
	
	
	static public function deleteById() {
	  $db = dbConnection::getConnection();
	  $tableName = get_called_class();
	  $sql = 'DELETE FROM ' . $tableName  . ' where id = :id';
	  try {
	     $statement = $db->prepare($sql);
	     $statement->bindParam(':id',$this->id);
	     $statement->execute();
	     echo 'Record deleted Sucessfully for Id :' .$this->id;
	     }catch (PDOException $e){
	     echo 'Error while deleting the record';
	  }
	}
}
