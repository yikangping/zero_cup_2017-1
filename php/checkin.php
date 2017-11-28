<?php
require_once("db.php");
$db=new WJRdb();
$db->connect();
$user=$db->query("select * from user where userid='".$_SESSION['userid']."'");
if($user['today']==0)$db->query("update user set today=1 where userid='".$_SESSION['userid']."'");
echo "已签到".(1+$user['days'])."天";
?>