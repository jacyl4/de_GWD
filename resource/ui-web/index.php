<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="de_GWD">
  <meta name="author" content="JacyL4">

<title>寒月</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/animation.css" rel="stylesheet">

  <link href="favicon.ico" rel="icon" type="image/x-icon" />

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</head>

<body id="page-top" class="sidebar-toggled fixed-padding">
<?php $de_GWDconf = file_get_contents('/opt/de_GWD/0conf'); ?>
<?php $checkNetdata = file_exists('/usr/libexec/netdata/netdata-updater.sh'); ?>
<?php $checkJellyfin = file_exists('/usr/bin/jellyfin'); ?>
<?php $checlBitwardenrs = json_decode($de_GWDconf)->app->bitwardenrs; ?>

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button id="sidebarToggle" class="btn btn-link btn-sm text-white order-1 order-sm-0" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php passthru('sudo /opt/de_GWD/ui-checkEditionARM');?></span>
<span class="float-right badge text-success"><?php passthru('sudo /opt/de_GWD/ui-checkEditionFWD');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkJellyfin === true) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8097')">
          <i class="fab fa-youtube"></i>
          <span>Jellyfin</span>
        </a>
      </li>

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkNetdata === true) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="/netdata/" onclick="javascript:event.target.port=location.port" target="_blank">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Netdata</span>
        </a>
      </li>

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checlBitwardenrs === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8099')">
          <i class="fas fa-shield-alt"></i>
          <span>Bitwarden_rs</span>
        </a>
      </li>
      
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="/admin/" onclick="javascript:event.target.port=location.port" target="_blank">
          <i class="fab fa-raspberry-pi"></i>
          <span>Pi-Hole</span>
        </a>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav toggled">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-tachometer-alt"></i>
          <span>概览</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forward.php">
          <i class="fas fa-project-diagram"></i>
          <span>中转</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ddns.php">
          <i class="fas fa-ethernet"></i>
          <span>DDNS & LINK</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="app.php">
          <i class="fab fa-app-store-ios"></i>
          <span>应用</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listBW.php">
          <i class="fas fa-th-list"></i>
          <span>黑白名单</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nodeMAN.php">
          <i class="fas fa-stream"></i>
          <span>节点管理</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update.php">
          <i class="fas fa-arrow-alt-circle-up"></i>
          <span>更新</span></a>
      </li>
      <li class="nav-item">
        <a id="buttonLogout" class="nav-link" href="javascript:void(0)">
          <i class="fas fa-sign-out-alt"></i>
          <span>注销</span></a>
      </li>
    </ul>

    <div id="content-wrapper" class="mx-auto" style="max-width: 1600px;">

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
                  <i class="fas fa-rocket"></i>
                </div>
                <div class="form-row align-items-center">联网状态</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="testBaidu" class="float-left"></span>
                <span id="testYoutue" class="float-right"></span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-bell"></i>
                </div>
                <div class="form-row align-items-center">版本检测</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <h6 class="float-left" style="margin-bottom: 0"><span id="currentver" class="" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;"></span></h6>
                <h6 class="float-right" style="margin-bottom: 0"><span id="remotever" class="" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;"></span></h6>
              </a>
            </div>
          </div>
          
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-toggle-on"></i>
                </div>
                <div class="form-row align-items-center">
                  <span>代理开关</span>
                  <span id="buttonProxyLoading"></span>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <h6 id="buttonProxyRestart" class="float-left" style="margin-bottom: 0"><button class="btn btn-light" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;">重启代理</button></h6>
                <h6 id="buttonProxyStop" class="float-right" style="margin-bottom: 0"><button class="btn btn-light" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;">关闭代理</button></h6>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-clock"></i>
                </div>
                  <div class="form-row align-items-center">运行时长</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="uptime" class="float-left"></span>
                <span class="float-right"><?php passthru('sudo /opt/de_GWD/ui-checkStatus');?></span>
              </a>
            </div>
          </div>
        </div>


