<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();

if (empty($_GET['id'])){
    $_GET['id'] = 1 ;
}

if (isset($_POST['submit'])){
    if(!$member_id=is_login($link)){
        echo"<script>alert('请登录！');window.location.href='register.php';</script>";
    }
    if($_POST['comment']!=''){
        $query="insert into comment(news_id,user_id,content,comment_time) values('{$_GET['id']}','{$member_id}','{$_POST['comment']}',now())";
        execute($link,$query);
        if(mysqli_affected_rows($link)==1){
            echo"<script>alert('评论成功！');window.location.href='news.php?id={$_GET['id']}';</script>";
        }else{
            echo"<script>alert('评论失败,请重试！');window.location.href='news.php?id={$_GET['id']}';</script>";
        }
    }else{
        echo"<script>alert('评论内容不得为空，请重试！');window.location.href='news.php?id=1';</script>";
    }
    
}
$dians="select count(*) from dianz where news_id={$_GET['id']}";
$count=num($link,$dians);
if(!$member_id=is_login($link)){
	$dd = '';
}else{
    $cha="select * from dianz where news_id={$_GET['id']} and user_id={$member_id}";
    $zhi=execute($link,$cha);
    $dd=mysqli_fetch_assoc($zhi);
}

?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>一球成名</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/news.css" />
    <link rel="stylesheet" href="css/login.css">
    <link href="./images/logo.png" rel="icon" type="image/x-icon" />
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

</head>

<body>
    <!--导航条-->
    <nav class="navbar navbar-default" style="background-color: #BCD68D;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <!--<div class="navbar-header">
					<a class="navbar-header" href="#">首页</a>
				</div>-->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php" class="logo"></a>
                    </li>
                    <li class="active">
                        <a href="#" style="background-color: white;">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a href="personal.php">个人空间 </a>
                    </li>
                    <li>
                        <a href="statistics.html">数据统计</a>
                    </li>
                    <li>
                        <a href="analysis.php">数据分析</a>
                    </li>
                    <li>
                        <a href="race.php">赛程</a>
                    </li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="关键字">
                    </div>
                    <button type="submit" class="btn btn-default">查询</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                <?php
$html1=<<<a
            <li>
                <a href="logout.php">注销</a>
            </li>
a;
$html2=<<<a
                    <li>
                        <a href="register.php">注册</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#myModal">登录</a>
                    </li>
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span><span class="sr-only">关闭</span>
                                                        </button>
                                    <h4 class="modal-title" id="myModalLaber">
                                        用户名密码登录
                                    </h4>
                                    
                                    <div class="login-all">
                                        <form action="" method="post">
                                            <div class="login-input1">
                                                <input type="text" placeholder="邮箱" name="email">
                                            </div>
                                            <div class="login-input2">
                                                <input type="password" placeholder="密码" name="password">
                                            </div>
                                            
                                                <div class="form-check">
                                                    <label class="form-check-label login-auto">
                                                            <input type="checkbox" value=""> 下次自动登录
                                                        </label>
                                            
                                            </div>
                                            <button class="login-btn" name="button">登录</button>
                                            <div class="forget-psw">
                                                <a href="#">忘记密码？</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="login-others-way">
                                        <div class="login-others-word">社交账号登录：</div>
                                        <div class="share-cpt">
                                            <div class="share-sina"></div>
                                            <div class="share-wechat"></div>
                                            <div class="share-qq"></div>
                                            <div class="share-dou"></div>
                                        </div>
                                    </div>
                                    <a href="./register.php" class="btn btn-success">立即注册</a>
                                </div>
                            </div>
                        </div>
                    </div>

