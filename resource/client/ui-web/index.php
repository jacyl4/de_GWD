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

<body id="page-top" class="sidebar-toggled">
<?php $de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf')); ?>
<?php $DoG = $de_GWDconf->dns->dog; ?>

<?php $checkJellyfin = $de_GWDconf->app->jellyfin; ?>
<?php $checkFileRun = file_exists('/var/www/html/filerun'); ?>
<?php $checkBitwarden = $de_GWDconf->app->bitwarden; ?>

<?php $FileRunWebConf = file_get_contents ('/etc/nginx/conf.d/filerun.conf'); preg_match_all('/(?<=\blisten )\S+/is', $FileRunWebConf, $FileRunPort); $FileRunPort = $FileRunPort[0][0] ?>
<?php $WebConf = file_get_contents ('/etc/nginx/conf.d/default.conf'); preg_match_all('/(?<=\bserver_name )\S+/is', $WebConf, $serverName); $serverName = rtrim($serverName[0][0],";") ?>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button id="sidebarToggle" class="btn btn-link btn-sm text-white order-1 order-sm-0" href="#">
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
          <span>DDNS & Wireguard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="app.php">
          <i class="fab fa-app-store-ios"></i>
          <span>应用</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nodes.php">
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
                <span class="float-right"><?php $kernelV=exec('sudo uname -r'); echo str_replace("-arm64", "", str_replace("-amd64", "", $kernelV));?></span>
              </a>
            </div>
          </div>
        </div>


<!-- Modal -->
<div id="markThis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="markThisLabel" class="modal-title">备注本机</h5>
      </div>
      <div class="modal-body">
        <input id="markName" type="text" class="form-control" placeholder="备注名" required="required" value="<?php echo $de_GWDconf->address->alias; ?>">
      </div>
      <div class="modal-footer">
        <button id="buttonMarkThis" type="button" class="btn btn-outline-dark btn-sm">应用</button>
      </div>
    </div>
  </div>
</div>

<div id="nodeSMrules" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text border-danger bg-danger text-white">YouTube</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowYoutube" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMyoutube" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMyoutube0' onclick="buttonNodeSMyoutube(this)"> 默认代理 </a>
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
  $num = $i+1;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeSMyoutube$num' onclick="buttonNodeSMyoutube(this)">$name</a>
EOT;
}
?>
      </div>
  </div>
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text border-danger bg-white text-danger">NETFLIX</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowNetflix" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMnetflix" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMnetflix0' onclick="buttonNodeSMnetflix(this)"> 默认代理 </a>
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
  $num = $i+1;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeSMnetflix$num' onclick="buttonNodeSMnetflix(this)">$name</a>
EOT;
}
?>
      </div>
  </div>
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text border-dark bg-dark text-white">HBO</span>
    <span class="input-group-text text-white" style="border-color: #6c3483;background-color: #6c3483;">Disney+</span>
    <span class="input-group-text text-white" style="border-color: #2ecc71;background-color: #2ecc71;">Hulu</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowHDH" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMhdh" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMhdh0' onclick="buttonNodeSMhdh(this)"> 默认代理 </a>
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
  $num = $i+1;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeSMhdh$num' onclick="buttonNodeSMhdh(this)">$name</a>
EOT;
}
?>
      </div>
  </div>
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text border-primary bg-primary text-white">TVB</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowTVB" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMtvb" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMtvb0' onclick="buttonNodeSMtvb(this)"> 默认代理 </a>
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
  $num = $i+1;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeSMtvb$num' onclick="buttonNodeSMtvb(this)">$name</a>
EOT;
}
?>
      </div>
  </div>
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text text-white" style="border-color: #3AC1DF;background-color: #3AC1DF;">巴哈姆特動畫瘋</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowBahamut" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMbahamut" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMbahamut0' onclick="buttonNodeSMbahamut(this)"> 默认代理 </a>
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
  $num = $i+1;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeSMbahamut$num' onclick="buttonNodeSMbahamut(this)">$name</a>
EOT;
}
?>
      </div>
  </div>
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text text-white" style="border-color: #75A99C;background-color: #75A99C;">OpenAI</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowOpenai" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMopenai" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMopenai0' onclick="buttonNodeSMopenai(this)"> 默认代理 </a>
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
  $num = $i+1;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeSMopenai$num' onclick="buttonNodeSMopenai(this)">$name</a>
EOT;
}
?>
      </div>
  </div>
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text border-secondary bg-secondary text-white">APPLE</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowApple" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMapple" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMapple0' onclick="buttonNodeSMapple(this)"> 直连 </a>
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
  $num = $i+1;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeSMapple$num' onclick="buttonNodeSMapple(this)">$name</a>
EOT;
}
?>
      </div>
  </div>
</div>

