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

<title>中转</title>

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

    <a class="navbar-brand mr-1" href="https://github.com/jacyl4/de_GWD/releases" target="_blank">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>
    
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php echo shell_exec('sudo /opt/de_GWD/ui-checkEditionARM');?></span>
<span class="float-right badge text-success"><?php echo shell_exec('sudo /opt/de_GWD/ui-checkEditionFWD');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="/admin/" onclick="javascript:event.target.port=location.port" target="_blank">
          <i class="fas fa-fw fa-tachometer-alt"></i>
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
      <li class="nav-item active">
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
          <li class="breadcrumb-item active">中转</li>
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


        <!-- Page Content -->      
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-shield-alt"></i>
            域名与证书
<span class="float-right mt-n1 mb-n2" id="CERbutton" style="display:none">
<button type="button" id="buttonGenCER" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">install</button>
</span>
<span class="float-right mt-n1 mb-n2" id="CERswitch">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="CERswitch()">展开</button>
</span>
          </div>

          <div class="card-body" id="CERbody" style="display:none">
    <div class="form-row">
      <div class="col-md-3 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">域名</span>
        </div>
          <input type="text" id="CFdomain" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->domain ?>">
      </div>

      <div class="col-md-5 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">CF API KEY</span>
        </div>
          <input type="text" id="CFapikey" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->APIkey ?>">
      </div>

      <div class="col-md-4 input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text justify-content-center" style="min-width: 120px;">CF E-mail</span>
        </div>
          <input type="text" id="CFemail" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->Email ?>">
      </div>
    </div>
          </div>
        </div>



        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-reply"></i>
            默认中转线
<span class="float-right mt-n1 mb-n2" id="FWD0button" style="display:none">
<button id="buttonFWD0save" type="button" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkFWD0');?> btn-sm mt-1" style="border-Radius: 0px;">应用</button>
<button id="buttonFWD0stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
</span>
<span class="float-right mt-n1 mb-n2" id="FWD0switch">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="FWD0switch()">展开</button>
</span>
          </div>

          <div class="card-body" id="FWD0body" style="display:none">
            <div class="form-row">
              <div class="col-md-3 mt-auto">

<span class="float-left mb-3">
<div class="form-group form-check ml-4 mt-1 my-2">
    <input type="checkbox" class="form-check-input" id="portCheck1" <?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->PortCheck1 ?>>
    <label class="form-check-label" for="portCheck1">阻止外部访问本机53端口</label>
</div>
</span>

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  域名
                  </span>
                </div>
                <span class="input-group-text form-control"><?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->domain ?>:<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD0->port ?></span>
              </div>
              </div>

              <div class="col-md-3 mt-auto">
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  端口
                  </span>
                </div>
                <input type="text" id="FWD0port" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD0->port ?>">
              </div>

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  Path
                  </span>
                </div>
                <input type="text" id="FWD0path" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD0->path ?>">
              </div>
              </div>

              <div class="col-md-6">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  UUID
                  </span>
                </div>
                  <textarea id="FWD0uuid" class="form-control" rows="4"><?php foreach (json_decode(file_get_contents('/opt/de_GWD/0conf'), true)['FORWARD']['FWD0']['uuid'] as $k => $v) {echo "$v\n";} ?></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>


        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-reply-all"></i>
            并行中转线
<span class="float-right mt-n1 mb-n2" id="FWD1button" style="display:none">
<button id="buttonFWD1save" type="button" class="btn btn-<?php echo shell_exec('sudo /opt/de_GWD/ui-checkFWD1');?> btn-sm mt-1" style="border-Radius: 0px;">应用</button>
<button id="buttonFWD1stop" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;">关闭</button>
</span>
<span class="float-right mt-n1 mb-n2" id="FWD1switch">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="FWD1switch()">展开</button>
</span>
          </div>

          <div class="card-body" id="FWD1body" style="display:none">
            <div class="form-row">
              <div class="col-md-3 mt-auto">

<span class="float-left mb-3">
<div class="input-group ml-4 mt-1 my-2">
  <div class="input-group-prepend">
    <label class="input-group-text">上级v2节点</label>
  </div>
  <div class="input-group-append">
    <button id="v2nodeNAMEshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD1->upstream ?>"><?php $v2nodeID = json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD1->upstream; echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->v2node[$v2nodeID]->name ?></button>
    <div id="v2nodeNAME" class="dropdown-menu">
    </div>
  </div>