a;
if(!$member_id=is_login($link)){
	echo $html2;
}else{
    echo $html1;
}
?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <div class="container">
        <div class="article">
            <!--新闻图-->
            <img src="images/soccer.png" class="article_img" />
            <div class="article_content">
                <!--新闻标题-->
                <p class="article_title">国际足联宣布世界杯延期</p>
                <div class="article_author">
                    <!--新闻来源-->
                    <div class="article_author_name">老乐说球</div>
                </div>
                <div class="article_text">
                    <p class="article_text_section">
                        随着法国和克罗地亚晋级决赛，俄罗斯世界杯只剩下两场比赛，球迷也有些意犹未尽，俄罗斯世界杯还没有结束，就已经期待2022年卡塔尔世界杯，俄罗斯世界杯的举办时间是在6月到7月之间，但是由于天气的原因，在比赛中的温度也会很高，所以我们在看比赛的时候，都会看到有球员补水的过程。
                    </p>
                    <p class="article_text_section">所以FIFA主席因凡蒂诺确认，卡塔尔世界杯将于2022年11月21日开幕，于12月18日结束。世界杯放到冬季，这在历史上还是首次。</p>
                    <p class="article_text_section">由于卡塔尔地处亚洲西南部，属热带沙漠气候，7月-9月气温最高，可达45℃，当地时间比北京时间慢五个小时。所以世界杯如果在夏季举行的话，在高温下比赛对于球员来说是一个煎熬的过程，也会影响球队的发挥。导致比赛的质量下降。</p>
                    <p class="article_text_section">但是在冬季比赛也属历史首次，而且在11月21日开幕，时间上对于欧洲联赛来说有些不合时宜，网友对这次决议非常不满，因为欧洲联赛踢到了半程最关键的时候，而且在冬季踢世界杯这样重大的赛事，会让球员的伤病增多，而且不利于场上的发挥。世界杯结束之后，各大国脚会引起FIFA病毒，导致下半程状态低迷。</p>
                </div>
            </div>
            <form action="" method="post" >
            <div class="comment">
                <div class="likes">
                    <div class="<?php if($dd!=''){echo 'likes_imgs';}else{echo 'likes_img';} ?>"></div>
                    <div class="likes_num"><?php echo $count ?></div>
                </div>
                <div class="publish_comment row">
                    <div class="col-lg-10">
                        <textarea placeholder="请输入你的评论" id="comment_write" name="comment"></textarea></div>
                    <div class="col-lg-2">
                        <input type="submit" id="publish_comment_btn" value="发表" name="submit" />
                    </div>
                </div>
        </form>

                <div class="all_comment">
                    <div class="all_comment_title">
                        <span>评论</span>
                    </div>
                    <?php
                    $link=connect();
                    $query="select * from comment where news_id={$_GET['id']}";
                    $result=execute($link,$query);
                    while($data=mysqli_fetch_assoc($result)){
                        $a="select * from member where id={$data['user_id']}";
				        $b=execute($link,$a);
				        $c=mysqli_fetch_assoc($b);
$html=<<<a
                    <div class="all-comment">
                        <div class="comment_messages">
                            <img src="{$c['toux']}" class="comment_messages_img" />
                            <div class="comment_messages_author">{$c['user']} | <span class="comment_massages_time">{$data['comment_time']}</span></div>
                            <input type="button" class="reply_btn1" value="|回复" />
                        </div>
                        <div class="comment_content">
                            <p>{$data['content']}</p>
                        </div>
                    </div>
                    <form action="" method="post" >
                        <div class="reply_write1 row">
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" value="" name="reply" />
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <input type="submit" value="发表" name="button" />
                            </div>
                        </div>
                    </form>

a;
echo $html;
if (isset($_POST['button'])){
    if(!$member_id=is_login($link)){
        echo"<script>alert('请登录！');window.location.href='register.php';</script>";
    }
    if($_POST['reply']!=''){
        $query="insert into reply(cid,uid,mid,content,reply_time) values('{$data['id']}','{$member_id}','{$c['id']}','{$_POST['reply']}',now())";
        execute($link,$query);
        if(mysqli_affected_rows($link)==1){
            echo"<script>alert('回复成功！');window.location.href='news.php?id={$_GET['id']}';</script>";
        }else{
            echo"<script>alert('回复失败,请重试！');window.location.href='news.php?id={$_GET['id']}';</script>";
        }
    }else{
        echo"<script>alert('回复内容不得为空，请重试！');window.location.href='news.php?id=1';</script>";
    }   
}
                    $query1="select * from reply where cid={$data['id']}";
                    $result1=execute($link,$query1);
                    while($data1=mysqli_fetch_assoc($result1)){
                        $a1="select * from member where id={$data1['uid']}";
				        $b1=execute($link,$a1);
                        $u=mysqli_fetch_assoc($b1);
                        $a2="select * from member where id={$data1['mid']}";
				        $b2=execute($link,$a2);
                        $m=mysqli_fetch_assoc($b2);
$htm=<<<a
        <div class="reply_comment">
        <div class="reply_messages">
            <img src="{$u['toux']}" class="reply_messages_img" />
            <div class="reply_massages_author">{$u['user']} | <span class="reply_massages_time">{$data1['reply_time']}</span></div>
            <input type="button" class="reply_btn2" value="|回复" />
        </div>
        <div class="reply_content">
            <p>@
                <a href="#">{$m['user']}</a> : <span>{$data1['content']}</span></p>
        </div>
        </div>
        <form action="" method="post" >
                        <div class="reply_write2 row">
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <input type="text" value="" name="reply"/>
                            </div>
                            <div class="col-lg-2  col-md-2 col-sm-2">
                                <input type="submit" value="发表" name="button1" />
                            </div>
                        </div>
        </form>
a;
echo $htm;
if (isset($_POST['button1'])){
    if(!$member_id=is_login($link)){
        echo"<script>alert('请登录！');window.location.href='register.php';</script>";
    }
    if($_POST['reply']!=''){
        $query="insert into reply(cid,uid,mid,content,reply_time) values('{$data['id']}','{$member_id}','{$u['id']}','{$_POST['reply']}',now())";
        execute($link,$query);
        if(mysqli_affected_rows($link)==1){
            echo"<script>alert('回复成功！');window.location.href='news.php?id={$_GET['id']}';</script>";
        }else{
            echo"<script>alert('回复失败,请重试！');window.location.href='news.php?id={$_GET['id']}';</script>";
        }
    }else{
        echo"<script>alert('回复内容不得为空，请重试！');window.location.href='news.php?id=1';</script>";
    }   
}
                    }

                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="reTop"></div>
    <!--底部-->
    <div class="container" id="bottom">
        <p class="text-center">关于我们
            <a>@一球成名项目组</a>
        </p>
        <p class="text-center">加入我们
            <a>体育赛况小组</a>
        </p>
    </div>
</body>
<script type="text/javascript">
    $(function() {
        $('#reTop').hide();
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#reTop').fadeIn();
            } else {
                $('#reTop').fadeOut();
            }
        });

        $('#reTop').click(function() {
            $('html ,body').animate({
                scrollTop: 0
            }, 300);
            return false;
        });
    });
    var add = 0;
    var news_id = <?php echo $_GET['id'] ?>;
    var member_id = <?php echo is_login($link) ?>;
    $('.likes_img').click(function() {
        if(add%2==0){
            $(this).css('background-image', 'url(images/heard-red.png)');
            var num = parseInt($('.likes_num').text()) + 1;
            $('.likes_num').text(num);
            $.ajax({
			"url" : "checkdianz.php?",
			"type" : "post",
			"data" : {"count": 1,
            "news_id": news_id,
            "member_id": member_id },
			"success" : function(msg){
                alert(msg);
            },
			"error" : function() {
				alert("出现错误");
			}
		});
        }else{
            $(this).css('background-image', 'url(images/heart-white.png)');
            var num = parseInt($('.likes_num').text()) - 1;
            $('.likes_num').text(num);
            $.ajax({
			"url" : "1.php?",
			"type" : "post",
			"data" : {"count": 2,
            "news_id": news_id,
            "member_id": member_id },
			"success" : function(msg){
                alert(msg);
            },
			"error" : function() {
				alert("出现错误");
			}
		});
        }
        add += 1
    });
    var add = 0;
    var news_id = <?php echo $_GET['id'] ?>;
    var member_id = <?php echo is_login($link) ?>;
    $('.likes_imgs').click(function() {
        if(add%2==0){
            $(this).css('background-image', 'url(images/heart-white.png)');
            var num = parseInt($('.likes_num').text()) - 1;
            $('.likes_num').text(num);
            $.ajax({
			"url" : "checkdianz.php?",
			"type" : "post",
			"data" : {"count": 2,
            "news_id": news_id,
            "member_id": member_id },
			"success" : function(msg){
                alert(msg);
            },
			"error" : function() {
				alert("出现错误");
			}
		});
        }else{
            $(this).css('background-image', 'url(images/heard-red.png)');
            var num = parseInt($('.likes_num').text()) + 1;
            $('.likes_num').text(num);
            $.ajax({
			"url" : "checkdianz.php?",
			"type" : "post",
			"data" : {"count": 1,
            "news_id": news_id,
            "member_id": member_id },
			"success" : function(msg){
                alert(msg);
            },
			"error" : function() {
				alert("出现错误");
			}
		});
        }
        add += 1
    });
    $('.reply_btn1').click(function() {
        if ($('.reply_write1').is(':hidden')) {
            $('.reply_write1').show();
        } else {
            $('.reply_write1').hide();
        }
    });
    $('.reply_btn2').click(function() {
        if ($('.reply_write2').is(':hidden')) {
            $('.reply_write2').show();
        } else {
            $('.reply_write2').hide();
        }
    });
    $('.reply_write1 input[type="button"]').click(function() {
        $(this).parent().hide();
    })
</script>

</html>