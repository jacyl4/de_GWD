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

<title>中转</title>

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

</head>

<body id="page-top" class="sidebar-toggled fixed-padding">
<?php $de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf')); ?>
<?php $checkNetdata = file_exists('/usr/libexec/netdata/netdata-updater.sh'); ?>
<?php $checkJellyfin = file_exists('/usr/bin/jellyfin'); ?>
<?php $checkBitwarden = $de_GWDconf->app->bitwarden; ?>

<?php $checkCer = file_exists('/var/www/ssl/ocsp.resp'); ?>

<?php $checkxDNSs = exec('sudo systemctl is-active xDNSs'); ?>
<?php $xDNSsConf = file_exists('/opt/de_GWD/xDNSs/config.json'); ?>

<?php $checkBlock53 = $de_GWDconf->FORWARD->block53; ?>

<?php $checkVtrui = exec('sudo systemctl is-active vtrui'); ?>
<?php $vtruiConf = json_decode(file_get_contents('/opt/de_GWD/vtrui/config.json')); ?>
<?php $checkFWD0 = empty($vtruiConf->inbounds[1]); ?>

<?php $checkVtrui1 = exec('sudo systemctl is-active vtrui1'); ?>
<?php $checkFWD1 = file_exists('/opt/de_GWD/vtrui1/config.json'); ?>

<?php $checkRproxyS = exec('sudo systemctl is-active RproxyS'); ?>
<?php $RproxySconf = json_decode(file_get_contents('/opt/de_GWD/RproxyS/config.json')); ?>

<?php $checkRproxyC = exec('sudo systemctl is-active RproxyC'); ?>
<?php $RproxyCconf = json_decode(file_get_contents('/opt/de_GWD/RproxyC/config.json')); ?>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>
    
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
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

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkBitwarden === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8099')">
          <i class="fas fa-shield-alt"></i>
          <span>Bitwarden</span>
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
      <li class="nav-item active">
        <a class="nav-link" href="forward.php">
          <i class="fas fa-project-diagram"></i>
          <span>中转</span></a>
      </li>
      <li class="nav-item">
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
          <li class="breadcrumb-item active">中转</li>
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
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-shield-alt"></i>
            域名与证书
<span id="CERbutton" class="float-right mt-n1 mb-n2" style="display:<?php if ($checkCer === true) echo 'block'; else echo 'none';?>">
<button id="buttonGenCER" type="button" class="btn <?php if ($checkCer === true) echo 'btn-outline-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">install</button>
<button id="buttonCheckCER" type="button" class="btn btn-outline-secondary btn-sm mt-1 ml-4" style="border-Radius: 0px;">
  <span id="buttonCheckCERloading"></span>
  <span id="buttonCheckCERtxt">检查证书有效期</span>
</button>
</span>
<span id="CERswitch" class="float-right mt-n1 mb-n2" style="display:<?php if ($checkCer === true) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="CERswitch()">展开</button>
</span>
          </div>

          <div id="CERbody" class="card-body" style="display:<?php if ($checkCer === true) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-3 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text justify-content-center" style="min-width: 120px;">域名</span>
                </div>
                  <input id="CFdomain" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->domain ?>">
              </div>

              <div class="col-md-5 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text justify-content-center" style="min-width: 120px;">CF API KEY</span>
                </div>
                  <input id="CFapikey" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->APIkey ?>">
              </div>

              <div class="col-md-4 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text justify-content-center" style="min-width: 120px;">CF E-mail</span>
                </div>
                  <input id="CFemail" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Email ?>">
              </div>
            </div>
          </div>
        </div>



        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-reply"></i>
            xDNS server
