<?php
require_once("db.php");
$db=new WJRdb();
$db->connect();
if($_GET['pwd']){
	if($_GET['pwd']==1){
		$user=$db->query("select userid from user where username='".$_POST['username']."' and password='".$_POST['password']."'");
		if($user)echo $user['userid'];
	}else if($_GET['pwd']==2){
		$userid=$db->query("insert into user (username,password) values ('".$_POST['username']."','".$_POST['password']."')",1);
		echo $userid;
	}
	$_SESSION=array(
		"userid"=>$user['userid']|$userid,
		"time"=>time(),
	);
}else{
	$user=$db->query("select userid from user where username='".$_POST['username']."'");
	if($user)echo $user['userid'];
}
?>