<!-- Modal -->
<div id="markThis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="markThisLabel" class="modal-title">备注本机</h5>
      </div>
      <div class="modal-body">
        <input id="markName" type="text" class="form-control" placeholder="备注名" required="required" value="<?php echo json_decode($de_GWDconf)->address->alias ?>">
      </div>
      <div class="modal-footer">
        <button id="buttonMarkThis" type="button" class="btn btn-outline-dark btn-sm">应用</button>
      </div>
    </div>
  </div>
</div>

<div id="reboot" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reboot" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="top:50%" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title">重启生效</h5>
      </div>

      <div class="modal-footer">
        <button id="buttonSubmitStaticIP" type="button" class="btn btn-sm btn-outline-danger">立即重启</button>
      </div>
    </div>
  </div>
</div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-stream"></i>
            节点列表
         <span class="float-right mt-n1 mb-n2">
              <div class="btn-group">
                <button id="buttonOffUDP" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOffUDPloading"></span>
                  <span>关闭</span>
                </button>
                <button id="buttonOnUDP" type="button" class="btn <?php if(strstr(file_get_contents('/opt/de_GWD/iptables-proxy-up'), '-p udp -j TPROXY') == false) echo 'btn-outline-secondary'; else echo 'btn-success';?> btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOnUDPloading"></span>
                  <span>UDP代理</span>
                </button>
              </div>
          </span>
          </div>
          <div style="display: flex;flex-wrap: wrap;">
            <button id="buttonPingTCP" type="button" class="btn btn-outline-success btn-sm col-6" style="border-radius: 0px;">Ping (TCP)</button>
            <button id="buttonPingICMP" type="button" class="btn btn-outline-success btn-sm col-6" style="border-radius: 0px;">Ping (ICMP)</button>
          </div>

          <div class="card-body">

<span class="float-left mx-4 mb-3">
<?php $nodeDT = json_decode($de_GWDconf)->divertLan->display; ?>
<div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text">内网设备分流</label>
  </div>
  <div id="nodeDTlist" class="input-group-append input-group-append" style="display:<?php if($nodeDT == block) echo 'block'; else echo 'none'; ?>">
    <button id="nodedtshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php $nodedtnum = exec('/opt/de_GWD/ui-checkNodeDT &'); echo json_decode($de_GWDconf)->v2node[$nodedtnum]->name; ?></button>
    <div id="nodedt" class="dropdown-menu">
    </div>
  </div>
  <div id="nodeDTip" class="input-group-prepend input-group-append" style="display:<?php if($nodeDT == block) echo 'block'; else echo 'none'; ?>">
    <input id="nodedttext" type="text" class="form-control" placeholder="内网设备IP 空格分隔" value="<?php foreach (json_decode($de_GWDconf)->divertLan->ip as $k => $v) {echo "$v ";} ?>">
  </div>
  <div id="nodeDTipButton" class="input-group-prepend input-group-append" style="display:<?php if($nodeDT == block) echo 'block'; else echo 'none'; ?>">
    <button id="buttonSubmitDivertIP" class="btn btn-outline-secondary" type="button">
      <span id="buttonSubmitDivertIPloading"></span>
      <span>IP写入</span>
    </button>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="nodeDTswitch(this)">
      <span id="buttonNodeDTloading"></span>
      <span id="nodeDTtext"><?php if($nodeDT == block) echo 'OFF'; else echo 'ON'; ?></span>
    </button>
  </div>
</div>
</span>

<span class="float-right mx-4 mb-3">
<div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text">Netflix 分流</label>
  </div>
  <div class="input-group-append">
    <button id="nodenfshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php $nodenfnum = exec('/opt/de_GWD/ui-checkNodeNF &'); echo json_decode($de_GWDconf)->v2node[$nodenfnum]->name; ?></button>
    <div id="nodenf" class="dropdown-menu">
    </div>
  </div>
