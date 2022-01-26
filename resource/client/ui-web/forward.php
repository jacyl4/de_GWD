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

  <script src="js/jquery.qrcode.min.js"></script>

</head>

<body id="page-top" class="sidebar-toggled">
<?php $de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf')); ?>
<?php $checkJellyfin = $de_GWDconf->app->jellyfin; ?>
<?php $checkFileRun = file_exists('/var/www/html/filerun'); ?>
<?php $checkBitwarden = $de_GWDconf->app->bitwarden; ?>

<?php $checkCer = file_exists('/var/www/ssl/ocsp.resp'); ?>

<?php $checkcoredns = exec('sudo systemctl is-active coredns'); ?>
<?php $DoGsConf = strpos(file_get_contents('/opt/de_GWD/coredns/corefile'),'grpc://.:');?>

<?php $checkBlock53 = $de_GWDconf->FORWARD->block53; ?>

<?php $checkVtrui = exec('sudo systemctl is-active vtrui'); ?>
<?php $vtruiConf = json_decode(file_get_contents('/opt/de_GWD/vtrui/config.json')); ?>
<?php $checkFWD0 = empty($vtruiConf->inbounds[1]); ?>

<?php $checkVtrui1 = exec('sudo systemctl is-active vtrui1'); ?>
<?php $checkFWD1OB = explode("\n", shell_exec('sudo /opt/de_GWD/ui-checkFWD1')); ?>
<?php $checkFWD1 = file_exists('/opt/de_GWD/vtrui1/config.json'); ?>

<?php $checkRproxyS = exec('sudo systemctl is-active RproxyS'); ?>
<?php $RproxySconf = json_decode(file_get_contents('/opt/de_GWD/RproxyS/config.json')); ?>

<?php $checkRproxyC = exec('sudo systemctl is-active RproxyC'); ?>
<?php $RproxyCconf = json_decode(file_get_contents('/opt/de_GWD/RproxyC/config.json')); ?>

<?php $FileRunWebConf = file_get_contents ('/etc/nginx/conf.d/filerun.conf'); preg_match_all('/(?<=\blisten )\S+/is', $FileRunWebConf, $FileRunPort); $FileRunPort = $FileRunPort[0][0] ?>
<?php $WebConf = file_get_contents ('/etc/nginx/conf.d/default.conf'); preg_match_all('/(?<=\bserver_name )\S+/is', $WebConf, $serverName); $serverName = rtrim($serverName[0][0],";") ?>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="javascript:void(0)" onclick="window.open('https://t.me/de_GWD_DQ')">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>
    
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
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
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="CERswitch()">展开</button>
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
            DNS over gRPC server
<span id="DoGsButton" class="float-right mt-n1 mb-n2" style="display:<?php if ($DoGsConf !== false) echo 'block'; else echo 'none';?>">
<div class="btn-group">
<button id="buttonDoGsStop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonDoGsStopLoading"></span>
  <span>关闭</span>
</button>
<button id="buttonDoGsSave" type="button" class="btn <?php if ($DoGsConf !== false && $checkcoredns === active) echo 'btn-success'; else echo 'btn-outline-secondary';?> btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonDoGsSaveLoading"></span>
  <span>应用</span>
</button>
</div>
</span>
<span id="DoGsSwitch" class="float-right mt-n1 mb-n2" style="display:<?php if ($DoGsConf !== false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="DoGsSwitch()">展开</button>
</span>
          </div>

          <div id="DoGsBody" class="card-body" style="display:<?php if ($DoGsConf !== false) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-2 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">端口</span>
                </div>
                  <input id="DoGsPort" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->DoGs->port ?>">
              </div>

              <div class="col-md-3 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">地址</span>
                </div>
                <input type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->DoGs->port ?>" READONLY>
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

<button id="buttonFWD0Add" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">
  添加 UUID
</button>

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
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="FWD0switch()">展开</button>
</span>
          </div>

          <div id="FWD0body" class="card-body" style="display:<?php if ($checkFWD0 === false) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-2">
                <div class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">端口</span>
                  </div>
                  <input id="FWD0port" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->FWD0->port ?>">
                </div>
              </div>

              <div class="col-md-3">
                <div class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">地址</span>
                  </div>
                  <input type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->FWD0->port ?>" READONLY>
                </div>
              </div>

              <div id="FWD0List" class="col-md-7">
