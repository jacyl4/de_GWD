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

<title>更新</title>

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
<?php $checlBitwardenrs = $de_GWDconf->app->bitwardenrs; ?>

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button id="sidebarToggle" class="btn btn-link btn-sm text-white order-1 order-sm-0" href="javascript:void(0)">
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

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checlBitwardenrs === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8099')">
          <i class="fas fa-shield-alt"></i>
          <span>Bitwarden_rs</span>
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
      <li class="nav-item">
        <a class="nav-link" href="forward.php">
          <i class="fas fa-project-diagram"></i>
          <span>中转</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ddns.php">
          <i class="fas fa-ethernet"></i>
          <span>DDNS & LINK</span></a>
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
      <li class="nav-item active">
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
          <li class="breadcrumb-item active">更新</li>
        </ol>


<!-- Modal -->
<div id="markThis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="markThisLabel"class="modal-title">备注本机</h5>
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

<div id="donate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="donate" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="top:50%" role="document">
    <div class="modal-content">
      <div class="modal-body mx-auto">
        <img src="./vendor/pic/EaMjS1J8yfrVv4N.png" width="260">
      </div>
    </div>
  </div>
</div>


        <!-- Page Content -->    
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-archive"></i>
            备份-恢复
          <span id="ddnscheckcf" class="badge text-success"></span>
          </div>
          <div class="card-body">

    <div class="form-row">
<button id="buttonBackup" type="button" class="btn btn-outline-secondary my-2">备份下载</button>
<div class="input-group col-md-4 my-2">
  <div class="custom-file">
    <input id="restorefile" type="file" class="custom-file-input">
    <label id="restorefileLabel"class="custom-file-label" for="restorefile">...</label>
  </div>
  <div class="input-group-append">
    <button id="buttonRestore" type="button" class="btn btn-outline-secondary">
      <span id="buttonRestoreLoading"></span>
      <span>上传恢复</span>
    </button>
  </div>
</div>
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
      <div class="input-group my-2 col-md-4">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">本机地址</span>
        </div>
          <input id="updateAddr" type="text" class="form-control" value="<?php echo $de_GWDconf->update->updateAddr ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text justify-content-center">端口</span>
        </div>
          <input id="updatePort" type="text" class="form-control col-md-2" value="<?php echo $de_GWDconf->update->updatePort ?>">
      </div>

      <div class="input-group my-2 col-md-8">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">CMD</span>
        </div>
          <input id="updateCMD" type="text" class="form-control" value="<?php echo $de_GWDconf->update->updateCMD ?>">
          <button id="buttonUpdateSave" type="button" class="btn btn-outline-danger btn-sm text-right ml-2" style="border-Radius: 0px;">开启更新</button>
      </div>
                </div>

<!-- Modal -->
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-footer">
        <input id="updateDst" type="text" class="form-control" value="" READONLY>
        <button id="buttonUpdateRun" type="button" class="btn btn-danger">UPDATE</button>
      </div>
    </div>
  </div>
</div>
          </div>
        </div>

<div class="row mt-4">
    <div class="col"><hr></div>
    <div class="col-auto"><a href="javascript:void(0)" data-toggle="modal" data-target="#donate">捐赠</a></div>
    <div class="col"><hr></div>
</div>

        <!-- Page Content -->
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © de_GWD by JacyL4 2021</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#buttonBackup').click(function(){
$.get('./act/backup.php', function(result){window.location.href = "/restore/de_GWD_bak"})
})

$("#restorefile").on("change", function() {
  var fileName = $(this).val().split("\\").pop()
  $(this).siblings("#restorefileLabel").addClass("selected").html(fileName);
  if( fileName != "de_GWD_bak" ){
  alert("文件选择错误，备份文件名为 de_GWD_bak ")
  }
})

$('#buttonRestore').click(function(){
$("#buttonRestoreLoading").attr("class", "spinner-border spinner-border-sm")
var file_data = $('#restorefile').prop('files')[0]
var form_data = new FormData()
form_data.append('file', file_data)
$.ajax({
        url: './act/restore.php',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(result){
          $("#buttonRestoreLoading").removeClass()
        }
      })
})

$('#buttonUpdateSave').click(function(){
updateCMD=$('#updateCMD').val();
updateAddr=$('#updateAddr').val();
updatePort=$('#updatePort').val();
$.get('./act/updateSave.php', {updateAddr:updateAddr,updatePort:updatePort,updateCMD:updateCMD}, function(data){
$("#updateDst").val(data)
$("#updateModal").modal('show')
})
})

$('#buttonUpdateRun').click(function(){
$.get('./act/updateRun.php', function(){})
var updateDst = "http://"+$("#updateDst").val()
var win = window.open(updateDst, 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        window.location.reload()
    }
}, 300);
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
