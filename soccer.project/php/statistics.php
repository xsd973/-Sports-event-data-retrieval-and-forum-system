<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'page.php';
$link=connect();

$ct="select count(*) from teamstatistic";
$count=num($link,$ct);
$page=page($count,20,5);

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>一球成名|数据统计</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/statistics.css">
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
                    <li>
                        <a href="index.php">首页 <span class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a href="personal.php">个人空间 </a>
                    </li>
                    <li class="active">
                        <a href="statistics.php" style="background-color: white;">数据统计</a>
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
                                        <div class="login-input1">
                                            <input type="text" placeholder="手机/邮箱/用户名" name="">
                                        </div>
                                        <div class="login-input2">
                                            <input type="password" placeholder="密码">
                                        </div>
                                        <form>
                                            <div class="form-check">
                                                <label class="form-check-label login-auto">
													<input type="checkbox" value=""> 下次自动登录
												  </label>
                                        </form>
                                        </div>
                                        <div class="login-btn">登录</div>
                                        <div class="forget-psw">
                                            <a href="#">忘记密码？</a>
                                        </div>
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
                                    <a href="./register.html" class="btn btn-success">立即注册</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="sta-all">
        <h3>球队数据</h3>
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    概况
                </a>
            </li>
            <li><a href="#attack" data-toggle="tab">进攻</a></li>
            <li><a href="#defend" data-toggle="tab">防守</a></li>
            <li><a href="#organization" data-toggle="tab">组织</a></li>

        </ul>
        <div id="myTabContent" class="tab-content">


            <div class="tab-pane fade in active" id="home">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球队
                                </th>
                                <th class="text-center">
                                    赛事
                                </th>
                                <th class="text-center">
                                    射门
                                </th>
                                <th class="text-center">
                                    红黄牌
                                </th>
                                <th class="text-center">
                                    控球率%
                                </th>
                                <th class="text-center">
                                    PS%
                                </th>
                                <th class="text-center">
                                    绝佳机会
                                </th>
                                <th class="text-center">
                                    争顶成功
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $pai="SELECT * from teamstatistic ORDER BY id ASC {$page['limit']}";
                    $jieg=execute($link,$pai);
                    while($data=mysqli_fetch_assoc($jieg)){
                        $data['possession'] = round($data['possession']*100,1);
                        $data['passSucc'] = round($data['passSucc']*100,1);
                        if($data['id']%2==1){
$html=<<<a
                        <tr class="success">
                        <th class="text-center">
                        {$data['id']}
                        </th>
                        <th class="text-left">
                            <a href="#">{$data['teamName']}</a>
                        </th>
                        <th class="text-center">
                        {$data['competitionName']}
                        </th>
                        <th class="text-center">
                            {$data['shots']}
                        </th>
                        <th class="text-center">
                            <span class="card-y">{$data['yelCards']}</span>
                            <span class="card-r">{$data['redCards']}</span>
                        </th>
                        <th class="text-center">
                            {$data['possession']}
                        </th>
                        <th class="text-center">
                            {$data['passSucc']}
                        </th>
                        <th class="text-center">
                            {$data['bigChanceCreated']}
                        </th>
                        <th class="text-center">
                            {$data['aerialWon']}
                        </th>
                        <th class="text-center">
                            <span class="label label-default">{$data['rate']}</span>
                        </th>
                        </tr>
                        <tr>

a;
echo $html;
                        }else{
$html=<<<a
                        <tr>
                        <th class="text-center">
                        {$data['id']}
                        </th>
                        <th class="text-left">
                            <a href="#">{$data['teamName']}</a>
                        </th>
                        <th class="text-center">
                        {$data['competitionName']}
                        </th>
                        <th class="text-center">
                            {$data['shots']}
                        </th>
                        <th class="text-center">
                            <span class="card-y">{$data['yelCards']}</span>
                            <span class="card-r">{$data['redCards']}</span>
                        </th>
                        <th class="text-center">
                            {$data['possession']}
                        </th>
                        <th class="text-center">
                            {$data['passSucc']}
                        </th>
                        <th class="text-center">
                            {$data['bigChanceCreated']}
                        </th>
                        <th class="text-center">
                            {$data['aerialWon']}
                        </th>
                        <th class="text-center">
                            <span class="label label-default">{$data['rate']}</span>
                        </th>
                        </tr>
a;
echo $html;
                        }
                    }

