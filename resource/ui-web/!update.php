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

  <title>更新</title>

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
<span class="float-right badge badge-pill text-success"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEditionNat');?></span>
<span class="float-right badge badge-pill text-primary"> <?php echo shell_exec('sudo /usr/local/bin/ui-checkEdition');?> </span>

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
      <li class="nav-item active">
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
          <li class="breadcrumb-item active">更新</li>
        </ol>

        <!-- Page Content -->    
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-archive"></i>
            备份-恢复
          <span id="ddnscheckcf" class="badge text-success"></span>
          </div>
          <div class="card-body">

  <div class="my-2 float-left">
<button type="button" class="btn btn-outline-secondary" onclick="backup()">备份下载</button>
  </div>

  <div class="my-2 col-md-4 float-left">
<form>
<div class="input-group">
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="restorefile">
    <label class="custom-file-label" for="restorefile">...</label>
  </div>
  <div class="input-group-append">
    <button type="button" class="btn btn-outline-secondary" onclick="restore()">上传恢复</button>
  </div>
</div>
</form>
  </div>

          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-archive"></i>
            更新
          </div>
          <div class="card-body">

    <div class="form-row">
      <div class="col-md-8 input-group my-1">
        <div class="input-group-prepend w-25">
          <span class="input-group-text justify-content-center w-100">脚本地址</span>
        </div>
          <input type="text" id="updateAddr" class="form-control" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->updateAddr ?>">
          <button type="button" class="btn btn-secondary btn-sm" style="border-Radius: 0px;" onclick="updateGen()">保存</button>
      </div>

      <div class="col-md-4 my-1 float-right">
        <button type="button" class="btn btn-outline-danger float-right" onclick="update()">运行</button>
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

function backup(){
$.get('backup.php', function(result){window.location.href = "0conf"});
}

function restore(){
var file_data = $('#restorefile').prop('files')[0];
var form_data = new FormData();
form_data.append('file', file_data);
$.ajax({
        url: 'restore.php',
        dataType: 'zip',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data){
        }
      });
alert('设置已恢复');
window.location.reload(true);
}

function updateGen(){
updateAddr=$('#updateAddr').val();
$.get('updateGen.php', {updateAddr:updateAddr}, function(result){ location.reload(); });
}

function update(){
$.get('update.php', function(result){});
window.open('', 'popupWindow', 'width=800, height=600, scrollbars=yes');
}

window.onload = function() {
$("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");
  $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

  if( fileName != "0conf" ){
  alert("文件选择错误");
  }

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