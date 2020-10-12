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

<title>黑白名单</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

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
        <a class="nav-link" href="/adg">
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
      <li class="nav-item active">
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
          <li class="breadcrumb-item active">黑白名单</li>
        </ol>

        <!-- Page Content -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-th-list"></i>
            名单编辑
<span class="float-right mt-n1 mb-n2">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="submitlistBW()">保存</button>
</span>
          </div>
          <div class="card-body">

<div class="form-row">
          <div class="col-md-3 form-group">
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text w-25 px-4" style="writing-mode: vertical-rl">
            黑名单域名（走国外线路）<br>
            </span>
          </div>
            <textarea id="listB" class="form-control" aria-label="listB" rows="32" placeholder="域名"><?php foreach (json_decode(file_get_contents('/usr/local/bin/0conf'), true)['listB'] as $k => $v) {echo "$k\n";} ?></textarea>
          </div>
          </div>

          <div class="col-md-3 form-group">
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text w-25 px-4" style="writing-mode: vertical-rl">
            白名单域名（走国内线路）<br>
            </span>
          </div>
            <textarea id="listW" class="form-control" aria-label="listW" rows="32" placeholder="域名"><?php foreach (json_decode(file_get_contents('/usr/local/bin/0conf'), true)['listW'] as $k => $v) {echo "$k\n";} ?></textarea>
          </div>
          </div>

          <div class="col-md-3 form-group">
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text w-25 px-4" style="writing-mode: vertical-rl">
            内网设备 黑名单IP（全局走国外线路）<br>
            </span>
          </div>
            <textarea id="listBlan" class="form-control" aria-label="listBlan" rows="32" placeholder="IP"><?php foreach (json_decode(file_get_contents('/usr/local/bin/0conf'), true)['listBlan'] as $k => $v) {echo "$v\n";} ?></textarea>
          </div>
          </div>

          <div class="col-md-3 form-group">
          <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text w-25 px-4" style="writing-mode: vertical-rl">
            内网设备 白名单IP（全局走国内线路）<br>
            </span>
          </div>
            <textarea id="listWlan" class="form-control" aria-label="listWlan" rows="32" placeholder="IP"><?php foreach (json_decode(file_get_contents('/usr/local/bin/0conf'), true)['listWlan'] as $k => $v) {echo "$v\n";} ?></textarea>
          </div>
          </div>
<span class="float-left text-secondary">
  <small>注：一行一个地址<br></small>
</span>
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

function submitlistBW () {
listB=$("#listB").val();
listW=$("#listW").val();
listBlan=$("#listBlan").val();
listWlan=$("#listWlan").val();
$.get("./act/saveListBW.php", {listB:listB, listW:listW, listBlan:listBlan, listWlan:listWlan}, function(result){ window.location.href="index.php" });
alert("保存黑白名单。。。");
}

window.onload = function() {

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
