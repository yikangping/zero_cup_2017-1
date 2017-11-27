<?php
require_once("php/db.php");
if($_SESSION['userid']&&time()-$_SESSION['time']<=900)
{
    $_SESSION['time']=time();
    $db=new WJRdb();
    $db->connect();
    $user=$db->query("select * from user where userid='".$_SESSION['userid']."'");
    $articles=$db->query("select * from article order by articleid desc",0);
}else{
    session_destroy();
    echo "<script>window.location.href='login.html';</script>";
}
?>
<!DOCTYPE html>
<html lang="cn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <title>用户主界面</title>
    <script src="js/jquery-321-min.js" type="text/javascript"></script>
    <script src="js/global.js" type="text/javascript"></script>
    <script src="js/index.js" type="text/javascript"></script>
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="css/global.css" rel="stylesheet">
    <link type="text/css" href="css/index.css" rel="stylesheet">
    <link type="text/css" href="css/nav.css" rel="stylesheet">
    <link type="text/css" href="css/main-left.css" rel="stylesheet">
    <link type="text/css" href="css/main-right.css" rel="stylesheet">
</head>

<body onload=<?php echo "init();rand_next();"?>>
    <div class="background" id="background" style="display:none;"></div>
    <div style="display:none;">
        <input value="" name="username" id="username" hidden readonly/>
    </div>
    <div class="content">
        <nav class="block">
            <div style="font-size:24px;">Hello! <?php echo $user['username'];?>.</div>
            <div class="opt">
                <a href="#" id="all" onclick="get_article('')">动态</a>
                <a href="#" id="myself" onclick=<?php echo "get_article('".$user['username']."')";?>>自己</a>
            </div>
        </nav>
        <div class="main-left">
            <div class="block" id="relessay">
                <input placeholder="这里是标题" type="text" id="reltitle" style="width:100%;border-radius:10px;padding:6px;font-size:16px;margin-bottom:6px;"/>
                <textarea rows="5" id="relcontent" placeholder="说出你的故事 #话题#放在前面 回车分段 走起"></textarea>
                <button class="btn btn-info" style="float:right;" onclick="relarticle();">发布</button>
            </div>
<?php
        foreach($articles as $article)
        {
            $article['time']=date("Y-m-d H:m:s",$article['time']);
?>
            <div class="block article" name=<?php echo "{$article['writer']}";?> id=<?php echo "part".$article['articleid'];?> style="display:none;">
                <div class="block pointer" id=<?php echo "article".$article['articleid'];?> >
                    <p class="article_title"><?php echo $article['title'];?></p>
                    <p class="article_sub_title"><?php echo $article['time'];?> | 作者：<?php echo $article['writer'];?></p>
                    <p class="article_abstract"><?php echo $article['content'];?></p>
                    <div class="article_btns">
                        <button type="button" class="btn btn-info">评论(<?php echo $article['comments']?>)</button>
                        <button type="button" class="btn btn-info">阅读原文</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="block" id=<?php echo "response".$article['articleid'];?> style="display:none;">
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
<?php
        }
?>
            <div class="block" id="relresponse" style="display:none;">
                <textarea rows="1" placeholder="元芳你怎么看？"></textarea>
                <button class="btn btn-info" style="float:right;">发布</button>
            </div>
        </div>
        <div class="main-right">
            <div class="block" style="display:block;">
                <button class="btn btn-info" style="font-size:20px;width:100%;">点击签到</button>
            </div>
            <div class="block">
                <p style="font-size:22px;">好友列表</p>
                <ul style="font-size:16px;">
                    <li>Ivy</li>
                    <li>Ivy</li>
                    <li>Ivy</li>
                </ul>
            </div>
        </div>
    </div>
    <footer>A exercise for Zero Cup 2017.</footer>
</body>

</html>