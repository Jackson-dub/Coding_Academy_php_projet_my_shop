<?php
/*
 * FUNCTION FILE IN ORDRE TO STORE ALL USEFUL FUNCTIONS
 */

/*
 * Autoload Classes
 */
function autoloadMyClasses($fullClassName) {
	$pathToClass = str_replace("\\", DIRECTORY_SEPARATOR, $fullClassName);
	$pathToClass = str_replace("Classes", 'classes', $pathToClass);
	include_once ROOT_FOLDER . '/' . $pathToClass. '.class.php';
}

/*
 * SESSION FUNCTION
 */

function getUserSession() {
	$_SESSION['user_id'] = isValidVar($_COOKIE['user_id'], $_SESSION['user_id']);
	$_SESSION['user_token'] = isValidVar($_COOKIE['user_token'], $_SESSION['user_token']);
	if ( isset($_SESSION['user_token']) && isset($_SESSION['user_id']) ) {
		$connect = new Classes\Connect();
		$userManager = new Classes\UserManager($connect->getBdd());
		return ($userManager->getUserByToken($_SESSION['user_id'], $_SESSION['user_token']));
	} else {
		return (NULL);
	}
}

/*
 * Function that return a var is set and not empty
 * returns the default var if not
 */
function isValidVar($var, $default) {
	if (isset($var) && !empty($var))
		return ($var);
	return ($default);
}

//DEBUG FUNCTIONS

function prettyPrintArray(array $array, bool $die = false) {
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	if ($die)
		$die;
}

//PAGING SYSTEM

function Pagin(array $listItem = null){

	echo "<div class='flexContainer numPages' id='numPagesDesktop'>";

	$listItem = ceil(count($listItem) / 10);
	
	for($i = 1; $i <= $listItem; $i++ > 0) {
	   
		if ($i <= 10) {
			echo '<a href='.$_SERVER["PHP_SELF"].'?page='.$i.'><div>' . $i . "</div></a>";
		}
	}
	if ($listItem > 10) {
	   // $numPage + 1;
		echo '<div class=\"nextPage\"><a href=\"#?page='.$i .'title=\"Page suivante\">&GT;</a></div>';
	}

	echo "</div>

<div class='flexContainer numPages' id='numPagesMobile'>";

	 for($i = 1; $i <= $listItem; $i++ > 0) {
		if ($i <= 10) {
			echo '<a href='.$_SERVER["PHP_SELF"].'?page='.$i.'><div>' . $i . "</div></a>";
		}
	}
	if ($listItem > 4) {
		//$numPage = + 1;
		echo '<div class=\"nextPage\"><a href=\"#/?page = '.$i .'title=\"Page suivante\">&GT;</a></div>';
	}
	
echo"</div>";

}