</div>
</span>


            <div class="table-responsive">
              <table class="table table-bordered table-hover text-center text-nowrap my-2">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>域名</th>
                    <th>节点名</th>
                    <th>延迟(ms)</th>
                    <th>速度(MB/s)</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody id="nodeTable">
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- row2 -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="far fa-compass"></i>
            DNS
          <span class="float-right mt-n1 mb-n2">
              <div class="btn-group">
                <button id="buttonDnsCHNW" type="button" class="btn btn-<?php $DNSchnw = file_get_contents('/opt/de_GWD/v2dns/config.json'); if(strpos($DNSchnw,'geosite:cn') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonDnsCHNWloading"></span>
                  <span>大陆白名单</span>
                </button>
                <button id="buttonDnsGFW" type="button" class="btn btn-<?php $DNSgfw = file_get_contents('/opt/de_GWD/v2dns/config.json'); if(strpos($DNSgfw,'geolocation-!cn') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonDnsGFWloading"></span>
                  <span>GFWlist</span>
                </button>
              </div>
                <button id="buttonclearDNS" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonclearDNSloading"></span>
                  <span>清理缓存</span>
                </button>
                <button id="buttonSubmitDNS" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonSubmitDNSloading"></span>
                  <span>应用</span>
                </button>
          </span>
          </div>

<?php $smartdnsConf = file_get_contents ('/etc/smartdns/smartdns.conf'); preg_match_all('/(?<=\bhttps:\/\/)\S+/is', $smartdnsConf, $DOHstr); preg_match_all('/(?<=\bhost-name )\S+/is', $smartdnsConf, $DOHdomain);?>
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-5">
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DoH 1<br>
                  </span>
                </div>
                <input type="text" id="DoH1" class="form-control" placeholder="DoH1" required="required" value="<?php echo $DOHdomain[0][0]; echo preg_replace('/\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}/', '', $DOHstr[0][0]);?>">
                <div class="input-group-append">
                  <span id="pingDOH1" class="input-group-text text-success"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DoH 2<br>
                  </span>
                </div>
                <input type="text" id="DoH2" class="form-control" placeholder="DoH2" required="required" value="<?php echo $DOHdomain[0][1]; echo preg_replace('/\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}/', '', $DOHstr[0][1]);?>">
                <div class="input-group-append">
                  <span id="pingDOH2" class="input-group-text text-success"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>

              <div class="row">
                <div class="ml-auto mr-3">
                  <div class="input-group my-2">
                    <div class="input-group-prepend">
                      <button id="buttonOnAPPLE" class="btn btn-<?php $apple = file_get_contents('/opt/de_GWD/v2dns/config.json'); if(strpos("$apple",'geosite:apple') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm" type="button">
                        <span id="buttonOnAPPLEloading"></span>
                        <span>Apple直连</span>
                      </button>
                    </div>
                    <div class="input-group-append">
                      <button id="buttonOffAPPLE" class="btn btn-secondary btn-sm" type="button">
                        <span id="buttonOffAPPLEloading"></span>
                        <span>OFF</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              </div>

              <div class="col-md-3">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DNS<br>
                  国内<br>
                  </span>
                </div>
                  <textarea id="dnsChina" class="form-control" aria-label="dnsChina" rows="6">
