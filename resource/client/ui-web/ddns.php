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

<title>DDNS & WG</title>

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

<body id="page-top" class="sidebar-toggled">
<?php $de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf')); ?>
<?php $checkJellyfin = $de_GWDconf->app->jellyfin; ?>
<?php $checkFileRun = file_exists('/var/www/html/filerun'); ?>
<?php $checkBitwarden = $de_GWDconf->app->bitwarden; ?>

<?php $FileRunWebConf = file_get_contents ('/etc/nginx/conf.d/filerun.conf'); preg_match_all('/(?<=\blisten )\S+/is', $FileRunWebConf, $FileRunPort); $FileRunPort = $FileRunPort[0][0] ?>
<?php $WebConf = file_get_contents ('/etc/nginx/conf.d/default.conf'); preg_match_all('/(?<=\bserver_name )\S+/is', $WebConf, $serverName); $serverName = rtrim($serverName[0][0],";") ?>

<?php $checkWGinstall = exec('sudo dpkg -l | grep " wireguard-tools "')?>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="javascript:void(0)" onclick="window.open('https://t.me/de_GWD_DQ')">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button id="sidebarToggle" class="btn btn-link btn-sm text-white order-1 order-sm-0" href="javascript:void(0)">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php passthru('sudo /opt/de_GWD/ui-checkEditionARM');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="nav navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkFileRun === true) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(<?php if ($serverName != "de_GWD") echo "'https://$serverName:$FileRunPort'"; else echo "location.origin+':$FileRunPort'" ?>)">
          <i class="fas fa-folder"></i>
          <span>FileRun</span>
        </a>
      </li>

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkJellyfin === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8097')">
          <i class="fab fa-youtube"></i>
          <span>Jellyfin</span>
        </a>
      </li>

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkBitwarden === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8099')">
          <i class="fas fa-shield-alt"></i>
          <span>Bitwarden</span>
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
          <span>DDNS & WG</span></a>
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
          <li class="breadcrumb-item active">DDNS & WG</li>
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
<button id="buttonDDNS3322switch" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
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
<button id="buttonDDNSCFswitch" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
</span>
          </div>

          <div id="ddnsCFbody" class="card-body" style="display:none">
    <div class="form-row">
      <div class="col-md-3 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">域名</span>
        </div>
          <input id="CFdomain" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddnsCF->cfDomain ?>">
      </div>

      <div class="col-md-5 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 120px;">CF API KEY</span>
        </div>
          <input id="CFapikey" type="text" class="form-control" value="<?php echo $de_GWDconf->ddns->ddnsCF->cfAPIkey ?>">
      </div>

      <div class="col-md-4 input-group my-2">
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
            <i class="fas fa-archway"></i>
            WireGuard Server
<span id="WGbutton" class="float-right mt-n1 mb-n2 ml-4" style="display:none">
<button id="buttonWGclientAdd" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">
  添加
</button>

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
<button id="buttonWGswitch" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
</span>
<span class="float-right mt-n1 mb-n2">
<button id="buttonWGinstall" type="button" class="btn <?php if (empty($checkWGinstall) === false) echo 'btn-outline-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">install</button>
</span>
          </div>
          <div id="WGbody" class="card-body" style="display:none">
<?php
  $sprivatekey = $de_GWDconf->wireguard->server->sprivatekey;
  $spublickey = $de_GWDconf->wireguard->server->spublickey;
  $WGaddress = $de_GWDconf->wireguard->server->WGaddress;
  $WGport = $de_GWDconf->wireguard->server->WGport;

  if ($sprivatekey == null || $sprivatekey == '')
  {
    $WGgenSkeyClass = "btn-secondary";
    $WGgenSkeyHtml = "生成密钥";
  }
  else
  {
    $WGgenSkeyClass = "btn-warning";
    $WGgenSkeyHtml = "重新生成密钥";
  }