?>
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                        <li><?php
    										$page=page($count,20,5);
    										echo $page['html'];
    									?></li>
                        </ul>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="attack">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球队
                                </th>
                                <th class="text-center">
                                    赛事
                                </th>
                                <th class="text-center">
                                    进球
                                </th>
                                <th class="text-center">
                                    射门
                                </th>
                                <th class="text-center">
                                    射正
                                </th>
                                <th class="text-center">
                                    绝佳机会
                                </th>
                                <th class="text-center">
                                    把握机会%
                                </th>
                                <th class="text-center">
                                    过人
                                </th>
                                <th class="text-center">
                                    被侵犯
                                </th>
                                <th class="text-center">
                                    越位
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                
                            <?php
                    $pai="SELECT * from teamstatistic ORDER BY id ASC {$page['limit']}";
                    $jieg=execute($link,$pai);
                    while($data=mysqli_fetch_assoc($jieg)){
                        $data['possession'] = round($data['possession']*100,1);
                        $data['passSucc'] = round($data['passSucc']*100,1);
                        $data['bigChanceSucc'] = round($data['bigChanceSucc']*100,1);
                        if($data['id']%2==1){
$html=<<<a
                        <tr class="success">
                        <th class="text-center">
                        {$data['id']}
                        </th>
                        <th class="text-left">
                            <a href="#">{$data['teamName']}</a>
                        </th>
                        <th class="text-center">
                        {$data['competitionName']}
                        </th>
                        <th class="text-center">
                            {$data['goals']}
                        </th>
                        <th class="text-center">
                            {$data['shots']}
                        </th>
                        <th class="text-center">
                            {$data['shotsOT']}
                        </th>
                        <th class="text-center">
                            {$data['shotsConceded']}
                        </th>
                        <th class="text-center">
                            {$data['bigChanceSucc']}
                        </th>
                        <th class="text-center">
                            {$data['clears']}
                        </th>
                        <th class="text-center">
                            {$data['fouled']}
                        </th>
                        <th class="text-center">
                            {$data['offsides']}
                        </th>
                        <th class="text-center">
                            <span class="label label-default">{$data['rate']}</span>
                        </th>
                        </tr>
                        <tr>
a;
echo $html;
                        }else{
$html=<<<a
                        <th class="text-center">
                        {$data['id']}
                        </th>
                        <th class="text-left">
                            <a href="#">{$data['teamName']}</a>
                        </th>
                        <th class="text-center">
                        {$data['competitionName']}
                        </th>
                        <th class="text-center">
                            {$data['goals']}
                        </th>
                        <th class="text-center">
                            {$data['shots']}
                        </th>
                        <th class="text-center">
                            {$data['shotsOT']}
                        </th>
                        <th class="text-center">
                            {$data['shotsConceded']}
                        </th>
                        <th class="text-center">
                            {$data['bigChanceSucc']}
                        </th>
                        <th class="text-center">
                            {$data['clears']}
                        </th>
                        <th class="text-center">
                            {$data['fouled']}
                        </th>
                        <th class="text-center">
                            {$data['offsides']}
                        </th>
                        <th class="text-center">
                            <span class="label label-default">{$data['rate']}</span>
                        </th>
                        <tr>
a;
echo $html;
                        }
                    }

