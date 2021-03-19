<?php 
session_start();

include 'library_action.php';
// when redirect do'nt keep session
//when registration: keep session ok
//but when login:don't keep session
if(!isset($_SESSION['id'])){
  header('location:./UI');
  exit();
}

// all user
$users_data = $lib_obj->get_users_data($_SESSION['id']);

//me
$my_data = $lib_obj->get_my_data($_SESSION['id']);

// debug ok
// if(isset($users_data)){
//   print_r($users_data);
// }else {
//   print_r("not data");
// }

// $first_user = $lib_obj->get_first_user();

// if(!issset($first_user)){
//   $first_user = " ";
// }

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

    <!-- php to javascript transfer valiable -->
    <script>
        const id = <?php echo json_encode($_SESSION['id']); ?>;
    </script>
  </head>
  <body>
      
    <div class="container-fluid d-flex flex-column vw-100 vh-100 m-0 p-0 position-absolute">
      <div class="header bg-success start-0 d-flex flex-row justify-content-center position-relative">
        <!-- header -->
        <p class="h-100 position-relative">header</p>
      </div>
      <!-- body -->
      <div class="body d-flex flex-row vw-100 start-0">
        <!-- side -->
        <div class="side w-25 bg-dark start-0 text-white position-relative">
          <!-- profile -->
          <!-- <p class="profile position-relative border-bottom"><a href="profile" class="text-white position-absolute">Profile</a></p> -->
          <button type="button" class="profile btn position-relative w-100 border-bottom bottom-0 text-white">
            Profile
          </button>
          <!-- add user -->
          <button type="button" class="add-user btn position-relative w-100 border-bottom bottom-0 text-white" data-toggle="modal" data-target="#adduserModal">
            Add user
          </button>
          <!-- add group -->
          <button type="button" class="add-group btn position-relative w-100 border-bottom bottom-0 text-white" data-toggle="modal" data-target="#addgroupModal">
            Add group
          </button>
          <!-- accordion -->
          <div class="panel-group text-white" id="accordion">
            <div class="panel panel-default border-bottom">
              <div class="panel-heading">
                <!-- <h4 class="panel-title"> -->
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="">Users</a>
                <!-- </h4> -->
              </div>
              <!-- user list -->
              <div id="collapse3" class="panel-collapse collapse in">
                <div class="panel-body">
                  <ul class="list-group">
                    <?php if(isset($users_data)){ ?>
                    <?php  foreach($users_data as $row): ?>
                    <li class="list-group-item text-danger display-5" id="<?php echo $row['user_id'] ?>">
                      <a id="<?php echo $row['user_id'] ?>" onclick="user_click(this)";><?php echo $row['user_name'] ?></a>
                    </li>
                    <?php endforeach; ?>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default border-bottom">
              <div class="panel-heading">
                <!-- <h4 class="panel-title"> -->
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Groups</a>
                <!-- </h4> -->
              </div>
              <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body">
                  <ul class="list-group">
                    <?php if(isset($users_data)){ ?>
                    <?php  foreach($users_data as $row): ?>
                    <li class="list-group-item text-danger display-5" id="<?php echo $row['user_id'] ?>">
                      <a id="<?php echo $row['user_id'] ?>" onclick="user_click(this)";><?php echo $row['user_name'] ?></a>
                    </li>
                    <?php endforeach; ?>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
            <!-- logout -->
            <button type="button" class="logout btn btn-danger position-relative w-100 border-bottom bottom-0" data-toggle="modal" data-target="#logoutModal">
            Logout
          </button>
            </div>
          </div>
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
        <!-- adduserModal -->
        <div class="modal fade" id="adduserModal" tabindex="-1" role="dialog" aria-labelledby="adduserModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="adduserModalLabel">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="post" action="./library_action.php">
                <input type="hidden" name="my-id" value="<?php echo $my_data['user_id'] ?>">
                <input type="hidden" name="my-name" value="<?php echo $my_data['user_name'] ?>">

                <div class="modal-body">
                  <div>
                    <p>Chat name</p><input type="text" name="add-private-chat-name">
                  </div>
                  <br>
                  <p>Select user</p>
                  <ul class="list-group">
                    <?php if(isset($users_data)){ ?>
                    <?php  foreach($users_data as $row): ?>
                    <li class="list-group-item text-danger display-5" id="<?php echo $row['user_id'] ?>">
                    <input type="radio" name="selected-user-id" value="<?php echo $row['user_id'] ?>">
                      <a id="<?php echo $row['user_id'] ?>"><?php echo $row['user_name'] ?></a>
                    </li>
                    <?php endforeach; ?>
                    <?php } ?>
                  </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" name="user_select">Add</button>
              
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- addgroupModal -->
        <div class="modal fade" id="addgroupModal" tabindex="-1" role="dialog" aria-labelledby="addgroupModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addgroupModalLabel">Add group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div>
                  <p>Chat name</p><input type="text" name="" neme="add_user_chat_name">
                </div>
                <br>
                <p>Select users</p>
                <ul class="list-group">
                  <?php if(isset($users_data)){ ?>
                  <?php  foreach($users_data as $row): ?>
                  <li class="list-group-item display-5" id="<?php echo $row['user_id'] ?>">
                  <input type="checkbox" name="selected-user" value="<?php echo $row['user_id'] ?>">
                    <a id="<?php echo $row['user_id'] ?>" onclick="user_clic(this)";><?php echo $row['user_name'] ?></a>
                  </li>
                  <?php endforeach; ?>
                  <?php } ?>
                </ul>
              </div>
              <div class="modal-footer">
                <form method="post" action="./library_action.php">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" name="logout">Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- main -->
        <div class="main w-75 start-25 position-relative d-flex flex-column">
          <!-- chat header -->
          <div class="chat-header position-relative start-25 w-100 m-0 d-flex flex row justify-content-center align-items-center" style="background-color:#C0C0C0;">
            <h1 class="chat-header-title" id="chat-header-title"></h1>
          </div>
          <!-- chat body -->
          <div class="chat-body position-relative d-flex flex-column" id="output">

            <!-- message show area -->

            <!-- opponentmessage -->
            <div class="opponent-message d-flex flex-column position-relative w-100 mt-5 bg-primary h-auto">
              <div class="d-flex flex-row position-relative m-3">
                <img src="" class="opponent-message-icon">
                <p class="position-relative m-3 ml-5">2021/01/01 22:44</p>
              </div>
              <p class=" opponent-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg">message</p>
            </div>

            <!-- my message -->
            <div class="my-message d-flex flex-column position-relative w-100 mt-5 bg-danger auto">
              <div class="d-flex flex-row position-relative m-3">
                <p class="my-message-date position-relative m-3">2021/01/01 22:44</p>
                <img src="" class="my-message-icon ml-3 position-absolute">
              </div>
              <p class="my-message-text w-50 text-center bg-white position-relative m-3 p-3 rounded-lg">messhuiiiiiiiiiiiiiiiiiiiagllllllllllllle</p>
            </div>
            

          </div>
          <div class="send-area position-relative w-100 d-flex flex-column border-top">
            <!-- messagetext -->
            <textarea class="w-100 h-50 send-text position-relative" id="send-text">abc</textarea>
            <!-- button and file area -->
            <div class="d-flex flex-row w-100 h-50 position-relative">
              <div class="h-100 w-75">
                <label for="send-file" id="avatar"><input id="send-file" type="file" accept="image/*"><i class="fas fa-image"></i></label>
              </div>
              <!-- send button -->
              <button type="button" class="btn w-25 h-100 bg-primary text-white send-button position-relative" id="send-button"><i class="fas fa-paper-plane fa-2x"></i></button>
      
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
  
    <!-- axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-storage.js"></script>
    <script src="./api/firebaseapi.js"></script>

    <script src="./JS/chatview.js"></script>

    <script>
      $(function() {

        
        let setTitle = document.getElementById('chat-header-title');
        setTitle.innerHTML = id.textContent;
        alert(id);

        const database = firebase.database();

        axios.get('http://localhost/Chat/api/Read.php', {
            params: {
              //query string
              userid:id,
            }
        })
        .then(function (response) {
            // let user_data = response.data();
            
            let prevTask = Promise.resolve();

            //read data
            // database.ref(1).on("child_added", (data) => {
            //     prevTask = prevTask.finally(async () => {
            //         const v = data.val();
            //         const k = data.key;

            
            //     }).catch(function (error) {

            //         // A full list of error codes is available at
            //         // https://firebase.google.com/docs/storage/web/handle-errors
            //         switch (error.code) {
            //             case 'storage/object-not-found':
            //                 alert('File doesn\'t exist');
            //                 break;

            //             case 'storage/unauthorized':
            //                 alert('User doesn\'t have permission to access the object');
            //                 break;

            //             case 'storage/canceled':
            //                 alert('User canceled the upload');
            //                 break;


            //             case 'storage/unknown':
            //                 alert('Unknown error occurred, inspect the server response');
            //                 break;
            //         }
            //     });
            // })
            // .catch(function (error) {
            //     // handle error
            //     console.log(error);
            // })
            // .finally(function () {
            //     // always executed
            // });

            //
        })
        .catch(function(error){
          alert(error);
        });
    });

</script>
  </body>
</html>