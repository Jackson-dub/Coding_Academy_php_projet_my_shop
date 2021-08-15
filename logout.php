<?php
include 'bootstrap';
session_start();
session_unset();
session_destroy();
setcookie('user_id', NULL, time() - 100);
setcookie('user_token', NULL, time() - 100);
header('Location: index.php');
