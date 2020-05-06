<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<!DOCTYPE html>
<html lang="en">

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

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">de_GWD</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-success"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEditionNat');?></span>
<span class="float-right badge text-primary"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEdition');?></span>

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
        <a class="nav-link" href="!ddns.php">
          <i class="fas fa-fw fa-ethernet"></i>
          <span>DDNS & WireGuard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="!nodeMAN.php">
          <i class="fas fa-fw fa-stream"></i>
          <span>节点管理</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="!listBW.php">
          <i class="fas fa-fw fa-th-list"></i>
          <span>黑白名单</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="!update.php">
          <i class="fas fa-fw fa-arrow-alt-circle-up"></i>
          <span>更新</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="logout()">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>注销</span></a>
      </li>
    </ul>

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
                <span id="testBaidu" class="float-left">
                </span>
                <span id="testGoogle" class="float-right">
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
                <div class="mr-5">代理模式</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span class="float-left"><?php echo shell_exec('sudo /usr/local/bin/ui-checkDNS');?></span>
                <button class="btn btn-light float-right" style="padding: 0.25rem 0.25rem;font-size: 0.7rem;line-height: 0.8;border-radius: 0.2rem;" onclick="restartProxy()">重启进程</button>
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
                <button type="button" class="btn btn-light float-left" style="padding: 0.25rem 0.25rem;font-size: 0.7rem;line-height: 0.8;border-radius: 0.2rem;" data-toggle="modal" data-target="#markThis">备注本机</button>
                <span id="uptime" class="float-right">
                </span>
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

<span class="float-right">
<div class="input-group mt-1 mr-4 mb-4">
  <div class="input-group-prepend">
  <label class="input-group-text">V2去广告<span class="badge badge-pill badge-success mt-auto mb-auto ml-1"><?php echo shell_exec('sudo /usr/local/bin/ui-checkV2ad');?></span></label>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="v2adADD()">开启</button>
    <button class="btn btn-secondary" type="button" onclick="v2adDEL()">关闭</button>
  </div>
</div>
</span>

                    <tr>
                    <th>#</th>
                    <th>域名</th>
                    <th>节点名</th>
                    <th>延迟(ms)</th>
                    <th>操作</th>
                    <th>状态</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[0]->domain ?></span></td>
                    <td><span id="nodeshow1" class="align-middle"></span></td>
                    <td><span id="ping1" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch1()">切换</button></td>
                    <td id="checkNode1"></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[1]->domain ?></span></td>
                    <td><span id="nodeshow2" class="align-middle"></span></td>
                    <td><span id="ping2" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch2()">切换</button></td>
                    <td id="checkNode2"></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[2]->domain ?></span></td>
                    <td><span id="nodeshow3" class="align-middle"></span></td>
                    <td><span id="ping3" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch3()">切换</button></td>
                    <td id="checkNode3"></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[3]->domain ?></span></td>
                    <td><span id="nodeshow4" class="align-middle"></span></td>
                    <td><span id="ping4" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch4()">切换</button></td>
                    <td id="checkNode4"></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[4]->domain ?></span></td>
                    <td><span id="nodeshow5" class="align-middle"></span></td>
                    <td><span id="ping5" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch5()">切换</button></td>
                    <td id="checkNode5"></td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[5]->domain ?></span></td>
                    <td><span id="nodeshow6" class="align-middle"></span></td>
                    <td><span id="ping6" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch6()">切换</button></td>
                    <td id="checkNode6"></td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[6]->domain ?></span></td>
                    <td><span id="nodeshow7" class="align-middle"></span></td>
                    <td><span id="ping7" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch7()">切换</button></td>
                    <td id="checkNode7"></td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[7]->domain ?></span></td>
                    <td><span id="nodeshow8" class="align-middle"></span></td>
                    <td><span id="ping8" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch8()">切换</button></td>
                    <td id="checkNode8"></td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><span class="align-middle"><?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[8]->domain ?></span></td>
                    <td><span id="nodeshow9" class="align-middle"></span></td>
                    <td><span id="ping9" class='text-success'></span></td>
                    <td><button type="button" class="btn btn-success btn-xs" onclick="switch9()">切换</button></td>
                    <td id="checkNode9"></td>
                  </tr>
                </tbody>
              </table>