<div class="input-group input-group-sm">
  <div class="input-group-prepend">
    <span class="input-group-text text-white" style="border-color: #184053;background-color: #184053;">Steam等国区游戏</span>
  </div>
  <div class="input-group-append">
      <button id="nodeSMshowSteam" class="btn btn-outline-secondary dropdown-toggle border-left-0" type="button" data-toggle="dropdown"></button>
      <div id="nodeSMsteam" class="dropdown-menu">
<a class='dropdown-item' href='#' id='nodeSMsteam0' onclick="buttonNodeSMsteam(this)"> 直连 </a>
<a class='dropdown-item' href='#' id='nodeSMsteam1' onclick="buttonNodeSMsteam(this)"> 默认代理 </a>
      </div>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button id="submitNodeSMrulesClear" type="button" class="btn btn-outline-secondary btn-sm">
          <span>重置</span>
        </button>

        <button id="submitNodeSMrules" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="submitNodeSMrulesLoading"></span>
          <span>规则写入</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="nodeDTrules" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">大陆白名单代理</span>
  </div>
   <input id="CHNlistProxyIP" type="text" class="form-control" placeholder="本地局域网IP 空格分隔" value="<?php foreach ($de_GWDconf->v2nodeDIV->nodeDT->CHNlistProxyIP as $k => $v) {echo "$v ";} ?>">
</div>

<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">全局代理</span>
  </div>
   <input id="globalProxyIP" type="text" class="form-control" placeholder="本地局域网IP 空格分隔" value="<?php foreach ($de_GWDconf->v2nodeDIV->nodeDT->globalProxyIP as $k => $v) {echo "$v ";} ?>">
</div>

<div class="input-group input-group-sm">
  <div class="input-group-prepend">
    <span class="input-group-text">全局直连</span>
  </div>
   <input id="directProxyIP" type="text" class="form-control" placeholder="本地局域网IP 空格分隔" value="<?php foreach ($de_GWDconf->v2nodeDIV->nodeDT->directProxyIP as $k => $v) {echo "$v ";} ?>">
</div>

      </div>
      <div class="modal-footer">
        <button id="buttonNodeDTrules" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonNodeDTrulesloading"></span>
          <span>规则写入</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="nodeCUrules" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <textarea id="nodeCUrulesDomain" class="form-control mb-2" rows="12"><?php $customDomainList = $de_GWDconf->v2nodeDIV->nodeCU->rulesDomain; foreach ( $customDomainList as $k => $v) {if (end($customDomainList) == $v) echo "$v"; else echo "$v\n";} ?></textarea>
        <div class="alert-light mb-4" role="alert">
        纯字符串: google.com<br>
        子域名: domain:google.com<br>
        子串: keyword:google.com<br>
        正则: regexp:\\.goo.*\\.com$<br>
        预定义域名列表: geosite:google<br>
        </div>

        <textarea id="nodeCUrulesIP" class="form-control mb-2" rows="6"><?php $customDomainList = $de_GWDconf->v2nodeDIV->nodeCU->rulesIP; foreach ( $customDomainList as $k => $v) {if (end($customDomainList) == $v) echo "$v"; else echo "$v\n";} ?></textarea>
        <div class="alert-light" role="alert">
        使用非内网IP，非专用网络IP<br>
        IP: 104.24.0.0<br>
        CIDR: 104.24.0.0/14<br>
        预定义IP列表:<br>
        geoip:cloudflare<br>
        geoip:cloudfront<br>
        geoip:facebook<br>
        geoip:fastly<br>
        geoip:google<br>
        geoip:netflix<br>
        geoip:telegram<br>
        geoip:twitter<br>
        </div>
      </div>
      <div class="modal-footer">
        <button id="buttonNodeCUrules" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonNodeCUrulesloading"></span>
          <span>规则写入</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="ssDetail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      <div class="input-group">
        <div class="input-group-prepend ">
          <span class="input-group-text">地址</span>
        </div>
          <input id="ssAddress" class="form-control" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssAddress; ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">端口</span>
        </div>
          <input id="ssPort" class="form-control" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssPort; ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">加密方式</span>
        </div>
        <div class="input-group-prepend input-group-append">
          <button id="ssMethod" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssMethod; ?>"><?php echo $de_GWDconf->v2nodeDIV->ss->ssMethod; ?></button>
          <div class="dropdown-menu">
            <a class='dropdown-item' href='#' id="ssAES256">AES-256-GCM</a>
            <a class='dropdown-item' href='#' id="ssAES128">AES-128-GCM</a>
            <a class='dropdown-item' href='#' id="ssChaCha20">ChaCha20-IETF-Poly1305</a>
          </div>
        </div>
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">密码</span>
        </div>
          <input id="ssSecure" class="form-control" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssSecure; ?>">
      </div>
      </div>
      <div class="modal-footer">
        <button id="buttonSSclear" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonSSclearloading"></span>
          <span>清除</span>
        </button>

        <button id="buttonSSsubmit" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonSSsubmitloading"></span>
          <span>应用</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="editListBW" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
              <div class="card">
                <div class="card-header">
                  <span>黑名单域名：</span>
                </div>
                  <textarea id="listB" class="form-control" aria-label="listB" rows="12" placeholder="一行一个域名" style="border-Radius: 0px;"><?php foreach($de_GWDconf->dns->listB as $v) {echo "$v\n";} ?></textarea>
              </div>

              <div class="card mt-3">
                <div class="card-header">
                  <span>白名单域名：</span>
                </div>
                  <textarea id="listW" class="form-control" aria-label="listW" rows="12" placeholder="一行一个域名"><?php foreach($de_GWDconf->dns->listW as $v) {echo "$v\n";} ?></textarea>
              </div>
      </div>
      <div class="modal-footer">
        <button id="buttonListBWurl" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonListBWurlloading"></span>
          <span>黑白名单写入</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="reboot" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reboot" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <span class="modal-title">确认重启并清理内核</span>
      </div>

      <div class="modal-footer">
        <button id="buttonReboot" type="button" class="btn btn-sm btn-danger" style="border-radius: 0px;">立即重启</button>
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
                <button type="button" class="btn btn-sm btn-outline-secondary mt-1 mr-2" style="border-radius: 0px;" data-toggle="modal" data-target="#nodeSMrules">
                  <span>预定义分流</span>
                </button>

                <button id="buttonSSdetail" type="button" class="btn <?php passthru('/opt/de_GWD/ui-checkNodeSS &'); ?> btn-sm mt-1 mr-2" style="border-radius: 0px;" data-toggle="modal" data-target="#ssDetail">
                  <span>SS</span>
                </button>

                <button id="buttonclearDIV" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonclearDIVloading"></span>
                  <span>清理所有分流</span>
                </button>
          </span>
          </div>
          <div style="display: flex;flex-wrap: wrap;">
            <button id="buttonPingTCP" type="button" class="btn btn-outline-success btn-sm col-12" style="border-radius: 0px;">Ping (TCP)</button>
          </div>

          <div class="card-body">
