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

<body id="page-top" class="sidebar-toggled">
<?php $de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf')); ?>
<?php $checkJellyfin = $de_GWDconf->app->jellyfin; ?>
<?php $checkFileRun = file_exists('/var/www/html/filerun'); ?>
<?php $checkBitwarden = $de_GWDconf->app->bitwarden; ?>

<?php $FileRunWebConf = file_get_contents ('/etc/nginx/conf.d/filerun.conf'); preg_match_all('/(?<=\blisten )\S+/is', $FileRunWebConf, $FileRunPort); $FileRunPort = $FileRunPort[0][0] ?>
<?php $WebConf = file_get_contents ('/etc/nginx/conf.d/default.conf'); preg_match_all('/(?<=\bserver_name )\S+/is', $WebConf, $serverName); $serverName = rtrim($serverName[0][0],";") ?>

<?php $checkAutoUpdateHour = $de_GWDconf->address->autoUpdateHour; ?>
<?php $checkAutoUpdateStatus = file_exists('/opt/de_GWD/autoUpdate'); ?>
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
  <div class="modal-dialog">
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

<div id="donateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="donate" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="top:50%">
    <div class="modal-content">
      <div class="modal-body mx-auto">
        <img id="donatePic" src="" width="260">
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
<div class="input-group col-md-4 my-2">
  <div class="input-group-prepend">
    <button id="buttonBackup" type="button" class="btn btn-outline-secondary">备份下载</button>
  </div>
  <div class="custom-file">
    <input id="restorefile" type="file" class="custom-file-input">
    <label id="restorefileLabel"class="custom-file-label" for="restorefile">...</label>
  </div>
  <div class="input-group-append">
    <button id="buttonRestore" type="button" class="btn btn-secondary">
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
          <span class="float-right mt-n1 mb-n2">
              <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                <span class="input-group-text mt-1">自动更新</span>
                </div>
              <div class="btn-group btn-group-sm">
                <button id="autoUpdateHourShow" class="btn <?php if ($checkAutoUpdateStatus === true) echo 'btn-success'; else echo 'btn-outline-secondary';?> mt-1 dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown" style="border-radius: 0px;">
                  <?php if ($checkAutoUpdateHour === off || $checkAutoUpdateHour === null) echo '关闭 '; else echo "$checkAutoUpdateHour:00";?>
                </button>
<div class="dropdown-menu dropdown-menu-sm">
<a class="dropdown-item text-center" href="#" onclick="autoUpdateHour(this)">关闭</a>
<div class="dropdown-divider"></div>
<?php
for( $i=0; $i<24; $i++){
  $autoHour = "$i:00";
print <<<EOT
<a class='dropdown-item text-center' href='#' onclick="autoUpdateHour(this)">$autoHour</a>
EOT;
}
?>
</div>
              </div>
              </div>
          </span>
          </div>
          <div class="card-body">

                <div class="form-row">
      <div class="input-group my-2 col-md-4">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">本机地址</span>
        </div>
          <input id="updateAddr" type="text" class="form-control" value="<?php echo $de_GWDconf->update->updateAddr ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">端口</span>
        </div>
          <input id="updatePort" type="text" class="form-control col-md-2" value="<?php echo $de_GWDconf->update->updatePort ?>">
      </div>

      <div class="input-group my-2 col-md-8">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">CMD</span>
        </div>
          <input id="updateCMD" type="text" class="form-control" value="<?php echo $de_GWDconf->update->updateCMD ?>">
          <button id="buttonUpdateSave" type="button" class="btn btn-outline-danger btn-sm text-right ml-2" style="border-Radius: 0px;">
            <span id="buttonUpdateSaveLoading"></span>
            保存并更新
          </button>
      </div>
                </div>

<!-- Modal -->
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
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
    <div class="col-auto"><img src="/vendor/w.JPG" alt="捐赠" width="300"></div>
    <div class="col"><hr></div>
</div>

        <!-- Page Content -->
      </div>
      <!-- /.container-fluid -->

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
function autoUpdateHour(autoUpdateHour){
var autoUpdateHourOBJ = $(autoUpdateHour).parent().parent().find('a')
var autoUpdateHourINDEX = autoUpdateHourOBJ.index($(autoUpdateHour))
if ( autoUpdateHourINDEX == 0 ){
  autoUpdateHourINDEX = 'off'
$('#autoUpdateHourShow').html('关闭 ')
$('#autoUpdateHourShow').attr('class', 'btn btn-outline-secondary mt-1 dropdown-toggle dropdown-toggle-split')
} else {
  autoUpdateHourINDEX = autoUpdateHourINDEX-1
  autoUpdateHourLabel = `${autoUpdateHourINDEX}:00 `
$('#autoUpdateHourShow').html(autoUpdateHourLabel)
$('#autoUpdateHourShow').attr('class', 'btn btn-success mt-1 dropdown-toggle dropdown-toggle-split')
}
$.get("./act/autoUpdateHour.php", {autoUpdateHourINDEX:autoUpdateHourINDEX}, function(result){})
}



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
var form_data = new FormData()
var file_data = $('#restorefile').prop('files')[0]
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
$("#buttonUpdateSaveLoading").attr("class", "spinner-border spinner-border-sm")
updateCMD=$('#updateCMD').val();
updateAddr=$('#updateAddr').val();
updatePort=$('#updatePort').val();
$.get('./act/updateSave.php', {updateAddr:updateAddr,updatePort:updatePort,updateCMD:updateCMD}, function(data){
$("#updateDst").val(data)
$("#updateModal").modal('show')
$("#buttonUpdateSaveLoading").removeClass()
})
})

$('#buttonUpdateRun').click(function(){
$.get('./act/updateRun.php', function(){})
var updateDst = "http://"+$("#updateDst").val()
var win = window.open(updateDst, 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        $.get('./act/installZ.php', function(result){window.location.reload()});
    }
}, 300);
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