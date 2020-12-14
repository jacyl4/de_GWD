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
</head>

<body id="page-top" class="sidebar-toggled fixed-padding">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="https://github.com/jacyl4/de_GWD/releases" target="_blank">de_GWD</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-tachometer-alt"></i>
          <span>概览</span>
        </a>
      </li>
      <li class="nav-item active">
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

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">概览</a>
          </li>
          <li class="breadcrumb-item active">DDNS & LINK</li>
        </ol>


<!-- Modal -->
<div class="modal fade" id="markThis" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="markThisLabel">备注本机</h5>
      </div>
      <div class="modal-body">
        <input type="text" id="markName" class="form-control" placeholder="备注名" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->alias ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-sm btn-dark" onclick="markThis()">应用</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端1 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode1"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop2" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端2 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode2"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop3" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端3 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode3"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop4" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端4 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode4"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop5" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端5 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode5"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop6" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端6 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode6"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop7" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端7 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode7"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop8" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-auto mr-auto" >WireGuard客户端8 二维码</h5>
      </div>
      <div class="modal-body">
        <div class="text-center" id="qrcode8"></div>
      </div>
    </div>
  </div>
</div>


        <!-- Page Content -->
      <div class="col-md-6 input-group mx-auto mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">Wan IP</span>
        </div>
          <input type="text" class="form-control text-center" id="wanIP" value="">
        <div class="input-group-append">
          <button type="button" class="btn btn-secondary btn-sm" onclick="showIP()">查询</button>
        </div>
      </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-cloud"></i>
            <a href="http://www.pubyun.com" target="_blank">F3322 DDNS</a>
<span class="float-right mt-n1 mb-n2" id="ddns3322button" style="display:none">
<button type="button" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkDDNS3322');?> btn-sm mt-1" style="border-Radius: 0px;" onclick="ddns3322save()">开启</button>
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="ddns3322stop()">关闭</button>
</span>
<span class="float-right mt-n1 mb-n2" id="ddns3322switch">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="ddns3322switch()">展开</button>
</span>
          </div>

          <div class="card-body" id="ddns3322body" style="display:none">
    <div class="form-row">
      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">域名</span>
        </div>
          <input type="text" id="f3322domain" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->ddns->ddns3322->domain ?>">
      </div>

      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">用户名</span>
        </div>
          <input type="text" id="f3322usr" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->ddns->ddns3322->user ?>">
      </div>

      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">密码</span>
        </div>
          <input type="password" id="f3322pwd" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->ddns->ddns3322->pwd ?>">
      </div>
    </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-cloud"></i>
            <a href="https://dash.cloudflare.com/login" target="_blank">CloudFlare DDNS</a>
<span class="float-right mt-n1 mb-n2" id="ddnsCFbutton" style="display:none">
<button type="button" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkDDNScf');?> btn-sm mt-1" style="border-Radius: 0px;" onclick="ddnsCFsave()">开启</button>
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="ddnsCFstop()">关闭</button>
</span>
<span class="float-right mt-n1 mb-n2" id="ddnsCFswitch">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="ddnsCFswitch()">展开</button>
</span>
          </div>

          <div class="card-body" id="ddnsCFbody" style="display:none">
    <div class="form-row">
      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">域名</span>
        </div>
          <input type="text" id="CFdomain" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->ddns->ddnsCF->cfDomain ?>">
      </div>

      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">Zone ID</span>
        </div>
          <input type="text" id="CFzoneid" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->ddns->ddnsCF->cfZoneID ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">CF API KEY</span>
        </div>
          <input type="text" id="CFapikey" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->ddns->ddnsCF->cfAPIkey ?>">
      </div>

      <div class="col-md-6 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">CF E-mail</span>
        </div>
          <input type="text" id="CFemail" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->ddns->ddnsCF->cfEmail ?>">
      </div>
    </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-bacon"></i>
            FRP