<span id="xDNSsButton" class="float-right mt-n1 mb-n2" style="display:<?php if ($xDNSsConf === true) echo 'block'; else echo 'none';?>">
<div class="btn-group">
<button id="buttonxDNSsStop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonxDNSsStopLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonxDNSsSave" type="button" class="btn <?php if ($xDNSsConf === true && $checkxDNSs === active) echo 'btn-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonxDNSsSaveLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="xDNSsSwitch" class="float-right mt-n1 mb-n2" style="display:<?php if ($xDNSsConf === true) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="xDNSsSwitch()">展开</button>
</span>
          </div>

          <div id="xDNSsBody" class="card-body" style="display:<?php if ($xDNSsConf === true) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-3 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  地址
                  </span>
                </div>
                  <span class="input-group-text form-control"><?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->xDNSs->port ?></span>
              </div>

              <div class="col-md-3 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  端口
                  </span>
                </div>
                  <input id="xDNSsPort" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->xDNSs->port ?>">
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-reply"></i>
            默认中转线
<span id="FWD0button" class="float-right mt-n1 mb-n2" style="display:<?php if ($checkFWD0 === false) echo 'block'; else echo 'none';?>">
<div class="btn-group">
<button id="buttonBlock53off" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonBlock53offLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonBlock53on" type="button" class="btn <?php if ($checkBlock53 === on) echo 'btn-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonBlock53onLoading"></span>
  <span>不对外开放53端口</span>
</button>
</div>

