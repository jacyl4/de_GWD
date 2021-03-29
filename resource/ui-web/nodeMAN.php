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

<title>节点管理</title>

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
      <li class="nav-item active">
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
          <li class="breadcrumb-item active">节点管理</li>
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
            <i class="fas fa-stream"></i>
            节点编辑
<span class="float-right mt-n1 mb-n2">
<button id="buttonSaveNode" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">
  <span id="buttonSaveNodeLoading"></span>
  <span>保存</span>
</button>
</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped text-center text-nowrap my-2">
                <thead>
                  <tr>
                    <th><a id="buttonAddLine" style="color:#28a745" href="javascript:void(0)"><i class="far fa-plus-square"></i></a></th>
                    <th class="text-nowrap text-center"><———— 地址 ————></th>
                    <th class="text-nowrap text-center"><———— 节点名 ————></th>
                    <th class="text-nowrap text-center"><———————— UUID ————————></th>
                    <th class="text-nowrap text-center"><—— PATH ——></th>
                    <th class="text-nowrap text-center"><i class="fas fa-caret-square-up"></i></th>
                    <th class="text-nowrap text-center"><i class="fas fa-caret-square-down"></i></th>
                  </tr>
                </thead>
                <tbody id="nodeTable">
                </tbody>
              </table>
            </div>
          </div>
        </div>


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
function moveUp(obj) { 
var current = $(obj).parent().parent();
var prev = current.prev();
if (current.index() > 0) { 
current.insertBefore(prev);
};
};

function moveDown(obj) { 
var current = $(obj).parent().parent();
var next = current.next();
if (next) { 
current.insertAfter(next);
};
};



$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})


$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$.get('./act/arrV2node.php', function(data) {
var nodeList = JSON.parse(data)
var len = nodeList.length
for( let i = 0; i<len; i++){
  let domain = nodeList[i].domain
  let name = nodeList[i].name
  let path = nodeList[i].path
  let uuid = nodeList[i].uuid
  $('#nodeTable').append(`
                          <tr>
                          <td class="align-middle">${i+1}</td>
                          <td class="align-middle"><input type="text" class="form-control" value="${domain}"></td>
                          <td class="align-middle"><input type="text" class="form-control" value="${name}"></td>
                          <td class="align-middle"><input type="text" class="form-control" value="${uuid}"></td>
                          <td class="align-middle"><input type="text" class="form-control" value="${path}"></td>
                          <td class="align-middle"><button type="button" class="form-control btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" onclick="moveUp(this)"><i class="fas fa-caret-up"></i></button></td>
                          <td class="align-middle"><button type="button" class="form-control btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" onclick="moveDown(this)"><i class="fas fa-caret-down"></i></button></td>
                          </tr>
                          `)
}

$('#buttonAddLine').click(function(){
  var i = $("#nodeTable td:nth-child(1)").length;
  $('#nodeTable').append(`
                          <tr>
                          <td class="align-middle">${i+1}</td>
                          <td class="align-middle"><input type="text" class="form-control" value=""></td>
                          <td class="align-middle"><input type="text" class="form-control" value=""></td>
                          <td class="align-middle"><input type="text" class="form-control" value=""></td>
                          <td class="align-middle"><input type="text" class="form-control" value=""></td>
                          <td class="align-middle"><button type="button" class="form-control btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" onclick="moveUp(this)"><i class="fas fa-caret-up"></i></button></td>
                          <td class="align-middle"><button type="button" class="form-control btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" onclick="moveDown(this)"><i class="fas fa-caret-down"></i></button></td>
                          </tr>
                          `)
})

$('#buttonSaveNode').click(function(){
$("#buttonSaveNodeLoading").attr("class", "spinner-border spinner-border-sm")
var nodeList = []
var domain, name, path, uuid
var len = $("#nodeTable td:nth-child(1)").length
var trList = $("#nodeTable").children("tr")
for( let i = 0; i<len; i++){
    var tdArr = trList.eq(i).find("td")
    var domain = tdArr.eq(1).find('input').val()
    var name = tdArr.eq(2).find('input').val()
    var uuid = tdArr.eq(3).find('input').val()
    var path = tdArr.eq(4).find('input').val()
    if (domain !== '' && name !== '' && uuid !== '' ) {
    nodeList.push({domain, name, uuid, path})
    }
}
$.get("./act/saveNode.php", {nodeList:nodeList}, function(result){
  $("#buttonSaveNodeLoading").removeClass()
  window.location.href="index.php"
})
})

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