<?php 
for( $i=0; $i<count($de_GWDconf->FORWARD->FWD0->uuid); $i++){
  $FWD0num = $i + 1;
  $FWD0uuid = $de_GWDconf->FORWARD->FWD0->uuid[$i]->FWD0uuid;
  $FWD0mark = $de_GWDconf->FORWARD->FWD0->uuid[$i]->FWD0mark;
print <<<EOT
              <div>
                <div id="FWD0UUIDline" class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">UUID</span>
                  </div>
                    <input id="FWD0uuid$FWD0num" type="text" class="form-control" value="$FWD0uuid">
                  <div class="input-group-prepend input-group-append">
                    <button type="button" class="btn btn-secondary" onclick="FWD0qr(this)">显示二维码</button>
                  </div>
                  <div class="input-group-prepend input-group-append">
                    <span class="input-group-text">备注</span>
                  </div>
                    <input id="FWD0mark$FWD0num" type="text" class="form-control col-md-3" value="$FWD0mark">
                </div>
              </div>
<div id="FWD0qrpop$FWD0num" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto" >默认中转线二维码 - $FWD0mark</h5>
      </div>
      <div class="modal-body">
        <div id="FWD0qrcode$FWD0num" class="text-center"></div>
      </div>
    </div>
  </div>
</div>
EOT;
}
?>
              </div>          
            </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-reply-all"></i>
            并行中转线
<span id="FWD1button" class="float-right mt-n1 mb-n2" style="display:<?php if ($checkFWD1 === true) echo 'block'; else echo 'none';?>">
<button id="buttonFWD1Add" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">
  添加 UUID
</button>

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
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="FWD1switch()">展开</button>
</span>
          </div>

          <div id="FWD1body" class="card-body" style="display:<?php if ($checkFWD1 === true) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-2">
                <div class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">端口</span>
                  </div>
                  <input id="FWD1port" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->FWD1->port ?>">
                </div>
              </div>

              <div class="col-md-3">
                <div class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">地址</span>
                  </div>
                  <input type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->FWD1->port ?>" READONLY>
                </div>

<div class="btn-group">
  <label class="input-group-text">上级v2节点</label>
  <button id="FWD1upstream" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" value="<?php echo $checkFWD1OB[1] ?>"><?php echo $checkFWD1OB[0] ?></button>
  <div id="FWD1upstreamDrop" class="dropdown-menu">
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $address = $de_GWDconf->v2node[$i]->domain;
  $name = $de_GWDconf->v2node[$i]->name;
print <<<EOT
<button class='dropdown-item' href='#' id='FWD1upstream$i' value="$address" onclick="buttonFWD1upstream(this)">$name</button>
EOT;
}
?>
  </div>
</div>
              </div>

              <div id="FWD1List" class="col-md-7">
<?php 
for( $i=0; $i<count($de_GWDconf->FORWARD->FWD1->uuid); $i++){
  $FWD1num = $i + 1;
  $FWD1uuid = $de_GWDconf->FORWARD->FWD1->uuid[$i]->FWD1uuid;
  $FWD1mark = $de_GWDconf->FORWARD->FWD1->uuid[$i]->FWD1mark;
print <<<EOT
              <div>
                <div class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">UUID</span>
                  </div>
                    <input id="FWD1uuid$FWD1num" type="text" class="form-control" value="$FWD1uuid">
                  <div class="input-group-prepend input-group-append">
                    <button type="button" class="btn btn-secondary" onclick="FWD1qr(this)">显示二维码</button>
                  </div>
                  <div class="input-group-prepend input-group-append">
                    <span class="input-group-text">备注</span>
                  </div>
                    <input id="FWD1mark$FWD1num" type="text" class="form-control col-md-3" value="$FWD1mark">
                </div>
              </div>

<div id="FWD1qrpop$FWD1num" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto" >并行中转线二维码 - $FWD1mark</h5>
      </div>
      <div class="modal-body">
        <div id="FWD1qrcode$FWD1num" class="text-center"></div>
      </div>
    </div>
  </div>
</div>

EOT;
}
?>
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
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxySswitch()">展开</button>
</span>
          </div>
          <div id="RproxySbody" class="card-body" style="display:<?php if (empty($RproxySconf) === false) echo 'block'; else echo 'none';?>">
            <div class="form-row">
             <div class="col-md-2 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">端口</span>
                </div>
                  <input id="RproxyStunnelPort" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->port ?>">
              </div>

              <div class="col-md-3 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">对接地址</span>
                </div>
                <input type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->port ?>" READONLY>
              </div>

              <div class="col-md-7 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">UUID</span>
                </div>
                  <input id="RproxyStunnelUUID" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->uuid ?>">
                </div>
            </div>

            <div class="card mb-3 mt-2">
              <div class="card-header">
                代理型
