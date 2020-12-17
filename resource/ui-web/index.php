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
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/animation.css" rel="stylesheet">

  <link href="favicon.ico" rel="icon" type="image/x-icon" />

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

</head>

<body id="page-top" class="sidebar-toggled fixed-padding">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="https://github.com/jacyl4/de_GWD/releases" target="_blank">de_GWD</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button id="sidebarToggle" class="btn btn-link btn-sm text-white order-1 order-sm-0" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php echo shell_exec('sudo /opt/de_GWD/ui-checkEditionARM');?></span>
<span class="float-right badge text-success"><?php echo shell_exec('sudo /opt/de_GWD/ui-checkEditionFWD');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="adg/" target="_blank">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>AdGuard Home</span>
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
                  <i class="fas fa-toggle-on"></i>
                </div>
                <div class="">代理开关</div>
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
                  <div class="">运行时长</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="uptime" class="float-left"></span>
                <span class="float-right"><?php echo shell_exec('sudo /opt/de_GWD/ui-checkStatus');?></span>
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
        <input id="markName" type="text" class="form-control" placeholder="备注名" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->alias ?>">
      </div>
      <div class="modal-footer">
        <button id="buttonMarkThis" type="button" class="btn-sm btn-dark">应用</button>
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
        <button id="buttonSubmitStaticIP" type="button" class="btn-sm btn-dark">立即重启</button>
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
                <button id="buttonNodeDTshow" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">启用内网设备分流</button>
                <button id="buttonNodeDThide" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">禁用内网设备分流</button>
          </span>
          </div>
          <div style="display: flex;flex-wrap: wrap;">
            <button id="buttonPingTCP" type="button" class="btn btn-outline-success btn-sm col-6" style="border-radius: 0px;">Ping (TCP)</button>
            <button id="buttonPingICMP" type="button" class="btn btn-outline-success btn-sm col-6" style="border-radius: 0px;">Ping (ICMP)</button>
          </div>

          <div class="card-body">

<span class="float-left">
<div class="input-group ml-4 mt-1 mb-4">
  <div class="input-group-prepend">
    <label class="input-group-text">Netflix 分流</label>
  </div>
  <div class="input-group-append">
    <button id="nodenfshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php $nodenfnum = exec("/opt/de_GWD/ui-checkNodeNF"); echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->v2node[$nodenfnum]->name; ?></button>
    <div id="nodenf" class="dropdown-menu">
    </div>
  </div>
</div>
</span>

<span class="float-right">
<div class="input-group mr-4 mt-1 mb-4">
  <div class="input-group-prepend">
    <button id="buttonOnUDP" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkUDP');?>" type="button">UDP代理</button>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="offUDP()">OFF</button>
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
                    <th>速度(MB/s)</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody id="nodeTable">
                </tbody>
              </table>
            </div>

<div id="shnodedt" style="display:<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->divertLan->display; ?>">
<span class="float-left">
<div class="input-group ml-4 mt-1 mb-1">
  <div class="input-group-prepend">
    <label class="input-group-text">内网设备分流</label>
  </div>
  <div class="input-group-append">
    <button id="nodedtshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php $nodedtnum = exec("/opt/de_GWD/ui-checkNodeDT"); echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->v2node[$nodedtnum]->name; ?></button>
    <div id="nodedt" class="dropdown-menu">
    </div>
  </div>
</div>
</span>

<span class="float-right">
<div class="input-group mr-4 mt-1">
  <div class="input-group-prepend">
  <input id="nodedttext" type="text" class="form-control" placeholder="内网设备IP 空格分隔" value="<?php foreach (json_decode(file_get_contents('/opt/de_GWD/0conf'), true)['divertLan']['ip'] as $k => $v) {echo "$v ";} ?>">
  </div>
  <div class="input-group-append">
    <button id="buttonSubmitlocalip" class="btn btn-secondary" type="button">IP写入</button>
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
                <button id="buttonDnsCHNW" type="button" class="btn btn-<?php $DNSchnw = file_get_contents('/opt/de_GWD/v2dns/config.json'); if(strpos("$DNSchnw",'geosite:cn') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;">大陆白名单</button>
                <button id="buttonDnsGFW" type="button" class="btn btn-<?php $DNSgfw = file_get_contents('/opt/de_GWD/v2dns/config.json'); if(strpos("$DNSgfw",'geolocation-!cn') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;">GFWlist</button>
                <button id="buttonSubmitDNS" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">应用</button>
          </span>
          </div>

          <div class="card-body">
            <div class="form-row">
              <div class="col-md-5">
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DoH 1<br>
                  </span>
                </div>
                <input type="text" id="DoH1" class="form-control" placeholder="DoH1" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->dns->doh1 ?>">
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
                <input type="text" id="DoH2" class="form-control" placeholder="DoH2" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->dns->doh2 ?>">
                <div class="input-group-append">
                  <span id="pingDOH2" class="input-group-text text-success"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>

              <div class="row">
                <div class="ml-auto mr-3">
                  <div class="input-group my-2">
                    <div class="input-group-prepend">
                      <button id="buttonOnAPPLE" class="btn btn-<?php $apple = file_get_contents('/opt/de_GWD/v2dns/config.json'); if(strpos("$apple",'geosite:apple') !== false) echo 'success'; else echo 'outline-secondary'; ?>" type="button">Apple直连</button>
                    </div>
                    <div class="input-group-append">
                      <button id="buttonOffAPPLE" class="btn btn-secondary" type="button">OFF</button>
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
                  <textarea id="dnsChina" class="form-control" aria-label="dnsChina" rows="6"><?php echo str_replace(' ', "\n", json_decode(file_get_contents('/opt/de_GWD/0conf'))->dns->china) ?></textarea>
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
                  <textarea id="hostsCustomize" class="form-control" aria-label="hostsCustomize" rows="6" placeholder="IP 空格 域名"><?php echo shell_exec("sudo /opt/de_GWD/ui-hostsCustomize"); ?></textarea>
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
                  <input id="localip" type="text" class="form-control" placeholder="本机地址" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->localIP ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">本机</span>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="upstreamip" type="text" class="form-control" placeholder="上级地址" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->upstreamIP ?>">
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
                <a class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" href="adg/#dhcp" target="_blank">详情</a>
                <button id="buttonOnDHCP" type="button" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkDhcp');?> btn-sm mt-1" style="border-radius: 0px;">保存/开启</button>
                <button id="buttonOffDHCP" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">关闭</button>
          </span>
          </div>
          <div class="card-body">
                <div class="form-row">
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="dhcpStart" type="text" class="form-control" placeholder="起始IP" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->dhcpStart ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">起始</span>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="dhcpEnd" type="text" class="form-control" placeholder="结束IP" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->dhcpEnd ?>">
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
            <span>Copyright © de_GWD by JacyL4 2020</span>
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
var currentvernum = data.split("-")[0].substring(0)
var remotevernum = data.split("-")[1].substring(0)
var vera = $.trim(currentvernum)
var verb = $.trim(remotevernum)
$('#currentver').html(currentvernum+'本机')
$('#remotever').html(remotevernum+' 发布')

