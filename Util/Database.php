<?php
/**
 * This file is responsible for initializing the database connection handle used
 * throughout the application.
 * 
 * @package GroceryList
 * @author Jose Fernando Lopez Fernandez
 * @license GPLv3
 */

/**
 * Import the configuration file.
 */
require_once('Util/Configuration.php');

/**
 * This is the main database handle object through which all database calls are
 * made. This file takes care of the initialization of the handle as soon as the
 * file is imported.
 */
$db = null;

/**
 * This function contains all of the necessary code for initializing the
 * database connection handle. At the moment there is no semblance of error-
 * handling; the application will simply die if it fails to connect.
 * 
 * @return \PDO Database connection handle object
 */
function initializeDatabaseConnection() : \PDO {
    /**
     * This local variable shadows the database handle with the same name in the
     * larger lexical scope.
     */
    $db = null;

    try {
        $host = DATABASE_HOST;
        $name = DATABASE_NAME;

        $db = new \PDO("mysql:host=$host;dbname=$name;charset=utf8", DATABASE_USER, DATABASE_PASS);
    } catch (\PDOException $pdoException) {
        die($pdoException->getMessage());
    }

    return $db;
}

/**
 * Actually call the database initialization function.
 */
$db = initializeDatabaseConnection();