<span id="RproxyS0Button" class="float-right mt-n1 mb-n2" style="display:<?php if ($de_GWDconf->FORWARD->Rproxy->server->inStatus === on) echo 'block'; else echo 'none';?>">
<button id="buttonRproxyS0Add" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">添加 UUID</button>
<button id="buttonRproxyS0Stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
</span>
<span id="RproxyS0Switch" class="float-right mt-n1 mb-n2" style="display:<?php if ($de_GWDconf->FORWARD->Rproxy->server->inStatus === on) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyS0Switch()">展开</button>
</span>
              </div>
              <div id="RproxyS0Body" class="card-body" style="display:<?php if ($de_GWDconf->FORWARD->Rproxy->server->inStatus === on) echo 'block'; else echo 'none';?>">
                <div class="form-row">
                  <div class="col-md-3">
                  <div class="input-group my-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">连入地址</span>
                    </div>
                    <input type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->domain ?>:<?php echo $de_GWDconf->FORWARD->Rproxy->server->tunnel->port ?>" READONLY>
                  </div>
                  </div>

                  <div id="RproxyS0List" class="col-md-9">
<?php 
for( $i=0; $i<count($de_GWDconf->FORWARD->Rproxy->server->inUUID); $i++){
  $RproxyS0num = $i + 1;
  $RproxyS0uuid = $de_GWDconf->FORWARD->Rproxy->server->inUUID[$i]->RproxyS0uuid;
  $RproxyS0mark = $de_GWDconf->FORWARD->Rproxy->server->inUUID[$i]->RproxyS0mark;
print <<<EOT
                  <div>
                    <div class="input-group my-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">UUID</span>
                    </div>
                      <input id="RproxyS0uuid$RproxyS0num" type="text" class="form-control" value="$RproxyS0uuid">
                    <div class="input-group-prepend input-group-append">
                      <button type="button" class="btn btn-secondary" onclick="RproxyS0qr(this)">显示二维码</button>
                    </div>
                    <div class="input-group-prepend input-group-append">
                      <span class="input-group-text">备注</span>
                    </div>
                      <input id="RproxyS0mark$RproxyS0num" type="text" class="form-control col-md-3" value="$RproxyS0mark">
                    </div>
                  </div>

<div id="RproxyS0qrpop$RproxyS0num" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mx-auto" >内网穿透 代理型 二维码 - $RproxyS0mark</h5>
      </div>
      <div class="modal-body">
        <div id="RproxyS0qrcode$RproxyS0num" class="text-center"></div>
      </div>
    </div>
  </div>
</div>

EOT;
}
?>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-3">
              <div class="card-header">
                端口映射型
<span id="RproxyS1Button" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxySconf), 'mapping') !== false) echo 'block'; else echo 'none';?>">
<button id="buttonRproxyS1Add" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">添加</button>
<button id="buttonRproxyS1Stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
</span>
<span id="RproxyS1Switch" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxySconf), 'mapping') !== false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyS1Switch()">展开</button>
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
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyCswitch()">展开</button>
</span>
          </div>
          <div id="RproxyCbody" class="card-body" style="display:<?php if (empty($RproxyCconf) === false) echo 'block'; else echo 'none';?>">
            <div class="form-row">
              <div class="col-md-5 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">对接地址</span>
                </div>
                  <input id="RproxyCtunnelAddress" type="text" class="form-control" value="<?php echo $de_GWDconf->FORWARD->Rproxy->client->tunnel->address ?>">
              </div>

              <div class="col-md-7 input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">UUID</span>
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
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyC0Switch()">展开</button>
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
<button id="buttonRproxyC1Add" type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;">添加</button>
<button id="buttonRproxyC1Stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
</span>
<span id="RproxyC1Switch" class="float-right mt-n1 mb-n2" style="display:<?php if (strpos(json_encode($RproxyCconf), 'mapping') !== false) echo 'none'; else echo 'block';?>">
<button type="button" class="btn btn-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="RproxyC1Switch()">展开</button>
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
            <span>Copyright © de_GWD by JacyL4 2017 ~ 2022</span>
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

function DoGsSwitch(){
$('#DoGsSwitch').css('display', 'none');
$('#DoGsButton').css('display', 'block');
$('#DoGsBody').css('display', 'block');
}

function FWD0switch(){
$('#FWD0switch').css('display', 'none');
$('#FWD0button').css('display', 'block');
$('#FWD0body').css('display', 'block');
}

function FWD0qr(FWD0qr){
var FWD0obj = $(FWD0qr).parent().parent().parent().parent().find('.input-group')
var FWD0objLine = $(FWD0qr).parent().parent().parent().find('div')
var FWD0index = FWD0obj.index(FWD0objLine)+1
$.get('./act/FWD0qr.php', {FWD0index:FWD0index}, function(data){
$('#FWD0qrcode'+FWD0index).empty()
$('#FWD0qrpop'+FWD0index).modal('show')
$('#FWD0qrcode'+FWD0index).qrcode({width: 240,height: 240,correctLevel:0,text:data})
})
}