<div class="form-row">
<div class="mx-4 mr-auto">
<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">本地局域网分流</span>
  </div>
  <div id="nodeDTlist" class="input-group-prepend" style="display:none">
    <button id="nodeDTshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"></button>
    <div id="nodeDT" class="dropdown-menu">
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeDT$i' onclick="buttonNodeDT(this)">$name</a>
EOT;
}
?>
    </div>
  </div>
  <div id="nodeDTipButton" class="input-group-prepend input-group-append" style="display:none">
    <button class="btn btn-outline-secondary border-left-0" type="button" data-toggle="modal" data-target="#nodeDTrules">规则</button>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="nodeDTswitch(this)">
      <span id="buttonNodeDTloading"></span>
      <span id="nodeDTtext">ON</span>
    </button>
  </div>
</div>
</div>

<div class="mx-4">
<div class="input-group input-group-sm mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">自定义分流</span>
  </div>
  <div id="nodeCUlist" class="input-group-prepend" style="display:none">
    <button id="nodeCUshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"></button>
    <div id="nodeCU" class="dropdown-menu">
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeCU$i' onclick="buttonNodeCU(this)">$name</a>
EOT;
}
?>
    </div>
  </div>
  <div id="nodeCUrulesButton" class="input-group-prepend" style="display:none">
    <button class="btn btn-outline-secondary border-left-0" type="button" data-toggle="modal" data-target="#nodeCUrules">规则</button>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="nodeCUswitch(this)">
      <span id="buttonNodeCUloading"></span>
      <span id="nodeCUtext">ON</span>
    </button>
  </div>
</div>
</div>

</div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover text-center text-nowrap my-2">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>节点地址</th>
                    <th class="text-left">节点名</th>
                    <th>延迟(ms)</th>
                    <th>速度(MB/s)</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody id="nodeTable">
<?php
  $checkNode = exec('/opt/de_GWD/ui-checkNode');
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $nodeNUM = $i+1;
  $domain = $de_GWDconf->v2node[$i]->domain;
  $name = $de_GWDconf->v2node[$i]->name;
  if ( $checkNode != null && $checkNode == $i) $checkStatus = "btn-success"; else $checkStatus = "btn-outline-secondary";
