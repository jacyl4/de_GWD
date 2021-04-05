<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

<title>DDNS & LINK</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <link href="favicon.ico" rel="icon" type="image/x-icon" />

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="js/jquery.qrcode.min.js"></script>

</head>

<body id="page-top" class="sidebar-toggled fixed-padding">
<?php $de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf')); ?>
<?php $checkNetdata = file_exists('/usr/libexec/netdata/netdata-updater.sh'); ?>
<?php $checkJellyfin = file_exists('/usr/bin/jellyfin'); ?>
<?php $checlBitwardenrs = $de_GWDconf->app->bitwardenrs; ?>

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button id="sidebarToggle" class="btn btn-link btn-sm text-white order-1 order-sm-0" href="javascript:void(0)">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php passthru('sudo /opt/de_GWD/ui-checkEditionARM');?></span>

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

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checlBitwardenrs === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8099')">
          <i class="fas fa-shield-alt"></i>
          <span>Bitwarden_rs</span>
        </a>
      </li>

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkNetdata === true) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="/netdata/" onclick="javascript:event.target.port=location.port" target="_blank">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Netdata</span>
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
      <li class="nav-item">
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
      <li class="nav-item active">
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

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">概览</a>
          </li>
          <li class="breadcrumb-item active">DDNS & LINK</li>
        </ol>


<!-- Modal -->
<div id="markThis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="markThisLabel" class="modal-title">备注本机</h5>
      </div>
      <div class="modal-body">
        <input id="markName" type="text" class="form-control" placeholder="备注名" required="required" value="<?php echo $de_GWDconf->address->alias ?>">
      </div>
      <div class="modal-footer">
        <button id="buttonMarkThis" type="button" class="btn btn-outline-dark btn-sm">应用</button>
      </div>
    </div>
  </div>
</div>


        <!-- Page Content -->
      <div class="col-md-5 input-group mx-auto mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Wan IP</span>
        </div>
          <input id="wanIP" type="text" class="form-control text-center" value="" READONLY>
        <div class="input-group-append">
          <button id="buttonShowIP" type="button" class="btn btn-secondary btn-sm">查询</button>
        </div>
      </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-cloud"></i>
            <a href="http://www.pubyun.com" target="_blank">F3322 DDNS</a>
<span id="ddns3322button" class="float-right mt-n1 mb-n2" style="display:none">
<div class="btn-group">
<button id="buttonddns3322off" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonddns3322offLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonddns3322on" type="button" class="btn btn-<?php passthru('sudo /opt/de_GWD/ui-checkDDNS3322');?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonddns3322onLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="ddns3322switch" class="float-right mt-n1 mb-n2">
<button id="buttonDDNS3322switch" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
</span>
          </div>

          <div id="ddns3322body" class="card-body" style="display:none">
    <div class="form-row">
      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">域名</span>
        </div>
          <input id="f3322domain" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddns3322->domain ?>">
      </div>

      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">用户名</span>
        </div>
          <input id="f3322usr" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddns3322->user ?>">
      </div>

      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">密码</span>
        </div>
          <input id="f3322pwd" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddns3322->pwd ?>">
      </div>
    </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-cloud"></i>
            <a href="https://dash.cloudflare.com/login" target="_blank">CloudFlare DDNS</a>
<span id="ddnsCFbutton" class="float-right mt-n1 mb-n2" style="display:none">
<div class="btn-group">
<button id="buttonddnsCFoff" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonddnsCFoffLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonddnsCFon" type="button" class="btn btn-<?php passthru('sudo /opt/de_GWD/ui-checkDDNScf');?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonddnsCFonLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="ddnsCFswitch" class="float-right mt-n1 mb-n2">
<button id="buttonDDNSCFswitch" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
</span>
          </div>

          <div id="ddnsCFbody" class="card-body" style="display:none">
    <div class="form-row">
      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">域名</span>
        </div>
          <input id="CFdomain" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddnsCF->cfDomain ?>">
      </div>

      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">Zone ID</span>
        </div>
          <input id="CFzoneid" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddnsCF->cfZoneID ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">CF API KEY</span>
        </div>
          <input id="CFapikey" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddnsCF->cfAPIkey ?>">
      </div>

      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">CF E-mail</span>
        </div>
          <input id="CFemail" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddnsCF->cfEmail ?>">
      </div>
    </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-bacon"></i>
            FRP