?>
                            
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="defend">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球队
                                </th>
                                <th class="text-center">
                                    赛事
                                </th>
                                <th class="text-center">
                                    失球
                                </th>
                                <th class="text-center">
                                    被射门
                                </th>
                                <th class="text-center">
                                    抢断
                                </th>
                                <th class="text-center">
                                    拦截
                                </th>
                                <th class="text-center">
                                    解围
                                </th>
                                <th class="text-center">
                                    造越位
                                </th>
                                <th class="text-center">
                                    犯规
                                </th>
                                <th class="text-center">
                                    致命失误
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            <?php
                    $pai="SELECT * from teamstatistic ORDER BY id ASC {$page['limit']}";
                    $jieg=execute($link,$pai);
                    while($data=mysqli_fetch_assoc($jieg)){
                        $data['possession'] = round($data['possession']*100,1);
                        $data['passSucc'] = round($data['passSucc']*100,1);
                        $data['bigChanceSucc'] = round($data['bigChanceSucc']*100,1);
                        if($data['id']%2==1){
$html=<<<a
                        <tr class="success">
                        <th class="text-center">
                            {$data['id']}
                        </th>
                        <th class="text-left">
                            <a href="#">{$data['teamName']}</a>
                        </th>
                        <th class="text-center">
                            {$data['competitionName']}
                        </th>
                        <th class="text-center">
                            {$data['goalsLost']}
                        </th>
                        <th class="text-center">
                            {$data['shotsConceded']}
                        </th>
                        <th class="text-center">
                            {$data['tackles']}
                        </th>
                        <th class="text-center">
                            {$data['interceptions']}
                        </th>
                        <th class="text-center">
                            {$data['assists']}
                        </th>
                        <th class="text-center">
                            {$data['dribbles']}
                        </th>
                        <th class="text-center">
                            {$data['fouls']}
                        </th>
                        <th class="text-center">
                            {$data['errorsSum']}
                        </th>
                        <th class="text-center">
                            <span class="label label-default">{$data['rate']}</span>
                        </th>
                        </tr>
a;
echo $html;
                        }else{
$html=<<<a
                        <th class="text-center">
                        {$data['id']}
                        </th>
                        <th class="text-left">
                        <a href="#">{$data['teamName']}</a>
                        </th>
                        <th class="text-center">
                        {$data['competitionName']}
                        </th>
                        <th class="text-center">
                        {$data['goalsLost']}
                        </th>
                        <th class="text-center">
                        {$data['shotsConceded']}
                        </th>
                        <th class="text-center">
                        {$data['tackles']}
                        </th>
                        <th class="text-center">
                        {$data['interceptions']}
                        </th>
                        <th class="text-center">
                        {$data['assists']}
                        </th>
                        <th class="text-center">
                        {$data['dribbles']}
                        </th>
                        <th class="text-center">
                        {$data['fouls']}
                        </th>
                        <th class="text-center">
                        {$data['errorsSum']}
                        </th>
                        <th class="text-center">
                        <span class="label label-default">{$data['rate']}</span>
                        </th>
                        </tr>
a;
echo $html;
                        }
                    }

?>
                            
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="organization">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球队
                                </th>
                                <th class="text-center">
                                    赛事
                                </th>
                                <th class="text-center">
                                    助攻
                                </th>
                                <th class="text-center">
                                    关键传球
                                </th>
                                <th class="text-center">
                                    控球率%
                                </th>
                                <th class="text-center">
                                    传球
                                </th>
                                <th class="text-center">
                                    PS%
                                </th>
                                <th class="text-center">
                                    FTPS%
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $pai="SELECT * from teamstatistic ORDER BY id ASC {$page['limit']}";
                    $jieg=execute($link,$pai);
                    while($data=mysqli_fetch_assoc($jieg)){
                        $data['possession'] = round($data['possession']*100,1);
                        $data['passSucc'] = round($data['passSucc']*100,1);
                        $data['bigChanceSucc'] = round($data['bigChanceSucc']*100,1);
                        if($data['id']%2==1){
$html=<<<a
                            <tr class="success">
                            <th class="text-center">
                                {$data['id']}
                            </th>
                            <th class="text-left">
                                <a href="#">{$data['teamName']}</a>
                            </th>
                            <th class="text-center">
                                {$data['competitionName']}
                            </th>
                            <th class="text-center">
                                {$data['assists']}
                            </th>
                            <th class="text-center">
                                {$data['keyPasses']}
                            </th>
                            <th class="text-center">
                                {$data['possession']}
                            </th>
                            <th class="text-center">
                                {$data['passes']}
                            </th>
                            <th class="text-center">
                                {$data['passSucc']}
                            </th>
                            <th class="text-center">
                                {$data['finalThirdPassSucc']}
                            </th>
                            <th class="text-center">
                            <span class="label label-default">{$data['rate']}</span>
                            </th>
                            </tr>
                            <tr>
a;
echo $html;
                        }else{
$html=<<<a
                            <th class="text-center">
                            {$data['id']}
                            </th>
                            <th class="text-left">
                            <a href="#">{$data['teamName']}</a>
                            </th>
                            <th class="text-center">
                            {$data['competitionName']}
                            </th>
                            <th class="text-center">
                            {$data['assists']}
                            </th>
                            <th class="text-center">
                            {$data['keyPasses']}
                            </th>
                            <th class="text-center">
                            {$data['possession']}
                            </th>
                            <th class="text-center">
                            {$data['passes']}
                            </th>
                            <th class="text-center">
                            {$data['passSucc']}
                            </th>
                            <th class="text-center">
                            {$data['finalThirdPassSucc']}
                            </th>
                            <th class="text-center">
                            <span class="label label-default">{$data['rate']}</span>
                            </th>
                            </tr>
a;
echo $html;
                        }
                    }

