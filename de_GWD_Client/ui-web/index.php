<?php ob_start(ob_gzhandler); ?> 
<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="de_GWD">
  <meta name="author" content="JacyL4">

  <title>de_GWD - 概览</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">
  <link href="css/bootstrap4-toggle.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">de_GWD</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Pi-hole</span>
        </a>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>概览</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nodeman.php">
          <i class="fas fa-fw fa-stream"></i>
          <span>节点管理</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listbw.php">
          <i class="fas fa-fw fa-th-list"></i>
          <span>黑白名单</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="donate.php">
          <i class="fas fa-fw fa-yen-sign"></i>
          <span>捐赠</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="logout()">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>注销</span></a>
      </li>
    </ul>
<script>
function logout () {
$.get('auth.php', {logout:'true'}, function(result){ window.location.href="index.php" });
};
</script>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">概览</a>
          </li>
          <li class="breadcrumb-item active">状态</li>
        </ol>

        <!-- Icon Cards -->
        <div class="row">

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-rocket"></i>
                </div>
                <div class="mr-5">联网状态</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="testbaidu" class="float-left">
                </span>
                <span id="testgoogle" class="float-right">
                </span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-toggle-on"></i>
                </div>
                <div class="mr-5">代理开关</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span class="float-left">
<input id="proxy-toggle" type="checkbox" data-toggle="toggle" data-on="代理中" data-off="已停止" data-onstyle="light" data-offstyle="dark" data-style="border mt-n1" data-size="xs">
                </span>
                <span class="float-right">
<button type="button" class="btn btn-light btn-xs mt-n1" onclick="proxyon()">ON</button>
&#160
<button type="button" class="btn btn-secondary btn-xs mt-n1" onclick="proxyoff()">OFF</button>
<script>
function proxyon () {
    $.get('proxyon.php', function(result){});
};
function proxyoff () {
    $.get('proxyoff.php', function(result){});
};
</script>
                </span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-bell"></i>
                </div>
                <div class="mr-5">版本检测</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <h6><span id="currentver" class="badge badge-pill badge-light float-left mb-n2"></span></h6>
                <h6><span id="remotever" class=""></span></h6>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-clock"></i>
                </div>
                <div class="mr-5">运行时长</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="uptime" class="float-right">
                </span>
              </a>
            </div>
          </div>

        </div>

<script> 
function uptime() { 
$.get('uptime.php', function(data) { $('span#uptime').text(data) });
};

function chlink1() { 
$.get('testbaidu.php', function(data) { $('span#testbaidu').text(data) });
};

function chlink2() { 
$.get('testgoogle.php', function(data) { $('span#testgoogle').text(data) });
};

function testproxy() { 
$.get('testproxy.php', function(data) { $('#proxy-toggle').bootstrapToggle(String(data)) });
};

window.onload = setInterval(function() {
uptime();
chlink1();
chlink2();
testproxy();
}, 1000);
</script>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-stream"></i>
            节点列表</div><button type="button" class="btn btn-outline-success btn-sm" style="border-Radius: 0px;" onclick="pingtest()">Ping</button>
<script>
function pingtest () {
$.get('ping1.php', function(data) { $('#ping1').html(data) });

$.get("ping2.php", function(data) { $('#ping2').html(data) });

$.get("ping3.php", function(data) { $('#ping3').html(data) });

$.get("ping4.php", function(data) { $('#ping4').html(data) });

$.get("ping5.php", function(data) { $('#ping5').html(data) });

$.get("ping6.php", function(data) { $('#ping6').html(data) });

$.get("ping7.php", function(data) { $('#ping7').html(data) });

$.get("ping8.php", function(data) { $('#ping8').html(data) });

$.get("ping9.php", function(data) { $('#ping9').html(data) });
};
</script>



          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover text-center text-nowrap" id="dataTable">
                <thead>

<span class="float-left">
<div class="input-group ml-4 mb-4 mt-1">
  <div class="input-group-prepend">
    <label class="input-group-text">Netflix 分流</label>
  </div>
  <div class="input-group-append">
    <button id="nodenfshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"></button>
    <div class="dropdown-menu">
      <a class="dropdown-item" onclick="nfswitch1()" href="#" id="nodenfshow1"></a>
      <a class="dropdown-item" onclick="nfswitch2()" href="#" id="nodenfshow2"></a>
      <a class="dropdown-item" onclick="nfswitch3()" href="#" id="nodenfshow3"></a>
      <a class="dropdown-item" onclick="nfswitch4()" href="#" id="nodenfshow4"></a>
      <a class="dropdown-item" onclick="nfswitch5()" href="#" id="nodenfshow5"></a>
      <a class="dropdown-item" onclick="nfswitch6()" href="#" id="nodenfshow6"></a>
      <a class="dropdown-item" onclick="nfswitch7()" href="#" id="nodenfshow7"></a>
      <a class="dropdown-item" onclick="nfswitch8()" href="#" id="nodenfshow8"></a>
      <a class="dropdown-item" onclick="nfswitch9()" href="#" id="nodenfshow9"></a>
    </div>
  </div>