print <<<EOT
                  <tr> 
                    <td class="align-middle">$nodeNUM</td>
                    <td class="align-middle"><span id="nodeDomain${i}">${domain}</span></td>
                    <td class="text-left"><span id="nodeshow${i}">${name}</span></td>
                    <td class="align-middle"><span id="ping${i}" class='text-success'></span></td>
                    <td class="align-middle"><span id="speed${i}" class='text-success'><a href="javascript:void(0)" class="text-success" onclick="buttonSpeed(this)"><i class="far fa-play-circle fa-lg"></i></a></span></td>
                    <td class="align-middle"><button id="switch${i}" type="button" class="btn $checkStatus btn-sm" onclick="buttonSwitch(this)">切换</button></td>
                  </tr>
EOT;
}
?>
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
                <button type="button" class="btn btn-secondary btn-sm mt-1 mr-2" style="border-radius: 0px;" data-toggle="modal" data-target="#editListBW">
                  <span>黑白名单</span>
                </button>

                <div class="btn-group">
                  <button id="buttonDNSsubmit" type="button" class="btn btn-secondary btn-sm mt-1" style="border-radius: 0px;">
                    <span id="buttonDNSsubmitloading"></span>
                    <span>应用</span>
                  </button>
                </div>
          </span>
          </div>

          <div class="card-body">
            <div class="form-row">
              <div class="col-md-5">
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="min-width: 75px">DoH 1</span>
                </div>
                <input type="text" id="DoH1" class="form-control" placeholder="域名:端口/dq" required="required" value="<?php echo $de_GWDconf->dns->doh[0];?>">
                <div class="input-group-append">
                  <span id="pingDOH1" class="input-group-text text-success"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="min-width: 75px">DoH 2</span>
                </div>
                <input type="text" id="DoH2" class="form-control" placeholder="域名:端口/dq" required="required" value="<?php echo $de_GWDconf->dns->doh[1];?>">
                <div class="input-group-append">
                  <span id="pingDOH2" class="input-group-text text-success"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="min-width: 75px">DNS over gRPC</span>
                </div>
                <input type="text" id="DoGc" class="form-control" placeholder="域名:端口" required="required" value="<?php echo $DoG ?>" style="display:<?php if (empty($DoG) === false) echo 'block'; else echo 'none';?>">
                <div id="DoGping" class="input-group-prepend input-group-append" style="display:<?php if (empty($DoG) === false) echo 'block'; else echo 'none';?>">
                  <span id="pingDoG" class="form-control input-group-text text-success"></span>
                </div>
                <div id="DoGpingMS" class="input-group-append" style="display:<?php if (empty($DoG) === false) echo 'block'; else echo 'none';?>">
                  <span class="input-group-text text-secondary">ms</span>
                </div>
                <div id="DoGbutton" class="input-group-prepend" style="display:<?php if (empty($DoG) === true) echo 'block'; else echo 'none';?>">
                  <button id="openDoG" class="form-control btn btn-outline-secondary" type="button"><i class="fas fa-angle-right"></i></button>
                </div>
              </div>
              </div>

                <div class="input-group col-md-3 my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DNS<br>
                  国内<br>
                  </span>
                </div>
                  <textarea id="dnsChina" class="form-control" aria-label="dnsChina" rows="6"><?php
$smartdnsConf = file_get_contents('/opt/de_GWD/smartdns/smartdns.conf');
preg_match_all('/(?<=\bserver )\S+/is', $smartdnsConf, $dnsClist);
if(($index = array_search('1.1.1.1',$dnsClist[0]))){
unset($dnsClist[0][$index]);
}
if(($index = array_search('8.8.8.8',$dnsClist[0]))){
unset($dnsClist[0][$index]);
}
if(($index = array_search('127.0.0.1:5333',$dnsClist[0]))){
unset($dnsClist[0][$index]);
}
foreach(array_unique($dnsClist[0]) as $k => $v){
  if ($v == end($dnsClist[0]))
    echo $v;
  else
    echo "$v\n";
}
?></textarea>
                </div>

                <div class="input-group col-md-4 my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  hosts<br>
                  静态<br>
                  </span>
                </div>
                  <textarea id="hostsCustomize" class="form-control" aria-label="hostsCustomize" rows="6" placeholder="IP 空格 abc.com &#10;IP 空格 *.abc.com"><?php passthru("sudo /opt/de_GWD/ui-hostsCustomize"); ?></textarea>
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
                <button type="button" class="btn btn-secondary btn-sm mt-1" style="border-radius: 0px;" data-toggle="modal" data-target="#reboot">应用 & 重启</button>
          </span>
          </div>
          <div class="card-body">
                <div class="form-row">
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="localip" type="text" class="form-control" placeholder="本机地址" required="required" value="<?php echo $de_GWDconf->address->localIP; ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">本机</span>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="upstreamip" type="text" class="form-control" placeholder="上级地址" required="required" value="<?php echo $de_GWDconf->address->upstreamIP; ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">上级</span>
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
            <span>Copyright © de_GWD by JacyL4 2017 ~ 2025</span>
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