<div class="btn-group">
<button id="buttonFWD0stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonFWD0stopLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonFWD0save" type="button" class="btn <?php if ($checkFWD0 === false && $checkVtrui === active) echo 'btn-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonFWD0saveLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="FWD0switch" class="float-right mt-n1 mb-n2" style="display:<?php if ($checkFWD0 === false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="FWD0switch()">展开</button>
</span>
          </div>

          <div id="FWD0body" class="card-body" style="display:<?php if ($checkFWD0 === false) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-3 mt-auto">

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  地址
                  </span>
                </div>
                <span class="input-group-text form-control"><?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->FWD0->port ?></span>
              </div>
              </div>

              <div class="col-md-3 mt-auto">
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  端口
                  </span>
                </div>
                <input id="FWD0port" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->FWD0->port ?>">
              </div>
              </div>

              <div class="col-md-6">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  UUID
                  </span>
                </div>
                  <textarea id="FWD0uuid" class="form-control" placeholder="一行一个UUID" rows="4"><?php foreach ($de_GWDconf->FORWARD->FWD0->uuid as $k => $v) {echo "$v\n";} ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-reply-all"></i>
            并行中转线
<span id="FWD1button" class="float-right mt-n1 mb-n2" style="display:<?php if ($checkFWD1 === true) echo 'block'; else echo 'none';?>">
<div class="btn-group">
<button id="buttonFWD1stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonFWD1stopLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonFWD1save" type="button" class="btn <?php if ($checkFWD1 === true && $checkVtrui1 === active) echo 'btn-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonFWD1saveLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="FWD1switch" class="float-right mt-n1 mb-n2" style="display:<?php if ($checkFWD1 === true) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="FWD1switch()">展开</button>
</span>
          </div>

          <div id="FWD1body" class="card-body" style="display:<?php if ($checkFWD1 === true) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-3 mt-auto">

<span class="float-left mb-3">
<div class="input-group ml-4 mt-1 my-2">
  <div class="input-group-prepend">
    <label class="input-group-text">上级v2节点</label>
  </div>
  <div class="input-group-append">
    <button id="v2nodeNAMEshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" value="<?php echo $de_GWDconf->FORWARD->FWD1->upstream ?>"><?php passthru('sudo /opt/de_GWD/ui-checkVtrui1') ?></button>
    <div id="v2nodeNAME" class="dropdown-menu">
    </div>
  </div>
</div>
</span>

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  地址
                  </span>
                </div>
                <span class="input-group-text form-control"><?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->FWD1->port ?></span>
              </div>
              </div>

              <div class="col-md-3 mt-auto">
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  端口
                  </span>
                </div>
                <input id="FWD1port" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->FWD1->port ?>">
              </div>
              </div>

              <div class="col-md-6">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  UUID
                  </span>
                </div>
                  <textarea id="FWD1uuid" class="form-control" placeholder="一行一个UUID" rows="4"><?php foreach ($de_GWDconf->FORWARD->FWD1->uuid as $k => $v) {echo "$v\n";} ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="card bg-light border-secondary mb-3">
          <div class="card-header">
            <i class="fas fa-share-square"></i>
            内网穿透 服务端 (公网设置)
<span id="RproxySbutton" class="float-right mt-n1 mb-n2" style="display:<?php if (empty($RproxySconf) === false) echo 'block'; else echo 'none';?>">
<div class="btn-group">
<button id="buttonRproxySstop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonRproxySstopLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonRproxySsave" type="button" class="btn <?php if (empty($RproxySconf) === false && $checkRproxyS === active) echo 'btn-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonRproxySsaveLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="RproxySswitch" class="float-right mt-n1 mb-n2" style="display:<?php if (empty($RproxySconf) === false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxySswitch()">展开</button>
</span>
          </div>
          <div id="RproxySbody" class="card-body" style="display:<?php if (empty($RproxySconf) === false) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-3 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  对接地址
                  </span>
                </div>
                  <span class="input-group-text form-control"><?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->port ?></span>
              </div>

              <div class="col-md-3 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  端口
                  </span>
                </div>
                  <input id="RproxyStunnelPort" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->port ?>">
              </div>

              <div class="col-md-6 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  UUID
                  </span>
                </div>
                  <input id="RproxyStunnelUUID" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->uuid ?>">
                </div>
            </div>

            <div class="card mb-3 mt-2">
              <div class="card-header">
                代理型
<span id="RproxyS0Button" class="float-right mt-n1 mb-n2" style="display:<?php if ($de_GWDconf->FORWARD->Rproxy->server->inStatus === on) echo 'block'; else echo 'none';?>">
<button id="buttonRproxyS0Stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
</span>
<span id="RproxyS0Switch" class="float-right mt-n1 mb-n2" style="display:<?php if ($de_GWDconf->FORWARD->Rproxy->server->inStatus === on) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyS0Switch()">展开</button>
</span>
              </div>
              <div id="RproxyS0Body" class="card-body" style="display:<?php if ($de_GWDconf->FORWARD->Rproxy->server->inStatus === on) echo 'block'; else echo 'none';?>">
                <div class="form-row">
                  <div class="col-md-3 mt-auto">
                  <div class="input-group my-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                      连入地址
                      </span>
                    </div>
                    <span class="input-group-text form-control"><?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->port ?></span>
                  </div>
                  </div>

                  <div class="col-md-6">
                    <div class="input-group my-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                      UUID
                      </span>
                    </div>
                      <textarea id="RproxySinUUID" class="form-control" rows="4"><?php foreach ($de_GWDconf->FORWARD->Rproxy->server->in->uuid as $k => $v) {echo "$v\n";} ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-3">
              <div class="card-header">
                端口映射型
<span id="RproxyS1Button" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxySconf), 'mapping') !== false) echo 'block'; else echo 'none';?>">
<button id="buttonRproxyS1Stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
<button id="buttonRproxyS1Add" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">增加</button>
</span>
<span id="RproxyS1Switch" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxySconf), 'mapping') !== false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyS1Switch()">展开</button>
</span>
              </div>
              <div id="RproxyS1Body" class="card-body" style="display:<?php if (strpos(json_encode($RproxySconf), 'mapping') !== false) echo 'block'; else echo 'none';?>">
                <div id="RproxyS1List" class="form-row">
