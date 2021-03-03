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

<title>应用</title>

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
  
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>
    
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php passthru('sudo /opt/de_GWD/ui-checkEditionARM');?></span>
<span class="float-right badge text-success"><?php passthru('sudo /opt/de_GWD/ui-checkEditionFWD');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li id="netdataLi" class="nav-item no-arrow mx-1" style="display:none">
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
      <li class="nav-item active">
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
          <li class="breadcrumb-item active">应用</li>
        </ol>


<!-- Modal -->
<div id="markThis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="markThisLabel" class="modal-title">备注本机</h5>
      </div>
      <div class="modal-body">
        <input id="markName" type="text" class="form-control" placeholder="备注名" required="required" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->alias ?>">
      </div>
      <div class="modal-footer">
        <button id="buttonMarkThis" type="button" class="btn-sm btn-dark">应用</button>
      </div>
    </div>
  </div>
</div>

<div class="form-row col-md-12">
<button id="installNetdata" type="button" class="btn btn-outline-secondary btn-sm mb-3" style="border-Radius: 0px;">install Netdata</button>
</div>

        <!-- Page Content -->      
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-folder"></i>
            NFS挂载
<span id="NFSbutton" class="float-right mt-n1 mb-n2 ml-4" style="display:none">
<button id="buttonNFSAdd" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">新增</button>
<button id="buttonOnNFS" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">应用</button>
</span>
<span id="NFSswitch" class="float-right mt-n1 mb-n2 ml-4">
<button id="buttonNFSswitch" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">展开</button>
</span>
<span class="float-right mt-n1 mb-n2">
<button id="buttonNFSinstall" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">install</button>
</span>
          </div>

          <div class="card-body" id="NFSbody" style="display:none">

<!-- Modal -->
<div id="NFSmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <input id="NFSpath" type="text" class="form-control" required="required" value="" READONLY>

        <ul id="NFSlist" class="list-group mt-3" style="max-height:320px;overflow:scroll">
        </ul>

      </div>
      <input id="NFSmodalID" type="hidden" value="">
      <div class="modal-footer">
        <button id="confirmNFSaddr" type="button" class="btn-sm btn-dark">应用</button>
      </div>
    </div>
  </div>
</div>

          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fab fa-youtube"></i>
            Jellyfin
<span class="float-right mt-n1 mb-n2">
<button id="buttonJellyfinInstall" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">install</button>
</span>
          </div>

          <div class="card-body" id="JellyfinBody" style="display:none">
            <div class="form-row">
              <div class="col-md-12 input-group my-2">
                <a type="button" class="btn btn-outline-secondary btn-sm" style="border-Radius: 0px;" href="/" onclick="javascript:event.target.port=8097" target="_blank">访问Jellyfin (HTTPS)</a>
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
            <span>Copyright © de_GWD by JacyL4 2021</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
function NFSswitch(){
$('#NFSswitch').css('display', 'none'); 
$('#NFSbutton').css('display', 'block'); 
$('#NFSbody').css('display', 'block'); 
};

function JellyfinSwitch(){
$('#JellyfinBody').css('display', 'block'); 
};

function NFSdel(NFSdel){
var NFSnum = $(NFSdel).parent().parent().find('input').attr('id')
var NFSnum = NFSnum.replace(/[^0-9]/ig,"")
var NFSpoint = $('#NFSpoint'+NFSnum).val()
$.get('./act/offNFS.php', {NFSpoint:NFSpoint}, function(result){
  $(NFSdel).parent().parent('.form-row').remove()
})
}


$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$.get("./act/checkNetdata.php", function(data){
if (data == "installed"){
$('#installNetdata').attr('class', 'btn btn-outline-success btn-sm mb-3')
$('#netdataLi').css('display', 'block')
}
})

$('#installNetdata').click(function(){
$.get('./act/installNetdata.php', function(){});
var win = window.open('/ttyd', 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        $.get('./act/installZ.php', function(result){window.location.reload()})
    }
}, 300);
})

$.get("./act/checkNFS.php", function(data){
if (data == "installed"){
NFSswitch()
$('#buttonNFSinstall').attr('class', 'btn btn-outline-success btn-sm mt-1')
}
})

$('#buttonNFSinstall').click(function(){
$.get('./act/installNFS.php', function(){})
var win = window.open('/ttyd', 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        $.get('./act/installZ.php', function(result){window.location.reload()})
    }
}, 300);
})

$('#buttonNFSswitch').click(function(){
NFSswitch()
})

$.get("./act/checkJellyfin.php", function(data){
if (data == "installed"){
JellyfinSwitch()
$('#buttonJellyfinInstall').attr('class', 'btn btn-outline-success btn-sm mt-1')
}
})

