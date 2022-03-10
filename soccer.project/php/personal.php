<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();

if(!$member_id=is_login($link)){
	echo"<script>alert('请登录！');window.location.href='register.php';</script>";
}

$Uslt="select * from member where id={$member_id}";//查询语句  member的表中id与浏览器存的cookie_id
$Uexe=execute($link,$Uslt); //执行语句
$Ures=mysqli_fetch_assoc($Uexe);   //返回结果 ，数组类型

if(isset($_POST['submit'])){
    $link=connect();
    $_POST=escape($link,$_POST);
	
    $query="update member set sex='{$_POST['sex']}',age='{$_POST['age']}', constellation='{$_POST['constellation']}',autograph='{$_POST['autograph']}',
    hobby='{$_POST['hobby']}',occupation='{$_POST['occupation']}',telephone='{$_POST['telephone']}',wechat='{$_POST['wechat']}',city='{$_POST['city']}' where id='{$member_id}'";
    execute($link,$query);
    if(mysqli_affected_rows($link)==1){
		echo"<script>alert('修改成功！');window.location.href='personal.php';</script>";
        skit('personal.php','ok','修改成功!');
    }else{
		echo"<script>alert('修改失败，请重新修改！');window.location.href='personal.php';</script>";
        skit('personal.php','ok','修改失败，请重新修改!');
    }
}


?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>一球成名|个人空间</title>

    <!-- Bootstrap -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" />
    <script type="text/javascript" src="./bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/personal.css">
    <link href="./images/logo.png" rel="icon" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <!-- 到这里 -->

</head>