<?php 
for( $i=0; $i<count($de_GWDconf->FORWARD->Rproxy->server->mapping); $i++){
  $RproxyS1Port = $de_GWDconf->FORWARD->Rproxy->server->mapping[$i]->port;
  $RproxyS1Protocol = $de_GWDconf->FORWARD->Rproxy->server->mapping[$i]->protocol;
print <<<EOT
<div class="col-md-4 input-group my-2">
  <div class="input-group-prepend">
    <span class="input-group-text">外部端口</span>
  </div>
    <input id="RproxyS1Port$i" type="text" class="form-control" value="$RproxyS1Port">
  <div class="input-group-prepend input-group-append">
    <button id="RproxyS1Protocol$i" type="button" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">$RproxyS1Protocol</button>
      <div class="dropdown-menu">
        <a class="dropdown-item" onclick="RproxyS1TCP(this)" href="javascript:void(0)">tcp</a>
        <a class="dropdown-item" onclick="RproxyS1UDP(this)" href="javascript:void(0)">udp</a>
        <a class="dropdown-item" onclick="RproxyS1TCPUDP(this)" href="javascript:void(0)">tcp,udp</a>
      </div>
  </div>
  <div class="input-group-append">
    <button type="button" class="btn btn-secondary btn-sm" onclick="mappingServerDel(this)">删除</button>
  </div>
</div>
EOT;
}
?>
                </div>
              </div>
            </div>
          </div>
        </div>

    <div class="card bg-light border-secondary mb-3">
          <div class="card-header">
            <i class="far fa-share-square"></i>
            内网穿透 客户端 (内网设置)
<span id="RproxyCbutton" class="float-right mt-n1 mb-n2" style="display:<?php if (empty($RproxyCconf) === false) echo 'block'; else echo 'none';?>">
<div class="btn-group">
<button id="buttonRproxyCstop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonRproxyCstopLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonRproxyCsave" type="button" class="btn <?php if (empty($RproxyCconf) === false && $checkRproxyC === active) echo 'btn-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonRproxyCsaveLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="RproxyCswitch" class="float-right mt-n1 mb-n2" style="display:<?php if (empty($RproxyCconf) === false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyCswitch()">展开</button>
</span>
          </div>
          <div id="RproxyCbody" class="card-body" style="display:<?php if (empty($RproxyCconf) === false) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-5 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  对接地址
                  </span>
                </div>
                  <input id="RproxyCtunnelAddress" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Rproxy->client->tunnel->address ?>">
              </div>

              <div class="col-md-7 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  UUID
                  </span>
                </div>
                  <input id="RproxyCtunnelUUID" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Rproxy->client->tunnel->uuid ?>">
                </div>
            </div>

            <div class="card mb-3 mt-2">
              <div class="card-header">
                代理型
<span id="RproxyC0Button" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxyCconf), 'directOut') !== false) echo 'block'; else echo 'none';?>">
<button id="buttonRproxyC0Stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
</span>
<span id="RproxyC0Switch" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxyCconf), 'directOut') !== false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyC0Switch()">展开</button>
</span>
              </div>
              <div id="RproxyC0Body" class="card-body" style="display:<?php if (strpos(json_encode($RproxyCconf), 'directOut') !== false) echo 'block'; else echo 'none';?>">
                <div class="form-row">
                  <div class="col-md-3 input-group my-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Out</span>
                    </div>
                      <input type="text" class="form-control" value="Freedom" readonly="true">
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-3">
              <div class="card-header">
                端口映射型
<span id="RproxyC1Button" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxyCconf), 'mapping') !== false) echo 'block'; else echo 'none';?>">
<button id="buttonRproxyC1Stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
<button id="buttonRproxyC1Add" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">增加</button>
</span>
<span id="RproxyC1Switch" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxyCconf), 'mapping') !== false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyC1Switch()">展开</button>
</span>
              </div>
              <div id="RproxyC1Body" class="card-body" style="display:<?php if (strpos(json_encode($RproxyCconf), 'mapping') !== false) echo 'block'; else echo 'none';?>">
                <div id="RproxyC1List" class="form-row">
