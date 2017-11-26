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
	  foreach (array_flip($array) as $key=>$value){
	    $statement->bindParam(":$value", $this->$value);
	  }
	  $statement->execute();
	  $id = $db->lastInsertId();
          return $id;
       }

	private function insert() {      
	  $modelName = get_called_class();
	  $tableName = $modelName::getTablename();
	  $array = get_object_vars($this);
    	  $columnString = implode(',', array_flip($array));
	  $valueString = ':'.implode(',:', array_flip($array));
          $sql =  'INSERT INTO '.$tableName.' ('.$columnString.') VALUES ('.$valueString.')';
	  return $sql;
  	}

	private function update() {  
	  $modelName=get_called_class();
	  $tableName = $modelName::getTablename();
	  $array = get_object_vars($this);
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
}