$.get('./act/testGlobal.php',function(data){
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
var nodeDTtext = $(nodeDTswitch).find('#nodeDTtext').html()
if (nodeDTtext == 'OFF'){
$.get('./act/NodeDTswitch.php', {switchNodeDT:"NodeDThide"}, function(result){
  $("#nodeDTlist").css("display", "none")
  $("#nodeDTiptext").css("display", "none")
  $("#nodeDTipButton").css("display", "none")
  $("#buttonNodeDTloading").removeClass()
  $("#nodeDTtext").html("ON")
})
}
else {
$.get('./act/NodeDTswitch.php', {switchNodeDT:"NodeDTshow"}, function(data){
  $("#nodeDTlist").css("display", "block")
  $("#nodeDTiptext").css("display", "block")
  $("#nodeDTipButton").css("display", "block")
  $("#buttonNodeDTloading").removeClass()
  $("#nodeDTshow").html(data)
  $("#nodeDTtext").html("OFF")
})
}
}

function nodeCUswitch(nodeCUswitch){
$("#buttonNodeCUloading").attr("class", "spinner-border spinner-border-sm")
var nodeCUtext = $(nodeCUswitch).find('#nodeCUtext').html()
if (nodeCUtext == 'OFF'){
$.get('./act/NodeCUswitch.php', {switchNodeCU:"NodeCUhide"}, function(result){
  $("#nodeCUlist").css("display", "none")
  $("#nodeCUrulesButton").css("display", "none")
  $("#nodeCUtext").html("ON")
  $("#buttonNodeCUloading").removeClass()
})
}
else {
$.get('./act/NodeCUswitch.php', {switchNodeCU:"NodeCUshow"}, function(data){
  $("#nodeCUlist").css("display", "block")
  $("#nodeCUrulesButton").css("display", "block")
  $('#nodeCUshow').html(data)
  $("#nodeCUtext").html("OFF")
  $("#buttonNodeCUloading").removeClass()
})
}
}

function buttonSpeed(buttonSpeed){
var SPEEDobj = $(buttonSpeed).parent().parent().parent().parent().find('tr')
var SPEEDindex = SPEEDobj.index($(buttonSpeed).parent().parent().parent()[0])
$('#speed'+SPEEDindex).empty()
$('#speed'+SPEEDindex).attr('class', 'cloud')
$.get("./act/speedT.php", {speedT:SPEEDindex}, function(data){$('#speed'+SPEEDindex).attr('class', 'text-success'); $('#speed'+SPEEDindex).text(data)})
}

function buttonSwitch(buttonSwitch){
var SWITCHobj = $(buttonSwitch).parent().parent().parent().find('tr')
var SWITCHindex = SWITCHobj.index($(buttonSwitch).parent().parent()[0])
$("#nodeTable td:nth-child(6) button").attr('class', "btn btn-outline-secondary btn-sm")
$("#buttonSSdetail").attr('class','btn btn-outline-secondary btn-sm mt-1')
$('#switch'+SWITCHindex).attr('class', 'btn btn-success btn-sm');
$.get("./act/NodeChange.php", {nodenum:SWITCHindex}, function(){})
}

function buttonNodeSMyoutube(buttonNodeSMyoutube){
var NodeSMyoutubeOBJ = $(buttonNodeSMyoutube).parent().find('a')
var NodeSMyoutubeIndex = NodeSMyoutubeOBJ.index($(buttonNodeSMyoutube))
var NodeSMyoutubeName = $('#nodeSMyoutube'+NodeSMyoutubeIndex).html()
$('#nodeSMshowYoutube').html(NodeSMyoutubeName)
$('#nodeSMshowYoutube').val(NodeSMyoutubeIndex)
}

function buttonNodeSMnetflix(buttonNodeSMnetflix){
var NodeSMnetflixOBJ = $(buttonNodeSMnetflix).parent().find('a')
var NodeSMnetflixIndex = NodeSMnetflixOBJ.index($(buttonNodeSMnetflix))
var NodeSMnetflixName = $('#nodeSMnetflix'+NodeSMnetflixIndex).html()
$('#nodeSMshowNetflix').html(NodeSMnetflixName)
$('#nodeSMshowNetflix').val(NodeSMnetflixIndex)
}

function buttonNodeSMhdh(buttonNodeSMhdh){
var NodeSMhdhOBJ = $(buttonNodeSMhdh).parent().find('a')
var NodeSMhdhIndex = NodeSMhdhOBJ.index($(buttonNodeSMhdh))
var NodeSMhdhName = $('#nodeSMhdh'+NodeSMhdhIndex).html()
$('#nodeSMshowHDH').html(NodeSMhdhName)
$('#nodeSMshowHDH').val(NodeSMhdhIndex)
}

function buttonNodeSMtvb(buttonNodeSMtvb){
var NodeSMtvbOBJ = $(buttonNodeSMtvb).parent().find('a')
var NodeSMtvbIndex = NodeSMtvbOBJ.index($(buttonNodeSMtvb))
var NodeSMtvbName = $('#nodeSMtvb'+NodeSMtvbIndex).html()
$('#nodeSMshowTVB').html(NodeSMtvbName)
$('#nodeSMshowTVB').val(NodeSMtvbIndex)
}

function buttonNodeSMbahamut(buttonNodeSMbahamut){
var NodeSMbahamutOBJ = $(buttonNodeSMbahamut).parent().find('a')
var NodeSMbahamutIndex = NodeSMbahamutOBJ.index($(buttonNodeSMbahamut))
var NodeSMbahamutName = $('#nodeSMbahamut'+NodeSMbahamutIndex).html()
$('#nodeSMshowBahamut').html(NodeSMbahamutName)
$('#nodeSMshowBahamut').val(NodeSMbahamutIndex)
}

function buttonNodeSMopenai(buttonNodeSMopenai){
var NodeSMopenaiOBJ = $(buttonNodeSMopenai).parent().find('a')
var NodeSMopenaiIndex = NodeSMopenaiOBJ.index($(buttonNodeSMopenai))
var NodeSMopenaiName = $('#nodeSMopenai'+NodeSMopenaiIndex).html()
$('#nodeSMshowOpenai').html(NodeSMopenaiName)
$('#nodeSMshowOpenai').val(NodeSMopenaiIndex)
}

function buttonNodeSMapple(buttonNodeSMapple){
var NodeSMappleOBJ = $(buttonNodeSMapple).parent().find('a')
var NodeSMappleIndex = NodeSMappleOBJ.index($(buttonNodeSMapple))
var NodeSMappleName = $('#nodeSMapple'+NodeSMappleIndex).html()
$('#nodeSMshowApple').html(NodeSMappleName)
$('#nodeSMshowApple').val(NodeSMappleIndex)
}

function buttonNodeSMsteam(buttonNodeSMsteam){
var NodeSMsteamOBJ = $(buttonNodeSMsteam).parent().find('a')
var NodeSMsteamIndex = NodeSMsteamOBJ.index($(buttonNodeSMsteam))
var NodeSMsteamName = $('#nodeSMsteam'+NodeSMsteamIndex).html()
$('#nodeSMshowSteam').html(NodeSMsteamName)
$('#nodeSMshowSteam').val(NodeSMsteamIndex)
}

function buttonNodeDT(buttonNodeDT){
var NodeDTobj = $(buttonNodeDT).parent().find('a')
var NodeDTindex = NodeDTobj.index($(buttonNodeDT))
var NodeDTname = $('#nodeDT'+NodeDTindex).html()
$('#nodeDTshow').html(NodeDTname)
$.get("./act/NodeDTchange.php", {nodeDTnum:NodeDTindex}, function(){})
}

function buttonNodeCU(buttonNodeCU){
var NodeCUobj = $(buttonNodeCU).parent().find('a')
var NodeCUindex = NodeCUobj.index($(buttonNodeCU))
var NodeCUname = $('#nodeCU'+NodeCUindex).html()
$('#nodeCUshow').html(NodeCUname)
$.get("./act/NodeCUchange.php", {nodeCUnum:NodeCUindex}, function(){})
}

$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#currentver').click(function(){
window.open("https://github.com/jacyl4/de_GWD/releases")
})