<?php 
for( $i=0; $i<count($de_GWDconf->FORWARD->Rproxy->client->mapping); $i++){
  $RproxyC1extPort = $de_GWDconf->FORWARD->Rproxy->client->mapping[$i]->extPort;
  $RproxyC1extProtocol = $de_GWDconf->FORWARD->Rproxy->client->mapping[$i]->extProtocol;
  $RproxyC1intIP = $de_GWDconf->FORWARD->Rproxy->client->mapping[$i]->intIP;
  $RproxyC1intPort = $de_GWDconf->FORWARD->Rproxy->client->mapping[$i]->intPort;
print <<<EOT
<div class="col-md-6 input-group my-2">
  <div class="input-group-prepend">
    <span class="input-group-text">外部端口</span>
  </div>
    <input id="RproxyC1extPort$i" type="text" class="form-control" value="$RproxyC1extPort">
  <div class="input-group-prepend input-group-append">
    <button id="RproxyC1extProtocol$i" type="button" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">$RproxyC1extProtocol</button>
      <div class="dropdown-menu">
        <a class="dropdown-item" onclick="RproxyC1TCP(this)" href="javascript:void(0)">tcp</a>
        <a class="dropdown-item" onclick="RproxyC1UDP(this)" href="javascript:void(0)">udp</a>
        <a class="dropdown-item" onclick="RproxyC1TCPUDP(this)" href="javascript:void(0)">tcp,udp</a>
      </div>
  </div>
  <div class="input-group-prepend">
    <span class="input-group-text">内部IP</span>
  </div>
    <input id="RproxyC1intIP$i" type="text" class="form-control" value="$RproxyC1intIP">
  <div class="input-group-prepend input-group-append">
    <span class="input-group-text">内部端口</span>
  </div>
    <input id="RproxyC1intPort$i" type="text" class="form-control" value="$RproxyC1intPort">
  <div class="input-group-append">
    <button type="button" class="btn btn-secondary btn-sm" onclick="mappingClientDel(this)">删除</button>
  </div>
</div>
EOT;
}
?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page Content -->
      </div>
      

      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © de_GWD by JacyL4 2017 ~ 2021</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
function CERswitch(){
$('#CERswitch').css('display', 'none');
$('#CERbutton').css('display', 'block');
$('#CERbody').css('display', 'block');
}

function xDNSsSwitch(){
$('#xDNSsSwitch').css('display', 'none');
$('#xDNSsButton').css('display', 'block');
$('#xDNSsBody').css('display', 'block');
}

function FWD0switch(){
$('#FWD0switch').css('display', 'none');
$('#FWD0button').css('display', 'block');
$('#FWD0body').css('display', 'block');
}

function FWD1switch(){
$('#FWD1switch').css('display', 'none');
$('#FWD1button').css('display', 'block');
$('#FWD1body').css('display', 'block');
}

function RproxySswitch(){
$('#RproxySswitch').css('display', 'none');
$('#RproxySbutton').css('display', 'block');
$('#RproxySbody').css('display', 'block');
}

function RproxyS0Switch(){
$('#RproxyS0Switch').css('display', 'none');
$('#RproxyS0Button').css('display', 'block');
$('#RproxyS0Body').css('display', 'block');
}

function RproxyS1Switch(){
$('#RproxyS1Switch').css('display', 'none');
$('#RproxyS1Button').css('display', 'block');
$('#RproxyS1Body').css('display', 'block');
}

function RproxyC0Switch(){
$('#RproxyC0Switch').css('display', 'none');
$('#RproxyC0Button').css('display', 'block');
$('#RproxyC0Body').css('display', 'block');
}

function RproxyC1Switch(){
$('#RproxyC1Switch').css('display', 'none');
$('#RproxyC1Button').css('display', 'block');
$('#RproxyC1Body').css('display', 'block');
}

function RproxyS1TCP(RproxyS1TCP){
$(RproxyS1TCP).parent().parent().find('.dropdown-toggle').html("tcp")
}

function RproxyS1UDP(RproxyS1UDP){
$(RproxyS1UDP).parent().parent().find('.dropdown-toggle').html("udp")
}

function RproxyS1TCPUDP(RproxyS1TCPUDP){
$(RproxyS1TCPUDP).parent().parent().find('.dropdown-toggle').html("tcp,udp")
}

function RproxyC1TCP(RproxyC1TCP){
$(RproxyC1TCP).parent().parent().find('.dropdown-toggle').html("tcp")
}

function RproxyC1UDP(RproxyC1UDP){
$(RproxyC1UDP).parent().parent().find('.dropdown-toggle').html("udp")
}

function RproxyC1TCPUDP(RproxyC1TCPUDP){
$(RproxyC1TCPUDP).parent().parent().find('.dropdown-toggle').html("tcp,udp")
}