<div id="shnodedt" style="display:none">
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
  <input id="nodedttext" type="text" class="form-control" placeholder="内网设备IP" value="<?php foreach (json_decode(file_get_contents('/usr/local/bin/0conf'), true)['divertLan'] as $k => $v) {echo "$v ";} ?>">
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="submitlocalip()">IP写入</button>
  </div>
</div>
</span>
</div>


            </div>
          </div>
        </div>


        <!-- row2 -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="far fa-compass"></i>
            DNS
          <span class="float-right mt-n1 mb-n2">
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" onclick="changeNLchnw()">大陆白名单</button>
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" onclick="changeNLgfw()">GFWlist</button>
                <button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-radius: 0px;" onclick="submitDNS()">提交</button>
          </span>
          </div>

          <div class="card-body">
            <div class="form-row">
              <div class="col-md-3">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DoH 1<br>
                  </span>
                </div>
                <input type="text" id="DoH1" class="form-control" placeholder="DoH1" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->doh->doh1 ?>">
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
                <input type="text" id="DoH2" class="form-control" placeholder="DoH2" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->doh->doh2 ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-success" id="pingDOH2"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>
              </div>

              <div class="col-md-3">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DNS<br>
                  国内<br>
                  </span>
                </div>
                  <textarea id="chinaDNS" class="form-control" aria-label="chinaDNS" rows="6"><?php echo shell_exec("sudo /usr/local/bin/ui-getDNS"); ?></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  hosts<br>
                  静态解析<br>
                  </span>
                </div>
                  <textarea id="hostsCustomize" class="form-control" aria-label="hostsCustomize" rows="6"><?php echo shell_exec("sudo /usr/local/bin/ui-hostsCustomize"); ?></textarea>
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
                <button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-radius: 0px;" onclick="submitstaticip()">重启</button>
          </span>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <div class="input-group">
                  <input type="text" id="localip" class="form-control" placeholder="本机地址" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->address->localIP ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">本机</span>
                </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
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
          <span class="badge badge-pill badge-success mt-auto mb-auto ml-1"><?php echo shell_exec('sudo /usr/local/bin/ui-checkDhcp');?></span>
<span class="float-right mt-n1 mb-n2">
<a href="/admin/settings.php?tab=piholedhcp" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">详情</a>
<button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-radius: 0px;" onclick="dhcpUP()">开启</button>
<button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-radius: 0px;" onclick="dhcpDOWN()">关闭</button>
</span>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <div class="input-group">
                  <input type="text" id="dhcpStart" class="form-control" placeholder="起始IP" required="required" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->address->dhcpStart ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">起始</span>
                </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
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
$.get('testBaidu.php',function(data) {
var checklink1 = data;
if ( $.trim(checklink1) == "ONLINE" ) {
$('#testBaidu').text("✓ 国内线路畅通");
}
else {
$('#testBaidu').text("✗ 国内线路不通");
}
});

$.get('testGoogle.php',function(data) {
var checklink2 = data;
if ( $.trim(checklink2) == "ONLINE" ) {
$('#testGoogle').text("✓ 国外线路畅通");
}
else {
$('#testGoogle').text("✗ 国外线路不通");
}
});
}

function restartProxy(){
alert('确认重启代理进程');
$.get('restartProxy.php', function(result){window.location.reload();});
}

function markThis(){
markNametxt=$('#markName').val();
$.get('markThis.php', {markName:markNametxt}, function(result){window.location.reload();});
}

function NodeDTshow(){
$.get('switchNodeDT.php', {switchNodeDT:"NodeDTshow"}, function(result){window.location.reload();});
}
function NodeDThide(){
$.get('switchNodeDT.php', {switchNodeDT:"NodeDThide"}, function(result){window.location.reload();});
}

function pingICMP(){
$.get('pingICMP1.php', function(data) { $('#ping1').text(data) });
$.get("pingICMP2.php", function(data) { $('#ping2').text(data) });
$.get("pingICMP3.php", function(data) { $('#ping3').text(data) });
$.get("pingICMP4.php", function(data) { $('#ping4').text(data) });
$.get("pingICMP5.php", function(data) { $('#ping5').text(data) });
$.get("pingICMP6.php", function(data) { $('#ping6').text(data) });
$.get("pingICMP7.php", function(data) { $('#ping7').text(data) });
$.get("pingICMP8.php", function(data) { $('#ping8').text(data) });
$.get("pingICMP9.php", function(data) { $('#ping9').text(data) });
$.get("pingICMPDOH1.php", function(data) { $('#pingDOH1').text(data) });
$.get("pingICMPDOH2.php", function(data) { $('#pingDOH2').text(data) });
}

