<?php
session_name("managmentSession");
session_start();

use back\Models\backEnd\Back as Back;
if(!isset($_SESSION['id'])){
	require("login.php");
}else{
	if(isset($_GET['logout'])){
		session_destroy();
		echo"<script>location.href='index.php';</script>";
	}

require_once("config/db.php");
require "Models/DB.php";
require_once("Models/Back.php");


$admin=new Back();
if(isset($_GET['controller'],$_GET['action'])&& $_GET['controller']=='api') {
if($_GET['action']=='article_data'){
	$article=$_GET['article'];
	$admin->getDataByArticle($article);
}
if($_GET['action']=='getQuantityByTicket'){
	$article=$_GET['article'];
	$ticket=$_GET['ticket'];
	$admin->getQuantityByTicket($ticket,$article);
}
if($_GET['action']=='mailDailyProduction'){
$admin->mailDailyProduction();
	}
if($_GET['action']=='mailDailyStock'){	
$admin->mailDailyStock();
	}

}

require_once(__DIR__."/Views/header.php");


if(isset($_GET['page'])&&($_GET['page']!='')) {
    if(file_exists(__DIR__."/Views/".$_GET['page'].".php")) {
    require_once(__DIR__."/Views/".$_GET['page'].".php");
}else{
    require(__DIR__."/Views/404.html");
}
} else{
    require_once(__DIR__."/Views/default.php");
}



require_once(__DIR__."/Views/footer.php");
} ?>