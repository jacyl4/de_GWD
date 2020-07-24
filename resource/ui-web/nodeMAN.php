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
  <link href="css/sb-admin.min.css" rel="stylesheet">
  <link href="css/bootstrap4-toggle.min.css" rel="stylesheet">

</head>

<body id="page-top" class="sidebar-toggled">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">de_GWD</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEditionARM');?></span>
<span class="float-right badge text-success"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEditionFWD');?></span>
<span class="float-right badge text-primary"><?php echo shell_exec('sudo /usr/local/bin/ui-checkEdition');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">      
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="/admin">
          <i class="fas fa-tachometer-alt"></i>
          <span>Pi-hole</span>
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
      <li class="nav-item active">
        <a class="nav-link" href="nodeMAN.php">
          <i class="fas fa-stream"></i>
          <span>节点管理</span></a>
      </li>
      <li class="nav-item">
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
          <li class="breadcrumb-item active">节点管理</li>
        </ol>

        <!-- Page Content -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-stream"></i>
            节点编辑
<span class="float-right mt-n1 mb-n2">
<button type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-Radius: 0px;" onclick="saveNode()">保存</button>
</span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-nowrap text-center"><———— 域名 ————></th>
                    <th class="text-nowrap text-center"><———— 节点名 ————></th>
                    <th class="text-nowrap text-center"><—— PATH ——></th>
                    <th class="text-nowrap text-center"><———————— UUID ————————></th>
                  </tr>
                </thead>
                <tbody id="nodeTable">
                  <tr>
                    <td>1</td>
                    <td><input type="text" class="form-control" id="domain1" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[0]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename1" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[0]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path1" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[0]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid1" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[0]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><input type="text" class="form-control" id="domain2" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[1]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename2" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[1]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path2" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[1]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid2" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[1]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><input type="text" class="form-control" id="domain3" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[2]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename3" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[2]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path3" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[2]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid3" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[2]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><input type="text" class="form-control" id="domain4" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[3]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename4" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[3]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path4" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[3]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid4" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[3]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><input type="text" class="form-control" id="domain5" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[4]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename5" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[4]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path5" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[4]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid5" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[4]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td><input type="text" class="form-control" id="domain6" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[5]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename6" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[5]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path6" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[5]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid6" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[5]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td><input type="text" class="form-control" id="domain7" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[6]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename7" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[6]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path7" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[6]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid7" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[6]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td><input type="text" class="form-control" id="domain8" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[7]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename8" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[7]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path8" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[7]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid8" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[7]->uuid ?>"></td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td><input type="text" class="form-control" id="domain9" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[8]->domain ?>"></td>
                    <td><input type="text" class="form-control" id="nodename9" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[8]->name ?>"></td>
                    <td><input type="text" class="form-control" id="path9" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[8]->path ?>"></td>
                    <td><input type="text" class="form-control" id="uuid9" value="<?php echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[8]->uuid ?>"></td>
                  </tr>
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
            <span>Copyright © de_GWD by JacyL4 2020</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
function logout () {
$.get('auth.php', {logout:'true'}, function(result){ window.location.href="index.php" });
}

function saveNode(){
var nodeList = [];
var domain, name, path, uuid;
var len = $("#nodeTable td:nth-child(1)").length+1
for( let i = 1; i<len; i++){
    domain = $('#domain'+i).val();
    name = $('#nodename'+i).val();
    path = $('#path'+i).val();
    uuid = $('#uuid'+i).val();
    if (domain !== '' || name !== '' || path !== '' || uuid !== '' ) {
    nodeList.push({domain, name, path, uuid});
    }
};
$.get("./act/saveNode.php", {nodeList:nodeList}, function(result){window.location.reload();});
};


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