<span class="float-right mt-n1 mb-n2 ml-4" id="FRPbutton" style="display:none">
<button type="button" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkFRP'); ?> btn-sm mt-1" style="border-Radius: 0px;" onclick="onFRP()">开启</button>
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="offFRP()">关闭</button>
</span>
<span class="float-right mt-n1 mb-n2">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="installFRP()">install</button>
</span>
          </div>

          <div class="card-body" id="FRPbody" style="display:none">
  <div class="form-row">
      <div class="col-md-8">
        <H6 class="my-auto mr-3">
        <i class="fas fa-globe-asia my-1 ml-4 mr-2"></i>服务端：
        </H6>
      <div class="input-group my-2">
        <div class="input-group-prepend col-xs-5">
          <span class="input-group-text align-self-center">服务器域名</span>
        </div>
        <input type="text" id="FRPdomain" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->domain ?>">

        <div class="input-group-append">
          <span class="input-group-text align-self-center">Bind-Port</span>
        </div>
          <input type="text" id="FRPbindPort" class="form-control" style="max-width: 120px;" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->bindPort ?>">

        <div class="input-group-append">
          <span class="input-group-text align-self-center">Token</span>
        </div>
          <input type="text" id="FRPtoken" class="form-control" style="max-width: 120px;" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->token ?>">
        <div class="input-group-prepend">
          <button id="FRPbindProtocol" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->bindProtocol ?>"><?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->bindProtocol ?></button>
            <div class="dropdown-menu">
            <a class="dropdown-item" onclick="FRPbindTCP()" href="#">TCP</a>
            <a class="dropdown-item" onclick="FRPbindKCP()" href="#">KCP</a>
            </div>
        </div>
      </div>
      </div>

      <div class="col-md-4">
        <H6 class="my-auto mr-3">
        <i class="fas fa-ethernet my-1 ml-4 mr-2"></i>本地端：
        </H6>
      <div class="input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text align-self-center">服务器端口</span>
        </div>
          <input type="text" id="FRPremotePort" class="form-control" style="max-width: 120px;" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->remotePort ?>">

        <div class="input-group-append">
          <span class="input-group-text align-self-center">本地端口</span>
        </div>
          <input type="text" id="FRPlocalPort" class="form-control" style="max-width: 120px;" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->localPort ?>">  

        <div class="input-group-prepend">
          <button id="FRPprotocol" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->protocol ?>"><?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->protocol ?></button>
            <div class="dropdown-menu">
            <a class="dropdown-item" onclick="FRPprotocolTCP()" href="#">TCP</a>
            <a class="dropdown-item" onclick="FRPprotocolUDP()" href="#">UDP</a>
            </div>
        </div>
      </div>
      </div>
  </div>

    <div class="form-row mt-3">
      <div class="col-md-12 input-group">
        <input class="form-control" type="text" id="frpCMD" placeholder="服务端安装指令" value="" readonly>
        <div class="input-group-append">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" onclick="genFRPcmd()">生成安装指令</button>
        </div> 
      </div>
    </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-archway"></i>
            WireGuard Server
<span class="float-right mt-n1 mb-n2 ml-4" id="WGbutton" style="display:none">
<button type="button" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkWG');?> btn-sm mt-1" style="border-Radius: 0px;" onclick="WGon()">开启</button>
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="WGoff()">关闭</button>
</span>
<span class="float-right mt-n1 mb-n2 ml-4" id="WGswitch">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="WGswitch()">展开</button>
</span>
<span class="float-right mt-n1 mb-n2">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="installWG()">install</button>
</span>
          </div>
          <div class="card-body" id="WGbody" style="display:none">

<div class="form-row mb-3">
      <div class="col-md-4 input-group mb-1 ml-auto">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">Endpoint</span>
          <span class="input-group-text justify-content-center">域名/公网IP</span>
        </div>
          <input type="text" id="WGaddress" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGdomain ?>">
      </div>
      <div class="col-md-4 input-group mb-1 mr-auto">
         <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">UDP端口</span>
         </div>
          <input type="text" id="WGaddressport" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGport ?>">
         <div class="input-group-append">
          <button type="button" class="btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" onclick="WGchangeKey()">重新生成密钥</button>
         </div>
      </div>
</div>