<body class="body">
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
                    <li>
                        <a href="index.php">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="active">
                        <a href="personal.php" style="background-color: white;">个人空间 </a>
                    </li>
                    <li>
                        <a href="statistics.php">数据统计</a>
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
                <li>
                    <a href="logout.php">注销</a>
                </li>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="message-all">
        <div class="message-bg"></div>
        <div class="message-left">
            <div class="avatar-all">
                <img src="<?php if($Ures['toux']!=''){echo $Ures['toux'];}else{ echo './images/author1.jpg';}?>" class="avatar">
                <div class="avatar-name"><?php echo $Ures['user'] ?></div>
                <div class="line"></div>
                <div class="avatar-name2">完善我的资料能交更多志趣相投的朋友哦</div>
                <div class="message-changeimg" ><a href="imgupload.php">更换头像</a></div>
            </div>
            <div class="message-data">
                <button type="text" class="btn btn-success message-people"> 个人资料
                </button>

                <div class="collapse in">
                    <form method="POST">
                        <div class="main" id="mainlogin">
                            <div class="collapse in">
                                
                                <div class="message-bepeople">签名：</div>
                                <div class="message-word"><?php if($Ures['autograph']!=''){echo $Ures['autograph'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">年龄：</div>
                                <div class="message-word"><?php if($Ures['age']!=''){echo $Ures['age'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">性别：</div>
                                <div class="message-word"><?php if($Ures['sex']!=''){echo $Ures['sex'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">星座：</div>
                                <div class="message-word"><?php if($Ures['constellation']!=''){echo $Ures['constellation'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">爱好：</div>
                                <div class="message-word"><?php if($Ures['hobby']!=''){echo $Ures['hobby'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">职业：</div>
                                <div class="message-word"><?php if($Ures['occupation']!=''){echo $Ures['occupation'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">城市：</div>
                                <div class="message-word"><?php if($Ures['city']!=''){echo $Ures['city'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">邮箱：</div>
                                <div class="message-word"><?php if($Ures['email']!=''){echo $Ures['email'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">微信：</div>
                                <div class="message-word"><?php if($Ures['wechat']!=''){echo $Ures['wechat'];}else{ echo '未填';}?></div>
                                <div class="message-bepeople">电话：</div>
                                <div class="message-word"><?php if($Ures['telephone']!=''){echo $Ures['telephone'];}else{ echo '未填';}?></div>
                                <div class="message-change" id="register">修改个人资料</div>
                            </div>
                        </div>

                        <div class="main" id="mainregister">
                            <div style="position: absolute; right: 50px;font-size: 35px;">
                            </div>
                            <div class="message-bepeople">签名：</div>
                            <input type="text" placeholder="介绍一下自己吧" class="message-input-sign" name="autograph" value="<?php if($Ures['autograph']!=''){echo $Ures['autograph'];}else{ echo '';}?>">
                            <div class="constellation">
                                <div class="tip message-bepeople">年龄</div>
                                <select class="select" name="age">
                                            <option value="15"<?php if($Ures['age']=='15'){echo 'selected';}?>>15</option>
											<option value="16"<?php if($Ures['age']=='16'){echo 'selected';}?>>16</option>
											<option value="17"<?php if($Ures['age']=='17'){echo 'selected';}?>>17</option>
											<option value="18"<?php if($Ures['age']=='18'){echo 'selected';}?>>18</option>
											<option value="19"<?php if($Ures['age']=='19'){echo 'selected';}?>>19</option>
											<option value="20"<?php if($Ures['age']=='20'){echo 'selected';}?>>20</option>
											<option value="21"<?php if($Ures['age']=='21'){echo 'selected';}?>>21</option>
											<option value="22"<?php if($Ures['age']=='22'){echo 'selected';}?>>22</option>
											<option value="23"<?php if($Ures['age']=='23'){echo 'selected';}?>>23</option>
											<option value="24"<?php if($Ures['age']=='24'){echo 'selected';}?>>24</option>
											<option value="25"<?php if($Ures['age']=='25'){echo 'selected';}?>>25</option>
											<option value="26"<?php if($Ures['age']=='26'){echo 'selected';}?>>26</option>
											<option value="27"<?php if($Ures['age']=='27'){echo 'selected';}?>>27</option>
											<option value="28"<?php if($Ures['age']=='28'){echo 'selected';}?>>28</option>
								</select>
                            </div>
                            <div class="constellation">
                                <div class="tip message-bepeople">性别</div>
                                <select class="select" name="sex">
                                            <option value="女"<?php if($Ures['sex']=='女'){echo 'selected';}?>>女</option>
											<option value="男"<?php if($Ures['sex']=='男'){echo 'selected';}?>>男</option>
                                </select>
                            </div>
                            <div class="constellation">
                                <div class="tip message-bepeople">星座</div>
                                <select class="select" name="constellation">
                                            <option value="水瓶座"<?php if($Ures['constellation']=='水瓶座'){echo 'selected';}?>>水瓶座</option>
											<option value="双鱼座"<?php if($Ures['constellation']=='双鱼座'){echo 'selected';}?>>双鱼座</option>
											<option value="白羊座"<?php if($Ures['constellation']=='白羊座'){echo 'selected';}?>>白羊座</option>
											<option value="金牛座"<?php if($Ures['constellation']=='金牛座'){echo 'selected';}?>>金牛座</option>
											<option value="双子座"<?php if($Ures['constellation']=='双子座'){echo 'selected';}?>>双子座</option>
											<option value="巨蟹座"<?php if($Ures['constellation']=='巨蟹座'){echo 'selected';}?>>巨蟹座</option>
											<option value="狮子座"<?php if($Ures['constellation']=='狮子座'){echo 'selected';}?>>狮子座</option>
											<option value="处女座"<?php if($Ures['constellation']=='处女座'){echo 'selected';}?>>处女座</option>
											<option value="天秤座"<?php if($Ures['constellation']=='天秤座'){echo 'selected';}?>>天秤座</option>
											<option value="天蝎座"<?php if($Ures['constellation']=='天蝎座'){echo 'selected';}?>>天蝎座</option>
											<option value="射手座"<?php if($Ures['constellation']=='射手座'){echo 'selected';}?>>射手座</option>
											<option value="魔羯座"<?php if($Ures['constellation']=='魔羯座'){echo 'selected';}?>>魔羯座</option>
                                </select>
                            </div>
                            <div class="message-bepeople">爱好：</div>
                            <input type="text" placeholder="我的兴趣爱好" class="message-input" name="hobby" value="<?php if($Ures['hobby']!=''){echo $Ures['hobby'];}else{ echo '';}?>">
                            <div class="message-bepeople">职业：</div>
                            <input type="text" placeholder="我的职业" class="message-input" name="occupation" value="<?php if($Ures['occupation']!=''){echo $Ures['occupation'];}else{ echo '';}?>">
                            <div class="message-bepeople">城市：</div>
                            <input type="text" placeholder="所在城市" class="message-input" name="city" value="<?php if($Ures['city']!=''){echo $Ures['city'];}else{ echo '';}?>">
                            <div class="message-bepeople">微信：</div>
                            <input type="text" placeholder="你的微信号" class="message-input" name="wechat" value="<?php if($Ures['wechat']!=''){echo $Ures['wechat'];}else{ echo '';}?>">
                            <div class="message-bepeople">电话：</div>
                            <input type="text" placeholder="保持联络" class="message-input" name="telephone" value="<?php if($Ures['telephone']!=''){echo $Ures['telephone'];}else{ echo '';}?>">
                            <button class="message-change" name="submit">保存</button>
                        </div>
                </div>
                <div class="maine" id="mainloginer">
                </div>
                <div class="main" id="mainer">
                </div>

                <div class="main" id="mainery">
                </div>
                </form>


            </div>
        </div>
    </div>
    </div>

    </div>
    </div>

    <div class="message-right">

        <ul id="myTab" class="nav nav-tabs">

            <li><a href="#myCollection" data-toggle="tab">我的收藏</a></li>
            <li><a href="#myFocus" data-toggle="tab">关注球队</a></li>
            <li class="active"><a href="#myLike" data-toggle="tab">收到的赞</a></li>
            <li><a href="#sendComment" data-toggle="tab">发表留言</a></li>
            <li class="dropdown">
                <a href="#" id="#myMessage" class="dropdown-toggle" data-toggle="dropdown">我的消息
                                    <b class="caret"></b>
                                </a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                    <li><a href="#myReceived" tabindex="-1" data-toggle="tab">收到的评论</a></li>
                    <li><a href="#myIssue" tabindex="-1" data-toggle="tab">发出的评论</a></li>
                </ul>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">

            <!-- 我收到的评论 -->
            <div class="tab-pane fade" id="myReceived">
                <!-- 面板的开始 -->
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        回复我：我喜欢这条评论！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            回复我的评论：我说的内容......
                        </div>
                    </div>
                    <!-- 面板脚注有回复和点赞 -->
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-pencil"></span> 回复
                            </button>
                        <button type="button" class="btn btn-success btn-sm">
                                    <span class="glyphicon glyphicon-heart"></span> 点赞
                            </button>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        回复我：我喜欢这条评论！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            回复我的评论：我说的内容......
                        </div>
                    </div>
                    <!-- 面板脚注有回复和点赞 -->
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-pencil"></span> 回复
                                </button>
                        <button type="button" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-heart"></span> 点赞
                            </button>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        回复我：我喜欢这条评论！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            回复我的评论：我说的内容......
                        </div>
                    </div>
                    <!-- 面板脚注有回复和点赞 -->
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-sm">
                                                <span class="glyphicon glyphicon-pencil"></span> 回复
                                    </button>
                        <button type="button" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-heart"></span> 点赞
                                </button>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        回复我：我喜欢这条评论！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            回复我的评论：我说的内容......
                        </div>
                    </div>
                    <!-- 面板脚注有回复和点赞 -->
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-sm">
                                                    <span class="glyphicon glyphicon-pencil"></span> 回复
                                        </button>
                        <button type="button" class="btn btn-success btn-sm">
                                                <span class="glyphicon glyphicon-heart"></span> 点赞
                                    </button>
                    </div>
                </div>
            </div>

            <!-- 我发出的评论 -->
            <div class="tab-pane fade" id="myIssue">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        我喜欢这条留言！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            评论某人的留言：某人说的内容......
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        我喜欢这条留言！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            评论某人的留言：某人说的内容......
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        我喜欢这条留言！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            评论某人的留言：某人说的内容......
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        我喜欢这条留言！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            评论某人的留言：某人说的内容......
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        我喜欢这条留言！
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            评论某人的留言：某人说的内容......
                        </div>
                    </div>
                </div>
            </div>





            <!-- 我的收藏 -->
            <div class="tab-pane fade" id="myCollection">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            收藏内容
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="myCollection-content">
                            <h4>谁是史上第1巨星？60万网友当评委：梅西C罗进决赛 大罗出局</h4>
                            因为疫情影响，西甲、意甲、英超、欧冠等足球赛事全部停摆。没有足球的日子里，西班牙《马卡报》在网上举办一场“史上最佳球员PK大赛”。足坛百年历史上的顶级巨星，采取1V1的单挑模式，按照网友的支持率决出胜者。如今，这项PK大赛即将进入尾声，梅西和C罗两大巨星会师决赛！

                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-remove"></span> 删除
                            </button>
                    </div>
                </div>
            </div>





            <!-- 我的关注 -->
            <div class="tab-pane fade" id="myFocus">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            全部关注
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="myFocus-content">
                            <div class="myFocus-content1"></div>
                            <div class="myFocus-name">阿斯维拉斯</div>
                            <div>赛程时间：2020.04.02</div>
                            <button type="button" class="btn btn-success btn-xs">
                                    <span class="glyphicon glyphicon-remove"></span> 取消关注
                                </button>
                        </div>
                        <div class="myFocus-content">
                            <div class="myFocus-content2"></div>
                            <div class="myFocus-name">狼队</div>
                            <div>赛程时间：2020.04.02</div>
                            <button type="button" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 取消关注
                                </button>
                        </div>
                        <div class="myFocus-content">
                            <div class="myFocus-content3"></div>
                            <div class="myFocus-name">阿森纳</div>
                            <div>赛程时间：2020.04.02</div>
                            <button type="button" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 取消关注
                                </button>
                        </div>
                        <div class="myFocus-content">
                            <div class="myFocus-content4"></div>
                            <div class="myFocus-name">诺维奇</div>
                            <div>赛程时间：2020.04.02</div>
                            <button type="button" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 取消关注
                                </button>
                        </div>
                        <div class="myFocus-content">
                            <div class="myFocus-content5"></div>
                            <div class="myFocus-name">伯恩茅斯</div>
                            <div>赛程时间：2020.04.02</div>
                            <button type="button" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 取消关注
                                </button>
                        </div>
                        <div class="myFocus-content">
                            <div class="myFocus-content6"></div>
                            <div class="myFocus-name">纽卡斯尔</div>
                            <div>赛程时间：2020.04.02</div>
                            <button type="button" class="btn btn-success btn-xs">
                                <span class="glyphicon glyphicon-remove"></span> 取消关注
                                </button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 我收到的赞，包括回复 -->
            <div class="tab-pane fade" id="myLike">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        赞了你的留言
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            我的留言内容：我说的内容......
                        </div>
                    </div>
                    <!-- 面板脚注有回复和点赞 -->
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-pencil"></span> 回复
                            </button>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- 面板标题包括用户头像，用户昵称，收到时间 -->
                            <div class="user-picture"></div>
                            <div class="user-nickname">nickname</div>
                            <div class="user-time">2020-04-01 18:14</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        赞了你的留言
                        <!-- 面板内容有因为哪条新闻收到的评论，评论内容 -->
                        <div class="user-content">
                            我的留言内容：我说的内容......
                        </div>
                    </div>
                    <!-- 面板脚注有回复和点赞 -->
                    <div class="panel-footer">
                        <button type="button" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-pencil"></span> 回复
                                        </button>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="sendComment">

                <div class="message-bottem">
                    <div id="content">
                        <div id="post">
                            <div class="all-comment">
                                <div id="comment"></div>
                            </div>
                            <div class="all-view">
                                <div class="message-nicknametop">
                                    <div class="message-nickname">昵称：</div>

                                    <input type="submit" id="shangtian" name="Submit3" class="message-nickname" value="" onclick="prom()" />
                                    <input type="text" id="ritian" class="message-content" onclick="prom()" />
                                </div>
                                <div>
                                    <textarea class="transition"></textarea>
                                </div>
                                <input id="postBt" type="button" class="message-botton" value="发表留言" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        var named;

        function delete1(id) {
            localStorage.removeItem(id);
            this.Storage.writeData();
        }

        function prom() {

            var name = prompt("请输入您的名字", ""); //将输入的内容赋给变量 name ，
            named = name;
            //这里需要注意的是，prompt有两个参数，前面是提示的话，后面是当对话框出来后，在对话框里的默认值

            if (named) //如果返回的有内容

            {

                alert("欢迎您：" + name)
                document.getElementById("shangtian").style.display = "none";
                document.getElementById("ritian").value = named;

            } else {
                document.getElementById("ritian").value = "匿名";
            }

        }
        var Storage = {
            saveData: function() //保存数据
                {

                    var data = document.querySelector("#post textarea");
                    if (data.value != "") {
                        var time = new Date().getTime() + Math.random() * 5; //getTime是Date对象中的方法，作用是返回 1970年01月01日至今的毫秒数
                        if (named) {
                            localStorage.setItem(time, data.value + "|" + named + "|" + this.getDateTime()); //将毫秒数存入Key值中，可以降低Key值重复率
                        } else {
                            localStorage.setItem(time, data.value + "|" + "&nbsp&nbsp&nbsp&nbsp&nbsp匿名" + "|" + this.getDateTime()); //将毫秒数存入Key值中，可以降低Key值重复率
                        }

                        data.value = "";
                        this.writeData();
                    } else {
                        alert("请填写您的留言！");
                    }
                },
            writeData: function() //输出数据
                {
                    var dataHtml = "",
                        data = "";
                    for (var i = localStorage.length - 1; i >= 0; i--) //效率更高的循环方法
                    {
                        data = localStorage.getItem(localStorage.key(i)).split("|");

                        //dataHtml += "<p><span class=\"msg\">" + data[0] + "</span><span class=\"datetime\">" + data[1] + "</span><span>" + data[2]+"</span></p>";
                        dataHtml += "<span style=>" + data[1] + "<span style=\"float:right\">" + data[2] + "</span><p><span class=\"msg\">" + data[0] + "<input style=\"float:right;width:50px;background-color: rgba(1, 53, 8, 0.8);color:#fff;padding:2px;font-weight: 100;border:none;border-radius:5px;\" id=\"clearBt\" type=\"button\" onclick=\"delete1(" + localStorage.key(i) + ");\" value=\"删除\"/>" + "</span></p>";
                    }
                    document.getElementById("comment").innerHTML = dataHtml;
                },

            getDateTime: function() //获取日期时间，例如 2012-03-08 12:58:58
                {
                    var isZero = function(num) //私有方法，自动补零
                        {
                            if (num < 10) {
                                num = "0" + num;
                            }
                            return num;
                        }

                    var d = new Date();
                    return d.getFullYear() + "-" + isZero(d.getMonth() + 1) + "-" + isZero(d.getDate()) + " " + isZero(d.getHours()) + ":" + isZero(d.getMinutes()) + ":" + isZero(d.getSeconds());
                }
        }

        window.onload = function() {
            Storage.writeData(); //当打开页面的时候，先将localStorage中的数据输出一边，如果没有数据，则输出空
            document.getElementById("postBt").onclick = function() {
                    Storage.saveData();
                } //发表评论按钮添加点击事件，作用是将localStorage中的数据输出
        }
    </script>
</body>
<script type="text/javascript">
    window.onload = function() {
        var $ = function(id) {
            return document.getElementById(id);
        }
        $("mainlogin").style.display = "block";
        $("mainregister").style.display = "none";
        $("mainloginer").style.display = "none";
        $("mainer").style.display = "none";
        $("mainery").style.display = "none";

        $("register").onclick = function() {
            $("mainlogin").style.display = "none";
            $("mainregister").style.display = "block";
            $("re").style.border = "1px dotted #333";
            $("gis").style.border = "1px dotted #333";
        }
        $("care1").onclick = function() {
            $("mainlogin").style.display = "none";
            $("mainloginer").style.display = "block";
            $("mainregister").style.display = "none";
            $("mainer").style.display = "none";
            $("mainery").style.display = "none";
        }
        $("care2").onclick = function() {
            $("mainlogin").style.display = "none";
            $("mainloginer").style.display = "none";
            $("mainregister").style.display = "none";
            $("mainer").style.display = "block";
            $("mainery").style.display = "none";
        }
        $("care3").onclick = function() {
            $("mainlogin").style.display = "none";
            $("mainloginer").style.display = "none";
            $("mainregister").style.display = "none";
            $("mainer").style.display = "none";
            $("mainery").style.display = "block";
        }

    }
</script>

<script src="./js/plugins/jQuery/jquery-3.3.1.slim.min.js"></script>
<script src="./js/plugins/bootstrap/popper.min.js"></script>
<script src="./js/plugins/bootstrap/bootstrap.min.js"></script>

</html>