<?php
preg_match_all('/(?<=\bserver )\S+/is', $smartdnsConf, $dnsClist);
foreach($dnsClist[0] as $k => $v){
  if ($k === array_key_last($dnsClist[0]))
    echo "$v";
  else
    echo "$v\n";
}
?>
                  </textarea>
                </div>
              </div>

              <div class="col-md-4">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  hosts<br>
                  静态<br>
                  </span>
                </div>
                  <textarea id="hostsCustomize" class="form-control" aria-label="hostsCustomize" rows="6" placeholder="IP 空格 域名"><?php passthru("sudo /opt/de_GWD/ui-hostsCustomize"); ?></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- row3 -->
        <div class="form-row">
        <!-- 静态地址 -->
          <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-exchange-alt"></i>
            IP地址
          <span class="float-right mt-n1 mb-n2">
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" data-toggle="modal" data-target="#reboot">应用/重启</button>
          </span>
          </div>
          <div class="card-body">
                <div class="form-row">
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="localip" type="text" class="form-control" placeholder="本机地址" required="required" value="<?php echo json_decode($de_GWDconf)->address->localIP ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">本机</span>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="upstreamip" type="text" class="form-control" placeholder="上级地址" required="required" value="<?php echo json_decode($de_GWDconf)->address->upstreamIP ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">上级</span>
                </div>
                </div>
                </div>
                </div>
          </div>
          </div>
          </div>

        <!-- DHCP -->
          <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-network-wired"></i>
            DHCP
          <span class="float-right mt-n1 mb-n2">
                <a class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" href="admin/settings.php?tab=piholedhcp" target="_blank">详情</a>
              <div class="btn-group">
                <button id="buttonOffDHCP" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOffDHCPloading"></span>
                  <span>关闭</span>
                </button>
                <button id="buttonOnDHCP" type="button" class="btn btn-<?php passthru('sudo /opt/de_GWD/ui-checkDhcp');?> btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOnDHCPloading"></span>
                  <span>应用</span>
                </button>
              </div>
          </span>
          </div>
          <div class="card-body">
                <div class="form-row">
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="dhcpStart" type="text" class="form-control" placeholder="起始IP" required="required" value="<?php echo json_decode($de_GWDconf)->address->dhcpStart ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">起始</span>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="dhcpEnd" type="text" class="form-control" placeholder="结束IP" required="required" value="<?php echo json_decode($de_GWDconf)->address->dhcpEnd ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">结束</span>
                </div>
                </div>
                </div>
                </div>
          </div>
          </div>
          </div>
        </div>



        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © de_GWD by JacyL4 2021</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
function checklink(){
$.get('./act/testBaidu.php',function(data){
var checklink1 = data
if ( $.trim(checklink1) == "ONLINE" ) {
$('#testBaidu').text("✓ 国内线路畅通")
} else {
$('#testBaidu').text("✗ 国内线路不通")
}
})

$.get('./act/testGoogle.php',function(data){
var checklink2 = data
if ( $.trim(checklink2) == "ONLINE" ) {
$('#testYoutue').text("✓ 国外线路畅通")
} else {
$('#testYoutue').text("✗ 国外线路不通")
}
})

$.get("./act/version.php", function(data){
var currentvernum = data.split("-")[0]
var remotevernum = data.split("-")[1]
var vera = $.trim(currentvernum)
var verb = $.trim(remotevernum)
$('#currentver').attr('class','btn btn-light').html(currentvernum+'本机')
$('#remotever').attr('class','btn btn-light').html(remotevernum+' 发布')
if (vera != verb) {
$('#remotever').attr('class','btn btn-warning')
}
})
}



function nodeDTswitch(nodeDTswitch){
$("#buttonNodeDTloading").attr("class", "spinner-border spinner-border-sm")
var current = $(nodeDTswitch).find('#nodeDTtext').html()
if (current == 'OFF'){
$.get('./act/switchNodeDT.php', {switchNodeDT:"NodeDThide"}, function(result){
  $("#nodeDTlist").css("display", "none")
  $("#nodeDTip").css("display", "none")
  $("#nodeDTipButton").css("display", "none")
  $("#buttonNodeDTloading").removeClass()
  $("#nodeDTtext").html("ON")
})
}
else {
$.get('./act/switchNodeDT.php', {switchNodeDT:"NodeDTshow"}, function(result){
  $("#nodeDTlist").css("display", "block")
  $("#nodeDTip").css("display", "block")
  $("#nodeDTipButton").css("display", "block")
  $("#buttonNodeDTloading").removeClass()
  $("#nodeDTtext").html("OFF")
})
}
}



$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#remotever').click(function(){
window.open("https://github.com/jacyl4/de_GWD/releases")
})

$('#buttonProxyRestart').click(function(){
$("#buttonProxyLoading").attr("class", "spinner-border spinner-border-sm ml-2")
$.get('./act/proxyRestart.php', function(result){
  $("#buttonProxyLoading").removeClass()
})
})

