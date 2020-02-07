<?php
namespace connection;
//singletone pdo instance




use PDO;

class DB {

 private static $db;


 private function __construct() {

 }


 private function constructor() {
 			try{

			self::$db=new PDO(DB_TYPE.":host=".HOST.";dbname=".DBA.";charset=".CHARSET.";",USER,PASSWORD);
			if(DEBUG==TRUE){
		 self::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		 return self::$db;

		} catch(Exception $e){
			if(DEBUG==TRUE){
			die($e->getMessage());
		}
		die("Problem happened...");
		}
	

 }

 public  static function getConnection(){
 	if(empty(self::$db)) {
self::$db=self::constructor();


 	}
 	return self::$db;
 }
}