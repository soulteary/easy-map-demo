<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <title>智能公交查询系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le styles -->
    <link rel="stylesheet" href="./extra/bootstrap.min.css"/>
    <link rel="stylesheet" href="./extra/main.less"/>
    <link rel="stylesheet" href="./extra/bootstrap-responsive.min.css"/>
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
                        <li><a href="#:FAV">收藏</a></li>
                        <li><a href="#:ABOUT">关于</a></li>
                        <li><a href="#:HELP">帮助</a></li>
                        <li><a href="#CONTACT">联系</a></li>
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
        <div class="bs-docs-example form-search">
            <div class="input-append span11 offset1">
                <input class="span10 search-query" type="text" placeholder="请输入路线或者公交线路">
                <a href="#CMD:SEARCH">搜索!</a>
            </div>
        </div>
    </div>
    <hr>

    <div class="row-fluid">
        <div class="span3">
            <div class="table-header">
                <span class="bus-no badge badge-important pull-left">811路</span>
                <span class="label label-info pull-right">约30分钟 / 4.3公里</span>
            </div>
            <table class="table table-striped route-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>路线引导</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span class="badge">1</span></td>
                    <td><span class="route-info">雄楚国际大酒店</span></td>
                </tr>
                <tr>
                    <td><span class="badge">2</span></td>
                    <td><span class="route-info">70米</span></td>
                </tr>
                <tr>
                    <td><span class="badge">3</span></td>
                    <td><span class="route-info">步行至 雄楚大道元宝山站</span></td>
                </tr>
                <tr>
                    <td><span class="badge">4</span></td>
                    <td><span class="route-info">8站</span></td>
                </tr>
                <tr>
                    <td><span class="badge">5</span></td>
                    <td><span class="route-info">乘坐 811路(或 586路, 590路), 在 民族大道时间广场站 下车</span></td>
                </tr>
                <tr>
                    <td><span class="badge">6</span></td>
                    <td><span class="route-info">10米</span></td>
                </tr>
                <tr>
                    <td><span class="badge">7</span></td>
                    <td><span class="route-info">步行至 中南民族大学</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="span9">

            <img src="./extra/data.png" alt=""/>
        </div>

    </div>

    <hr>

    <div class="footer">
        <p>&copy; Company 2013</p>
    </div>

</div> <!-- /container -->
</body>
</html>