</div>
</span>

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  域名
                  </span>
                </div>
                <span class="input-group-text form-control"><?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->domain ?>:<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD1->port ?></span>
              </div>
              </div>

              <div class="col-md-3 mt-auto">
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  端口
                  </span>
                </div>
                <input type="text" id="FWD1port" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD1->port ?>">
              </div>

              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  Path
                  </span>
                </div>
                <input type="text" id="FWD1path" class="form-control" value="<?php echo json_decode(file_get_contents('/opt/de_GWD/0conf'))->FORWARD->FWD1->path ?>">
              </div>
              </div>

              <div class="col-md-6">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  UUID
                  </span>
                </div>
                  <textarea id="FWD1uuid" class="form-control" rows="4"><?php foreach (json_decode(file_get_contents('/opt/de_GWD/0conf'), true)['FORWARD']['FWD1']['uuid'] as $k => $v) {echo "$v\n";} ?></textarea>
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
            <span>Copyright © de_GWD by JacyL4 2021</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
function CERswitch(){
$('#CERswitch').css('display', 'none'); 
$('#CERbutton').css('display', 'block'); 
$('#CERbody').css('display', 'block'); 
};

function FWD0switch(){
$('#FWD0switch').css('display', 'none'); 
$('#FWD0button').css('display', 'block'); 
$('#FWD0body').css('display', 'block'); 
};

function FWD1switch(){
$('#FWD1switch').css('display', 'none'); 
$('#FWD1button').css('display', 'block'); 
$('#FWD1body').css('display', 'block'); 
};



$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#buttonGenCER').click(function(){
cfdomain=$('#CFdomain').val()
cfapikey=$('#CFapikey').val()
cfemail=$('#CFemail').val()
$.get('./act/genCER.php', {CFdomain:cfdomain, CFapikey:cfapikey, CFemail:cfemail}, function(result){})
window.open('/ttyd', 'popupWindow', 'width=800, height=600, scrollbars=yes')
})

$.get('./act/checkCER.php', function(data){
if ($.trim(data) == "installed") {
$('#buttonGenCER').attr('class', 'btn btn-outline-success btn-sm mt-1')
CERswitch()
}
})

$.get('./act/checkFWD0.php', function(data){
if ($.trim(data) == 'installed'){
FWD0switch()
}
})

$.get('./act/checkFWD1.php', function(data){
if ($.trim(data) == 'installed'){
FWD1switch()
}
})

$.get('./act/arrV2node.php', function(data){
var nodeList = JSON.parse(data)
var len = nodeList.length
for( let i = 0; i<len; i++){
  let name = nodeList[i].name
  $('#v2nodeNAME').append("<a class='dropdown-item' href='#' id='nodeName"+i+"'>"+name+"</a>");
  $('#nodeName'+i).click(function(){ $('#v2nodeNAMEshow').html(name); $('#v2nodeNAMEshow').val(i)})
}
})

$('#buttonFWD0save').click(function(){
if ($('#portCheck1').prop('checked') == true) {
  var portCheck1 = "checked"
} else {
  var portCheck1 = ""
}
FWD0port=$('#FWD0port').val()
FWD0path=$('#FWD0path').val()
FWD0uuid=$('#FWD0uuid').val()
$.get('./act/FWD0save.php', {portCheck1:portCheck1, FWD0port:FWD0port, FWD0path:FWD0path, FWD0uuid:FWD0uuid}, function(result){window.location.reload()})
})

$('#buttonFWD0stop').click(function(){
$.get('./act/FWD0stop.php', function(result){window.location.reload()})
})

$('#buttonFWD1save').click(function(){
v2nodeID=$('#v2nodeNAMEshow').val()
FWD1port=$('#FWD1port').val()
FWD1path=$('#FWD1path').val()
FWD1uuid=$('#FWD1uuid').val()
$.get('./act/FWD1save.php', {v2nodeID:v2nodeID, FWD1port:FWD1port, FWD1path:FWD1path, FWD1uuid:FWD1uuid}, function(result){window.location.reload()})
})

$('#buttonFWD1stop').click(function(){
$.get('./act/FWD1stop.php', function(result){window.location.reload()})
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