<span id="FRPbutton" class="float-right mt-n1 mb-n2 ml-4" style="display:none">
<div class="btn-group">
<button id="buttonOffFRP" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonOffFRPloading"></span>
  <span>关闭</span>
</button>
<button id="buttonOnFRP" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonOnFRPloading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="FRPswitch" class="float-right mt-n1 mb-n2 ml-4">
<button id="buttonFRPswitch" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
</span>
<span class="float-right mt-n1 mb-n2">
<button id="buttonFRPinstall" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">install</button>
</span>
          </div>

          <div id="FRPbody" class="card-body" style="display:none">

        <H6 class="mt-1 ml-4">
        <i class="fas fa-globe-asia"></i>&nbsp&nbsp服务端：
        </H6>
    <div class="form-row">
      <div class="col-md-12 input-group my-2">
        <input id="frpCMD" type="text" class="form-control" placeholder="服务端安装指令" value="" readonly>
        <div class="input-group-append">
          <button id="buttonGenFRPcmd" type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;">生成安装指令</button>
        </div> 
      </div>
    </div>
    <div class="form-row">
      <div class="input-group my-2 col-md-12">
        <div class="input-group-prepend">
          <span class="input-group-text">服务器域名</span>
        </div>
          <input id="FRPdomain" type="text" class="form-control" style="max-width: 280px;" value="<?php echo $de_GWDconf->FRP->server->domain ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">Token</span>
        </div>
          <input id="FRPtoken" type="text" class="form-control" style="max-width: 150px;" value="<?php echo $de_GWDconf->FRP->server->token ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">Bind-Port</span>
        </div>
          <input id="FRPbindPort" type="text" class="form-control" style="max-width: 125px;" value="<?php echo $de_GWDconf->FRP->server->bindPort ?>">
        <div class="input-group-prepend">
          <button id="FRPbindProtocol" class="btn btn-outline-secondary dropdown-toggle" style="min-width: 80px;" type="button" data-toggle="dropdown"><?php echo $de_GWDconf->FRP->server->bindProtocol ?></button>
            <div class="dropdown-menu">
            <a id="buttonFRPbindTCP" class="dropdown-item" href="javascript:void(0)">TCP</a>
            <a id="buttonFRPbindKCP" class="dropdown-item" href="javascript:void(0)">KCP</a>
            </div>
        </div>
          <button id="buttonFRPclientAdd" class="btn btn-sm btn-outline-secondary ml-auto" style="border-Radius: 0px;" type="button">添加客户端配置</button>
      </div>
    </div>

        <H6 class="mt-3 ml-4">
        <i class="fas fa-ethernet mb-2"></i>&nbsp&nbsp客户端：
        </H6>
    <div id="FRPclients" class="form-row">

    </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-archway"></i>
            WireGuard Server
<span id="WGbutton" class="float-right mt-n1 mb-n2 ml-4" style="display:none">
<div class="btn-group">
<button id="buttonOffWG" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonOffWGloading"></span>
  <span>关闭</span>
</button>
<button id="buttonOnWG" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonOnWGloading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="WGswitch" class="float-right mt-n1 mb-n2 ml-4">
<button id="buttonWGswitch" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
</span>
<span class="float-right mt-n1 mb-n2">
<button id="buttonWGinstall" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">install</button>
</span>
          </div>
          <div id="WGbody" class="card-body" style="display:none">

