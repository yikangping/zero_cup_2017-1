<?php
require_once("php/db.php");
$db=new WJRdb();
$db->connect();
for($i=1;$i<5;$i++)
{
    $time=time()+$i;
    $db->query("insert into comment (content,time,articleid,writer) values ('我认为这篇文章写得很好，你们认为呢？','{$time}','{$i}','bbb')");
    $time+=300;
    $db->query("insert into comment (content,time,articleid,writer) values ('我也要为这篇文章点赞。','{$time}','{$i}','Ivy')");    
}
?>