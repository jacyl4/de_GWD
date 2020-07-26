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

<title>de_GWD</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">
  <link href="css/bootstrap4-toggle.min.css" rel="stylesheet">

</head>

<body id="page-top" class="sidebar-toggled">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">de_GWD</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-primary"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEdition');?></span>
<span class="float-right badge text-info"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEditionARM');?></span>
<span class="float-right badge text-success"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEditionFWD');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="/admin">
          <i class="fas fa-tachometer-alt"></i>
          <span>Pi-hole</span>
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
        <a class="nav-link" href="ddns.php">
          <i class="fas fa-ethernet"></i>
          <span>DDNS & LINK</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forward.php">
          <i class="fas fa-project-diagram"></i>
          <span>中转</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nodeMAN.php">
          <i class="fas fa-stream"></i>
          <span>节点管理</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listBW.php">
          <i class="fas fa-th-list"></i>
          <span>黑白名单</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update.php">
          <i class="fas fa-arrow-alt-circle-up"></i>
          <span>更新</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="logout()">
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
                <div class="">联网状态</div>
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
                  <i class="fas fa-toggle-on"></i>
                </div>
                <div class="">快捷选项</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <h6 class="float-left" style="margin-bottom: 0"><button class="btn btn-light" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;" onclick="restartProxy()">重启进程</button></h6>
                <h6 class="float-right" style="margin-bottom: 0"><button class="btn btn-light" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;" data-toggle="modal" data-target="#markThis">备注本机</button></h6>
              </a>
            </div>
          </div>
          
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-bell"></i>
                </div>
                <div class="">版本检测</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <h6 class="float-left" style="margin-bottom: 0"><span id="currentver" class="badge badge-pill badge-light"></span></h6>
                <h6 class="float-right" style="margin-bottom: 0"><span id="remotever" class=""></span></h6>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-clock"></i>
                </div>
                  <div class="">运行时长</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="uptime" class="float-left"></span>
                <span class="float-right"><?php echo shell_exec('sudo /usr/local/bin/ui-checkStatus');?></span>
              </a>
            </div>
          </div>
        </div>


<!-- Modal -->
<div class="modal fade" id="markThis" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="markThisLabel">备注本机</h5>
      </div>
      <div class="modal-body">
        <input type="text" id="markName" class="form-control" placeholder="备注名" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->address->alias ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-sm btn-dark" onclick="markThis()">应用</button>
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
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" onclick="NodeDTshow()">启用内网设备分流</button>
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" onclick="NodeDThide()">禁用内网设备分流</button>
          </span>
          </div>
          <div style="display: flex;flex-wrap: wrap;">
            <button type="button" class="btn btn-outline-success btn-sm col-6" style="border-radius: 0px;" onclick="pingICMP()">Ping (ICMP)</button>
            <button type="button" class="btn btn-outline-success btn-sm col-6" style="border-radius: 0px;" onclick="pingTCP()">Ping (TCP)</button>
          </div>

          <div class="card-body">

<span class="float-left">
<div class="input-group ml-4 mt-1 mb-4">
  <div class="input-group-prepend">
    <label class="input-group-text">Netflix 分流</label>
  </div>
  <div class="input-group-append">
    <button id="nodenfshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php $nodenfnum = exec("/usr/local/bin/ui-checkNodeNF"); echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[$nodenfnum]->name; ?></button>
    <div id="nodenf" class="dropdown-menu">
    </div>
  </div>
</div>
</span>

<span class="float-right">
<div class="input-group mr-4 mt-1 mb-4">
  <div class="input-group-prepend">
  <label class="input-group-text">UDP代理</label>
  </div>
  <div class="input-group-append">
    <button class="btn btn-<?php echo shell_exec('sudo /usr/local/bin/ui-checkUDP');?>" type="button" onclick="onUDP()">开启</button>
    <button class="btn btn-secondary" type="button" onclick="offUDP()">关闭</button>
  </div>
</div>
</span>


            <div class="table-responsive">
              <table class="table table-bordered table-hover text-center text-nowrap">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>域名</th>
                    <th>节点名</th>
                    <th>延迟(ms)</th>
                    <th>操作</th>
                    <th>状态</th>
                  </tr>
                </thead>
                <tbody id="nodeTable">
                </tbody>
              </table>
            </div>