$('#buttonProxyStop').click(function(){
$("#buttonProxyLoading").attr("class", "spinner-border spinner-border-sm ml-2")
$.get('./act/proxyStop.php', function(result){
  $("#buttonProxyLoading").removeClass()
})
})

$.get('./act/uptime.php', function(data){$('#uptime').text(data)})

$.get('./act/arrV2node.php', function(data) {
var nodeList = JSON.parse(data);
var len = nodeList.length;
for( let i = 0; i<len; i++){
  let domain = nodeList[i].domain;
  let name = nodeList[i].name;
  let nodeNF = nodeList[i].name;
  let nodeDT = nodeList[i].name;
  $('#nodeTable').append(`
                          <tr> 
                          <td class="align-middle">${i+1}</td>
                          <td class="align-middle"><span id="nodeDomain${i}">${domain}</span></td>
                          <td class="align-middle"><span id="nodeshow${i}">${name}</span></td>
                          <td class="align-middle"><span id="ping${i}" class='text-success'></span></td>
                          <td class="align-middle"><span id="speed${i}" class='text-success'><a href="javascript:void(0)" class="text-success"><i class="far fa-play-circle fa-lg"></i></a></span></td>
                          <td class="align-middle"><button id="switch${i}" type="button" class="btn btn-outline-secondary btn-sm">切换</button></td>
                          </tr>
                          `)

  $('#speed'+i).click(function(){
    $('#speed'+i).empty()
    $('#speed'+i).attr('class', 'cloud')
    $.get("./act/speedT.php", {speedT:i}, function(data){$('#speed'+i).attr('class', 'text-success'); $('#speed'+i).text(data)})
  })

  $('#switch<?php echo exec('/opt/de_GWD/ui-checkNode');?>').attr('class', 'btn btn-success btn-sm')
  $('#switch'+i).click(function(){
    $("#nodeTable td:nth-child(6) button").attr('class', "btn btn-outline-secondary btn-sm")
    $('#switch'+i).attr('class', 'btn btn-success btn-sm');
    $.get("./act/changeNode.php", {nodenum:i}, function(){})
  })

  $('#nodenf').append("<a class='dropdown-item' href='#' id='nodenf"+i+"'>"+nodeNF+"</a>")
  $('#nodenf'+i).click(function(){
    $('#nodenfshow').html(nodeNF)
    $('#nodenfshow').val(i)
    $.get("./act/changeNodeNF.php", {nodenfnum:i}, function(){})
  })

  $('#nodedt').append("<a class='dropdown-item' href='#' id='nodedt"+i+"'>"+nodeDT+"</a>");
  $('#nodedt'+i).click(function(){
    $('#nodedtshow').html(nodeDT)
    $('#nodedtshow').val(i)
    $.get("./act/changeNodeDT.php", {nodedtnum:i}, function(){})
  })
}
})

$('#buttonPingTCP').click(function(){
$.get('./act/arrV2node.php', function(data) {
var nodeList = JSON.parse(data)
$.each(nodeList, function(i){
  $.get("./act/pingTCP.php", {pingTCP:i}, function(data){ $('#ping'+i).text(data) })
})
})
$.get("./act/pingTCPDOH1.php", function(data) { $('#pingDOH1').text(data) })
$.get("./act/pingTCPDOH2.php", function(data) { $('#pingDOH2').text(data) })
})

$('#buttonPingICMP').click(function(){
$.get('./act/arrV2node.php', function(data) {
var nodeList = JSON.parse(data)
$.each(nodeList, function(i){
  $.get("./act/pingICMP.php", {pingICMP:i}, function(data){ $('#ping'+i).text(data) })
})
})
$.get("./act/pingICMPDOH1.php", function(data) { $('#pingDOH1').text(data) })
$.get("./act/pingICMPDOH2.php", function(data) { $('#pingDOH2').text(data) })
})

$('#buttonOnUDP').click(function(){
$("#buttonOnUDPloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/onUDP.php', function(result){
  $("#buttonOnUDPloading").removeClass()
  $('#buttonOnUDP').attr('class', 'btn btn-success btn-sm mt-1')
})
})