function pingTCP(){
$.get('pingTCP1.php', function(data) { $('#ping1').text(data) });
$.get("pingTCP2.php", function(data) { $('#ping2').text(data) });
$.get("pingTCP3.php", function(data) { $('#ping3').text(data) });
$.get("pingTCP4.php", function(data) { $('#ping4').text(data) });
$.get("pingTCP5.php", function(data) { $('#ping5').text(data) });
$.get("pingTCP6.php", function(data) { $('#ping6').text(data) });
$.get("pingTCP7.php", function(data) { $('#ping7').text(data) });
$.get("pingTCP8.php", function(data) { $('#ping8').text(data) });
$.get("pingTCP9.php", function(data) { $('#ping9').text(data) });
$.get("pingTCPDOH1.php", function(data) { $('#pingDOH1').text(data) });
$.get("pingTCPDOH2.php", function(data) { $('#pingDOH2').text(data) });
}

function v2adADD(){
$.get('v2adADD.php', function(result){window.location.reload();});
}

function v2adDEL(){
$.get('v2adDEL.php', function(result){window.location.reload();});
}

function submitlocalip(){
localiptxt=$('#nodedttext').val();
$.get('changeLocalIP.php', {localip:localiptxt}, function(result){ });
alert("IP已写入");
}

function changeNLchnw(){
$.get('changeNLchnw.php', function(result){window.location.reload();});
}

function changeNLgfw(){
$.get('changeNLgfw.php', function(result){window.location.reload();});
}

function submitDNS(){
dohtxt1=$('#DoH1').val();
dohtxt2=$('#DoH2').val();
chinaDNS=$("#chinaDNS").val();
hostsCustomize=$("#hostsCustomize").val();
$.get("saveDNS.php", {DoH1:dohtxt1, DoH2:dohtxt2, chinaDNS:chinaDNS, hostsCustomize:hostsCustomize}, function(result){window.location.reload();});
}

function submitstaticip(){
staticip1=$('#localip').val();
staticip2=$('#upstreamip').val();
$.get('changeStaticIP.php', {localip:staticip1, upstreamip:staticip2}, function(result){});
alert("本机已开始重新启动");
}

function dhcpUP(){
dhcpStarttxt=$('#dhcpStart').val();
dhcpEndtxt=$('#dhcpEnd').val();
$.get('dhcpUP.php', {dhcpStart:dhcpStarttxt, dhcpEnd:dhcpEndtxt}, function(result){window.location.reload();});
alert('DHCP服务正在启动');
}

function dhcpDOWN(){
$.get('dhcpDOWN.php', function(result){window.location.reload();});
}

node1 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[0]->name ?>";
node2 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[1]->name ?>";
node3 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[2]->name ?>";
node4 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[3]->name ?>";
node5 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[4]->name ?>";
node6 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[5]->name ?>";
node7 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[6]->name ?>";
node8 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[7]->name ?>";
node9 = "<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[8]->name ?>";

nodenum = "checkNode<?php echo exec('/usr/local/bin/ui-checkNode');?>" ;
nodestatusf = "<h5 class='mb-0'><span class='badge badge-pill badge-secondary'>闲置</span></h5>";
nodestatust = "<h5 class='mb-0'><span class='badge badge-pill badge-success'>选中</span></h5>";

