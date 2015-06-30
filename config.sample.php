<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 6/30/2015
 * Time: 10:29 AM
 */
class Config {
	const HOST = "localhost"; // Host name
	const USERNAME = "username"; // Mysql username
	const DATABASE = "dbName"; // Database name
	private static $password = 'password'; // Mysql password

	public function __construct(){}
}
?>