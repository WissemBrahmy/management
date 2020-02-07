<?php 
require "config/db.php";
require "Models/DB.php";
require "Models/Back.php";

	use back\Models\backEnd\Back as Back;
if(isset($_POST["login"])){
	

	$admin=new Back();
	$error=$admin->login((object)$_POST);


}


?>
<style>

.container{
	margin:0 auto;
	padding:0;
	text-align:center;
	margin-top:10%;
	font-family: arial;
	background-color:#ddd;
	width:40%;
	height:40%;
	padding:10px;
	line-height: 30px;
	border-radius:5px;
	display:flex;


}
label{
	font-weight: normal;
}
input{
	height: 30px;
	margin:5px;
	padding:5px;
	border-radius:5px;


}
input[type="submit"]{
	margin-top:20px;
	background-color: #a8d;
	border-radius: 5px;
	border-color:#000;
font-weight:bold;
	padding:5px;
	cursor:pointer;
	width:70px;
}
input[type="submit"]:hover{
	
	background-color: #fff;
	width:150px;
	height: 50px;
	
}
.errors{
	font-size:14px;
}
label{
	font-family:arial;
	font-weight: bold;

}
.content{
	margin: auto;
	

}








</style>

<div class="container">
<div class="content">
<form method="post">
<label> Login</label><br>
<input type="text" name="login" placeholder="Login">
<br>
<label>Password</label>
<br> <input type="password" name="password" placeholder="Password">
<br>
<input type="submit" value="Login">


</form>
<div class="errors">
<?php if(isset($error)){
	echo $error;

}
?>
</div>

	
</div>
</div>
