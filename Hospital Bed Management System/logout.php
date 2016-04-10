<?php
session_start();
include_once('inc/functions.php');

unset($_SESSION['user_id']);
unset($_SESSION['name']);

Redirect('index.php');
?>