$('#buttonJellyfinInstall').click(function(){
$.get('./act/installJellyfin.php', function(){});
var win = window.open('/ttyd', 'popupWindow', 'width=900, height=900, scrollbars=yes')
var timer = setInterval(function() { 
    if(win.closed) {
        clearInterval(timer);
        $.get('./act/installZ.php', function(result){window.location.reload()})
    }
}, 300);
})

$('#buttonNFSAdd').click(function(){
  var i = $("#NFSbody .form-row").length
  $('#NFSbody').append(`
    <div class="form-row">
      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text">挂载点&nbsp<span class="badge bg-secondary">X</span></span>
        </div>
          <input id="NFSpoint${i}" type="text" class="form-control" value="" READONLY>
      </div>

      <div class="col-md-8 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">NFS服务器地址</span>
        </div>
          <input id="NFSserver${i}" type="text" class="form-control" style="max-width: 160px;" value="">
        <div class="input-group-prepend input-group-append">
          <button id="NFSlink${i}" type="button" class="btn btn-outline-secondary btn-sm" style="border-Radius: 0px;">连接</button>
        </div>
          <span id="NFSaddress${i}" class="input-group-text form-control"></span>
          <button type="button" class="btn btn-outline-secondary btn-sm text-right ml-2" style="border-Radius: 0px;" onclick="NFSdel(this)">删除</button>
      </div>
    </div>
                          `)

  $('#NFSlink'+i).click(function(){
  var NFSserver = $('#NFSserver'+i).val()
  $("#NFSmodal").modal('show')
  $(":hidden#NFSmodalID").val(i)
  $("#NFSpath").val("选择路径并应用")
  $.get('./act/getNFSlist.php', {NFSserver:NFSserver}, function(data){
  var data = data.split('\n');
  var len = data.length;
  $("li[id^='NFSlistLine']").remove()
  for( let i = 0; i<len; i++){
    let NFSlistLine = data[i];
    $('#NFSlist').append(`
        <li id="NFSlistLine${i}" type="button" class="list-group-item">${NFSlistLine}</li>
                          `)
    $('#NFSlistLine'+i).click(function(){
      $("#NFSpath").val(NFSlistLine.split(' ')[0])
  })
  }
  })
  })
})

$('#confirmNFSaddr').click(function(){
  var NFSmodalID =  $(":hidden#NFSmodalID").val()
  var NFSaddress = $('#NFSpath').val()
  $("#NFSaddress"+NFSmodalID).html(NFSaddress)
  $("#NFSpoint"+NFSmodalID).val("/mnt/"+NFSaddress.split('/')[NFSaddress.split('/').length - 1])
  $("#NFSmodal").modal('hide')
})

$.get('./act/arrNFS.php', function(data) {
var data = data.split('\n');
var len = data.length-1;
for( let i = 0; i<len; i++){
  let NFSpoint = data[i].split(/\s+/)[0];
  let NFSserver = data[i].split(/\s+/)[2].split(':')[0];
  let NFSaddress = data[i].split(/\s+/)[2].split(':')[1];
  $('#NFSbody').append(`
    <div class="form-row">
      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text">挂载点&nbsp<span class="badge bg-success">O</span></span>
        </div>
          <input id="NFSpoint${i}" type="text" class="form-control" value="${NFSpoint}" READONLY>
      </div>

      <div class="col-md-8 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center">NFS服务器地址</span>
        </div>
          <input id="NFSserver${i}" type="text" class="form-control" style="max-width: 160px;" value="${NFSserver}" READONLY>
        <div class="input-group-prepend input-group-append">
        </div>
          <span id="NFSaddress${i}" class="input-group-text form-control">${NFSaddress}</span>
          <button type="button" class="btn btn-outline-secondary btn-sm text-right ml-2" style="border-Radius: 0px;" onclick="NFSdel(this)">删除</button>
      </div>
    </div>
                          `)
}
})

$('#buttonOnNFS').click(function(){
var NFSlist = []
var len = $("#NFSbody .form-row").length
var NFSpoint, NFSserver, NFSaddress
for( let i = 0; i<len; i++){
    var NFSpoint = $('#NFSpoint'+i).val()
    var NFSserver = $('#NFSserver'+i).val()
    var NFSaddress = $('#NFSaddress'+i).html()
    if ( NFSpoint !== '' && NFSserver !== '' && NFSaddress !== '') {
    NFSlist.push({NFSpoint, NFSserver, NFSaddress})
    }
}
$.get('./act/onNFS.php', {NFSlist:NFSlist}, function(result){window.location.reload()})
alert("应用NFS挂载。。。")
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