<div id="shnodedt" style="display:<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->divertLan->display; ?>">
<span class="float-left">
<div class="input-group ml-4 mt-1 mb-1">
  <div class="input-group-prepend">
    <label class="input-group-text">内网设备分流</label>
  </div>
  <div class="input-group-append">
    <button id="nodedtshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php $nodedtnum = exec("/usr/local/bin/ui-checkNodeDT"); echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[$nodedtnum]->name; ?></button>
    <div id="nodedt" class="dropdown-menu">
    </div>
  </div>
</div>
</span>

<span class="float-right">
<div class="input-group mr-4 mt-1">
  <div class="input-group-prepend">
  <input id="nodedttext" type="text" class="form-control" placeholder="内网设备IP 空格分隔" value="<?php foreach (json_decode(file_get_contents('/usr/local/bin/0conf'), true)['divertLan']['ip'] as $k => $v) {echo "$v ";} ?>">
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="submitlocalip()">IP写入</button>
  </div>
</div>
</span>
</div>

          </div>
        </div>


        <!-- row2 -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="far fa-compass"></i>
            DNS
          <span class="float-right mt-n1 mb-n2">
                <button type="button" class="btn btn-<?php $DNSchnw = file_get_contents('/usr/local/bin/v2dns/config.json'); if(strpos("$DNSchnw",'geosite:cn') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;" onclick="dnsCHNW()">大陆白名单</button>
                <button type="button" class="btn btn-<?php $DNSgfw = file_get_contents('/usr/local/bin/v2dns/config.json'); if(strpos("$DNSgfw",'geolocation-!cn') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;" onclick="dnsGFW()">GFWlist</button>
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" onclick="submitDNS()">提交</button>
          </span>
          </div>

          <div class="card-body">
            <div class="form-row">
              <div class="col-md-4 mt-auto">

                <div class="form-row ml-4">
                  <div class="col-md-6 my-auto">
              <div class="input-group mb-4 mx-auto">
                <div class="input-group-prepend">
                <label class="input-group-text">去广告</label>
                </div>
                <div class="input-group-append">
                  <button class="btn btn-<?php $v2add = file_get_contents('/usr/local/bin/v2dns/config.json'); if(strpos("$v2add",'category-ads') !== false) echo 'success'; else echo 'secondary'; ?>" type="button" onclick="onV2ad()">ON</button>
                  <button class="btn btn-secondary" type="button" onclick="offV2ad()">OFF</button>
                </div>
              </div>
                  </div>

                  <div class="col-md-6 my-auto">
              <div class="input-group mb-4 mx-auto">
                <div class="input-group-prepend">
                <label class="input-group-text">Apple直连</label>
                </div>
                <div class="input-group-append">
                  <button class="btn btn-<?php $apple = file_get_contents('/usr/local/bin/v2dns/config.json'); if(strpos("$apple",'geosite:apple-cn') !== false) echo 'success'; else echo 'secondary'; ?>" type="button" onclick="onAPPLE()">ON</button>
                  <button class="btn btn-secondary" type="button" onclick="offAPPLE()">OFF</button>
                </div>
              </div>
                  </div>
                </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DoH 1<br>
                  </span>
                </div>
                <input type="text" id="DoH1" class="form-control" placeholder="DoH1" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->dns->doh1 ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-success" id="pingDOH1"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DoH 2<br>
                  </span>
                </div>
                <input type="text" id="DoH2" class="form-control" placeholder="DoH2" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->dns->doh2 ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-success" id="pingDOH2"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>
              </div>

              <div class="col-md-4">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DNS<br>
                  国内<br>
                  </span>
                </div>
                  <textarea id="dnsChina" class="form-control" aria-label="dnsChina" rows="6"><?php echo str_replace(' ', "\n", json_decode(file_get_contents('/usr/local/bin/0conf'))->dns->china) ?></textarea>
                </div>
              </div>

              <div class="col-md-4">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  hosts<br>
                  静态解析<br>
                  </span>
                </div>
                  <textarea id="hostsCustomize" class="form-control" aria-label="hostsCustomize" rows="6" placeholder="IP 空格 域名"><?php echo shell_exec("sudo /usr/local/bin/ui-hostsCustomize"); ?></textarea>
                </div>
              </div>
            </div>

          </div>
          </div>


        <!-- row3 -->