$('#remotever').click(function(){
window.open("https://t.me/de_GWD_info")
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

$('#buttonPingTCP').click(function(){
$('#nodeTable tr').each(function(i){
$.get("./act/pingTCP.php", {pingTCP:i}, function(data){ $('#ping'+i).text(data) })
})
$.get("./act/pingTCPDOH1.php", function(data) { $('#pingDOH1').text(data) })
$.get("./act/pingTCPDOH2.php", function(data) { $('#pingDOH2').text(data) })
$.get("./act/pingTCPDoG.php", function(data) { $('#pingDoG').text(data) })
})

$('#submitNodeSMrulesClear').click(function(){
$('#nodeSMshowYoutube').html(' 默认代理 ')
$('#nodeSMshowYoutube').val('0')
$('#nodeSMshowNetflix').html(' 默认代理 ')
$('#nodeSMshowNetflix').val('0')
$('#nodeSMshowHDH').html(' 默认代理 ')
$('#nodeSMshowHDH').val('0')
$('#nodeSMshowTVB').html(' 默认代理 ')
$('#nodeSMshowTVB').val('0')
$('#nodeSMshowBahamut').html(' 默认代理 ')
$('#nodeSMshowBahamut').val('0')
$('#nodeSMshowOpenai').html(' 默认代理 ')
$('#nodeSMshowOpenai').val('0')
$('#nodeSMshowApple').html(' 直连 ')
$('#nodeSMshowApple').val('0')
$('#nodeSMshowSteam').html(' 直连 ')
$('#nodeSMshowSteam').val('0')
})

$('#submitNodeSMrules').click(function(){
$("#submitNodeSMrulesLoading").attr("class", "spinner-border spinner-border-sm ml-2")
nodeSMshowYoutube=$('#nodeSMshowYoutube').val()
nodeSMshowNetflix=$('#nodeSMshowNetflix').val()
nodeSMshowHDH=$('#nodeSMshowHDH').val()
nodeSMshowTVB=$('#nodeSMshowTVB').val()
nodeSMshowBahamut=$('#nodeSMshowBahamut').val()
nodeSMshowOpenai=$('#nodeSMshowOpenai').val()
nodeSMshowApple=$('#nodeSMshowApple').val()
nodeSMshowSteam=$('#nodeSMshowSteam').val()
$.get('./act/NodeSMrules.php', {nodeSMshowYoutube:nodeSMshowYoutube, nodeSMshowNetflix:nodeSMshowNetflix, nodeSMshowHDH:nodeSMshowHDH, nodeSMshowTVB:nodeSMshowTVB, nodeSMshowBahamut:nodeSMshowBahamut, nodeSMshowOpenai:nodeSMshowOpenai, nodeSMshowApple:nodeSMshowApple, nodeSMshowSteam:nodeSMshowSteam}, function(result){
  $("#submitNodeSMrulesLoading").removeClass()
  $("#nodeSMrules").modal('hide')
  window.location.reload()
})
})

$('#buttonclearDIV').click(function(){
$("#buttonclearDIVloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/NodeOne.php', function(result){
  $("#buttonclearDIVloading").removeClass()
  window.location.reload()
})
})

$('#buttonNodeDTrules').click(function(){
$("#buttonNodeDTrulesloading").attr("class", "spinner-border spinner-border-sm")
CHNlistProxyIP=$('#CHNlistProxyIP').val()
globalProxyIP=$('#globalProxyIP').val()
directProxyIP=$('#directProxyIP').val()
$.get('./act/NodeDTrules.php', {CHNlistProxyIP:CHNlistProxyIP, globalProxyIP:globalProxyIP, directProxyIP:directProxyIP}, function(result){
  $("#buttonNodeDTrulesloading").removeClass()
  $("#nodeDTrules").modal('hide')
})
})

$('#buttonNodeCUrules').click(function(){
$("#buttonNodeCUrulesloading").attr("class", "spinner-border spinner-border-sm")
customDomain=$('#nodeCUrulesDomain').val()
customIP=$('#nodeCUrulesIP').val()
$.get('./act/NodeCUrules.php', {customDomain:customDomain, customIP:customIP}, function(result){
  $("#buttonNodeCUrulesloading").removeClass()
  $("#nodeCUrules").modal('hide')
})
})

$('#ssAES256').click(function(){
$('#ssMethod').html("AES-256-GCM")
$('#ssMethod').val("aes-256-gcm")
})

$('#ssAES128').click(function(){
$('#ssMethod').html("AES-128-GCM")
$('#ssMethod').val("aes-128-gcm")
})

$('#ssChaCha20').click(function(){
$('#ssMethod').html("ChaCha20-IETF-Poly1305")
$('#ssMethod').val("chacha20-ietf-poly1305")
})

$('#buttonSSclear').click(function(){
$("#buttonSSclearloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/changeNodeSS0.php', function(result){
  $("#buttonSSclearloading").removeClass()
  window.location.reload()
})
})