<div class="form-row mb-3">
      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点1</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark1" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[0] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop1" onclick="submitWGmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点2</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark2" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[1] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop2" onclick="submitWGmark()">显示二维码</button>
      </div>
</div>

<div class="form-row mb-3">
      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点3</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark3" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[2] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop3" onclick="submitWGmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点4</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark4" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[3] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop4" onclick="submitWGmark()">显示二维码</button>
      </div>
</div>

<div class="form-row mb-3">
      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点5</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark5" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[4] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop5" onclick="submitWGmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点6</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark6" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[5] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop6" onclick="submitWGmark()">显示二维码</button>
      </div>
</div>

<div class="form-row mb-3">
      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点7</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark7" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[6] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop7" onclick="submitWGmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group mb-1">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">节点8</span>
          <span class="input-group-text justify-content-center">备注：</span>
        </div>
          <input type="text" id="WGmark8" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->wireguard->WGmark[7] ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop8" onclick="submitWGmark()">显示二维码</button>
      </div>
</div>

<span class="float-left text-secondary">
  <small>
注：需要主路由映射所需UDP端口到de_GWD的地址。显示二维码的同时，即保存备注。
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

function markThis(){
markNametxt=$('#markName').val();
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload();});
}

function showIP(){
$.get('./act/checkDDNSip.php', function(data) { $('#wanIP').attr("value",data); });
}

function ddns3322switch(){
$("#ddns3322switch").css("display", "none"); 
$("#ddns3322button").css("display", "block"); 
$("#ddns3322body").css("display", "block"); 
}

function ddnsCFswitch(){
$("#ddnsCFswitch").css("display", "none"); 
$("#ddnsCFbutton").css("display", "block"); 
$("#ddnsCFbody").css("display", "block"); 
}

function ddns3322save(){
f3322domain=$('#f3322domain').val();
f3322usr=$('#f3322usr').val();
f3322pwd=$('#f3322pwd').val();
$.get('./act/ddns3322save.php', {f3322domain:f3322domain, f3322usr:f3322usr, f3322pwd:f3322pwd}, function(result){ location.reload() });
alert("开启DDNS。。。");
}

function ddns3322stop(){
$.get('./act/ddns3322stop.php', function(result){window.location.reload();});
}

function ddnsCFsave(){
cfdomain=$('#CFdomain').val();
cfzoneid=$('#CFzoneid').val();
cfapikey=$('#CFapikey').val();
cfemail=$('#CFemail').val();
$.get('./act/ddnsCFsave.php', {CFdomain:cfdomain, CFzoneid:cfzoneid, CFapikey:cfapikey, CFemail:cfemail}, function(result){ location.reload() });
alert("开启DDNS。。。");
}

function ddnsCFstop(){
$.get('./act/ddnsCFstop.php', function(result){window.location.reload();});
}

function FRPbindTCP(){$('#FRPbindProtocol').html("TCP"); };
function FRPbindKCP(){$('#FRPbindProtocol').html("KCP"); };

function FRPprotocolTCP(){$('#FRPprotocol').html("TCP"); };
function FRPprotocolUDP(){$('#FRPprotocol').html("UDP"); };

function installFRP(){
$.get('./act/installFRPc.php', function(result){});
window.open('/ttyd', 'popupWindow', 'width=800, height=600, scrollbars=yes');
};

function onFRP(){
FRPdomain=$('#FRPdomain').val();
FRPbindPort=$('#FRPbindPort').val();
FRPtoken=$('#FRPtoken').val();
FRPbindProtocol=$('#FRPbindProtocol').html();
FRPremotePort=$('#FRPremotePort').val();
FRPlocalPort=$('#FRPlocalPort').val();
FRPprotocol=$('#FRPprotocol').html();
$.get('./act/onFRP.php', {FRPdomain:FRPdomain, FRPbindPort:FRPbindPort, FRPtoken:FRPtoken, FRPbindProtocol:FRPbindProtocol, FRPremotePort:FRPremotePort, FRPlocalPort:FRPlocalPort, FRPprotocol:FRPprotocol}, function(result){ location.reload() });
};

function offFRP(){
$.get('./act/offFRP.php', function(result){window.location.reload();});
};

