<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/28/2015
 * Time: 4:51 PM
 */
include_once "config.php";
class SQL {
	/**
	 * Uninstantiable
	 */
	private function __construct() {}

	private static $connection = null;

	/**
	 * Gets a connection to the MySQL database.
	 * @throws mysqli_sql_exception
	 * @return mysqli
	 */
	public static function getConnection() {
		if (is_null(SQL::$connection)) {
			SQL::$connection = new mysqli(Config::HOST, Config::USERNAME, Config::$pw, Config::DATABASE);
			SQL::$connection->set_charset('utf8');
		}
		if (SQL::$connection->connect_error)
			throw new mysqli_sql_exception("Failed to connect to database: " . SQL::$connection->connect_error);
		return SQL::$connection;
	}
}
?>