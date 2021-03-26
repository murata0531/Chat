<?php 
session_start();

include 'library_action.php';

if(!isset($_SESSION['id'])){
  header('location:./UI');
  exit();
}


//me
$my_data = $lib_obj->get_my_data($_SESSION['id']);


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="./css/style.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- fontawsome -->
    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">

  </head>
  <body>
      
    <div class="container-fluid d-flex flex-column vw-100 vh-100 m-0 p-0 position-absolute">
      <div class="header bg-success start-0 d-flex flex-row justify-content-center align-items-center position-relative">
        <!-- header -->
        <p class="display-4 text-white font-weight-bold">User plofile</p>
      </div>
      <!-- body -->
      <div class="body d-flex flex-row vw-100 start-0">
        <!-- side -->
        <div class="side w-25 bg-dark start-0 text-white position-relative">
            <!-- back -->
            <button type="button" class="back btn btn-primary position-relative w-100 border-bottom bottom-0" id="back">
                Back
            </button>
            <!-- logout -->
            <button type="button" class="logout btn btn-danger position-relative w-100 border-bottom bottom-0" data-toggle="modal" data-target="#logoutModal">
                Logout
            </button>
          
        </div>
      
        <!-- logoutModal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="logoutLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Logout 
              </div>
              <div class="modal-footer">
                <form method="post" action="./library_action.php">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" name="logout">OK</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <!-- main -->
        <div class="main w-75 start-25 position-relative d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="card mt-5 mx-auto w-75">
                    <!-- <div class="card-header">
                        Login Form
                    </div> -->
                    <div class="card-body">
                        <form action="useredit.php" method="post">
                            <p>Your name</p>
                            <input type="text" name="user-name" placeholder="" id="user-name" class="form-control mt-3" value="<?php echo $my_data['user_name'] ?>" readonly>
                            <p>Your e-mail</p>
                            <input type="email" name="user-email" placeholder="example@example.com" id="user-email" class="form-control mt-3" value="<?php echo $my_data['user_email'] ?>" readonly>
                            <br>
                            <p>Your password</p>
                            <input type="password" name="user-password" placeholder="" id="user-password" class="form-control mt-3" value="<?php echo $my_data['user_password'] ?>" readonly>
                            <br>
                            <p>Your icon</p>
                            <img src="<?php echo $my_data['user_icon'] ?>" class="h-auto w-25">
                            <br>
                            <div class="d-flex justify-content-center  mt-3">
                                <button type="submit" name="user-edit" id="user-edit" class="btn btn-outline-primary w-100">Edit</button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="card-footer">
                        <a href="register.php">Click here if you do not have an account</a>
                    </div> -->
                </div>
            </div>
        </div>
      <div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    <script>
        document.getElementById("back").addEventListener('click',function(){
            history.back();
        },false);
    </script>
  </body>
</html>