<div class="form-row">
<div class="col-md-6">      
        <!-- 静态地址 -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-exchange-alt"></i>
            IP地址
          <span class="float-right mt-n1 mb-n2">
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" onclick="submitstaticip()">重启</button>
          </span>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-6 mb-1">
                <div class="input-group">
                  <input type="text" id="localip" class="form-control" placeholder="本机地址" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->address->localIP ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">本机</span>
                </div>
                </div>
              </div>
              <div class="col-md-6 mb-1">
                <div class="input-group">
                  <input type="text" id="upstreamip" class="form-control" placeholder="上级地址" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->address->upstreamIP ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">上级</span>
                </div>
                </div>
              </div>
            </div>
          </div>
          </div>
</div>

<div class="col-md-6"> 
        <!-- DHCP -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-network-wired"></i>
            DHCP 服务
<span class="float-right mt-n1 mb-n2">
<a href="/admin/settings.php?tab=piholedhcp" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">详情</a>
<button type="button" class="btn btn-<?php echo shell_exec('sudo /usr/local/bin/ui-checkDhcp');?> btn-sm mt-1" style="border-radius: 0px;" onclick="onDHCP()">开启</button>
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" onclick="offDHCP()">关闭</button>
</span>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-6 mb-1">
                <div class="input-group">
                  <input type="text" id="dhcpStart" class="form-control" placeholder="起始IP" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->address->dhcpStart ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">起始</span>
                </div>
                </div>
              </div>
              <div class="col-md-6 mb-1">
                <div class="input-group">
                  <input type="text" id="dhcpEnd" class="form-control" placeholder="结束IP" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->address->dhcpEnd ?>">
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
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © de_GWD by JacyL4 2020</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
function logout(){
$.get('auth.php', {logout:'true'}, function(result){ window.location.href="index.php" });
}

function checklink(){
$.get('./act/testBaidu.php',function(data) {
var checklink1 = data;
if ( $.trim(checklink1) == "ONLINE" ) {
$('#testBaidu').text("✓ 国内线路畅通");
} else {
$('#testBaidu').text("✗ 国内线路不通");
}
});

$.get('./act/testYoutue.php',function(data) {
var checklink2 = data;
if ( $.trim(checklink2) == "ONLINE" ) {
$('#testYoutue').text("✓ 国外线路畅通");
} else {
$('#testYoutue').text("✗ 国外线路不通");
}
});
}

function restartProxy(){
$.get('./act/restartProxy.php', function(result){window.location.reload();});
}

function markThis(){
markNametxt=$('#markName').val();
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload();});
}

function NodeDTshow(){
$("#shnodedt").css("display", "block");
$.get('./act/switchNodeDT.php', {switchNodeDT:"NodeDTshow"}, function(result){window.location.reload();});
}
function NodeDThide(){
$("#shnodedt").css("display", "none");
$.get('./act/switchNodeDT.php', {switchNodeDT:"NodeDThide"}, function(result){window.location.reload();});
}

function pingICMP(){
$.get('./act/v2node.php', function(data) {
var nodeList = JSON.parse(data);
var len = nodeList.length;
for( let i = 0; i<len; i++){
  $.get("./act/pingICMP.php", {pingICMP:i}, function(data){ $('#ping'+i).text(data) });
};
});
$.get("./act/pingICMPDOH1.php", function(data) { $('#pingDOH1').text(data) });
$.get("./act/pingICMPDOH2.php", function(data) { $('#pingDOH2').text(data) });
}

function pingTCP(){
$.get('./act/v2node.php', function(data) {
var nodeList = JSON.parse(data);
var len = nodeList.length;
for( let i = 0; i<len; i++){
  $.get("./act/pingTCP.php", {pingTCP:i}, function(data){ $('#ping'+i).text(data) });
};
});
$.get("./act/pingTCPDOH1.php", function(data) { $('#pingDOH1').text(data) });
$.get("./act/pingTCPDOH2.php", function(data) { $('#pingDOH2').text(data) });
}

function onUDP(){
$.get('./act/onUDP.php', function(result){window.location.reload();});
}

function offUDP(){
$.get('./act/offUDP.php', function(result){window.location.reload();});
}

function submitlocalip(){
localiptxt=$('#nodedttext').val();
$.get('./act/changeLocalIP.php', {localip:localiptxt}, function(result){window.location.reload();});
}

function dnsCHNW(){
$.get('./act/dnsCHNW.php', function(result){window.location.reload();});
alert("切换至大陆白名单。。。");
}

function dnsGFW(){
$.get('./act/dnsGFW.php', function(result){window.location.reload();});
alert("切换至GFWlist。。。");
}