function mappingServerDel(mappingServerDel){
$(mappingServerDel).parent().parent('.input-group').remove()
}

function mappingClientDel(mappingClientDel){
$(mappingClientDel).parent().parent('.input-group').remove()
}

function RproxyCswitch(){
$('#RproxyCswitch').css('display', 'none');
$('#RproxyCbutton').css('display', 'block');
$('#RproxyCbody').css('display', 'block');
};

$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#buttonGenCER').click(function(){
cfdomain=$('#CFdomain').val()
cfapikey=$('#CFapikey').val()
cfemail=$('#CFemail').val()
$.get('./act/genCER.php', {CFdomain:cfdomain, CFapikey:cfapikey, CFemail:cfemail}, function(){})
var win = window.open('/ttyd', 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        $.get('./act/installZ.php', function(result){window.location.reload()})
    }
}, 300);
})

$('#buttonCheckCER').click(function(){
$("#buttonCheckCERloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/checkCER.php', function(data){
  $("#buttonCheckCERloading").removeClass()
  $("#buttonCheckCERtxt").html(data)
})
})

$.get('./act/arrV2node.php', function(data){
var nodeList = JSON.parse(data)
var len = nodeList.length
for( let i = 0; i<len; i++){
  let name = nodeList[i].name
  $('#v2nodeNAME').append("<a class='dropdown-item' href='#' id='nodeName"+i+"'>"+name+"</a>");
  $('#nodeName'+i).click(function(){ $('#v2nodeNAMEshow').html(name); $('#v2nodeNAMEshow').val(i)})
}
})

$('#buttonxDNSsSave').click(function(){
$("#buttonxDNSsSaveLoading").attr("class", "spinner-border spinner-border-sm")
xDNSsPort=$('#xDNSsPort').val()
$.get('./act/xDNSsSave.php', {xDNSsPort:xDNSsPort}, function(result){
  $("#buttonxDNSsSaveLoading").removeClass()
  window.location.reload()

})
})

$('#buttonxDNSsStop').click(function(){
$("#buttonxDNSsStopLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/xDNSsStop.php', function(result){
  $("#buttonxDNSsStopLoading").removeClass()
  $("#buttonxDNSsSave").attr('class','btn btn-outline-secondary btn-sm mt-1')
  $('#xDNSsSwitch').css('display', 'block');
  $('#xDNSsButton').css('display', 'none');
  $('#xDNSsBody').css('display', 'none');
})
})

$('#buttonBlock53on').click(function(){
$("#buttonBlock53onLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/block53on.php', function(result){
  $("#buttonBlock53onLoading").removeClass()
  $("#buttonBlock53on").attr('class','btn btn-success btn-sm mt-1')
})
})

$('#buttonBlock53off').click(function(){
$("#buttonBlock53offLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/block53off.php', function(result){
  $("#buttonBlock53offLoading").removeClass()
  $("#buttonBlock53on").attr('class','btn btn-outline-secondary btn-sm mt-1')
})
})

$('#buttonFWD0save').click(function(){
$("#buttonFWD0saveLoading").attr("class", "spinner-border spinner-border-sm")
FWD0port=$('#FWD0port').val()
FWD0uuid=$('#FWD0uuid').val()
$.get('./act/FWD0save.php', {FWD0port:FWD0port, FWD0uuid:FWD0uuid}, function(result){
  $("#buttonFWD0saveLoading").removeClass()
  window.location.reload()
})
})

$('#buttonFWD0stop').click(function(){
$("#buttonFWD0stopLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/FWD0stop.php', function(result){
  $("#buttonFWD0stopLoading").removeClass()
  $("#buttonFWD0save").attr('class','btn btn-outline-secondary btn-sm mt-1')
  $('#FWD0switch').css('display', 'block');
  $('#FWD0button').css('display', 'none');
  $('#FWD0body').css('display', 'none');
})
})