?>
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <h3>球员数据</h3>
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#home2" data-toggle="tab">
                        概况
                    </a>
            </li>
            <li><a href="#attack2" data-toggle="tab">进攻</a></li>
            <li><a href="#defend2" data-toggle="tab">防守</a></li>
            <li><a href="#organization2" data-toggle="tab">组织</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">



            <div class="tab-pane fade in active" id="home2">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球员
                                </th>
                                <th class="text-center">
                                    出场
                                </th>
                                <th class="text-center">
                                    上场时间
                                </th>
                                <th class="text-center">
                                    进球
                                </th>
                                <th class="text-center">
                                    助攻
                                </th>
                                <th class="text-center">
                                    红黄牌
                                </th>
                                <th class="text-center">
                                    PS%
                                </th>
                                <th class="text-center">
                                    创造机会
                                </th>
                                <th class="text-center">
                                    争顶成功
                                </th>
                                <th class="text-center">
                                    全场最佳
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <th class="text-center">
                                    1
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    2
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    3
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    4
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    5
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    6
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    7
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    8
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    9
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    10
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    <span class="card-y">51</span>
                                    <span class="card-r">3</span>
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="attack2">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球员
                                </th>
                                <th class="text-center">
                                    出场
                                </th>
                                <th class="text-center">
                                    上场时间
                                </th>
                                <th class="text-center">
                                    进球
                                </th>
                                <th class="text-center">
                                    射门
                                </th>
                                <th class="text-center">
                                    射正
                                </th>
                                <th class="text-center">
                                    过人
                                </th>
                                <th class="text-center">
                                    被侵犯
                                </th>
                                <th class="text-center">
                                    越位
                                </th>
                                <th class="text-center">
                                    被抢断
                                </th>
                                <th class="text-center">
                                    失误
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <th class="text-center">
                                    1
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    2
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="defend2">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球员
                                </th>
                                <th class="text-center">
                                    出场
                                </th>
                                <th class="text-center">
                                    上场时间
                                </th>
                                <th class="text-center">
                                    抢断
                                </th>
                                <th class="text-center">
                                    拦截
                                </th>
                                <th class="text-center">
                                    解围
                                </th>
                                <th class="text-center">
                                    封堵
                                </th>
                                <th class="text-center">
                                    造越位
                                </th>
                                <th class="text-center">
                                    犯规
                                </th>
                                <th class="text-center">
                                    被过
                                </th>
                                <th class="text-center">
                                    致命失误
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <th class="text-center">
                                    1
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    2
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="organization2">
                <div class="row" style="border-top: 4px solid gainsboro;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    排名
                                </th>
                                <th class="text-left">
                                    球员
                                </th>
                                <th class="text-center">
                                    出场
                                </th>
                                <th class="text-center">
                                    上场时间
                                </th>
                                <th class="text-center">
                                    助攻
                                </th>
                                <th class="text-center">
                                    关键传球
                                </th>
                                <th class="text-center">
                                    传球
                                </th>
                                <th class="text-center">
                                    PS%
                                </th>
                                <th class="text-center">
                                    FTPS%
                                </th>
                                <th class="text-center">
                                    传中
                                </th>
                                <th class="text-center">
                                    长传
                                </th>
                                <th class="text-center">
                                    直塞
                                </th>
                                <th class="text-center">
                                    评分
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <th class="text-center">
                                    1
                                </th>
                                <th class="text-left">
                                    <a href="#">德布劳内</a>
                                    <img src="images/mc.png"></img>
                                    <span class="playerWord">曼城，28，前锋</span>
                                </th>
                                <th class="text-center">
                                    25（1）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    2
                                </th>
                                <th class="text-left">
                                    <a href="#">阿达马·特劳雷</a>
                                    <img src="images/ld.png"></img>
                                    <span class="playerWord">狼队，24，右边锋</span>
                                </th>
                                <th class="text-center">
                                    22（6）
                                </th>
                                <th class="text-center">
                                    19.3
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    65.8
                                </th>
                                <th class="text-center">
                                    51
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    13.9
                                </th>
                                <th class="text-center">
                                    101
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">7.01</span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="playerPage">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>