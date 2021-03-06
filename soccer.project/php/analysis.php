<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'page.php';
$link=connect();

$ct="select count(*) from progress";
$count=num($link,$ct);
$page=page($count,10,5);
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>一球成名|数据分析</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/analysis.css">
    <link href="./images/logo.png" rel="icon" type="image/x-icon" />
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <script src="./js/echarts.js"></script>
    <script src="./js/infographic.js"></script>

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
                    <li>
                        <a href="statistics.php">数据统计</a>
                    </li>
                    <li class="active">
                        <a href="analysis.php" style="background-color: white;">数据分析</a>
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
    <div class="anal-all">
        <h3>五大联赛</h3>
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab">
                    英超
                </a>
            </li>
            <li><a href="#xi" data-toggle="tab">西甲</a></li>
            <li><a href="#de" data-toggle="tab">德甲</a></li>
            <li><a href="#yi" data-toggle="tab">意甲</a></li>
            <li><a href="#fa" data-toggle="tab">法甲</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <div id="main" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option = {
                        title: {
                            text: '球队积分排名',
                            subtext: '英超'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            data: ['积分数值']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                            type: 'category',
                            data: ['诺维奇', '维拉', '伯恩茅斯', '沃特福德', '西汉姆', '布莱顿', '南安普顿', '纽卡斯尔', '埃弗顿', '水晶宫', '伯恩利', '阿森纳', '热刺', '谢菲联', '狼队', '曼联', '切西尔', '莱斯特', '曼城', '利物浦', '积分（分）']
                        },
                        series: [{
                            name: '积分数值',
                            type: 'bar',
                            data: [21, 25, 27, 27, 27, 29, 34, 35, 37, 39, 39, 40, 41, 43, 43, 45, 48, 53, 57, 82]
                        }, ]
                    };
                    myChart.setOption(option);
                </script>
                <div id="main2" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main2'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option2 = {
                        title: {
                            text: '球队进失球情况',
                            subtext: '英超'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球', '失球', '净胜球']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: ['诺维奇', '维拉', '伯恩茅斯', '沃特福德', '西汉姆', '布莱顿', '南安普顿', '纽卡斯尔', '埃弗顿', '水晶宫', '伯恩利', '阿森纳', '热刺', '谢菲联', '狼队', '曼联', '切西尔', '莱斯特', '曼城', '利物浦', '进失球情况']
                        },
                        series: [{
                            name: '进球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [25, 34, 29, 27, 35, 32, 35, 25, 37, 26, 34, 40, 47, 30, 41, 44, 51, 58, 68, 66]
                        }, {
                            name: '失球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [52, 56, 47, 44, 50, 40, 52, 41, 46, 32, 40, 36, 40, 25, 34, 30, 39, 28, 31, 21]
                        }, {
                            name: '净胜球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [-27, -22, -18, -17, -15, -8, -17, -16, -9, -6, -6, 4, 7, 5, 7, 14, 12, 30, 37, 45]
                        }, ]
                    };
                    myChart.setOption(option2);
                </script>
                <div id="main3" style="width: 1000px;height:400px"></div>
                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('main3'), 'infographic');
                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option3 = {
                        title: {
                            text: '英超射手榜',
                            subtext: '球员个人进球情况'
                        },
                        dataZoom: [{
                            id: 'dataZoomX',
                            type: 'slider',
                            xAxisIndex: [0],
                            filterMode: 'filter', // 设定为 'filter' 从而 X 的窗口变化会影响 Y 的范围。
                            start: 0,
                            end: 100
                        }, {
                            id: 'dataZoomY',
                            type: 'slider',
                            yAxisIndex: [0],
                            filterMode: 'empty',
                            start: 80,
                            end: 100
                        }],
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球数', '点球数']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: [
                                '伦德斯特拉姆(JohnLundstram)', '阿达马-特拉奥雷(AdamaTraoré)', '杰伊-罗德里格斯(JayRodriguez)', '威廉(Willian)',
                                '谢尔维(JonjoShelvey)', '格林伍德(MasonGreenwood)', '韦斯利(Wesley)',
                                '弗莱克(JohnFleck)', '普利西奇(ChristianPulisic)', '伊斯梅拉-萨尔(IsmailaSarr)',
                                '穆塞(LysMousset)', '斯诺德格拉斯(RobertSnodgrass)', '贝尔纳多-席尔瓦(BernardoSilva)',
                                '迪尼(TroyDeeney)', 'A-巴恩斯(AshleyBarnes)', '若塔(DiogoJota)', '坎特韦尔(ToddCantwell)',
                                '麦迪逊(JamesMaddison)', '芒特(MasonMount)', 'H-巴恩斯(HarveyBarnes)', 'A-佩雷斯(AyozePérez)',
                                '哈里-威尔逊(HarryWilson)', '阿莱(SébastienHaller)', '拉卡泽特(AlexandreLacazette)',
                                '格雷利什(JackGrealish)', '马赫雷斯(RiyadMahrez)', '莫佩(NealMaupay)', '阿里(DeleAlli)',
                                '卡勒姆-威尔逊(CallumWilson)', '小阿尤(JordanAyew)', '菲尔米诺(RobertoFirmino)',
                                '德布劳内(KevinDeBruyne)', '孙兴慜(SonHeung-Min)', '理查利森(Richarlison)',
                                '热苏斯(GabrielJesus)', '凯恩(HarryKane)', '普基(TeemuPukki)', '克里斯-伍德(ChrisWood)',
                                '斯特林(RaheemSterling)', '马夏尔(AnthonyMartial)', '希门尼斯(RaúlJiménez)',
                                '卡尔弗特-勒温(DominicCalvert-Lewin)', '亚伯拉罕(TammyAbraham)', '拉什福德(MarcusRashford)',
                                '马内(SadioMané)', '英斯(DannyIngs)', '萨拉赫(MohamedSalah)', '阿圭罗(SergioAgüero)',
                                '奥巴梅扬(Pierre-EmerickAubameyang)', '瓦尔迪(JamieVardy)',
                            ]
                        },
                        series: [{
                            name: '进球数',
                            type: 'bar',
                            data: [4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6, 6, 6, 7, 7, 7, 7, 7, 7, 8, 8, 8, 8, 8, 8, 9, 10, 10, 11, 11, 11, 11, 11, 13, 13, 13, 14, 14, 15, 16, 16, 17, 19

                            ],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, {
                            name: '点球数',
                            type: 'bar',
                            data: [0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 2, 2, 0, 0, 0, 3, 0, 0, 5, 0, 0, 3, 2, 1, 4

                            ],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, ]
                    };
                    myChart.setOption(option3);
                </script>
            </div>

            <div class="tab-pane fade" id="xi">
                <div id="main4" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main4'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option4 = {
                        title: {
                            text: '球队积分排名',
                            subtext: '西甲'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            data: ['积分数值']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                            type: 'category',
                            data: ['西班牙人', '莱加内斯', '马略卡', '塞尔塔', '埃瓦尔', '巴拉多利德', '阿拉维斯', '莱万特', '皇家贝蒂斯', '奥萨苏纳',
                                '毕尔巴鄂', '格拉纳达', '比利亚雷亚尔', '瓦伦西亚', '马竞', '赫塔菲', '皇家社会', '塞维利亚', '皇马', '巴塞罗那', '积分（分）'
                            ]
                        },
                        series: [{
                            name: '积分数值',
                            type: 'bar',
                            data: [20, 23, 25, 26, 27, 29, 32, 33, 33, 34, 37, 38, 38, 42, 45, 46, 46, 47, 56, 58]
                        }, ]
                    };
                    myChart.setOption(option4);
                </script>
                <div id="main5" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main5'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option5 = {
                        title: {
                            text: '球队进失球情况',
                            subtext: '西甲'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球', '失球', '净胜球']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: ['西班牙人', '莱加内斯', '马略卡', '塞尔塔', '埃瓦尔', '巴拉多利德', '阿拉维斯', '莱万特', '皇家贝蒂斯', '奥萨苏纳',
                                '毕尔巴鄂', '格拉纳达', '比利亚雷亚尔', '瓦伦西亚', '马竞', '赫塔菲', '皇家社会', '塞维利亚', '皇马', '巴塞罗那', '进失球情况'
                            ]
                        },
                        series: [{
                            name: '进球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [23, 21, 28, 22, 27, 23, 29, 32, 38, 34, 29, 33, 44, 38, 31, 37, 45, 39, 49, 63]
                        }, {
                            name: '失球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [46, 39, 44, 34, 41, 33, 37, 40, 43, 38, 23, 32, 38, 39, 21, 25, 33, 29, 19, 31]
                        }, {
                            name: '净胜球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [-23, -18, -16, -12, -14, -10, -8, -8, -5, -4, 6, 1, 6, -1, 10, 12, 12, 10, 30, 32]
                        }, ]
                    };
                    myChart.setOption(option5);
                </script>
                <div id="main6" style="width: 1000px;height:400px"></div>
                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('main6'), 'infographic');
                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option6 = {
                        title: {
                            text: '西甲射手榜',
                            subtext: '球员个人进球情况'
                        },
                        dataZoom: [{
                            id: 'dataZoomX',
                            type: 'slider',
                            xAxisIndex: [0],
                            filterMode: 'filter', // 设定为 'filter' 从而 X 的窗口变化会影响 Y 的范围。
                            start: 0,
                            end: 100
                        }, {
                            id: 'dataZoomY',
                            type: 'slider',
                            yAxisIndex: [0],
                            filterMode: 'empty',
                            start: 80,
                            end: 100
                        }],
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球数', '点球数']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: [
                                '莫伊-戈麦斯(MoiGómez)', '费兰-托雷斯(FerranTorres)', '厄德高(MartinØdegaard)', '拉莫斯(SergioRamos)', '莫利纳(JorgeMolina)', '查莱斯(Charles)', 'D-罗德里格斯(DaniRodríguez)',
                                '普埃尔塔斯(AntonioPuertas)', '卢克-德容(LuukdeJong)', '马约拉尔(BorjaMayoral)', '加梅罗(KevinGameiro)', '卢纳(CarlosFernández)', '科雷亚(ÁngelCorrea)', '罗伯托-托雷斯(RobertoTorres)',
                                '威廉姆斯(IñakiWilliams)', '鲁文-加西亚(RubénGarcía)', '马奇斯(DarwinMachís)', '布莱斯维特(MartinBraithwaite)', 'S-瓜迪奥拉(SergiGuardiola)', '埃坎比(KarlTokoEkambi)', '比达尔(ArturoVidal)',
                                '奥雷利亚纳(FabiánOrellana)', '奥斯卡-罗德里格斯(ÓscarRodríguez)', '费基尔(NabilFekir)', '伊萨克(AlexanderIsak)', '恩-尼西里(YoussefEn-Nesyri)', '波图(Portu)', '卡索拉(SantiCazorla)', '帕雷霍(DanielParejo)',
                                '奥亚萨瓦尔(MikelOyarzabal)', '华金(Joaquín)', '海梅-马塔(JaimeMata)', '莫拉塔(ÁlvaroMorata)', '格列兹曼(AntoineGriezmann)', '劳尔-加西亚(RaúlGarcía)', '阿斯帕斯(IagoAspas)', '威廉-若泽(WillianJosé)', '何塞卢(Joselu)',
                                '布季米尔(AnteBudimir)', '阿维拉(ChimyAvila)', '莫龙(LorenMorón)', '马克西-戈麦斯(MaxiGómez)', '奥坎波斯(LucasOcampos)', '罗德里格斯(ÁngelRodríguez)', '卢卡斯-佩雷斯(LucasPérez)', '罗赫尔(RogerMartí)', '苏亚雷斯(LuisSuárez)', '杰拉德-莫雷诺(GerardMoreno)', '本泽马(KarimBenzema)', '梅西(LionelMessi)',
                            ]
                        },
                        series: [{
                            name: '进球数',
                            type: 'bar',
                            data: [4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6, 6, 6, 6, 7, 7, 7, 7, 7, 7, 8, 8, 8, 8, 8, 8, 8, 9, 9, 9, 9, 9, 9, 9, 9, 10, 10, 11, 11, 11, 11, 14, 19


                            ],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, {
                            name: '点球数',
                            type: 'bar',
                            data: [0, 0, 0, 3, 2, 1, 1, 0, 0, 0, 0, 0, 0, 5, 1, 1, 1, 0, 0, 0, 0, 3, 1, 1, 0, 0, 0, 6, 5, 4, 2, 2, 1, 0, 5, 2, 0, 0, 0, 0, 0, 0, 2, 1, 5, 4, 1, 0, 3, 3

                            ],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, ]
                    };
                    myChart.setOption(option6);
                </script>
            </div>
            <div class="tab-pane fade" id="de">
                <div id="main7" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main7'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option7 = {
                        title: {
                            text: '球队积分排名',
                            subtext: '德甲'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            data: ['积分数值']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                            type: 'category',
                            data: ['帕德博恩', '不莱梅', '杜塞尔多夫', '美因茨', '奥格斯堡', '柏林赫塔', '法兰克福',
                                '柏林联合', '科隆', '霍芬海姆', '弗赖堡', '沃尔夫斯堡', '沙尔克04', '勒沃库森', '门兴', 'RB莱比锡',
                                '多特蒙德', '拜仁', '积分（分）'
                            ]
                        },
                        series: [{
                            name: '积分数值',
                            type: 'bar',
                            data: [16, 18, 22, 26, 27, 28, 28, 30, 32, 35, 36, 36, 37, 47, 49, 50, 51, 55]
                        }, ]
                    };
                    myChart.setOption(option7);
                </script>
                <div id="main8" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main8'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option8 = {
                        title: {
                            text: '球队进失球情况',
                            subtext: '德甲'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球', '失球', '净胜球']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: ['帕德博恩', '不莱梅', '杜塞尔多夫', '美因茨', '奥格斯堡', '柏林赫塔', '法兰克福',
                                '柏林联合', '科隆', '霍芬海姆', '弗赖堡', '沃尔夫斯堡', '沙尔克04', '勒沃库森', '门兴', 'RB莱比锡',
                                '多特蒙德', '拜仁', '进失球情况'
                            ]
                        },
                        series: [{
                            name: '进球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [30, 27, 27, 34, 36, 32, 38, 32, 39, 35, 34, 34, 33, 45, 49, 62, 68, 73]
                        }, {
                            name: '失球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [54, 55, 50, 53, 52, 48, 41, 41, 45, 43, 35, 30, 36, 30, 30, 26, 33, 26]
                        }, {
                            name: '净胜球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [-24, -28, -23, -19, -16, -16, -3, -9, -6, -8, -1, 4, -3, 15, 19, 36, 35, 47]
                        }, ]
                    };
                    myChart.setOption(option8);
                </script>
                <div id="main9" style="width: 1000px;height:400px"></div>
                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('main9'), 'infographic');
                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option9 = {
                        title: {
                            text: '德甲射手榜',
                            subtext: '球员个人进球情况'
                        },
                        dataZoom: [{
                            id: 'dataZoomX',
                            type: 'slider',
                            xAxisIndex: [0],
                            filterMode: 'filter', // 设定为 'filter' 从而 X 的窗口变化会影响 Y 的范围。
                            start: 0,
                            end: 100
                        }, {
                            id: 'dataZoomY',
                            type: 'slider',
                            yAxisIndex: [0],
                            filterMode: 'empty',
                            start: 80,
                            end: 100
                        }],
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球数', '点球数']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: [
                                '贝拉拉比(KarimBellarabi)', '乌特(MarkUth)', '奥尼西沃(KarimOnisiwo)', '科斯蒂奇(FilipKostic)',
                                '恩昆库(ChristopherNkunku)', '瓦尔德施密特(Gian-LucaWaldschmidt)', '福斯贝里(EmilForsberg)',
                                '博尔瑙(SebastiaanBornauw)', '多斯特(BasDost)', '阿达米扬(SargisAdamyan)', '利昂-贝利(LeonBailey)',
                                '帕科(PacoAlcácer)', '格雷罗(RaphaelGuerreiro)', '曼巴(StreliMamba)', '托米(ErikThommy)',
                                '卢克巴基奥(DodiLukébakio)', '赫尔曼(PatrickHerrmann)', '小阿扎尔(ThorganHazard)',
                                '阿拉里奥(LucasAlario)', '施廷德尔(LarsStindl)', '阿里特(AmineHarit)', '欣特雷格(MartinHinteregger)',
                                '哈弗茨(KaiHavertz)', '图拉姆(MarcusThuram)', '穆勒(ThomasMüller)', '拉希察(MilotRashica)',
                                '克拉马里奇(AndrejKramaric)', '帕先西亚(GonçaloPaciência)', '马克斯(PhilippMax)', '比尔特(MariusBülter)',
                                '谢尔达尔(SuatSerdar)', '希克(PatrikSchick)', '恩博洛(BreelEmbolo)', '彼得森(NilsPetersen)',
                                '库蒂尼奥(PhilippeCoutinho)', '萨比策(MarcelSabitzer)', '普莱亚(AlassanePléa)', '哈兰德(ErlingHaaland)',
                                '福兰德(KevinVolland)', '科尔多瓦(JhonCórdoba)', '亨宁斯(RouwenHennings)', '韦霍斯特(WoutWeghorst)',
                                '安德松(SebastianAndersson)', '罗伊斯(MarcoReus)', '尼德莱希纳(FlorianNiederlechner)', '格纳布里(SergeGnabry)',
                                '奎森(RobinQuaison)', '桑乔(JadonSancho)', '维尔纳(TimoWerner)', '莱万多夫斯基(RobertLewandowski)',
                            ]
                        },
                        series: [{
                            name: '进球数',
                            type: 'bar',
                            data: [4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6, 6, 6, 7, 7, 7, 7, 7, 7, 7, 7, 8, 8, 8, 8, 9, 9, 10, 11, 11, 11, 11, 11, 11, 12, 14, 21, 25

                            ],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, {
                            name: '点球数',
                            type: 'bar',
                            data: [0, 0, 0, 0, 0, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 2, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 3, 3, 1, 1, 1, 0, 1, 0, 3, 3],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, ]
                    };
                    myChart.setOption(option9);
                </script>
            </div>
            <div class="tab-pane fade" id="yi">
                <div id="main10" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main10'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option10 = {
                        title: {
                            text: '球队积分排名',
                            subtext: '意甲'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            data: ['积分数值']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                            type: 'category',
                            data: ['布雷西亚', '斯帕尔', '莱切', '热那亚', '桑普', '都灵', '乌迪内斯', '佛罗伦萨', '卡利亚里', '萨索洛', '博洛尼亚', '帕尔马',
                                '维罗纳', 'AC米兰', '那不勒斯', '罗马', '亚特兰大', '国际米兰', '拉齐奥', '尤文图斯', '积分（分）'
                            ]
                        },
                        series: [{
                            name: '积分数值',
                            type: 'bar',
                            data: [16, 18, 25, 25, 26, 27, 28, 30, 32, 32, 34, 35, 35, 36, 39, 45, 48, 54, 62, 63]
                        }, ]
                    };
                    myChart.setOption(option10);
                </script>
                <div id="main11" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main11'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option11 = {
                        title: {
                            text: '球队进失球情况',
                            subtext: '意甲'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球', '失球', '净胜球']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: ['布雷西亚', '斯帕尔', '莱切', '热那亚', '桑普', '都灵', '乌迪内斯', '佛罗伦萨', '卡利亚里', '萨索洛', '博洛尼亚', '帕尔马',
                                '维罗纳', 'AC米兰', '那不勒斯', '罗马', '亚特兰大', '国际米兰', '拉齐奥', '尤文图斯', '进失球情况'
                            ]
                        },
                        series: [{
                            name: '进球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [22, 20, 34, 31, 28, 28, 21, 32, 41, 41, 38, 32, 29, 28, 41, 51, 70, 49, 60, 50]
                        }, {
                            name: '失球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [49, 44, 56, 47, 44, 45, 37, 36, 40, 39, 42, 31, 26, 34, 36, 35, 34, 24, 23, 24]
                        }, {
                            name: '净胜球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [-27, -24, -22, -16, -16, -17, -16, -4, 1, 2, -4, 1, 3, -6, 5, 16, 36, 25, 37, 26]
                        }, ]
                    };
                    myChart.setOption(option11);
                </script>
                <div id="main12" style="width: 1000px;height:400px"></div>
                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('main12'), 'infographic');
                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option12 = {
                        title: {
                            text: '意甲射手榜',
                            subtext: '球员个人进球情况'
                        },
                        dataZoom: [{
                            id: 'dataZoomX',
                            type: 'slider',
                            xAxisIndex: [0],
                            filterMode: 'filter', // 设定为 'filter' 从而 X 的窗口变化会影响 Y 的范围。
                            start: 0,
                            end: 100
                        }, {
                            id: 'dataZoomY',
                            type: 'slider',
                            yAxisIndex: [0],
                            filterMode: 'empty',
                            start: 80,
                            end: 100
                        }],
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球数', '点球数']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: [
                                '米林科维奇-萨维奇(SergejMilinkovic-Savic)', '因西涅(LorenzoInsigne)', '拉米雷斯(GastónRamírez)', '巴洛特利(MarioBalotelli)',
                                '贝伦格尔(AlexBerenguer)', '特奥(TheoHernández)', '德保罗(RodrigodePaul)', '奥卡卡(StefanoOkaka)',
                                '库阿梅(ChristianKouamé)', '热尔维尼奥(Gervinho)', '伊瓜因(GonzaloHiguaín)', '帕萨利奇(MarioPasalic)',
                                '纳英戈兰(RadjaNainggolan)', '库卢塞夫斯基(DejanKulusevski)', '科拉罗夫(AleksandarKolarov)',
                                '弗拉霍维奇(DusanVlahovic)', '加比亚迪尼(ManoloGabbiadini)', '小基耶萨(FedericoChiesa)', '雷比奇(AnteRebic)',
                                '帕拉西奥(RodrigoPalacio)', '小西蒙尼(GiovanniSimeone)', '姆希塔良(HenrikhMkhitaryan)', '默滕斯(DriesMertens)',
                                'A-戈麦斯(AlejandroGómez)', '克里希托(DomenicoCriscito)', '拉帕杜拉(GianlucaLapadula)', '迪巴拉(PauloDybala)',
                                '潘德夫(GoranPandev)', '华金-科雷亚(JoaquínCorrea)', '奥尔索利尼(RiccardoOrsolini)', '戈森斯(RobinGosens)',
                                '曼科苏(MarcoMancosu)', '科内柳斯(AndreasCornelius)', '博加(JeremieBoga)', '凯塞多(FelipeCaicedo)',
                                '贝洛蒂(AndreaBelotti)', '夸利亚雷拉(FabioQuagliarella)', '米利克(ArkadiuszMilik)', '贝拉尔迪(DomenicoBerardi)',
                                '佩塔尼亚(AndreaPetagna)', '劳塔罗-马丁内斯(LautaroMartínez)', 'D-萨帕塔(DuvánZapata)', '哲科(EdinDzeko)',
                                '穆里尔(LuisMuriel)', '卡普托(FrancescoCaputo)', '伊利契奇(JosipIlicic)', '若昂-佩德罗(JoãoPedro)',
                                '卢卡库(RomeluLukaku)', 'C罗(CristianoRonaldo)', '因莫比莱(CiroImmobile)',
                            ]
                        },
                        series: [{
                            name: '进球数',
                            type: 'bar',
                            data: [4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 7, 7, 7, 7, 7, 7, 7, 8, 8, 8, 8, 9, 9, 9, 9, 11, 11, 11, 12, 13, 13, 15, 16, 17, 21, 27

                            ],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, {
                            name: '点球数',
                            type: 'bar',
                            data: [0, 3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1, 1, 1, 0, 0, 0, 0, 0, 0, 7, 2, 1, 0, 0, 0, 0, 5, 0, 0, 0, 5, 5, 0, 0, 5, 2, 1, 0, 5, 1, 0, 3, 4, 7, 10],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, ]
                    };
                    myChart.setOption(option12);
                </script>
            </div>
            <div class="tab-pane fade" id="fa">
                <div id="main13" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main13'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option13 = {
                        title: {
                            text: '球队积分排名',
                            subtext: '法甲'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },
                        legend: {
                            data: ['积分数值']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                            type: 'category',
                            data: ['图卢兹', '亚眠', '尼姆', '圣埃蒂安', '第戎', '梅斯', '布雷斯特', '南特', '波尔多', '斯特拉斯堡', '昂热',
                                '摩纳哥', '蒙彼利埃', '里昂', '尼斯', '兰斯', '里尔', '雷恩', '马赛', '巴黎圣日耳曼', '积分（分）'
                            ]
                        },
                        series: [{
                            name: '积分数值',
                            type: 'bar',
                            data: [13, 23, 27, 30, 30, 34, 34, 37, 37, 38, 39, 40, 40, 40, 41, 41, 49, 50, 56, 68]
                        }, ]
                    };
                    myChart.setOption(option13);
                </script>
                <div id="main14" style="width: 500px;height:600px;float: left"></div>
                <script type="text/javascript">
                    // 基于准备好的dom，初始化echarts实例
                    var myChart = echarts.init(document.getElementById('main14'), 'infographic');

                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option14 = {
                        title: {
                            text: '球队进失球情况',
                            subtext: '英超'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球', '失球', '净胜球']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: ['图卢兹', '亚眠', '尼姆', '圣埃蒂安', '第戎', '梅斯', '布雷斯特', '南特', '波尔多', '斯特拉斯堡', '昂热',
                                '摩纳哥', '蒙彼利埃', '里昂', '尼斯', '兰斯', '里尔', '雷恩', '马赛', '巴黎圣日耳曼', '进失球情况'
                            ]
                        },
                        series: [{
                            name: '进球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [22, 31, 29, 29, 27, 27, 34, 28, 40, 32, 28, 44, 35, 42, 41, 26, 35, 38, 41, 75]
                        }, {
                            name: '失球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [58, 50, 44, 45, 37, 35, 37, 31, 34, 32, 33, 44, 34, 27, 38, 21, 27, 24, 29, 24]
                        }, {
                            name: '净胜球',
                            type: 'bar',
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                            data: [-36, -19, -15, -16, -10, -8, -3, -3, 6, 0, -5, 0, 1, 15, 3, 5, 8, 14, 12, 51]
                        }, ]
                    };
                    myChart.setOption(option14);
                </script>
                <div id="main15" style="width: 1000px;height:400px"></div>
                <script type="text/javascript">
                    var myChart = echarts.init(document.getElementById('main15'), 'infographic');
                    var base = +new Date(1968, 9, 3);
                    var oneDay = 24 * 3600 * 1000;
                    var date = [];

                    var data = [Math.random() * 300];

                    for (var i = 1; i < 20000; i++) {
                        var now = new Date(base += oneDay);
                        date.push([now.getFullYear(), now.getMonth() + 1, now.getDate()].join('-'));
                        data.push(Math.round((Math.random() - 0.5) * 20 + data[i - 1]));
                    }
                    option15 = {
                        title: {
                            text: '法甲射手榜',
                            subtext: '球员个人进球情况'
                        },
                        dataZoom: [{
                            id: 'dataZoomX',
                            type: 'slider',
                            xAxisIndex: [0],
                            filterMode: 'filter', // 设定为 'filter' 从而 X 的窗口变化会影响 Y 的范围。
                            start: 0,
                            end: 100
                        }, {
                            id: 'dataZoomY',
                            type: 'slider',
                            yAxisIndex: [0],
                            filterMode: 'empty',
                            start: 80,
                            end: 100
                        }],
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        legend: {
                            data: ['进球数', '点球数']
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        xAxis: {
                            type: 'value'
                        },
                        yAxis: {
                            type: 'category',
                            data: [
                                '小凯塔(Keita)', '乌丹(RemiOudin)', '科尔内(MaxwelCornet)', '萨拉维亚(PabloSarabia)', '沙博尼耶(GaëtanCharbonnier)',
                                '塔瓦雷斯(JúlioTavares)', '小拉菲尼亚(Raphinha)', '门多萨(JohnStivenMendoza)', '卢多维奇-布拉斯(LudovicBlas)',
                                '马维蒂蒂(StephyMavididi)', '拉多尼奇(NemanjaRadonjic)', '菲利波托(RomainPhilippoteaux)', '恩格特(OpaNguette)',
                                '桑松(MorganSanson)', '西蒙(MosesSimon)', '里斯-米罗(PierreLees-Melou)', '萨瓦尼耶(TéjiSavanier)',
                                '普雷维尔(NicolasdePreville)', '阿里奥伊(RachidAlioui)', '哈穆马(RomainHamouma)', '巴尔德(MamaBaldé)',
                                '黄义助(HwangUi-Jo)', '马贾(JoshMaja)', '莫莱(FlorentMollet)', '卡多纳(IrvinCardona)', '拉波德(GaetanLaborde)',
                                '西普里安(WylanCyprien)', '迪亚(BoulayeDia)', '白里安(JimmyBriand)', '雷米(LoïcRémy)', '胡诺(AdrienHunou)',
                                '卢多维克(LudovicAjorque)', '迪马利亚(ÁngelDiMaría)', '托马松(AdrienThomasson)', '吉拉西(SerhouGuirassy)',
                                '帕耶特(DimitriPayet)', '孟菲斯(MemphisDepay)', '斯利马尼(IslamSlimani)', '德洛尔(AndyDelort)',
                                '博安加(DenisBouanga)', '尼昂(M-BayeNiang)', '贝内德托(DaríoBenedetto)', '多尔贝尔(KasperDolberg)',
                                '迪亚洛(HabibDiallo)', '伊卡尔迪(MauroIcardi)', '内马尔(Neymar)', '奥斯梅恩(VictorOsimhen)',
                                '小穆萨-登贝莱(MoussaDembele)', '本耶德尔(WissamBenYedder)', '姆巴佩(KylianMbappé)',
                            ]
                        },
                        series: [{
                            name: '进球数',
                            type: 'bar',
                            data: [4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 7, 7, 7, 7, 8, 8, 8, 8, 9, 9, 9, 9, 9, 10, 10, 11, 11, 12, 12, 13, 13, 16, 18, 18],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, {
                            name: '点球数',
                            type: 'bar',
                            data: [0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 5, 1, 1, 0, 1, 1, 1, 0, 3, 3, 1, 1, 0, 3, 0, 0, 0, 1, 0, 4, 2, 4, 3, 0],
                            stack: '总量',
                            label: {
                                show: true,
                                position: 'insideRight'
                            },
                        }, ]
                    };
                    myChart.setOption(option15);
                </script>
            </div>
        </div>
    </div>
    <div class="anal-bottom">
        <h3>最快进步/退步</h3>
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#home2" data-toggle="tab">
                        最快进步
                    </a>
            </li>
            <li><a href="#regress" data-toggle="tab">最大退步</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home2">
                <div class="row news" style="border-top: 4px solid gainsboro;">
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
                                    上赛季评分
                                </th>
                                <th class="text-center">
                                    本赛季评分
                                </th>
                                <th class="text-center">
                                    差值
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $pai="SELECT * from progress ORDER BY id ASC {$page['limit']}";
                            $jieg=execute($link,$pai);
                            while($data=mysqli_fetch_assoc($jieg)){
                                if($data['id']%2==1){
$html=<<<a
<tr class="success">
    <th class="text-center">
    {$data['id']}
    </th>
    <th class="text-left">
        <a href="#">{$data['playerName']}</a>
        <span class="playerWord">({$data['teamName']}，{$data['age']}，{$data['playerMainPosition']})</span>
    </th>
    <th class="text-center">
    {$data['apps']}（{$data['appsSub']}）
    </th>
    <th class="text-center">
        {$data['mins']}
    </th>
    <th class="text-center">
    {$data['lastRate']}
    </th>
    <th class="text-center">
    {$data['curRate']}
    </th>
    <th class="text-center">
    {$data['diffRate']}
    </th>
</tr>
a;
echo $html;
                                }else{
$html=<<<a
<tr>
<th class="text-center">
{$data['id']}
</th>
<th class="text-left">
    <a href="#">{$data['playerName']}</a>
    <span class="playerWord">({$data['teamName']}，{$data['age']}，{$data['playerMainPosition']})</span>
</th>
<th class="text-center">
{$data['apps']}（{$data['appsSub']}）
</th>
<th class="text-center">
    {$data['mins']}
</th>
<th class="text-center">
{$data['lastRate']}
</th>
<th class="text-center">
{$data['curRate']}
</th>
<th class="text-center">
{$data['diffRate']}
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
    										$page=page($count,10,5);
    										echo $page['html'];
    									?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="regress">
                <div class="row news" style="border-top: 4px solid gainsboro;">
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
                                    上赛季评分
                                </th>
                                <th class="text-center">
                                    本赛季评分
                                </th>
                                <th class="text-center">
                                    差值
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $pai="SELECT * from fail ORDER BY id ASC {$page['limit']}";
                            $jieg=execute($link,$pai);
                            while($data=mysqli_fetch_assoc($jieg)){
                                if($data['id']%2==1){
$html=<<<a
<tr class="success">
    <th class="text-center">
    {$data['id']}
    </th>
    <th class="text-left">
        <a href="#">{$data['playerName']}</a>
        <span class="playerWord">({$data['teamName']}，{$data['age']}，{$data['playerMainPosition']})</span>
    </th>
    <th class="text-center">
    {$data['apps']}（{$data['appsSub']}）
    </th>
    <th class="text-center">
        {$data['mins']}
    </th>
    <th class="text-center">
    {$data['lastRate']}
    </th>
    <th class="text-center">
    {$data['curRate']}
    </th>
    <th class="text-center">
    {$data['diffRate']}
    </th>
</tr>
a;
echo $html;
                                }else{
$html=<<<a
<tr>
<th class="text-center">
{$data['id']}
</th>
<th class="text-left">
    <a href="#">{$data['playerName']}</a>
    <span class="playerWord">({$data['teamName']}，{$data['age']}，{$data['playerMainPosition']})</span>
</th>
<th class="text-center">
{$data['apps']}（{$data['appsSub']}）
</th>
<th class="text-center">
    {$data['mins']}
</th>
<th class="text-center">
{$data['lastRate']}
</th>
<th class="text-center">
{$data['curRate']}
</th>
<th class="text-center">
{$data['diffRate']}
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
    										$page=page($count,10,5);
    										echo $page['html'];
    									?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="organization">
                <div class="row news" style="border-top: 4px solid gainsboro;">
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
                                    Mins
                                </th>
                                <th class="text-center">
                                    传球
                                </th>
                                <th class="text-center">
                                    PS%
                                </th>
                                <th class="text-center">
                                    CrS%
                                </th>
                                <th class="text-center">
                                    LbS%
                                </th>
                                <th class="text-center">
                                    ThS%
                                </th>
                                <th class="text-center">
                                    FTB
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
                            <tr class="success">
                                <th class="text-center">
                                    1
                                </th>
                                <th class="text-left">
                                    <a href="#">梅西</a>
                                    <span class="playerWord">(巴塞罗那，32，右中锋)</span>
                                </th>
                                <th class="text-center">
                                    21（1）
                                </th>
                                <th class="text-center">
                                    1890
                                </th>
                                <th class="text-center">
                                    55.5
                                </th>
                                <th class="text-center">
                                    82.9
                                </th>
                                <th class="text-center">
                                    24.6
                                </th>
                                <th class="text-center">
                                    64.7
                                </th>
                                <th class="text-center">
                                    50
                                </th>
                                <th class="text-center">
                                    31.6
                                </th>
                                <th class="text-center">
                                    75.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.6</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    2
                                </th>
                                <th class="text-left">
                                    <a href="#">内马尔</a>
                                    <span class="playerWord">(巴黎圣日耳曼，28，左中锋)</span>
                                </th>
                                <th class="text-center">
                                    15
                                </th>
                                <th class="text-center">
                                    1322
                                </th>
                                <th class="text-center">
                                    58.5
                                </th>
                                <th class="text-center">
                                    80.5
                                </th>
                                <th class="text-center">
                                    23.6
                                </th>
                                <th class="text-center">
                                    62.3
                                </th>
                                <th class="text-center">
                                    72.2
                                </th>
                                <th class="text-center">
                                    32.3
                                </th>
                                <th class="text-center">
                                    73.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.55</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    3
                                </th>
                                <th class="text-left">
                                    <a href="#">梅西</a>
                                    <span class="playerWord">(巴塞罗那，32，右中锋)</span>
                                </th>
                                <th class="text-center">
                                    21（1）
                                </th>
                                <th class="text-center">
                                    1890
                                </th>
                                <th class="text-center">
                                    55.5
                                </th>
                                <th class="text-center">
                                    82.9
                                </th>
                                <th class="text-center">
                                    24.6
                                </th>
                                <th class="text-center">
                                    64.7
                                </th>
                                <th class="text-center">
                                    50
                                </th>
                                <th class="text-center">
                                    31.6
                                </th>
                                <th class="text-center">
                                    75.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.6</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    4
                                </th>
                                <th class="text-left">
                                    <a href="#">内马尔</a>
                                    <span class="playerWord">(巴黎圣日耳曼，28，左中锋)</span>
                                </th>
                                <th class="text-center">
                                    15
                                </th>
                                <th class="text-center">
                                    1322
                                </th>
                                <th class="text-center">
                                    58.5
                                </th>
                                <th class="text-center">
                                    80.5
                                </th>
                                <th class="text-center">
                                    23.6
                                </th>
                                <th class="text-center">
                                    62.3
                                </th>
                                <th class="text-center">
                                    72.2
                                </th>
                                <th class="text-center">
                                    32.3
                                </th>
                                <th class="text-center">
                                    73.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.55</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    5
                                </th>
                                <th class="text-left">
                                    <a href="#">梅西</a>
                                    <span class="playerWord">(巴塞罗那，32，右中锋)</span>
                                </th>
                                <th class="text-center">
                                    21（1）
                                </th>
                                <th class="text-center">
                                    1890
                                </th>
                                <th class="text-center">
                                    55.5
                                </th>
                                <th class="text-center">
                                    82.9
                                </th>
                                <th class="text-center">
                                    24.6
                                </th>
                                <th class="text-center">
                                    64.7
                                </th>
                                <th class="text-center">
                                    50
                                </th>
                                <th class="text-center">
                                    31.6
                                </th>
                                <th class="text-center">
                                    75.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.6</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    6
                                </th>
                                <th class="text-left">
                                    <a href="#">内马尔</a>
                                    <span class="playerWord">(巴黎圣日耳曼，28，左中锋)</span>
                                </th>
                                <th class="text-center">
                                    15
                                </th>
                                <th class="text-center">
                                    1322
                                </th>
                                <th class="text-center">
                                    58.5
                                </th>
                                <th class="text-center">
                                    80.5
                                </th>
                                <th class="text-center">
                                    23.6
                                </th>
                                <th class="text-center">
                                    62.3
                                </th>
                                <th class="text-center">
                                    72.2
                                </th>
                                <th class="text-center">
                                    32.3
                                </th>
                                <th class="text-center">
                                    73.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.55</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    7
                                </th>
                                <th class="text-left">
                                    <a href="#">梅西</a>
                                    <span class="playerWord">(巴塞罗那，32，右中锋)</span>
                                </th>
                                <th class="text-center">
                                    21（1）
                                </th>
                                <th class="text-center">
                                    1890
                                </th>
                                <th class="text-center">
                                    55.5
                                </th>
                                <th class="text-center">
                                    82.9
                                </th>
                                <th class="text-center">
                                    24.6
                                </th>
                                <th class="text-center">
                                    64.7
                                </th>
                                <th class="text-center">
                                    50
                                </th>
                                <th class="text-center">
                                    31.6
                                </th>
                                <th class="text-center">
                                    75.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.6</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    8
                                </th>
                                <th class="text-left">
                                    <a href="#">内马尔</a>
                                    <span class="playerWord">(巴黎圣日耳曼，28，左中锋)</span>
                                </th>
                                <th class="text-center">
                                    15
                                </th>
                                <th class="text-center">
                                    1322
                                </th>
                                <th class="text-center">
                                    58.5
                                </th>
                                <th class="text-center">
                                    80.5
                                </th>
                                <th class="text-center">
                                    23.6
                                </th>
                                <th class="text-center">
                                    62.3
                                </th>
                                <th class="text-center">
                                    72.2
                                </th>
                                <th class="text-center">
                                    32.3
                                </th>
                                <th class="text-center">
                                    73.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.55</span>
                                </th>
                            </tr>
                            <tr class="success">
                                <th class="text-center">
                                    9
                                </th>
                                <th class="text-left">
                                    <a href="#">梅西</a>
                                    <span class="playerWord">(巴塞罗那，32，右中锋)</span>
                                </th>
                                <th class="text-center">
                                    21（1）
                                </th>
                                <th class="text-center">
                                    1890
                                </th>
                                <th class="text-center">
                                    55.5
                                </th>
                                <th class="text-center">
                                    82.9
                                </th>
                                <th class="text-center">
                                    24.6
                                </th>
                                <th class="text-center">
                                    64.7
                                </th>
                                <th class="text-center">
                                    50
                                </th>
                                <th class="text-center">
                                    31.6
                                </th>
                                <th class="text-center">
                                    75.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.6</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">
                                    10
                                </th>
                                <th class="text-left">
                                    <a href="#">内马尔</a>
                                    <span class="playerWord">(巴黎圣日耳曼，28，左中锋)</span>
                                </th>
                                <th class="text-center">
                                    15
                                </th>
                                <th class="text-center">
                                    1322
                                </th>
                                <th class="text-center">
                                    58.5
                                </th>
                                <th class="text-center">
                                    80.5
                                </th>
                                <th class="text-center">
                                    23.6
                                </th>
                                <th class="text-center">
                                    62.3
                                </th>
                                <th class="text-center">
                                    72.2
                                </th>
                                <th class="text-center">
                                    32.3
                                </th>
                                <th class="text-center">
                                    73.1
                                </th>
                                <th class="text-center">
                                    <span class="label label-default">8.55</span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    注： Mins:上场时间(分钟) &nbsp;&nbsp;&nbsp;&nbsp; PS%:传球成功率 &nbsp;&nbsp;&nbsp;&nbsp; CrS%:传中成功率 &nbsp;&nbsp;&nbsp;&nbsp; LbS%:长传成功率 &nbsp;&nbsp;&nbsp;&nbsp; ThS%:直塞准确率 &nbsp;&nbsp;&nbsp;&nbsp; FTP%:前场传球 &nbsp;&nbsp;&nbsp;&nbsp; FTPS%:前场传球成功率 &nbsp;&nbsp;&nbsp;&nbsp;
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