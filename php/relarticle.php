<?php
require_once("db.php");
$db=new WJRdb();
$db->connect();
$user=$db->query("select * from user where userid='".$_SESSION['userid']."'");
$username=$user['username'];
$title=$_POST['title'];
$content=$_POST['content'];
$time=time();$db->query("insert into article (title,content,time,writer) values ('{$title}','{$content}','{$time}','{$username}')");
$time=time();$articles=$db->query("select * from article where time>'".$_SESSION['time']."' and time<='{$time}' order by articleid desc",0);
$_SESSION['time']=$time;
foreach($articles as $article)
{
    $article['time']=date("Y-m-d H:m:s",$article['time']);
    $comments=$db->query("select * from comment where articleid='".$article['articleid']."' order by time");
    $pics=$db->query("select * from pic where articleid='".$article['articleid']."'",0);
    $cnt=min(array(intval(sqrt(count($pics)))+1,3));
?>
    <div class="block article" name=<?php echo "{$article['writer']}";?> id=<?php echo "part".$article['articleid'];?> style="display:none;">
        <div class="block pointer" id=<?php echo "article".$article['articleid'];?> >
            <p class="article_title"><?php echo $article['title'];?></p>
            <p class="article_sub_title"><?php echo $article['time'];?> | 作者：<?php echo $article['writer'];?></p>
            <p class="article_abstract"><?php echo $article['content'];?></p>
            <div class="article_img">
<?php
            foreach($pics as $pic)
            {
?>
                <div <?php echo "class='img_".$cnt."' style='background:url(".$pic['path'].") no-repeat transparent center'";?>></div>
<?php
            }
?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="block" id=<?php echo "response".$article['articleid'];?> style="display:none;">
            <p class="article_title">评论区</p>
<?php
        foreach($comments as $comment)
        {
            $comment['time']=date("Y-m-d H:m:s",$comment['time']);
?>
            <div class="comment">
                <img src="src/userpic.gif" class="comment_img">
                <p class="comment_time"><?php echo $comment['time'];?></p>
                <p class="user_name"><?php echo $comment['writer'];?></p>
                <p class="comment_content"><?php echo $comment['content'];?></p>
            </div>
<?php
        }
?>
        </div>
    </div>
<?php
}
?>