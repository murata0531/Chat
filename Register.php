<?php 

include 'library_action.php';

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
      
    <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>create new account</h2>
        </div>

        <div class="row skills-content">
            <div class="container">
                <div class="card mt-5 mx-auto w-50">
                    <!-- <div class="card-header">
                        register Form
                    </div> -->
                    <div class="card-body">
                        <form action="../Home.php" method="post">
                        <p>input your name</p>
                        <input type="text" name="register-user-name" placeholder="input your name" id="register-user-name" class="form-control mt-3" required>
                        <br>
                        <p>input your email</p>
                        <input type="text" name="register-user-email" placeholder="example@example.com" id="register-user-email" class="form-control mt-3" required>
                        <br>
                        <?php if(isset($_SESSION['error-email'])){ ?>
                            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error-email'] ?></div>
                        <?php } ?>
                        <p>input your password</p>
                        <input type="password" name="register-user-password" 
                            placeholder="8 or more characters including uppercase, lowercase, and numbers."
                            id="register-user-password" class="form-control mt-3" required>
                        <br>
                        <?php if(isset($_SESSION['error-password'])){ ?>
                            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error-password'] ?></div>
                        <?php } ?>
                        <p>comfirm your password</p>
                        <input type="password" name="register-comfirm-password" placeholder="comfirm your password" id="register-comfirm-password" class="form-control mt-3" required>
                        <br>
                        <?php if(isset($_SESSION['error-comfirm'])){ ?>
                            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error-comfirm'] ?></div>
                        <?php } ?>
                        <div class="d-flex justify-content-center  mt-3">
                            <button type="submit" name="register" id="register" class="btn btn-outline-primary w-100">create account</button>
                        </div>
                        </form>
                    </div>
                    <!-- <div class="card-footer">
                        <a href="register.php">Click here if you have an account</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>