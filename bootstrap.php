<?php
session_start();
/*
 * FILE TO CREATE CONSTANTS AND AUTOLOAD CLASSES
 */

//INCLUDE SQL PARAM
include_once('assets/core/sqlParam.php');

const ADMIN_FORBIDDEN = 1; //Constant for $_GET when try acces admin

//////////// CONSTANTS ///////////////
define("ERROR_LOG_FILE", "errors.log");
define("ROOT_FOLDER", dirname(__FILE__));
define("CLASSES", ROOT_FOLDER.'/classes');
define("LAYOUT", ROOT_FOLDER.'/views/layout');
define("PAGES", ROOT_FOLDER.'/views/pages');
define("FORMS", ROOT_FOLDER.'/views/forms');
define("USER_COOKIE", "user");

//INCLUDE OUR FUNCTION FILE
include_once(ROOT_FOLDER.'/functions.php');

// Load our Class Autoloader
spl_autoload_register('autoloadMyClasses');

//Create a variable SESSION to store page sources
if ( !isset($_SESSION['source']) || !isset($_SESSION['target']) ) {
	$_SESSION['source'] = 'index.php';
} else if ($_SESSION['source'] != $_SESSION['target']) {
	$_SESSION['source'] = $_SESSION['target'];
} else {
	$_SESSION['source'] = 'index.php';
}
$_SESSION['target'] = $_SERVER['REQUEST_URI'];

//Get user if SESSION
$user = getUserSession();