function genFRPcmd(){
FRPdomain=$('#FRPdomain').val();
FRPbindPort=$('#FRPbindPort').val();
FRPtoken=$('#FRPtoken').val();
FRPbindProtocol=$('#FRPbindProtocol').html();
FRPremotePort=$('#FRPremotePort').val();
FRPlocalPort=$('#FRPlocalPort').val();
FRPprotocol=$('#FRPprotocol').html();
$.get('./act/genFRPcmd.php', {FRPdomain:FRPdomain, FRPbindPort:FRPbindPort, FRPtoken:FRPtoken, FRPbindProtocol:FRPbindProtocol, FRPremotePort:FRPremotePort, FRPlocalPort:FRPlocalPort, FRPprotocol:FRPprotocol}, function(data){
$('#frpCMD').val(data);
});
};

function WGswitch(){
$("#WGswitch").css("display", "none"); 
$("#WGbutton").css("display", "block"); 
$("#WGbody").css("display", "block"); 
}

function installWG(){
$.get('./act/installWG.php', function(result){});
window.open('/ttyd', 'popupWindow', 'width=800, height=600, scrollbars=yes');
};

function WGchangeKey(){
$.get('./act/WGchangeKey.php', function(result){window.location.reload();});
}

function WGon(){
WGaddress=$('#WGaddress').val();
WGaddressport=$('#WGaddressport').val();
$.get('./act/WGon.php', {WGaddress:WGaddress, WGaddressport:WGaddressport}, function(result){ location.reload() });
alert("开启WireGuard。。。");
}

function WGoff(){
$.get('./act/WGoff.php', function(result){window.location.reload();});
}

function submitWGmark(){
WGmark1=$('#WGmark1').val();
WGmark2=$('#WGmark2').val();
WGmark3=$('#WGmark3').val();
WGmark4=$('#WGmark4').val();
WGmark5=$('#WGmark5').val();
WGmark6=$('#WGmark6').val();
WGmark7=$('#WGmark7').val();
WGmark8=$('#WGmark8').val();
$.get('./act/WGmark.php', {WGmark1:WGmark1, WGmark2:WGmark2, WGmark3:WGmark3, WGmark4:WGmark4, WGmark5:WGmark5, WGmark6:WGmark6, WGmark7:WGmark7, WGmark8:WGmark8}, function(result){ });
}

window.onload = function() {
$.get("./act/checkDDNS3322.php", function(data) {
if ($.trim(data) == "installed") {
$("#ddns3322switch").css("display", "none"); 
$("#ddns3322button").css("display", "block"); 
$("#ddns3322body").css("display", "block"); 
};
});

$.get("./act/checkDDNScf.php", function(data) {
if ($.trim(data) == "installed") {
$("#ddnsCFswitch").css("display", "none"); 
$("#ddnsCFbutton").css("display", "block"); 
$("#ddnsCFbody").css("display", "block"); 
};
});

$.get("./act/checkFRP.php", function(data) {
if ($.trim(data) == "installed") {
$("#FRPbutton").css("display", "block"); 
$("#FRPbody").css("display", "block"); 
};
});

$.get("./act/checkWG.php", function(data) {
if ($.trim(data) == "installed") {
$("#WGswitch").css("display", "none"); 
$("#WGbutton").css("display", "block");
$("#WGbody").css("display", "block");
};
});

$.get('./act/WGqrTXT1.php', function(data){
jQuery('#qrcode1').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('./act/WGqrTXT2.php', function(data){
jQuery('#qrcode2').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('./act/WGqrTXT3.php', function(data){
jQuery('#qrcode3').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('./act/WGqrTXT4.php', function(data){
jQuery('#qrcode4').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('./act/WGqrTXT5.php', function(data){
jQuery('#qrcode5').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('./act/WGqrTXT6.php', function(data){
jQuery('#qrcode6').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('./act/WGqrTXT7.php', function(data){
jQuery('#qrcode7').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('./act/WGqrTXT8.php', function(data){
jQuery('#qrcode8').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
}
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
  <script src="js/jquery.qrcode.min.js"></script>

</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