<div class="form-row mb-3">
      <div class="input-group col-md-12 my-2">
        <div class="input-group-prepend ">
          <span class="input-group-text" style="min-width: 90px;">Endpoint</span>
          <button id="WGgenSkey" style="min-width: 150px; border-Radius: 0px;" type="button" onclick="WGgenSkey()"></button>
          <input id="sprivatekey" type="hidden" value="">
          <input id="spublickey" type="hidden" value="">
        </div>
          <input id="WGaddress" type="text" class="form-control" placeholder="域名/公网IP" style="max-width: 280px;" value="">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">UDP端口</span>
         </div>
          <input id="WGport" type="text" class="form-control" placeholder="端口号" style="max-width: 125px;" value="">
          <button id="buttonWGclientAdd" class="btn btn-sm btn-outline-secondary ml-auto" style="border-Radius: 0px;" type="button">添加客户端配置</button>
      </div>
</div>


<div id="WGclients" class="form-row mb-1">

</div>

<span class="float-left text-secondary">
  <small>
注：需要主路由映射所需UDP端口到de_GWD的地址。最后一个“清空”按钮，可以删除最后一个wireguard节点。
  </small>
</span>
          </div>
        </div>
        <!-- Page Content -->

      </div>
      <!-- /.container-fluid -->

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
function DDNS3322switch(){
$("#ddns3322switch").css("display", "none")
$("#ddns3322button").css("display", "block")
$("#ddns3322body").css("display", "block")
}

function DDNSCFswitch(){
$("#ddnsCFswitch").css("display", "none")
$("#ddnsCFbutton").css("display", "block")
$("#ddnsCFbody").css("display", "block")
}

function FRPswitch(){
$("#FRPswitch").css("display", "none")
$("#FRPbutton").css("display", "block")
$("#FRPbody").css("display", "block")
}

function WGswitch(){
$("#WGswitch").css("display", "none")
$("#WGbutton").css("display", "block")
$("#WGbody").css("display", "block")
}

function FRPremoteProtocolTCP(FRPremoteProtocolTCP){
$(FRPremoteProtocolTCP).parent().parent().find('.dropdown-toggle').html("TCP")
}

function FRPremoteProtocolUDP(FRPremoteProtocolUDP){
$(FRPremoteProtocolUDP).parent().parent().find('.dropdown-toggle').html("UDP")
}

function FRPclear(FRPclear){
var FRPnum = $(FRPclear).parent().parent().find('input').attr('id')
var FRPnum = FRPnum.replace(/[^0-9]/ig,"")
$('#FRPlocalIP'+FRPnum).val('')
$('#FRPlocalPort'+FRPnum).val('')
$('#FRPremotePort'+FRPnum).val('')
$('#FRPlocalMark'+FRPnum).val('')
}

function WGgenSkey(){
$.get('./act/WGgenSkey.php', function(result){window.location.reload()})
}

function WGgenCkey(WGgenCkey){
var WGnum = $(WGgenCkey).parent().find('.input-group-text').html()
var WGnum = WGnum.replace(/[^0-9]/ig,"")-1
$.get('./act/WGgenCkey.php', {WGnum:WGnum}, function(result){window.location.reload()})
}

function WGqr(WGqr){
var WGnum = $(WGqr).parent().parent().find('.input-group-text').html()
var WGnum = WGnum.replace(/[^0-9]/ig,"")
var QRnum = WGnum-1
$.get('./act/WGqr.php', {WGnum:WGnum}, function(data){
$('#qrcode'+QRnum).empty()
$('#qrcode'+QRnum).qrcode({width: 240,height: 240,correctLevel:0,text: data})
})
$.get('./act/WGqr.php', {WGnum:WGnum}, function(data){
$('#qrstr'+QRnum).val(data)
})
}

