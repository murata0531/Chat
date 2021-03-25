<?php 

include 'library_action.php';


// $url = parse_url($_SERVER["REQUEST_URI"]);

// print_r($url);

if(isset($_GET['error'])){
    $errorMessage = $_GET['error'];
}

// if(isset($url["query"])){

//     if(isset($_GET['error'])){
//         $errorMessage = $_GET['error'];
//         print_r($errorMessage);
//     }

//     parse_str($url["query"],$query);
// }

$url_param = $lib_obj->url_param_change(Array("errors"=>null));

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
  <body>
      
    <!-- <div class="container-fluid">
        <div class="jumbotron">
            <p class="lead text-center">
                Login
            </p>
        </div>
    </div> -->
    <div class="container">
        <div class="card mt-5 mx-auto w-50">
            <!-- <div class="card-header">
                Login Form
            </div> -->
            <div class="card-body">
                <form action="../home.php" method="post">
                    <p>input your e-mail</p>
                    <input type="email" name="user-email" placeholder="example@example.com" id="user-email" class="form-control mt-3" required>
                    <p>input your password</p>
                    <input type="password" name="user-password" placeholder="input your password" id="user-password" class="form-control mt-3" required>
                    <br>
                    <?php if(isset($_SESSION['login-error'])){ ?>
                    <div class="alert alert-danger" role="alert"><?php echo $_SESSION['login-error'] ?></div>
                    <?php } ?>
                    <div class="d-flex justify-content-center  mt-3">
                        <button type="submit" name="login" id="login" class="btn btn-outline-primary w-100">Login</button>
                    </div>
                </form>
            </div>
            <!-- <div class="card-footer">
                <a href="register.php">Click here if you do not have an account</a>
            </div> -->
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>