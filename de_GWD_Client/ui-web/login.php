<?php ob_start(ob_gzhandler); ?> 
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>de_GWD - 登入</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.min.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">登入</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputpassword" class="form-control" placeholder="密码" autofocus="autofocus" onkeydown="keyLogin()"/>
              <label for="inputpassword">密码</label>
            </div>
          </div>
          <button id=“login” type="button" class="btn btn-primary btn-block" onclick="login()">登入</button>
        </form>
      </div>
    </div>
  </div>

<script>
function login () {
GWDpassword=$("input#inputpassword").val();
$.get("auth.php", {GWDpw:GWDpassword});
window.location.href="index.php";
};
</script>

<script>
function keyLogin () {
    if(event.keyCode == 13) {
event.preventDefault();
GWDpassword=$("input#inputpassword").val();
$.get("auth.php", {GWDpw:GWDpassword});
window.location.href="index.php";
}
};
</script>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
<?php ob_end_flush(); ?> 