print <<<EOT
<div class="form-row mb-3">
      <div class="input-group col-md-12 my-2">
        <div class="input-group-prepend ">
          <span class="input-group-text" style="min-width: 90px;">Endpoint</span>
          <button id="WGgenSkey" class="btn btn-sm $WGgenSkeyClass" style="min-width: 150px; border-Radius: 0px;" type="button" onclick="WGgenSkey()">$WGgenSkeyHtml</button>
          <input id="sprivatekey" type="hidden" value="$sprivatekey">
          <input id="spublickey" type="hidden" value="$spublickey">
        </div>
          <input id="WGaddress" type="text" class="form-control" placeholder="域名/公网IP" style="max-width: 280px;" value="$WGaddress">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">UDP端口</span>
         </div>
          <input id="WGport" type="text" class="form-control" placeholder="端口号" style="max-width: 125px;" value="$WGport">
      </div>
</div>
EOT;
?>

<div id="WGclients" class="form-row mb-1">
<?php
for( $i=0; $i<count($de_GWDconf->wireguard->clients); $i++){
  $nodeNUM = $i+1;
  $cprivatekey = $de_GWDconf->wireguard->clients[$i]->cprivatekey;
  $cpublickey = $de_GWDconf->wireguard->clients[$i]->cpublickey;
  $mark = $de_GWDconf->wireguard->clients[$i]->mark;

  if ($cprivatekey == null || $cprivatekey == '' || $cprivatekey == '0000000000000000000000000000000000000000000=')
  {
    $buttonWGgenCKeyClass = "btn-secondary";
    $buttonWGgenCKeyHtml = "生成节点密钥";
  }
  else
  {
    $buttonWGgenCKeyClass = "btn-warning";
    $buttonWGgenCKeyHtml = "重新生成节点密钥";
  }

print <<<EOT
      <div class="input-group mb-2 col-md-6">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 90px;">节点$nodeNUM</span>
          <button id="buttonWGgenCKey${i}" type="button" class="btn $buttonWGgenCKeyClass btn-sm" style="min-width: 150px; border-Radius: 0px;" onclick="WGgenCkey(this)">$buttonWGgenCKeyHtml</button>
          <input id="cprivatekey${i}" type="hidden" value="$cprivatekey">
          <input id="cpublickey${i}" type="hidden" value="$cpublickey">
          <span class="input-group-text">备注</span>
        </div>
          <input id="WGmark${i}" type="text" class="form-control" value="$mark">
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
        <h5 class="modal-title mx-auto" >WireGuard客户端$nodeNUM</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode${i}" class="text-center"></div>
        <textarea id="qrstr${i}" class="mx-auto mt-3 col-12 small" rows="8" readonly></textarea>
      </div>
    </div>
  </div>
</div>
EOT;
}
?>
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
            <span>Copyright © de_GWD by JacyL4 2017 ~ 2022</span>
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

function WGswitch(){
$("#WGswitch").css("display", "none")
$("#WGbutton").css("display", "block")
$("#WGbody").css("display", "block")
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
$('#buttonWGgenCKey'+WGnum).html('生成节点密钥')
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
cfapikey=$('#CFapikey').val()
cfemail=$('#CFemail').val()
$.get('./act/onDDNScf.php', {CFdomain:cfdomain, CFapikey:cfapikey, CFemail:cfemail}, function(result){
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



$('#buttonWGclientAdd').click(function(){
  var i = $("#WGclients .input-group").length
$.get('./act/WGgenCkey.php', {WGnum:i}, function(data){
  var data = data.split('\n')
  var cprivatekey = data[0]
  var cpublickey = data[1]
  $('#WGclients').append(`
      <div class="input-group mb-2 col-md-6">
        <div class="input-group-prepend">
          <span class="input-group-text" style="min-width: 90px;">节点${i+1}</span>
          <button id="buttonWGgenCKey${i}" type="button" class="btn btn-warning btn-sm" style="min-width: 150px; border-Radius: 0px;" onclick="WGgenCkey(this)">重新生成节点密钥</button>
          <input id="cprivatekey${i}" type="hidden" value="${cprivatekey}">
          <input id="cpublickey${i}" type="hidden" value="${cpublickey}">
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
})
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
  $("#WGswitch").css("display", "block")
  $("#WGbutton").css("display", "none")
  $("#WGbody").css("display", "none")
})
})

})
</script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  
</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
