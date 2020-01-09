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


  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">de_GWD</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge badge-pill text-primary"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEdition');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="/ariang">
          <i class="fas fa-cloud-download-alt"></i>
          <span>AriaNG</span>
        </a>
      </li>

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
      <li class="nav-item active">
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
      </div>
      
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-ethernet"></i>
            CloudFlare DDNS
          <span id="ddnscheckcf" class="badge text-success"><?php echo shell_exec('sudo /usr/local/bin/ui-checkDDNScf');?></span>
<span class="float-right mt-n1 mb-n2">
<button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-Radius: 0px;" onclick="ddnsSaveCF()">开启</button>
<button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-Radius: 0px;" onclick="ddnsStopCF()">关闭</button>
</span>
          </div>

          <div class="card-body">
  <div class="form-group">
    <div class="form-row mb-3">
      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">域名</span>
        </div>
          <input type="text" id="CFdomain" class="form-control" value="<?php echo exec("awk 'NR==1{print}' /var/www/html/ddnsCF.txt"); ?>">
      </div>

      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">Zone ID</span>
        </div>
          <input type="text" id="CFzoneid" class="form-control" value="<?php echo exec("awk 'NR==2{print}' /var/www/html/ddnsCF.txt"); ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">CF API KEY</span>
        </div>
          <input type="text" id="CFapikey" class="form-control" value="<?php echo exec("awk 'NR==3{print}' /var/www/html/ddnsCF.txt"); ?>">
      </div>

      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">CF E-mail</span>
        </div>
          <input type="text" id="CFemail" class="form-control" value="<?php echo exec("awk 'NR==4{print}' /var/www/html/ddnsCF.txt"); ?>">
      </div>
    </div>
  </div>
          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-ethernet"></i>
            WireGuard Server
          <span class="badge text-success"><?php echo shell_exec('sudo /usr/local/bin/ui-checkWG');?></span>
<span class="float-right mt-n1 mb-n2">
<button type="button" class="btn btn-outline-dark btn-sm mt-1 mr-5" style="border-Radius: 0px;" onclick="wgrekey()">重新生成密钥</button>
<button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-Radius: 0px;" onclick="wgon()">开启</button>
<button type="button" class="btn btn-outline-dark btn-sm mt-1" style="border-Radius: 0px;" onclick="wgoff()">关闭</button>
</span>
          </div>
          <div class="card-body">

<div class="form-row mb-3">
      <div class="col-md-6 input-group my-1 ml-auto mr-auto ">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">Endpoint</span>
          <span class="input-group-text justify-content-center">域名/公网IP</span>
        </div>
          <input type="text" id="WGaddress" class="form-control" value="<?php echo exec("awk 'NR==1{print}' /var/www/html/WGaddress.txt"); ?>">
          <div class="input-group-append">
          <span class="input-group-text justify-content-center">UDP端口</span>
          </div>
          <input type="text" id="WGaddressport" class="form-control" value="<?php echo exec("awk 'NR==2{print}' /var/www/html/WGaddress.txt"); ?>">
      </div>
</div>


<div class="form-row mb-3">
      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点1</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark1" class="form-control" value="<?php echo exec("awk 'NR==1{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop1" onclick="submitwgmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点2</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark2" class="form-control" value="<?php echo exec("awk 'NR==2{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop2" onclick="submitwgmark()">显示二维码</button>
      </div>
</div>

<div class="form-row mb-3">
      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点3</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark3" class="form-control" value="<?php echo exec("awk 'NR==3{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop3" onclick="submitwgmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点4</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark4" class="form-control" value="<?php echo exec("awk 'NR==4{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop4" onclick="submitwgmark()">显示二维码</button>
      </div>
</div>

<div class="form-row mb-3">
      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点5</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark5" class="form-control" value="<?php echo exec("awk 'NR==5{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop5" onclick="submitwgmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点6</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark6" class="form-control" value="<?php echo exec("awk 'NR==6{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop6" onclick="submitwgmark()">显示二维码</button>
      </div>
</div>

<div class="form-row mb-3">
      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点7</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark7" class="form-control" value="<?php echo exec("awk 'NR==7{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop7" onclick="submitwgmark()">显示二维码</button>
      </div>

      <div class="col-md-6 input-group my-1">
        <div class="input-group-prepend w-50">
          <span class="input-group-text justify-content-center w-100">节点8</span>
          <span class="input-group-text justify-content-center w-100">备注：</span>
        </div>
          <input type="text" id="WGmark8" class="form-control" value="<?php echo exec("awk 'NR==8{print}' /var/www/html/WGmark.txt"); ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" data-toggle="modal" data-target="#wgqrpop8" onclick="submitwgmark()">显示二维码</button>
      </div>
</div>

<span class="float-left text-secondary">
  <small>
注：需要主路由映射所需UDP端口到de_GWD的地址。
  </small>
</span>


<!-- Modal -->
<div class="modal fade" id="wgqrpop1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端1 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode1"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop2" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端2 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode2"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop3" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端3 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode3"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop4" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端4 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode4"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop5" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端5 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode5"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop6" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端6 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode6"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop7" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端7 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode7"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="wgqrpop8" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >WireGuard客户端8 二维码</h5>
      </div>
      <div class="modal-body">
        <div id="qrcode8"></div>
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

function ddnsSaveCF(){
cfdomain=$('#CFdomain').val();
cfzoneid=$('#CFzoneid').val();
cfapikey=$('#CFapikey').val();
cfemail=$('#CFemail').val();
$.get('ddnsSaveCF.php', {CFdomain:cfdomain, CFzoneid:cfzoneid, CFapikey:cfapikey, CFemail:cfemail}, function(result){ location.reload() });
}

function ddnsStopCF(){
$.get('ddnsStopCF.php', function(result){window.location.reload();});
}

function wgrekey(){
$.get('wgrekey.php', function(result){window.location.reload();});
}

function wgon(){
WGaddress=$('#WGaddress').val();
WGaddressport=$('#WGaddressport').val();
$.get('wgon.php', {WGaddress:WGaddress, WGaddressport:WGaddressport}, function(result){ location.reload() });
}

function wgoff(){
$.get('wgoff.php', function(result){window.location.reload();});
}

function submitwgmark(){
WGmark1=$('#WGmark1').val();
WGmark2=$('#WGmark2').val();
WGmark3=$('#WGmark3').val();
WGmark4=$('#WGmark4').val();
WGmark5=$('#WGmark5').val();
WGmark6=$('#WGmark6').val();
WGmark7=$('#WGmark7').val();
WGmark8=$('#WGmark8').val();
$.get('wgmark.php', {WGmark1:WGmark1, WGmark2:WGmark2, WGmark3:WGmark3, WGmark4:WGmark4, WGmark5:WGmark5, WGmark6:WGmark6, WGmark7:WGmark7, WGmark8:WGmark8}, function(result){ });
}

window.onload = function() {
$("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");

$.get('wgqrtxt1.php', function(data){
jQuery('#qrcode1').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('wgqrtxt2.php', function(data){
jQuery('#qrcode2').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('wgqrtxt3.php', function(data){
jQuery('#qrcode3').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('wgqrtxt4.php', function(data){
jQuery('#qrcode4').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('wgqrtxt5.php', function(data){
jQuery('#qrcode5').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('wgqrtxt6.php', function(data){
jQuery('#qrcode6').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('wgqrtxt7.php', function(data){
jQuery('#qrcode7').qrcode({width: 240,height: 240,correctLevel:0,text: data}); 
});
$.get('wgqrtxt8.php', function(data){
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