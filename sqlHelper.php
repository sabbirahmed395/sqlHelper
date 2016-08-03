<?php

class sqlHelper {
	public static function bind(array $array = [], $dilimiter = "AND") {
		if(count($array) === 0) {
			throw new Exception("Please passes an array, that contain column name as key and value as value");
		}
		$keys = array_keys($array);
		$clause = "`".$keys[0]."`='".$array[$keys[0]]."'";
		if(count($array)>1) {
			for($i=1;$i<=count($array)-1;$i++) {
				$clause .= " ".$dilimiter." `".$keys[$i]."`='".$array[$keys[$i]]."'";
			}
		}
		return $clause;
	}
	
	public static function serialize(array $array, $type) {
		if(count($array) === 0) {
			throw new Exception("Please passes an array, that contain column name as key and value as value");
		}
		if($type==="value") {
			$keys = array_keys($array);
			$clause = "`".$array[$keys[0]]."`";
			if(count($array) > 1) {
				for($i=1;$i<=count($array)-1;$i++) {
					$clause .= ", `".$array[$keys[$i]]."`";
				}
			}
		}
		
		if($type==="key") {
			$keys = array_keys($array);
			$clause = "`".$keys[0]."`";
			if(count($keys) > 1) {
				for($i=1;$i<=count($keys)-1;$i++) {
					$clause .= ", `".$keys[$i]."`";
				}
			}
		}
		
		return $clause;
	}
	
	
	public static function select($table, array $data, $where=[], $limit=1) {
		if(is_array($where) === FALSE) {
			$limit = $where;
			$where=[];
		}
		
		$clause = "SELECT ".sqlHelper::serialize($data, 'value')." FROM `".$table."`";
		
		if(count($where)>0){
			$clause .= " WHERE ".sqlHelper::bind($where);
		}
		if($limit !== "*") {
			$clause .= " LIMIT ".$limit;
		}
		
		return $clause;
	}
	
	public static function update($table, array $data, array $where) {
		return "UPDATE `".$table."` SET ".sqlHelper::bind($data, ',')." WHERE ".sqlHelper::bind($where);
	}
	
	public static function insert($table, array $data) {
		return "INSERT INTO `".$table."` (".sqlHelper::serialize($data, 'key').") VALUES (".sqlHelper::serialize($data, 'value').")";
	}
	
	public static function delete($table, array $where, $limit=1) {
		$clause = "DELETE FROM `".$table."` WHERE ".sqlHelper::bind($where);
		if($limit !== "*") {
			$clause .= " LIMIT ".$limit;
		}
		return $clause;
	}
}