$('#buttonSSsubmit').click(function(){
$("#buttonSSsubmitloading").attr("class", "spinner-border spinner-border-sm")
ssAddress=$('#ssAddress').val()
ssPort=$('#ssPort').val()
ssMethod=$('#ssMethod').val()
ssSecure=$('#ssSecure').val()
$.get('./act/changeNodeSS.php', {ssAddress:ssAddress, ssPort:ssPort, ssMethod:ssMethod, ssSecure:ssSecure}, function(result){
  $("#buttonSSsubmitloading").removeClass()
  $("#ssDetail").modal('hide')
  $("#buttonSSdetail").attr('class','btn btn-success btn-sm mt-1')
  $("#nodeTable td:nth-child(6) button").attr('class', "btn btn-outline-secondary btn-sm")
})
})

$('#openDoG').click(function(){
$("#DoGc").css("display", "block")
$("#DoGping").css("display", "block")
$("#DoGpingMS").css("display", "block")
$("#DoGbutton").css("display", "none")
})

$('#buttonListBWurl').click(function(){
$("#buttonListBWurlloading").attr("class", "spinner-border spinner-border-sm")
listB=$("#listB").val()
listW=$("#listW").val()
$.get("./act/submitListBW.php", {listB:listB, listW:listW}, function(result){
  $("#buttonListBWurlloading").removeClass()
  $("#editListBW").modal('hide')
})
})

