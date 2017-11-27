<?php
require_once("db.php");
$db=new WJRdb();
$db->connect();
$user=$db->query("select * from user where userid='".$_SESSION['userid']."'");
$username=$user['username'];
$title=$_POST['title'];
$content=$_POST['content'];
$time=time();$db->query("insert into article (title,content,time,comments,writer) values ('{$title}','{$content}','{$time}','0','{$username}')");
$time=time();$articles=$db->query("select * from article where time>'".$_SESSION['time']."' and time<='{$time}' order by articleid desc",0);
$_SESSION['time']=$time;
foreach($articles as $article)
{
    $article['time']=date("Y-m-d H:m:s",$article['time']);
print<<<WJR
    <div class="block article" name="{$article['writer']}" id="part{$article['articleid']}" style="display:none;">
        <div class="block pointer" id="article{$article['articleid']}">
            <p class="article_title">{$article['title']}</p>
            <p class="article_sub_title">{$article['time']} | 作者：{$article['writer']}</p>
            <p class="article_abstract">{$article['content']}</p>
            <div class="article_btns">
                <button type="button" class="btn btn-info">评论({$article['comments']})</button>
                <button type="button" class="btn btn-info">阅读原文</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block" id="response{$article['articleid']}" style="display:none;">
        <p class="article_title">评论区</p>
            <div class="comment">
                <img src="src/userpic.gif" class="comment_img">
                <p class="comment_time">2017-09-20 15:20:32</p>
                <p class="user_name">我是谁</p>
                <p class="comment_content">我认为这篇文章写得很好，你们认为呢？</p>
            </div>
            <div class="comment">
                <img src="src/userpic.gif" class="comment_img">
                <p class="comment_time">2017-09-20 15:32:10</p>
                <p class="user_name">李晓红</p>
                <p class="comment_content">我也要为这篇文章点赞。</p>
            </div>
        </div>
    </div>
WJR;
}

?>