function FWD1switch(){
$('#FWD1switch').css('display', 'none');
$('#FWD1button').css('display', 'block');
$('#FWD1body').css('display', 'block');
}

function FWD1qr(FWD1qr){
var FWD1obj = $(FWD1qr).parent().parent().parent().parent().find('.input-group')
var FWD1objLine = $(FWD1qr).parent().parent().parent().find('div')
var FWD1index = FWD1obj.index(FWD1objLine)+1
$.get('./act/FWD1qr.php', {FWD1index:FWD1index}, function(data){
$('#FWD1qrcode'+FWD1index).empty()
$('#FWD1qrpop'+FWD1index).modal('show')
$('#FWD1qrcode'+FWD1index).qrcode({width: 240,height: 240,correctLevel:0,text:data})
})
}

function buttonFWD1upstream(buttonFWD1upstream){
var FWD1upstreamobj = $(buttonFWD1upstream).parent().find('button')
var FWD1upstreamindex = FWD1upstreamobj.index($(buttonFWD1upstream))
var FWD1upstreamAddress = $('#FWD1upstream'+FWD1upstreamindex).val()
var FWD1upstreamName = $('#FWD1upstream'+FWD1upstreamindex).html()
$('#FWD1upstream').html(FWD1upstreamName)
$('#FWD1upstream').val(FWD1upstreamAddress)
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

function RproxyS0qr(RproxyS0qr){
var RproxyS0obj = $(RproxyS0qr).parent().parent().parent().parent().find('.input-group')
var RproxyS0objLine = $(RproxyS0qr).parent().parent().parent().find('div')
var RproxyS0index = RproxyS0obj.index(RproxyS0objLine)+1
$.get('./act/RproxyS0qr.php', {RproxyS0index:RproxyS0index}, function(data){
$('#RproxyS0qrcode'+RproxyS0index).empty()
$('#RproxyS0qrpop'+RproxyS0index).modal('show')
$('#RproxyS0qrcode'+RproxyS0index).qrcode({width: 240,height: 240,correctLevel:0,text:data})
})
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
cfapikey=$('#CFapikey').val().trim()
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

$('#buttonDoGsSave').click(function(){
$("#buttonDoGsSaveLoading").attr("class", "spinner-border spinner-border-sm")
DoGsPort=$('#DoGsPort').val().trim()
$.get('./act/DoGsSave.php', {DoGsPort:DoGsPort}, function(result){
  $("#buttonDoGsSaveLoading").removeClass()
  window.location.reload()

})
})

$('#buttonDoGsStop').click(function(){
$("#buttonDoGsStopLoading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/DoGsStop.php', function(result){
  $("#buttonDoGsStopLoading").removeClass()
  $("#buttonDoGsSave").attr('class','btn btn-outline-secondary btn-sm mt-1')
  $('#DoGsSwitch').css('display', 'block');
  $('#DoGsButton').css('display', 'none');
  $('#DoGsBody').css('display', 'none');
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

$('#buttonFWD0Add').click(function(){
  var i = $("#FWD0List .input-group").length+1
  $('#FWD0List').append(`
                <div class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">UUID</span>
                  </div>
                    <input id="FWD0uuid${i}" type="text" class="form-control" value="">
                  <div class="input-group-prepend input-group-append">
                    <button type="button" class="btn btn-secondary" onclick="FWD0qr(this)">显示二维码</button>
                  </div>
                  <div class="input-group-prepend input-group-append">
                    <span class="input-group-text">备注</span>
                  </div>
                    <input id="FWD0mark${i}" type="text" class="form-control col-md-3" value="">
                </div>
                          `)
})

$('#buttonFWD0save').click(function(){
$("#buttonFWD0saveLoading").attr("class", "spinner-border spinner-border-sm")
FWD0port=$('#FWD0port').val().trim()
var FWD0uuidList = []
var len = $("#FWD0List .input-group").length
var FWD0uuid, FWD0mark
for( let i = 1; i<=len; i++){
    var FWD0uuid = $('#FWD0uuid'+i).val().trim()
    var FWD0mark = $('#FWD0mark'+i).val()
    if ( FWD0uuid !== '' ) {
    FWD0uuidList.push({FWD0uuid, FWD0mark})
    }
}
$.get('./act/FWD0save.php', {FWD0port:FWD0port, FWD0uuidList:FWD0uuidList}, function(result){
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

$('#buttonFWD1Add').click(function(){
  var i = $("#FWD1List .input-group").length+1
  $('#FWD1List').append(`
                <div class="input-group my-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">UUID</span>
                  </div>
                    <input id="FWD1uuid${i}" type="text" class="form-control" value="">
                  <div class="input-group-prepend input-group-append">
                    <button type="button" class="btn btn-secondary" onclick="FWD1qr(this)">显示二维码</button>
                  </div>
                  <div class="input-group-prepend input-group-append">
                    <span class="input-group-text">备注</span>
                  </div>
                    <input id="FWD1mark${i}" type="text" class="form-control col-md-3" value="">
                </div>
                          `)
})

$('#buttonFWD1save').click(function(){
$("#buttonFWD1saveLoading").attr("class", "spinner-border spinner-border-sm")
FWD1upstream=$('#FWD1upstream').val()
FWD1port=$('#FWD1port').val().trim()
var FWD1uuidList = []
var len = $("#FWD1List .input-group").length
var FWD1uuid, FWD1mark
for( let i = 1; i<=len; i++){
    var FWD1uuid = $('#FWD1uuid'+i).val().trim()
    var FWD1mark = $('#FWD1mark'+i).val()
    if ( FWD1uuid !== '' ) {
    FWD1uuidList.push({FWD1uuid, FWD1mark})
    }
}
$.get('./act/FWD1save.php', {FWD1upstream:FWD1upstream, FWD1port:FWD1port, FWD1uuidList:FWD1uuidList}, function(result){
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
RproxyStunnelPort=$('#RproxyStunnelPort').val().trim()
RproxyStunnelUUID=$('#RproxyStunnelUUID').val().trim()
RproxySinStatus=$('#RproxyS0Body').css('display')
var RproxyS0uuidList = []
var len = $("#RproxyS0List .input-group").length
var RproxyS0uuid, RproxyS0mark
for( let i = 1; i<=len; i++){
    var RproxyS0uuid = $('#RproxyS0uuid'+i).val().trim()
    var RproxyS0mark = $('#RproxyS0mark'+i).val()
    if ( RproxyS0uuid !== '' ) {
    RproxyS0uuidList.push({RproxyS0uuid, RproxyS0mark})
    }
}
RproxySmappingStatus=$('#RproxyS1Body').css('display')
var RproxyS1List = []
var len = $("#RproxyS1List .input-group").length
var RproxyS1Port, RproxyS1Protocol
for( let i = 0; i<len; i++){
    var port = $('#RproxyS1Port'+i).val().trim()
    var protocol = $('#RproxyS1Protocol'+i).html()
    if ( port !== '' && protocol !== '') {
    RproxyS1List.push({port, protocol})
    }
}
$.get('./act/RproxySsave.php', {RproxyStunnelPort:RproxyStunnelPort, RproxyStunnelUUID:RproxyStunnelUUID, RproxyS0uuidList:RproxyS0uuidList, RproxySinStatus:RproxySinStatus, RproxySmappingStatus:RproxySmappingStatus, RproxyS1List:RproxyS1List}, function(result){
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

$('#buttonRproxyS0Add').click(function(){
  var i = $("#RproxyS0List .input-group").length+1
  $('#RproxyS0List').append(`
                  <div>
                    <div class="input-group my-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">UUID</span>
                    </div>
                      <input id="RproxyS0uuid${i}" type="text" class="form-control" value="">
                    <div class="input-group-prepend input-group-append">
                      <button type="button" class="btn btn-secondary" onclick="RproxyS0qr(this)">显示二维码</button>
                    </div>
                    <div class="input-group-prepend input-group-append">
                      <span class="input-group-text">备注</span>
                    </div>
                      <input id="RproxyS0mark${i}" type="text" class="form-control col-md-3" value="">
                    </div>
                  </div>
                          `)
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
RproxyCtunnelUUID=$('#RproxyCtunnelUUID').val().trim()
RproxyCoutStatus=$('#RproxyC0Body').css('display')
RproxyCmappingStatus=$('#RproxyC1Body').css('display')
var RproxyC1List = []
var len = $("#RproxyC1List .input-group").length
var RproxyC1extPort, RproxyC1extProtocol, RproxyC1intIP, RproxyC1intPort
for( let i = 0; i<len; i++){
    var extPort = $('#RproxyC1extPort'+i).val().trim()
    var extProtocol = $('#RproxyC1extProtocol'+i).html()
    var intIP = $('#RproxyC1intIP'+i).val().trim()
    var intPort = $('#RproxyC1intPort'+i).val().trim()
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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  
</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