$('#buttonFWD1save').click(function(){
$("#buttonFWD1saveLoading").attr("class", "spinner-border spinner-border-sm")
v2nodeID=$('#v2nodeNAMEshow').val()
FWD1port=$('#FWD1port').val()
FWD1uuid=$('#FWD1uuid').val()
$.get('./act/FWD1save.php', {v2nodeID:v2nodeID, FWD1port:FWD1port, FWD1uuid:FWD1uuid}, function(result){
  $("#buttonFWD1saveLoading").removeClass()
  window.location.reload()

})
})

$('#buttonFWD1stop').click(function(){
$("#buttonFWD1stopLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/FWD1stop.php', function(result){
  $("#buttonFWD1stopLoading").removeClass()
  $("#buttonFWD1save").attr('class','btn btn-outline-secondary btn-sm mt-1')
  $('#FWD1switch').css('display', 'block');
  $('#FWD1button').css('display', 'none');
  $('#FWD1body').css('display', 'none');
})
})

$('#buttonRproxySsave').click(function(){
$("#buttonRproxySsaveLoading").attr("class", "spinner-border spinner-border-sm")
RproxyStunnelPort=$('#RproxyStunnelPort').val()
RproxyStunnelUUID=$('#RproxyStunnelUUID').val()
RproxySinUUID=$('#RproxySinUUID').val()
RproxySinStatus=$('#RproxyS0Body').css('display')
RproxySmappingStatus=$('#RproxyS1Body').css('display')
var RproxyS1List = []
var len = $("#RproxyS1List .input-group").length
var RproxyS1Port, RproxyS1Protocol
for( let i = 0; i<len; i++){
    var port = $('#RproxyS1Port'+i).val()
    var protocol = $('#RproxyS1Protocol'+i).html()
    if ( port !== '' && protocol !== '') {
    RproxyS1List.push({port, protocol})
    }
}
$.get('./act/RproxySsave.php', {RproxySinUUID:RproxySinUUID, RproxyStunnelPort:RproxyStunnelPort, RproxyStunnelUUID:RproxyStunnelUUID, RproxySinStatus:RproxySinStatus, RproxySmappingStatus:RproxySmappingStatus, RproxyS1List:RproxyS1List}, function(result){
  $("#buttonRproxySsaveLoading").removeClass()
  window.location.reload()
})
})

$('#buttonRproxySstop').click(function(){
$("#buttonRproxySstopLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/RproxySstop.php', function(result){
  $("#buttonRproxySstopLoading").removeClass()
  $("#buttonRproxySsave").attr('class','btn btn-outline-secondary btn-sm mt-1')
  $('#RproxySswitch').css('display', 'block'); 
  $('#RproxySbutton').css('display', 'none'); 
  $('#RproxySbody').css('display', 'none'); 
})
})

$('#buttonRproxyS0Stop').click(function(){
$('#RproxyS0Switch').css('display', 'block'); 
$('#RproxyS0Button').css('display', 'none'); 
$('#RproxyS0Body').css('display', 'none'); 
})

$('#buttonRproxyS1Stop').click(function(){
$('#RproxyS1Switch').css('display', 'block'); 
$('#RproxyS1Button').css('display', 'none'); 
$('#RproxyS1Body').css('display', 'none'); 
})

$('#buttonRproxyS1Add').click(function(){
  var i = $("#RproxyS1List .input-group").length
  $('#RproxyS1List').append(`
<div class="col-md-4 input-group my-2">
  <div class="input-group-prepend">
    <span class="input-group-text">外部端口</span>
  </div>
    <input id="RproxyS1Port${i}" type="text" class="form-control" value="">
  <div class="input-group-prepend input-group-append">
    <button id="RproxyS1Protocol${i}" type="button" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">tcp</button>
      <div class="dropdown-menu">
        <a class="dropdown-item" onclick="RproxyS1TCP(this)" href="javascript:void(0)">tcp</a>
        <a class="dropdown-item" onclick="RproxyS1UDP(this)" href="javascript:void(0)">udp</a>
        <a class="dropdown-item" onclick="RproxyS1TCPUDP(this)" href="javascript:void(0)">tcp,udp</a>
      </div>
  </div>
  <div class="input-group-append">
    <button type="button" class="btn btn-secondary btn-sm" onclick="mappingServerDel(this)">删除</button>
  </div>
</div>
                          `)
})