function WGclear(WGclear){
var WGtotal = $(WGclear).parent().parent().parent().find('.input-group').length-1
var WGnum = $(WGclear).parent().parent().find('.input-group-text').html()
var WGnum = WGnum.replace(/[^0-9]/ig,"")-1
if (WGnum == WGtotal){
$(WGclear).parent().parent('.input-group').remove()
}
else{
$(':hidden#cprivatekey'+WGnum).val('0000000000000000000000000000000000000000000=')
$(':hidden#cpublickey'+WGnum).val('0000000000000000000000000000000000000000000=')
$('#WGmark'+WGnum).val('')
$('#buttonWGgenCKey'+WGnum).attr('class', 'btn btn-sm btn-secondary')
$('#buttonWGgenCKey'+WGnum).html('生成节点密钥对')
}
}

function WGremove(WGremove){
$(WGremove).parent().parent('.input-group').remove()
}



$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#buttonShowIP').click(function(){
$.get('./act/checkDDNSip.php', function(data){$('#wanIP').attr("value",data)})
})


$.get("./act/checkDDNS3322.php", function(data){
if ($.trim(data) == "installed"){
DDNS3322switch()
}
})

$('#buttonDDNS3322switch').click(function(){
DDNS3322switch()
})

$('#buttonddns3322on').click(function(){
$("#buttonddns3322onLoading").attr("class", "spinner-border spinner-border-sm")
f3322domain=$('#f3322domain').val()
f3322usr=$('#f3322usr').val()
f3322pwd=$('#f3322pwd').val()
$.get('./act/onDDNS3322.php', {f3322domain:f3322domain, f3322usr:f3322usr, f3322pwd:f3322pwd}, function(result){
  $("#buttonddns3322onLoading").removeClass()
  $('#buttonddns3322on').attr('class', 'btn btn-success btn-sm mt-1')
})
})

$('#buttonddns3322off').click(function(){
$("#buttonddns3322offLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offDDNS3322.php', function(result){
  $("#buttonddns3322offLoading").removeClass()
  $('#buttonddns3322on').attr('class', 'btn btn-outline-secondary btn-sm mt-1')
})
})


$.get("./act/checkDDNScf.php", function(data){
if ($.trim(data) == "installed"){
DDNSCFswitch()
}
})

$('#buttonDDNSCFswitch').click(function(){
DDNSCFswitch()
})

$('#buttonddnsCFon').click(function(){
$("#buttonddnsCFonLoading").attr("class", "spinner-border spinner-border-sm")
cfdomain=$('#CFdomain').val()
cfzoneid=$('#CFzoneid').val()
cfapikey=$('#CFapikey').val()
cfemail=$('#CFemail').val()
$.get('./act/onDDNScf.php', {CFdomain:cfdomain, CFzoneid:cfzoneid, CFapikey:cfapikey, CFemail:cfemail}, function(result){
  $("#buttonddnsCFonLoading").removeClass()
  $('#buttonddnsCFon').attr('class', 'btn btn-success btn-sm mt-1')
})
})

$('#buttonddnsCFoff').click(function(){
$("#buttonddnsCFoffLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offDDNScf.php', function(result){
  $("#buttonddnsCFoffLoading").removeClass()
  $('#buttonddnsCFon').attr('class', 'btn btn-outline-secondary btn-sm mt-1')
})
})


