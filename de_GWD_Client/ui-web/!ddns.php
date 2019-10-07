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
      <li class="nav-item active">
        <a class="nav-link" href="!listbw.php">
          <i class="fas fa-fw fa-th-list"></i>
          <span>黑白名单</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="!ddns.php">
          <i class="fas fa-fw fa-ethernet"></i>
          <span>DDNS</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="logout()">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>注销</span></a>
      </li>
    </ul>
<script>
function logout () {
$.get('auth.php', {logout:'true'}, function(result){ window.location.href="index.php" });
}
</script>

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
          <span id="wanIP" class="form-control text-center"><?php echo exec("awk 'NR==1{print}' /tmp/wanip"); ?></span>
      </div>

      <div class="col-md-6 input-group ml-auto mr-auto mb-4">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">归属地</span>
        </div>
          <span class="form-control text-center"><?php echo exec("awk 'NR==2{print}' /tmp/wanip"); ?></span>
      </div>



        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-ethernet"></i>
            CloudFlare DDNS
          <span id="ddnscheck" class="badge badge-pill text-success"></span>
          <span class="float-right mt-n1 mb-n2">
                <button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="stopddns()">STOP</button>
          </span>
          </div>
          <div class="card-body">
  <div class="form-group">
    <div class="form-row mb-3">
      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">域名</span>
        </div>
          <input type="text" id="CFdomain" class="form-control" value="<?php echo exec("awk 'NR==2{print}' /var/www/html/ddns.txt"); ?>">
      </div>

      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">Zone ID</span>
        </div>
          <input type="text" id="CFzoneid" class="form-control" value="<?php echo exec("awk 'NR==3{print}' /var/www/html/ddns.txt"); ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">CF API KEY</span>
        </div>
          <input type="text" id="CFapikey" class="form-control" value="<?php echo exec("awk 'NR==4{print}' /var/www/html/ddns.txt"); ?>">
      </div>

      <div class="col-md-6 input-group">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">CF E-mail</span>
        </div>
          <input type="text" id="CFemail" class="form-control" value="<?php echo exec("awk 'NR==5{print}' /var/www/html/ddns.txt"); ?>">
      </div>
    </div>
  </div>

<span class="float-right">
  <button type="button" class="btn btn-primary" onclick="submitddns()">保存&开启</button>
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
            <span>Copyright © de_GWD by GWDburst 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script> 
function submitddns(){
wanip=$('#wanIP').text();
cfdomain=$('#CFdomain').val();
cfzoneid=$('#CFzoneid').val();
cfapikey=$('#CFapikey').val();
cfemail=$('#CFemail').val();
$.get('ddnssave.php', {wanIP:wanip, CFdomain:cfdomain, CFzoneid:cfzoneid, CFapikey:cfapikey, CFemail:cfemail}, function(result){ location.reload() });
}

function stopddns(){
$.get('ddnsstop.php', function(result){ location.reload() });
}

window.onload = function() {
$("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");
$.get('ddnsiptest.php');
$.get('ddnscheck.php', function(data){
if (data == "true") {$('#ddnscheck').html('on');}
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

</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
<?php ob_end_flush(); ?> 