if (vera == verb) {
$('#remotever').addClass('badge badge-pill badge-light')
} else {
$('#remotever').addClass('badge badge-pill badge-warning')
}
})
}



$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#buttonProxyRestart').click(function(){
$.get('./act/proxyRestart.php', function(result){window.location.reload()})
})

$('#buttonProxyStop').click(function(){
$.get('./act/proxyStop.php', function(result){window.location.reload()})
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
                          <td class="align-middle">${i}</td>
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
    $.get("./act/changeNode.php", {nodenum:i}, function(result){})
  })

  $('#nodenf').append("<a class='dropdown-item' href='#' id='nodenf"+i+"'>"+nodeNF+"</a>")
  $('#nodenf'+i).click(function(){
    $('#nodenfshow').html(nodeNF)
    $('#nodenfshow').val(i)
    $.get("./act/changeNodeNF.php", {nodenfnum:i}, function(result){})
  })

  $('#nodedt').append("<a class='dropdown-item' href='#' id='nodedt"+i+"'>"+nodeDT+"</a>");
  $('#nodedt'+i).click(function(){
    $('#nodedtshow').html(nodeDT)
    $('#nodedtshow').val(i)
    $.get("./act/changeNodeDT.php", {nodedtnum:i}, function(result){})
  })
}
})

$('#buttonNodeDTshow').click(function(){
$("#shnodedt").css("display", "block")
$.get('./act/switchNodeDT.php', {switchNodeDT:"NodeDTshow"}, function(result){window.location.reload()})
})

$('#buttonNodeDThide').click(function(){
$("#shnodedt").css("display", "none")
$.get('./act/switchNodeDT.php', {switchNodeDT:"NodeDThide"}, function(result){window.location.reload()})
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
$.get('./act/onUDP.php', function(result){window.location.reload()})
})

$('#buttonSubmitlocalip').click(function(){
localiptxt=$('#nodedttext').val()
$.get('./act/changeLocalIP.php', {localip:localiptxt}, function(result){window.location.reload()})
})

$('#buttonDnsCHNW').click(function(){
$.get('./act/dnsCHNW.php', function(result){window.location.reload()})
alert("切换至大陆白名单。。。")
})

$('#buttonDnsGFW').click(function(){
$.get('./act/dnsGFW.php', function(result){window.location.reload()})
alert("切换至GFWlist。。。")
})

$('#buttonSubmitDNS').click(function(){
dohtxt1=$('#DoH1').val()
dohtxt2=$('#DoH2').val()
dnsChina=$("#dnsChina").val()
hostsCustomize=$("#hostsCustomize").val()
$.get("./act/saveDNS.php", {DoH1:dohtxt1, DoH2:dohtxt2, dnsChina:dnsChina, hostsCustomize:hostsCustomize}, function(result){window.location.reload()})
alert("应用DNS设置。。。")
})

$('#buttonOnAPPLE').click(function(){
$.get('./act/onAPPLE.php', function(result){window.location.reload()})
})

$('#buttonOffAPPLE').click(function(){
$.get('./act/offAPPLE.php', function(result){window.location.reload()})
})

$('#buttonSubmitStaticIP').click(function(){
staticip1=$('#localip').val()
staticip2=$('#upstreamip').val()
$.get('./act/changeStaticIP.php', {localip:staticip1, upstreamip:staticip2}, function(result){})
alert("本机已开始重新启动")
})

$('#buttonOnDHCP').click(function(){
dhcpStarttxt=$('#dhcpStart').val()
dhcpEndtxt=$('#dhcpEnd').val()
$.get('./act/onDHCP.php', {dhcpStart:dhcpStarttxt, dhcpEnd:dhcpEndtxt, dhcp:"on"}, function(result){window.location.reload()})
alert('启动DHCP服务。。。')
})

$('#buttonOffDHCP').click(function(){
$.get('./act/offDHCP.php', function(result){window.location.reload()})
alert('关闭DHCP服务。。。')
})

setInterval(function() {
checklink()
}, 1800)

})
</script>

</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