$.get('./act/arrFRP.php', function(data) {
var arrFRPlist = JSON.parse(data);
var len = arrFRPlist.length;
for( let i = 0; i<len; i++){
  let localIP = arrFRPlist[i].localIP;
  let localPort = arrFRPlist[i].localPort;
  let remotePort = arrFRPlist[i].remotePort;
  let remoteProtocol = arrFRPlist[i].remoteProtocol;
  let localMark = arrFRPlist[i].localMark;
  $('#FRPclients').append(`
      <div class="input-group mb-2 col-md-12">
        <div class="input-group-prepend">
          <span class="input-group-text">本地IP</span>
        </div>
          <input id="FRPlocalIP${i}" type="text" class="form-control" style="max-width: 180px;" value="${localIP}">  
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">本地端口</span>
        </div>
          <input id="FRPlocalPort${i}" type="text" class="form-control" style="max-width: 125px;" value="${localPort}">  
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">对应服务器端口</span>
        </div>
          <input id="FRPremotePort${i}" type="text" class="form-control" style="max-width: 125px;" value="${remotePort}">
        <div class="input-group-append">
          <button id="FRPremoteProtocol${i}" type="button" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle" style="min-width: 80px;">${remoteProtocol}</button>
            <div class="dropdown-menu">
            <a class="dropdown-item" onclick="FRPremoteProtocolTCP(this)" href="javascript:void(0)">TCP</a>
            <a class="dropdown-item" onclick="FRPremoteProtocolUDP(this)" href="javascript:void(0)">UDP</a>
            </div>
        </div>
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">备注</span>
        </div>
          <input id="FRPlocalMark${i}" type="text" class="form-control" style="max-width: 150px;" value="${localMark}">
        <div class="input-group-append">
          <button type="button" class="btn btn-sm btn-outline-secondary" style="border-Radius: 0px;" onclick="FRPclear(this)">清空</button>
        </div>
      </div>
                          `)
}
})

$('#buttonFRPclientAdd').click(function(){
  var i = $("#FRPclients .input-group").length
  $('#FRPclients').append(`
      <div class="input-group mb-2 col-md-12">
        <div class="input-group-prepend">
          <span class="input-group-text">本地IP</span>
        </div>
          <input id="FRPlocalIP${i}" type="text" class="form-control" style="max-width: 180px;" value="">  
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">本地端口</span>
        </div>
          <input id="FRPlocalPort${i}" type="text" class="form-control" style="max-width: 125px;" value="">  
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">对应服务器端口</span>
        </div>
          <input id="FRPremotePort${i}" type="text" class="form-control" style="max-width: 125px;" value="">
        <div class="input-group-append">
          <button id="FRPremoteProtocol${i}" type="button" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle" style="min-width: 80px;">TCP</button>
            <div class="dropdown-menu">
            <a class="dropdown-item" onclick="FRPremoteProtocolTCP(this)" href="javascript:void(0)">TCP</a>
            <a class="dropdown-item" onclick="FRPremoteProtocolUDP(this)" href="javascript:void(0)">UDP</a>
            </div>
        </div>
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">备注</span>
        </div>
          <input id="FRPlocalMark${i}" type="text" class="form-control" style="max-width: 150px;" value="">
        <div class="input-group-append">
          <button type="button" class="btn btn-sm btn-outline-secondary" style="border-Radius: 0px;" onclick="FRPclear(this)">清空</button>
        </div>
      </div>
                          `)
})

$.get("./act/checkFRP.php", function(data){
var checkFRP = data.split(" ")
if (checkFRP[0] == "installed"){
$('#buttonFRPinstall').attr('class', 'btn btn-outline-success btn-sm mt-1')
}
if (checkFRP[1] == "on"){
FRPswitch()
$('#buttonOnFRP').attr('class', 'btn btn-success btn-sm mt-1')
}
})

$('#buttonFRPswitch').click(function(){
FRPswitch()
})

$('#buttonFRPbindTCP').click(function(){
$('#FRPbindProtocol').html("TCP")
})

$('#buttonFRPbindKCP').click(function(){
$('#FRPbindProtocol').html("KCP")
})

$('#buttonFRPinstall').click(function(){
$.get('./act/installFRPc.php', function(){})
var win = window.open('/ttyd', 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        $.get('./act/installZ.php', function(result){window.location.reload()})
    }
}, 300);
})