$('#buttonRproxyC1Add').click(function(){
  var i = $("#RproxyC1List .input-group").length
  $('#RproxyC1List').append(`
<div class="col-md-6 input-group my-2">
  <div class="input-group-prepend">
    <span class="input-group-text">外部端口</span>
  </div>
    <input id="RproxyC1extPort${i}" type="text" class="form-control" value="">
  <div class="input-group-prepend input-group-append">
    <button id="RproxyC1extProtocol${i}" type="button" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">tcp</button>
      <div class="dropdown-menu">
        <a class="dropdown-item" onclick="RproxyC1TCP(this)" href="javascript:void(0)">tcp</a>
        <a class="dropdown-item" onclick="RproxyC1UDP(this)" href="javascript:void(0)">udp</a>
        <a class="dropdown-item" onclick="RproxyC1TCPUDP(this)" href="javascript:void(0)">tcp,udp</a>
      </div>
  </div>
  <div class="input-group-prepend">
    <span class="input-group-text">内部IP</span>
  </div>
    <input id="RproxyC1intIP${i}" type="text" class="form-control" value="">
  <div class="input-group-prepend input-group-append">
    <span class="input-group-text">内部端口</span>
  </div>
    <input id="RproxyC1intPort${i}" type="text" class="form-control" value="">
  <div class="input-group-append">
    <button type="button" class="btn btn-secondary btn-sm" onclick="mappingClientDel(this)">删除</button>
  </div>
</div>
                          `)
})

$('#buttonRproxyCsave').click(function(){
$("#buttonRproxyCsaveLoading").attr("class", "spinner-border spinner-border-sm")
RproxyCtunnelAddress=$('#RproxyCtunnelAddress').val()
RproxyCtunnelUUID=$('#RproxyCtunnelUUID').val()
RproxyCoutStatus=$('#RproxyC0Body').css('display')
RproxyCmappingStatus=$('#RproxyC1Body').css('display')
var RproxyC1List = []
var len = $("#RproxyC1List .input-group").length
var RproxyC1extPort, RproxyC1extProtocol, RproxyC1intIP, RproxyC1intPort
for( let i = 0; i<len; i++){
    var extPort = $('#RproxyC1extPort'+i).val()
    var extProtocol = $('#RproxyC1extProtocol'+i).html()
    var intIP = $('#RproxyC1intIP'+i).val()
    var intPort = $('#RproxyC1intPort'+i).val()
    if ( extPort !== '' && extProtocol !== '' && intIP !== '' && intPort !== '') {
    RproxyC1List.push({extPort, extProtocol, intIP, intPort})
    }
}
$.get('./act/RproxyCsave.php', {RproxyCtunnelAddress:RproxyCtunnelAddress, RproxyCtunnelUUID:RproxyCtunnelUUID, RproxyCoutStatus:RproxyCoutStatus, RproxyCmappingStatus:RproxyCmappingStatus, RproxyC1List:RproxyC1List}, function(result){
  $("#buttonRproxyCsaveLoading").removeClass()
  window.location.reload()
})
})

$('#buttonRproxyCstop').click(function(){
$("#buttonRproxyCstopLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/RproxyCstop.php', function(result){
  $("#buttonRproxyCstopLoading").removeClass()
  $("#buttonRproxyCsave").attr('class','btn btn-outline-secondary btn-sm mt-1')
  $('#RproxyCswitch').css('display', 'block'); 
  $('#RproxyCbutton').css('display', 'none'); 
  $('#RproxyCbody').css('display', 'none'); 
})
})

$('#buttonRproxyC0Stop').click(function(){
$('#RproxyC0Switch').css('display', 'block'); 
$('#RproxyC0Button').css('display', 'none'); 
$('#RproxyC0Body').css('display', 'none'); 
})

$('#buttonRproxyC1Stop').click(function(){
$('#RproxyC1Switch').css('display', 'block'); 
$('#RproxyC1Button').css('display', 'none'); 
$('#RproxyC1Body').css('display', 'none'); 
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
