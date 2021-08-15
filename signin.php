<?php
include_once 'bootstrap.php';

$data = array(
	'page'	=>	'Connexion',
	'title'	=>	'Sign In',
	'description'	=>	'Here you can connect to your account',
	'keywords'		=>	'connexion user shop vente ligne commerce',
	'baseDir'		=> dirname(__FILE__)
);

//SI LE FORMULAIRE A ETE ENVOYE
if (isset($_POST) && !empty($_POST)) {
    $connect = new Classes\Connect();
    $userManager = new Classes\UserManager($connect->getBdd());
	$password = hash('sha256', htmlspecialchars($_POST['password']));
	$rememberMe = isValidVar($_POST['remember-me'], false);

    if ($user = $userManager->getUser($_POST['email'], $password)) {
		$user->rememberMe($rememberMe);
    	if ($user->isAdmin() == 1) {
        	header('location: admin.php');
    	} else {
        	header('location: index.php');
    	}
	} else {
		$user = new Classes\User($_POST);
		$user->setErrors("general", "User not found");
	}
}

try {
	$page = new Classes\Controller($data);
	echo $page->getPage(['user' => serialize($user)]);
} catch (Exception $e) {
	echo $e->getMessage();
}

 //Code limite tentative de connexions

//  function getIpAddr(){
// 	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
// 		$ipAddress=$_SERVER['HTTP_CLIENT_IP'];
// 	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
// 		$ipAddress=$_SERVER['HTTP_X_FORWARDED_FOR'];
// 	}else{
// 		$ipAddress=$_SERVER['REMOTE_ADDR'];
// 	}
// 	return $ipAddress;
// }

// $max_attempts=3;

// if(login_attempt_count($max_time, $pdo)<= $max_attempts){
// 	echo "please login". PHP_EOL;
// }else {
// 	echo "You have made too many attempts.". PHP_EOL;
// }
// $data=$_SERVER['REMOTE_ADDR'];
// print_r($data);

// function login_attempt_count($seconds, $pdo){
// $del_old= "DELETE FROM attempts WHERE `When` < ?";
// $oldest = strtotime(date("Y-m-d H:i:s")."-".$seconds." seconds");
// $oldest= date("Y-m-d H:i:s", $oldest);
// $del_data= array($oldest);
// $remove = $pdo->prepare($del_old);
// $remove->execute($del_data);

// $insert="INSERT INTO attempts (`ip`, `when`) VALUES (?, ?)";
// $data=array($_SERVER['REMOTE_ADDR'], date("Y-m-d H:i:s"));
// $input=$pdo->prepare($insert);
// }

$ipAddr=$_SERVER['HTTP_CLIENT_IP'];
print_r($ipAddr);