$('#buttonOnFRP').click(function(){
$("#buttonOnFRPloading").attr("class", "spinner-border spinner-border-sm")
FRPdomain=$('#FRPdomain').val()
FRPtoken=$('#FRPtoken').val()
FRPbindPort=$('#FRPbindPort').val()
FRPbindProtocol=$('#FRPbindProtocol').html()
var FRPclientsList = []
var len = $("#FRPclients .input-group").length
var localIP, localPort, remotePort, remoteProtocol, localMark
for( let i = 0; i<len; i++){
    var localIP = $('#FRPlocalIP'+i).val()
    var localPort = $('#FRPlocalPort'+i).val()
    var remotePort = $('#FRPremotePort'+i).val()
    var remoteProtocol = $('#FRPremoteProtocol'+i).html()
    var localMark = $('#FRPlocalMark'+i).val()
    if (localIP !== '' && localPort !== '' && remotePort !== '' && remoteProtocol !== '') {
    FRPclientsList.push({localIP, localPort, remotePort, remoteProtocol, localMark})
    }
}
$.get('./act/onFRP.php', {FRPdomain:FRPdomain, FRPtoken:FRPtoken, FRPbindPort:FRPbindPort, FRPbindProtocol:FRPbindProtocol, FRPclientsList:FRPclientsList}, function(result){
  $("#buttonOnFRPloading").removeClass()
  $('#buttonOnFRP').attr('class', 'btn btn-success btn-sm mt-1')
})
})

$('#buttonOffFRP').click(function(){
$("#buttonOffFRPloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offFRP.php', function(result){
  $("#buttonOffFRPloading").removeClass()
  $('#buttonOnFRP').attr('class', 'btn btn-outline-secondary btn-sm mt-1')
})
})

$('#buttonGenFRPcmd').click(function(){
$.get('./act/genFRPcmd.php', function(data){$('#frpCMD').val(data)})
})


$.get('./act/arrWG.php', function(data) {
var arrWGlist = JSON.parse(data)
if (arrWGlist.server.sprivatekey == null || arrWGlist.server.sprivatekey == undefined || arrWGlist.server.sprivatekey == 'undefined' || arrWGlist.server.sprivatekey == ''){
$('#WGgenSkey').attr('class', 'btn btn-sm btn-secondary')
$('#WGgenSkey').html('生成密钥对')
}
else{
$('#WGgenSkey').attr('class', 'btn btn-sm btn-warning')
$('#WGgenSkey').html('重新生成密钥对')
$(':hidden#sprivatekey').val(arrWGlist.server.sprivatekey)
$(':hidden#spublickey').val(arrWGlist.server.spublickey)
}

$('#WGaddress').val(arrWGlist.server.WGaddress)
$('#WGport').val(arrWGlist.server.WGport)

var arrWGlistC = arrWGlist.clients
var len = arrWGlistC.length
for( let i = 0; i<len; i++){
  var cprivatekey = arrWGlistC[i].cprivatekey
  var cpublickey = arrWGlistC[i].cpublickey
  var mark = arrWGlistC[i].mark
  if  ( mark == null || mark == undefined || mark == 'undefined' || mark == '' ){ mark = ''}
  $('#WGclients').append(`
      <div class="input-group mb-2 col-md-6">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 90px;">节点${i+1}</span>
          <button id="buttonWGgenCKey${i}" type="button" class="btn btn-secondary btn-sm" style="min-width: 150px; border-Radius: 0px;" onclick="WGgenCkey(this)"></button>
          <input id="cprivatekey${i}" type="hidden" value="${cprivatekey}">
          <input id="cpublickey${i}" type="hidden" value="${cpublickey}">
          <span class="input-group-text">备注</span>
        </div>
          <input id="WGmark${i}" type="text" class="form-control" value="${mark}">
        <div class="input-group-prepend input-group-append">
          <button type="button" class="btn btn-secondary btn-sm" style="min-width: 120px; border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop${i}" onclick="WGqr(this)">显示二维码</button>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" onclick="WGclear(this)">清空</button>
        </div>
      </div>

<div id="wgqrpop${i}" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto" >WireGuard客户端${i+1}</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode${i}" class="text-center"></div>
        <textarea id="qrstr${i}" class="mx-auto mt-3 col-12 small" rows="8" readonly></textarea>
      </div>
    </div>
  </div>
</div>
                          `)

  if ( cprivatekey == null || cprivatekey == undefined || cprivatekey == 'undefined' || cprivatekey == '0000000000000000000000000000000000000000000=' || cprivatekey == '' ){
  $('#buttonWGgenCKey'+i).attr('class', 'btn btn-sm btn-secondary')
  $('#buttonWGgenCKey'+i).html('生成节点密钥对')
  }
  else{
  $('#buttonWGgenCKey'+i).attr('class', 'btn btn-sm btn-warning')
  $('#buttonWGgenCKey'+i).html('重新生成节点密钥对')
  }

}
})