function submitDNS(){
dohtxt1=$('#DoH1').val();
dohtxt2=$('#DoH2').val();
dnsChina=$("#dnsChina").val();
hostsCustomize=$("#hostsCustomize").val();
$.get("./act/saveDNS.php", {DoH1:dohtxt1, DoH2:dohtxt2, dnsChina:dnsChina, hostsCustomize:hostsCustomize}, function(result){window.location.reload();});
alert("保存DNS设置。。。");
}

function onV2ad(){
$.get('./act/onV2ad.php', function(result){window.location.reload();});
}

function offV2ad(){
$.get('./act/offV2ad.php', function(result){window.location.reload();});
}

function onAPPLE(){
$.get('./act/onAPPLE.php', function(result){window.location.reload();});
}

function offAPPLE(){
$.get('./act/offAPPLE.php', function(result){window.location.reload();});
}

function submitstaticip(){
staticip1=$('#localip').val();
staticip2=$('#upstreamip').val();
$.get('./act/changeStaticIP.php', {localip:staticip1, upstreamip:staticip2}, function(result){});
alert("本机已开始重新启动");
}

function onDHCP(){
dhcpStarttxt=$('#dhcpStart').val();
dhcpEndtxt=$('#dhcpEnd').val();
$.get('./act/onDHCP.php', {dhcpStart:dhcpStarttxt, dhcpEnd:dhcpEndtxt}, function(result){window.location.reload();});
alert('启动DHCP服务。。。');
}

function offDHCP(){
$.get('./act/offDHCP.php', function(result){window.location.reload();});
}

window.onload = function() {
nodestatusf = "<h5 class='mb-0'><span class='badge badge-pill badge-secondary'>闲置</span></h5>";
nodestatust = "<h5 class='mb-0'><span class='badge badge-pill badge-success'>选中</span></h5>";

$.get('./act/v2node.php', function(data) {
var nodeList = JSON.parse(data);
var len = nodeList.length;
for( let i = 0; i<len; i++){
  let domain = nodeList[i].domain;
  let name = nodeList[i].name;
  let nodeNF = nodeList[i].name;
  let nodeDT = nodeList[i].name;
  $('#nodeTable').append(`<tr> 
                          <td class="align-middle">${i}</td>
                          <td class="align-middle"><span id="nodeDomain${i}">${domain}</span></td>
                          <td class="align-middle"><span id="nodeshow${i}">${name}</span></td>
                          <td class="align-middle"><span id="ping${i}" class='text-success'></span></td>
                          <td class="align-middle"><button id="switch${i}" type="button" class="btn btn-success btn-xs">切换</button></td>
                          <td id="checkNode${i}">${nodestatusf}</td>
                          </tr>`);
  $('#checkNode<?php echo exec('/usr/local/bin/ui-checkNode');?>').html(nodestatust);
  $('#switch'+i).click(function(){
    $("#nodeTable td:nth-child(6)").html(nodestatusf);
    $('#checkNode'+i).html(nodestatust);
    $.get("./act/changeNode.php", {nodenum:i}, function(result){ })
  });

  $('#nodenf').append("<a class='dropdown-item' href='#' id='nodenf"+i+"'>"+nodeNF+"</a>");
  $('#nodenf'+i).click(function(){
    $('#nodenfshow').html(nodeNF);
    $('#nodenfshow').val(i);
    $.get("./act/changeNodeNF.php", {nodenfnum:i}, function(result){ })
  });

  $('#nodedt').append("<a class='dropdown-item' href='#' id='nodedt"+i+"'>"+nodeDT+"</a>");
  $('#nodedt'+i).click(function(){
    $('#nodedtshow').html(nodeDT);
    $('#nodedtshow').val(i);
    $.get("./act/changeNodeDT.php", {nodedtnum:i}, function(result){ })
  });
};
});

$.get("./act/version.php", function(data) {
var currentvernum = data.split("-")[0].substring(0);
var remotevernum = data.split("-")[1].substring(0);
$('#currentver').html(currentvernum+'本机');
$('#remotever').html(remotevernum+' 发布');

var vera = $.trim(currentvernum);
var verb = $.trim(remotevernum);
if (vera == verb) {
$('#remotever').addClass('badge badge-pill badge-light');
} else {
$('#remotever').addClass('badge badge-pill badge-warning');
};
});

$.get('./act/uptime.php', function(data) { $('#uptime').text(data) });

setInterval(function() {
checklink();
}, 1800);
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

</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