function nfswitch1 () {$('#nodenfshow').html(node1); $.get("changeNodeNF.php", {nodenfnum:"1"}, function(result){ })};
function nfswitch2 () {$('#nodenfshow').html(node2); $.get("changeNodeNF.php", {nodenfnum:"2"}, function(result){ })};
function nfswitch3 () {$('#nodenfshow').html(node3); $.get("changeNodeNF.php", {nodenfnum:"3"}, function(result){ })};
function nfswitch4 () {$('#nodenfshow').html(node4); $.get("changeNodeNF.php", {nodenfnum:"4"}, function(result){ })};
function nfswitch5 () {$('#nodenfshow').html(node5); $.get("changeNodeNF.php", {nodenfnum:"5"}, function(result){ })};
function nfswitch6 () {$('#nodenfshow').html(node6); $.get("changeNodeNF.php", {nodenfnum:"6"}, function(result){ })};
function nfswitch7 () {$('#nodenfshow').html(node7); $.get("changeNodeNF.php", {nodenfnum:"7"}, function(result){ })};
function nfswitch8 () {$('#nodenfshow').html(node8); $.get("changeNodeNF.php", {nodenfnum:"8"}, function(result){ })};
function nfswitch9 () {$('#nodenfshow').html(node9); $.get("changeNodeNF.php", {nodenfnum:"9"}, function(result){ })};

function dtswitch1 () {$('#nodedtshow').html(node1); $.get("changeNodeDT.php", {nodedtnum:"1"}, function(result){ })};
function dtswitch2 () {$('#nodedtshow').html(node2); $.get("changeNodeDT.php", {nodedtnum:"2"}, function(result){ })};
function dtswitch3 () {$('#nodedtshow').html(node3); $.get("changeNodeDT.php", {nodedtnum:"3"}, function(result){ })};
function dtswitch4 () {$('#nodedtshow').html(node4); $.get("changeNodeDT.php", {nodedtnum:"4"}, function(result){ })};
function dtswitch5 () {$('#nodedtshow').html(node5); $.get("changeNodeDT.php", {nodedtnum:"5"}, function(result){ })};
function dtswitch6 () {$('#nodedtshow').html(node6); $.get("changeNodeDT.php", {nodedtnum:"6"}, function(result){ })};
function dtswitch7 () {$('#nodedtshow').html(node7); $.get("changeNodeDT.php", {nodedtnum:"7"}, function(result){ })};
function dtswitch8 () {$('#nodedtshow').html(node8); $.get("changeNodeDT.php", {nodedtnum:"8"}, function(result){ })};
function dtswitch9 () {$('#nodedtshow').html(node9); $.get("changeNodeDT.php", {nodedtnum:"9"}, function(result){ })};

function switch1 () {
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode1').html(nodestatust);
$.get("changeNode.php", {nodenum:"1"}, function(result){});
};
function switch2 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode2').html(nodestatust);
$.get("changeNode.php", {nodenum:"2"}, function(result){});
};
function switch3 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode3').html(nodestatust);
$.get("changeNode.php", {nodenum:"3"}, function(result){});
};
function switch4 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode4').html(nodestatust);
$.get("changeNode.php", {nodenum:"4"}, function(result){});
};
function switch5 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode5').html(nodestatust);
$.get("changeNode.php", {nodenum:"5"}, function(result){});
};
function switch6 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode6').html(nodestatust);
$.get("changeNode.php", {nodenum:"6"}, function(result){});
};
function switch7 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode7').html(nodestatust);
$.get("changeNode.php", {nodenum:"7"}, function(result){});
};
function switch8 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode9').html(nodestatusf);
$('#checkNode8').html(nodestatust);
$.get("changeNode.php", {nodenum:"8"}, function(result){});
};
function switch9 () {
$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatust);
$.get("changeNode.php", {nodenum:"9"}, function(result){});
};

window.onload = function() {
$("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");

$.get("checkNodeNF.php", function(data) { $('#nodenfshow').html(data) });
$.get("checkNodeDT.php", function(data) { $('#nodedtshow').html(data) });

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

$('#checkNode1').html(nodestatusf);
$('#checkNode2').html(nodestatusf);
$('#checkNode3').html(nodestatusf);
$('#checkNode4').html(nodestatusf);
$('#checkNode5').html(nodestatusf);
$('#checkNode6').html(nodestatusf);
$('#checkNode7').html(nodestatusf);
$('#checkNode8').html(nodestatusf);
$('#checkNode9').html(nodestatusf);

$("#"+nodenum).html(nodestatust);

$.get('uptime.php', function(data) { $('#uptime').text(data) });

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
$('#remotever').addClass('badge badge-pill badge-warning float-right mt-n2');
};
});

setInterval(function() {
checklink();
}, 1500);
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


</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