</div>
</span>

                    <tr>
                    <th>#</th>
                    <th>节点名</th>
                    <th>域名</th>
                    <th>延迟(ms)</th>
                    <th>操作</th>
                    <th>状态</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><span id="nodeshow1" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==1{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping1" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch1()">切换</button></td>
                    <td id="nodecheck1"></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span id="nodeshow2" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==2{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping2" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch2()">切换</button></td>
                    <td id="nodecheck2"></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><span id="nodeshow3" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==3{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping3" class='mb-0 text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch3()">切换</button></td>
                    <td id="nodecheck3"></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span id="nodeshow4" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==4{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping4" class='mb-0 text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch4()">切换</button></td>
                    <td id="nodecheck4"></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span id="nodeshow5" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==5{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping5" class='mb-0 text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch5()">切换</button></td>
                    <td id="nodecheck5"></td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span id="nodeshow6" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==6{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping6" class='mb-0 text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch6()">切换</button></td>
                    <td id="nodecheck6"></td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span id="nodeshow7" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==7{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping7" class='mb-0 text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch7()">切换</button></td>
                    <td id="nodecheck7"></td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span id="nodeshow8" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==8{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping8" class='mb-0 text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch8()">切换</button></td>
                    <td id="nodecheck8"></td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span id="nodeshow9" class="align-middle"></span></td>
                    <td><span class="align-middle"><?php echo shell_exec("awk 'NR==9{print}' /var/www/html/domain.txt"); ?></span></td>
                    <td><span id="ping9" class='mb-0 text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch9()">切换</button></td>
                    <td id="nodecheck9"></td>
                  </tr>
                </tbody>
              </table>

<span class="float-left">
<div class="input-group ml-4 mt-1 mb-1">
  <div class="input-group-prepend">
    <label class="input-group-text">内网设备分流</label>
  </div>
  <div class="input-group-append">
    <button id="nodedtshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"></button>
    <div class="dropdown-menu">
      <a class="dropdown-item" onclick="dtswitch1()" href="#" id="nodedtshow1"></a>
      <a class="dropdown-item" onclick="dtswitch2()" href="#" id="nodedtshow2"></a>
      <a class="dropdown-item" onclick="dtswitch3()" href="#" id="nodedtshow3"></a>
      <a class="dropdown-item" onclick="dtswitch4()" href="#" id="nodedtshow4"></a>
      <a class="dropdown-item" onclick="dtswitch5()" href="#" id="nodedtshow5"></a>
      <a class="dropdown-item" onclick="dtswitch6()" href="#" id="nodedtshow6"></a>
      <a class="dropdown-item" onclick="dtswitch7()" href="#" id="nodedtshow7"></a>
      <a class="dropdown-item" onclick="dtswitch8()" href="#" id="nodedtshow8"></a>
      <a class="dropdown-item" onclick="dtswitch9()" href="#" id="nodedtshow9"></a>
    </div>
  </div>
</div>
</span>

<span class="float-right">
<div class="input-group mt-1 mr-4">
  <div class="input-group-prepend">
  <input id="nodedttext" type="text" class="form-control" placeholder="内网设备IP" value="<?php echo shell_exec('awk "/[Rs]ource/" /etc/v2ray/config.json | cut -d"\"" -f4'); ?>">
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="submitlocalip()">IP写入</button>
  </div>
</div>
</span>

<script>
function submitlocalip () {
localiptxt=$('#nodedttext').val();
$.get('changelocalip.php', {localip:localiptxt}, function(result){ location.reload(); });
}
</script>

            </div>
          </div>
        </div>

        <!-- DoH -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-bezier-curve"></i>
            Dns over Https</div>
          <div class="card-body">
<form>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="DoH1" class="form-control" placeholder="DoH1" required="required" value="<?php echo shell_exec("awk '/[Rh]ttps:/' /etc/dns-over-https/doh-client.conf | awk -F'//' 'NR==1{print $2}' | cut -d'/' -f1
"); ?>">
                  <label for="DoH1">DoH1</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="DoH2" class="form-control" placeholder="DoH2" required="required" value="<?php echo shell_exec("awk '/[Rh]ttps:/' /etc/dns-over-https/doh-client.conf | awk -F'//' 'NR==2{print $2}' | cut -d'/' -f1
"); ?>">
                  <label for="DoH2">DoH2</label>
                </div>
              </div>
            </div>
          </div>
</form>

<span class="float-right">
<button id="submitdoh" type="button" class="btn btn-primary" onclick="submitdoh()">应用</button>
</span>

<script>
function submitdoh () {
dohtxt1=$('#DoH1').val();
dohtxt2=$('#DoH2').val();
$.get('changedoh.php', {DoH1:dohtxt1, DoH2:dohtxt2}, function(result){ location.reload() });
}
</script>
          </div>
          </div>

        <!-- 静态地址 -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-exchange-alt"></i>
            静态地址</div>
          <div class="card-body">
<form>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="localip" class="form-control" placeholder="本机地址" required="required" value="<?php echo shell_exec("ip -oneline -family inet address show |  awk '{print $4}' | awk 'END {print}' | cut -d '/' -f1"); ?>">
                  <label for="localip">本机地址</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="upstreamip" class="form-control" placeholder="上级地址" required="required" value="<?php echo shell_exec("route -n |  awk 'NR==3{print $2}'"); ?>">
                  <label for="upstreamip">上级地址</label>
                </div>
              </div>
            </div>
          </div>
</form>

<span class="float-right">
<button id="submitdoh" type="button" class="btn btn-danger" onclick="submitstaticip()">应用&重启</button>
</span>

<script>
function submitstaticip () {
staticip1=$('#localip').val();
staticip2=$('#upstreamip').val();
$.get('changestaticip.php', {localip:staticip1, upstreamip:staticip2}, function(result){});
}
</script>
          </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © de_GWD by JacyL4 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script> 
node1 = "<?php echo exec("awk 'NR==1{print}' /var/www/html/nodename.txt"); ?>";
node2 = "<?php echo exec("awk 'NR==2{print}' /var/www/html/nodename.txt"); ?>";
node3 = "<?php echo exec("awk 'NR==3{print}' /var/www/html/nodename.txt"); ?>";
node4 = "<?php echo exec("awk 'NR==4{print}' /var/www/html/nodename.txt"); ?>";
node5 = "<?php echo exec("awk 'NR==5{print}' /var/www/html/nodename.txt"); ?>";
node6 = "<?php echo exec("awk 'NR==6{print}' /var/www/html/nodename.txt"); ?>";
node7 = "<?php echo exec("awk 'NR==7{print}' /var/www/html/nodename.txt"); ?>";
node8 = "<?php echo exec("awk 'NR==8{print}' /var/www/html/nodename.txt"); ?>";
node9 = "<?php echo exec("awk 'NR==9{print}' /var/www/html/nodename.txt"); ?>";


nodenum = "nodecheck<?php echo exec('/usr/local/bin/ui-nodecheck');?>" ;
nodestatusf = "<h5 class='mb-0'><span class='badge badge-pill badge-secondary'>闲置</span></h5>";
nodestatust = "<h5 class='mb-0'><span class='badge badge-pill badge-success'>选中</span></h5>";

window.onload = function() {
$.get("version.php", function(data) {
var strver=data;
var currentvernum = strver.split("-")[0].substring(0);
var remotevernum = strver.split("-")[1].substring(0);
$('#currentver').html(currentvernum+'本机');
$('#remotever').html(remotevernum+' 发布');

var vera = $.trim(currentvernum);
var verb = $.trim(remotevernum);
if (vera == verb) {
$('#remotever').addClass('badge badge-pill badge-light float-right mt-n2');
} 
else {
$('#remotever').addClass('badge badge-pill badge-danger float-right mt-n2');
};

});





$("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");
$.get("nodechecknf.php", function(data) { $('#nodenfshow').html(data) });
$.get("nodecheckdt.php", function(data) { $('#nodedtshow').html(data) });

$('#nodenfshow1').text(node1);
$('#nodenfshow2').text(node2);
$('#nodenfshow3').text(node3);
$('#nodenfshow4').text(node4);
$('#nodenfshow5').text(node5);
$('#nodenfshow6').text(node6);
$('#nodenfshow7').text(node7);
$('#nodenfshow8').text(node8);
$('#nodenfshow9').text(node9);

$('#nodedtshow1').text(node1);
$('#nodedtshow2').text(node2);
$('#nodedtshow3').text(node3);
$('#nodedtshow4').text(node4);
$('#nodedtshow5').text(node5);
$('#nodedtshow6').text(node6);
$('#nodedtshow7').text(node7);
$('#nodedtshow8').text(node8);
$('#nodedtshow9').text(node9);

$('#nodeshow1').text(node1);
$('#nodeshow2').text(node2);
$('#nodeshow3').text(node3);
$('#nodeshow4').text(node4);
$('#nodeshow5').text(node5);
$('#nodeshow6').text(node6);
$('#nodeshow7').text(node7);
$('#nodeshow8').text(node8);
$('#nodeshow9').text(node9);

$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);

$("#"+nodenum).html(nodestatust);
};

function nfswitch1 () {
$.get("changenodenf.php", {nodenfnum:"1"}, function(result){ $('#nodenfshow').html(node1) });
};

function nfswitch2 () {
$.get("changenodenf.php", {nodenfnum:"2"}, function(result){ $('#nodenfshow').html(node2) });
};

function nfswitch3 () {
$.get("changenodenf.php", {nodenfnum:"3"}, function(result){ $('#nodenfshow').html(node3) });
};

function nfswitch4 () {
$.get("changenodenf.php", {nodenfnum:"4"}, function(result){ $('#nodenfshow').html(node4) });
};

function nfswitch5 () {
$.get("changenodenf.php", {nodenfnum:"5"}, function(result){ $('#nodenfshow').html(node5) });
};

function nfswitch6 () {
$.get("changenodenf.php", {nodenfnum:"6"}, function(result){ $('#nodenfshow').html(node6) });
};

function nfswitch7 () {
$.get("changenodenf.php", {nodenfnum:"7"}, function(result){ $('#nodenfshow').html(node7) });
};

function nfswitch8 () {
$.get("changenodenf.php", {nodenfnum:"8"}, function(result){ $('#nodenfshow').html(node8) });
};

function nfswitch9 () {
$.get("changenodenf.php", {nodenfnum:"9"}, function(result){ $('#nodenfshow').html(node9) });
};



function dtswitch1 () {
$.get("changenodedt.php", {nodedtnum:"1"}, function(result){ $('#nodedtshow').html(node1) });
};

function dtswitch2 () {
$.get("changenodedt.php", {nodedtnum:"2"}, function(result){ $('#nodedtshow').html(node2) });
};

function dtswitch3 () {
$.get("changenodedt.php", {nodedtnum:"3"}, function(result){ $('#nodedtshow').html(node3) });
};

function dtswitch4 () {
$.get("changenodedt.php", {nodedtnum:"4"}, function(result){ $('#nodedtshow').html(node4) });
};

function dtswitch5 () {
$.get("changenodedt.php", {nodedtnum:"5"}, function(result){ $('#nodedtshow').html(node5) });
};

function dtswitch6 () {
$.get("changenodedt.php", {nodedtnum:"6"}, function(result){ $('#nodedtshow').html(node6) });
};

function dtswitch7 () {
$.get("changenodedt.php", {nodedtnum:"7"}, function(result){ $('#nodedtshow').html(node7) });
};

function dtswitch8 () {
$.get("changenodedt.php", {nodedtnum:"8"}, function(result){ $('#nodedtshow').html(node8) });
};

function dtswitch9 () {
$.get("changenodedt.php", {nodedtnum:"9"}, function(result){ $('#nodedtshow').html(node9) });
};



function switch1 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"1"}, function(result){ $('#nodecheck1').html(nodestatust) });
};

function switch2 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"2"}, function(result){ $('#nodecheck2').html(nodestatust) });
};

function switch3 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"3"}, function(result){ $('#nodecheck3').html(nodestatust) });
};

function switch4 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"4"}, function(result){ $('#nodecheck4').html(nodestatust) });
};

function switch5 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"5"}, function(result){ $('#nodecheck5').html(nodestatust) });
};

function switch6 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"6"}, function(result){ $('#nodecheck6').html(nodestatust) });
};

function switch7 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"7"}, function(result){ $('#nodecheck7').html(nodestatust) });
};

function switch8 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"8"}, function(result){ $('#nodecheck8').html(nodestatust) });
};

function switch9 () {
$('#nodecheck1').html(nodestatusf);
$('#nodecheck2').html(nodestatusf);
$('#nodecheck3').html(nodestatusf);
$('#nodecheck4').html(nodestatusf);
$('#nodecheck5').html(nodestatusf);
$('#nodecheck6').html(nodestatusf);
$('#nodecheck7').html(nodestatusf);
$('#nodecheck8').html(nodestatusf);
$('#nodecheck9').html(nodestatusf);
    $.get("changenode.php", {nodenum:"9"}, function(result){ $('#nodecheck9').html(nodestatust) });
};
</script>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  <script src="js/bootstrap4-toggle.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- scripts for this page-->

</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
<?php ob_end_flush(); ?> 