$('#buttonWGclientAdd').click(function(){
  var i = $("#WGclients .input-group").length
  $('#WGclients').append(`
      <div class="input-group mb-2 col-md-6">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 90px;">节点${i+1}</span>
          <button id="buttonWGgenCKey${i}" type="button" class="btn btn-secondary btn-sm" style="min-width: 150px; border-Radius: 0px;" onclick="WGgenCkey(this)"></button>
          <input id="cprivatekey${i}" type="hidden" value="">
          <input id="cpublickey${i}" type="hidden" value="">
          <span class="input-group-text">备注</span>
        </div>
          <input id="WGmark${i}" type="text" class="form-control" value="">
        <div class="input-group-prepend input-group-append">
          <button type="button" class="btn btn-secondary btn-sm" style="min-width: 120px; border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop" onclick="WGqr(this)">显示二维码</button>
        </div>
        <div class="input-group-append">
          <button type="button" class="btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" onclick="WGclear(this)">清空</button>
        </div>
      </div>
                          `)
  $.get('./act/WGgenCkey.php', {WGnum:i}, function(result){window.location.reload()})
})

$.get("./act/checkWG.php", function(data){
var checkWG = data.split(" ");
if (checkWG[0] == "installed"){
$('#buttonWGinstall').attr('class', 'btn btn-outline-success btn-sm mt-1')
};
if (checkWG[1] == "on"){
WGswitch()
$('#buttonOnWG').attr('class', 'btn btn-success btn-sm mt-1')
}
})

$('#buttonWGswitch').click(function(){
WGswitch()
})

$('#buttonWGinstall').click(function(){
$.get('./act/installWG.php', function(){});
var win = window.open('/ttyd', 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        $.get('./act/installZ.php', function(result){window.location.reload()})
    }
}, 300);
})

$('#buttonOnWG').click(function(){
$("#buttonOnWGloading").attr("class", "spinner-border spinner-border-sm")
WGaddress=$('#WGaddress').val()
WGport=$('#WGport').val()
sprivatekey=$(':hidden#sprivatekey').val()
spublickey=$(':hidden#spublickey').val()
var WGclientsList = []
var len = $("#WGclients .input-group").length
var cprivatekey, cpublickey, mark
for( let i = 0; i<len; i++){
    var cprivatekey = $(':hidden#cprivatekey'+i).val()
    var cpublickey = $(':hidden#cpublickey'+i).val()
    var mark = $('#WGmark'+i).val()
    if ( cprivatekey !== '' || cpublickey !== '' || mark !== '') {
    WGclientsList.push({cprivatekey, cpublickey, mark})
    }
}
$.get('./act/onWG.php', {WGaddress:WGaddress, WGport:WGport, sprivatekey:sprivatekey, spublickey:spublickey, WGclientsList:WGclientsList}, function(result){
  $("#buttonOnWGloading").removeClass()
  $('#buttonOnWG').attr('class', 'btn btn-success btn-sm mt-1')
})
})

$('#buttonOffWG').click(function(){
$("#buttonOffWGloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offWG.php', function(result){
  $("#buttonOffWGloading").removeClass()
  $('#buttonOnWG').attr('class', 'btn btn-outline-secondary btn-sm mt-1')
})
})

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
