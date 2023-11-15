<?php
  require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    if(isset($_COOKIE['zxadfggh']) && isset($_COOKIE['jyuongga'])){

        $_SESSION['Logged'] = true;
        $_SESSION['email'] = $_COOKIE['zxadfggh'];
        $_SESSION['password'] = base64_decode($_COOKIE['jyuongga']);
                    
    ?>
    
    
    <script>
        location.href = 'index.php';
    </script>
                    
<?php } ?>
<!doctype html>
<html lang="en">
<head>
<!-- <?php include_once('controls/meta.php'); ?> -->

</head>
<body class="font-opensans">

<div class="auth">
    <div class="card">
        <div class="text-center mb-5">
            <a class="header-brand" href="index.php">
                <!-- <i class="fe fe-command brand-logo"></i> -->
                <img src="assets/logo-ori.png" style="width: 50%;">
            </a>
        </div>
        <form id="login-form" method="POST">
            <div class="card-body">
                <div class="card-title">Login to your account</div>
                <div class="form-group style2">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="example@mail.com" name="email" id="email">
                </div>
                <div class="form-group style2">
                    <label class="form-label">Password<a href="#!" class="float-right small">I forgot password</a></label>
                    <input type="password" class="form-control" placeholder="XXXXXXXX" name="password" id="password">
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember"/>
                    <span class="custom-control-label" for="remember">Remember me</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button name="btn_lg" class="btn btn-primary btn-block">Sign in</button>
                </div>
            </div>
        </form>
        <div class="text-center">
            Powered by <a href="https://amazoft.com/" target="_blank" style="color: #FFF;">AMAZOFT</a>
            <!-- Don't have account yet? <a href="register.html">Sign up</a> -->
        </div>
        <!--<div class="card-footer text-center mt-3">
            <button type="button" class="btn btn-icon btn-facebook"><i class="fa fa-facebook"></i></button>
            <button type="button" class="btn btn-icon btn-twitter"><i class="fa fa-twitter"></i></button>
            <button type="button" class="btn btn-icon btn-google"><i class="fa fa-google"></i></button>
            <button type="button" class="btn btn-icon btn-youtube"><i class="fa fa-youtube"></i></button>
            <button type="button" class="btn btn-icon btn-vimeo"><i class="fa fa-vimeo"></i></button>
        </div> -->
    </div>

</div>

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  $(document).on('submit', '#login-form', function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url:'controls/login.php',
            type:'POST',
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(data){
                                
                var json=JSON.parse(data);
                if(json.result){
                    location.href="index.php";
                }else{
                    Swal.fire({
                        text:json.msg,
                        icon:'error',
                        title:'Warning !'
                    });
                }
                                
                                
            },
            error:function(err,xhr,data){
                    alert("err "+data);
            }



        });


    });
    
</script>

</body>
</html>