$('#buttonOffUDP').click(function(){
$("#buttonOffUDPloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offUDP.php', function(result){
  $("#buttonOffUDPloading").removeClass()
  $('#buttonOnUDP').attr('class', 'btn btn-outline-secondary btn-sm mt-1')
})
})

$('#buttonSubmitDivertIP').click(function(){
$("#buttonSubmitDivertIPloading").attr("class", "spinner-border spinner-border-sm")
divertIP=$('#nodedttext').val()
$.get('./act/changeDivertIP.php', {divertIP:divertIP}, function(result){
  $("#buttonSubmitDivertIPloading").removeClass()
})
})

$('#buttonDnsCHNW').click(function(){
$("#buttonDnsCHNWloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/dnsCHNW.php', function(result){
  $("#buttonDnsCHNWloading").removeClass()
  $('#buttonDnsCHNW').attr('class', 'btn btn-success btn-sm mt-1')
  $('#buttonDnsGFW').attr('class', 'btn btn-outline-secondary btn-sm mt-1')
})
})

$('#buttonDnsGFW').click(function(){
$("#buttonDnsGFWloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/dnsGFW.php', function(){
  $("#buttonDnsGFWloading").removeClass()
  $('#buttonDnsCHNW').attr('class', 'btn btn-outline-secondary btn-sm mt-1')
  $('#buttonDnsGFW').attr('class', 'btn btn-success btn-sm mt-1')
})
})

$('#buttonclearDNS').click(function(){
$("#buttonclearDNSloading").attr("class", "spinner-border spinner-border-sm")
$.get("./act/clearDNS.php", function(result){
  $("#buttonclearDNSloading").removeClass()
})
})

$('#buttonSubmitDNS').click(function(){
$("#buttonSubmitDNSloading").attr("class", "spinner-border spinner-border-sm")
dohtxt1=$('#DoH1').val()
dohtxt2=$('#DoH2').val()
dnsChina=$("#dnsChina").val()
hostsCustomize=$("#hostsCustomize").val()
$.get("./act/saveDNS.php", {DoH1:dohtxt1, DoH2:dohtxt2, dnsChina:dnsChina, hostsCustomize:hostsCustomize}, function(result){
  $("#buttonSubmitDNSloading").removeClass()
})
})

$('#buttonOnAPPLE').click(function(){
$("#buttonOnAPPLEloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/onAPPLE.php', function(result){
  $("#buttonOnAPPLEloading").removeClass()
  $("#buttonOnAPPLE").attr("class", "btn btn-success btn-sm")
})
})

$('#buttonOffAPPLE').click(function(){
$("#buttonOffAPPLEloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offAPPLE.php', function(result){
  $("#buttonOffAPPLEloading").removeClass()
  $("#buttonOnAPPLE").attr("class", "btn btn-outline-secondary btn-sm")
})
})

$('#buttonSubmitStaticIP').click(function(){
staticip1=$('#localip').val()
staticip2=$('#upstreamip').val()
$.get('./act/changeStaticIP.php', {localip:staticip1, upstreamip:staticip2}, function(result){window.location.reload()})
})

$('#buttonOnDHCP').click(function(){
$("#buttonOnDHCPloading").attr("class", "spinner-border spinner-border-sm")
dhcpStarttxt=$('#dhcpStart').val()
dhcpEndtxt=$('#dhcpEnd').val()
$.get('./act/onDHCP.php', {dhcpStart:dhcpStarttxt, dhcpEnd:dhcpEndtxt, dhcp:"on"}, function(result){
  $("#buttonOnDHCPloading").removeClass()
  $("#buttonOnDHCP").attr("class", "btn btn-success btn-sm mt-1")
})
})

$('#buttonOffDHCP').click(function(){
$("#buttonOffDHCPloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offDHCP.php', function(result){
  $("#buttonOffDHCPloading").removeClass()
  $("#buttonOnDHCP").attr("class", "btn btn-outline-secondary btn-sm mt-1")
})
})

setInterval(function() {
checklink()
}, 1800)

})
</script>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  
</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
