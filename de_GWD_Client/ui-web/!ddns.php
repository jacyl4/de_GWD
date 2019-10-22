<?php ob_start(ob_gzhandler); ?> 
<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
  
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>de_GWD - DDNS</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">de_GWD</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

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
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>概览</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="!nodeman.php">
          <i class="fas fa-fw fa-stream"></i>
          <span>节点管理</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="!listbw.php">
          <i class="fas fa-fw fa-th-list"></i>
          <span>黑白名单</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="!ddns.php">
          <i class="fas fa-fw fa-ethernet"></i>
          <span>DDNS & WireGuard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="logout()">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>注销</span></a>
      </li>
    </ul>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">概览</a>
          </li>
          <li class="breadcrumb-item active">DDNS</li>
        </ol>

        <!-- Page Content -->
      <div class="col-md-6 input-group ml-auto mr-auto mb-3">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">Wan IP</span>
        </div>
          <span class="form-control text-center"><?php echo exec("curl http://members.3322.org/dyndns/getip"); ?></span>
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" onclick="stopddns()">STOP</button>
      </div>
      
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-ethernet"></i>
            CloudFlare DDNS
          <span id="ddnscheckcf" class="badge text-success"></span>
          </div>
          <div class="card-body">
  <div class="form-group">
    <div class="form-row mb-3">
      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">域名</span>
        </div>
          <input type="text" id="CFdomain" class="form-control" value="<?php echo exec("awk 'NR==1{print}' /var/www/html/ddnscf.txt"); ?>">
      </div>

      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">Zone ID</span>
        </div>
          <input type="text" id="CFzoneid" class="form-control" value="<?php echo exec("awk 'NR==2{print}' /var/www/html/ddnscf.txt"); ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">CF API KEY</span>
        </div>
          <input type="text" id="CFapikey" class="form-control" value="<?php echo exec("awk 'NR==3{print}' /var/www/html/ddnscf.txt"); ?>">
      </div>

      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">CF E-mail</span>
        </div>
          <input type="text" id="CFemail" class="form-control" value="<?php echo exec("awk 'NR==4{print}' /var/www/html/ddnscf.txt"); ?>">
      </div>
    </div>
  </div>

<span class="float-right">
  <button type="button" class="btn btn-primary" onclick="submitddnscf()">保存&开启</button>
</span>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-ethernet"></i>
            WireGuard Server
          <span id="wgcheck" class="badge text-success"></span>
          </div>
          <div class="card-body">

<span class="float-left text-secondary">
  <small>
注：<br>
需要CloudFlare DDNS开启状态<br>
需要主路由映射端口9895到de_GWD的地址<br>
  </small>
</span>

<span class="float-right">
  <button type="button" class="btn btn-outline-danger" onclick="wgoff()">关闭</button>
  <button type="button" class="btn btn-outline-primary" onclick="wgon()">开启</button>
  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#wgqrpop">显示二维码</button>
</span>

<!-- Modal -->
<div class="modal fade" id="wgqrpop" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode"></div>
      </div>
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
            <span>Copyright © de_GWD by GWDburst 2019</span>
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

function submitddnscf(){
cfdomain=$('#CFdomain').val();
cfzoneid=$('#CFzoneid').val();
cfapikey=$('#CFapikey').val();
cfemail=$('#CFemail').val();
$.get('ddnssavecf.php', {CFdomain:cfdomain, CFzoneid:cfzoneid, CFapikey:cfapikey, CFemail:cfemail}, function(result){ location.reload() });
}

function stopddns(){
$.get('ddnsstop.php', function(result){ location.reload() });
}

function wgoff(){
$.get('wgoff.php', function(result){ location.reload() });
}

function wgon(){
$.get('wgon.php', function(result){ location.reload() });
}

window.onload = function() {
$("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");
$.get('ddnscheck.php', function(data){
if (data.indexOf("cfon") != -1) {$('#ddnscheckcf').html('on');}
});
$.get('wgcheck.php', function(data){
if (data.indexOf("on") != -1) {$('#wgcheck').html('on');}
});
$.get('wgqrtxt.php', function(data){
jQuery('#qrcode').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
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
<?php ob_end_flush(); ?> 