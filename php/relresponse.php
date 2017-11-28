<?php
require_once("db.php");
$db=new WJRdb();
$db->connect();
$user=$db->query("select * from user where userid='".$_SESSION['userid']."'");
$time=time();
$db->query("insert into comment (content,time,articleid,writer) values ('".$_POST['content']."','{$time}','".$_POST['articleid']."','".$user['username']."')");
$time=date("Y-m-d H:m:s",$time);
print<<<WJR
<div class="comment">
    <img src="src/userpic.gif" class="comment_img">
    <p class="comment_time">{$time}</p>
    <p class="user_name">{$user['username']}</p>
    <p class="comment_content">{$_POST['content']}</p>
</div>
WJR;
?>