$('#adBlistLoad').click(function(){
$("#adBlist").val("")
})

$('#adBregexLoad').click(function(){
var adBregexLoadDefault=$.ajax({url:"/act/adBregexDefault",async:false,cache:false})
$("#adBregex").val(adBregexLoadDefault.responseText)
})

$('#adWlistLoad').click(function(){
var adWlistLoadDefault=$.ajax({url:"/act/adWlistDefault",async:false,cache:false})
$("#adWlist").val(adWlistLoadDefault.responseText)
})

$('#adWregexLoad').click(function(){
var adWregexLoadDefault=$.ajax({url:"/act/adWregexDefault",async:false,cache:false})
$("#adWregex").val(adWregexLoadDefault.responseText)
})

$('#buttonDNSsubmit').click(function(){
$("#buttonDNSsubmitloading").attr("class", "spinner-border spinner-border-sm")
DoGc=$('#DoGc').val()
doh1txt=$('#DoH1').val()
doh2txt=$('#DoH2').val()
dnsChina=$("#dnsChina").val()
hostsCustomize=$("#hostsCustomize").val()
$.get("./act/DNSsave.php", {DoGc:DoGc, DoH1:doh1txt, DoH2:doh2txt, dnsChina:dnsChina, hostsCustomize:hostsCustomize}, function(result){
  $("#buttonDNSsubmitloading").removeClass()
  window.location.reload()
})
})

$('#buttonReboot').click(function(){
staticip1=$('#localip').val()
staticip2=$('#upstreamip').val()
$.get('./act/reboot.php', {localip:staticip1, upstreamip:staticip2}, function(result){window.location.reload()})
})

setInterval(function() {
checklink()
}, 1800)

$.get('./act/uptime.php', function(data){$('#uptime').text(data)})

$.get('./act/NodeDTcheck.php', function(data){
if(data != "") {
  $('#nodeDTshow').html(data)
  $("#nodeDTlist").css("display", "block")
  $("#nodeDTiptext").css("display", "block")
  $("#nodeDTipButton").css("display", "block")
  $("#nodeDTtext").html("OFF")
}
})

$.get('./act/NodeCUcheck.php', function(data){
if(data != "") {
  $('#nodeCUshow').html(data)
  $("#nodeCUlist").css("display", "block")
  $("#nodeCUrulesButton").css("display", "block")
  $("#nodeCUtext").html("OFF")
}
})

$.get('./act/NodeSMcheck.php', function(data){
let SMarray = data.split("\n")
let youtubeNum = SMarray[0]
let youtubeName = SMarray[1]
if (youtubeName == "-none-") {
    youtubeName = " 默认代理 "
}
let netflixNum = SMarray[2]
let netflixName = SMarray[3]
if (netflixName == "-none-") {
    netflixName = " 默认代理 "
}
let hdhNum = SMarray[4]
let hdhName = SMarray[5]
if (hdhName == "-none-") {
    hdhName = " 默认代理 "
}
let tvbNum = SMarray[6]
let tvbName = SMarray[7]
if (tvbName == "-none-") {
    tvbName = " 默认代理 "
}
let bahamutNum = SMarray[8]
let bahamutName = SMarray[9]
if (bahamutName == "-none-") {
    bahamutName = " 默认代理 "
}
let openaiNum = SMarray[10]
let openaiName = SMarray[11]
if (openaiName == "-none-") {
    openaiName = " 默认代理 "
}
let appleNum = SMarray[12]
let appleName = SMarray[13]
if (appleName == "-none-") {
    appleName = " 直连 "
}
let steamNum = SMarray[14]
let steamName = SMarray[15]
if (steamName == "-none-") {
    steamName = " 直连 "
}

$('#nodeSMshowYoutube').val(youtubeNum)
$('#nodeSMshowYoutube').html(youtubeName)
$('#nodeSMshowNetflix').val(netflixNum)
$('#nodeSMshowNetflix').html(netflixName)
$('#nodeSMshowHDH').val(hdhNum)
$('#nodeSMshowHDH').html(hdhName)
$('#nodeSMshowTVB').val(tvbNum)
$('#nodeSMshowTVB').html(tvbName)
$('#nodeSMshowBahamut').val(bahamutNum)
$('#nodeSMshowBahamut').html(bahamutName)
$('#nodeSMshowOpenai').val(openaiNum)
$('#nodeSMshowOpenai').html(openaiName)
$('#nodeSMshowApple').val(appleNum)
$('#nodeSMshowApple').html(appleName)
$('#nodeSMshowSteam').val(steamNum)
$('#nodeSMshowSteam').html(steamName)
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
