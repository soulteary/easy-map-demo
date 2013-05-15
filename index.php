<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <title>智能公交查询系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le styles -->
    <link rel="stylesheet" href="./extra/bootstrap.min.css"/>
    <link rel="stylesheet/less" href="./extra/main.less"/>
    <link rel="stylesheet" href="./extra/bootstrap-responsive.min.css"/>
    <script type="text/javascript" src="./extra/less-1.3.3.min.js"></script>
    <script type="text/javascript" src="./extra/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="./extra/application.js"></script>
</head>
<body>

<div class="container">

    <div class="masthead">
        <h3 class="muted">智能公交查询系统</h3>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li class="active"><a href="#CMD:HOME">首页</a></li>
                        <li><a href="#CMD:FAV">收藏</a></li>
                        <li><a href="#CMD:ABOUT">关于</a></li>
                        <li><a href="#CMD:HELP">帮助</a></li>
                        <li><a href="#CMD:CONTACT">联系</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- /.navbar -->
    </div>

    <div class="jumbotron">
        <h1>掌握实时出行数据!</h1>
        <p class="lead">改变乘客对公交运行状况毫不知情的状况，让乘客在赶往车站途
            中即可根据自身实际情况，获取路况和车辆的实时运行情况以制定更为人性化的乘车
            计划。</p>
        <a class="btn btn-large btn-success" href="#CMD:BEGIN">开始使用</a>
    </div>
    <hr>

    <div class="row-fluid">
        <input class="offset1 span8" id="search-query" type="text" placeholder="请输入路线或者公交线路">
        <a href="#CMD:SEARCH" class="btn btn-primary span2" id="search">搜索!</a>
    </div>
    <hr>

    <div class="row-fluid">
            <table class="table table-striped" id="route-table">
                <thead>
                <tr>
                    <th width="10%">路线编号</th>
                    <th width="20%">路线方案</th>
                    <th width="50%">路线详情</th>
                    <th width="10%">路线状态</th>
                    <th width="10%">到达时间</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="5">请先输入查询数据。</td>
                </tr>

                </tbody>
            </table>
    </div>

    <hr>

    <div class="footer">
        <p>&copy; Company 2013</p>
    </div>

</div> <!-- /container -->
</body>
</html>
