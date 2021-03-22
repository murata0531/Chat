<?php

include 'classes/Library.php';

$lib_obj = new Library;

//login
if(isset($_POST['login'])){

    //debug complete
    // print_r("UPPER CASE!");

    $user_email = $_POST['user-email'];
    $user_password = $_POST['user-password'];

    $lib_obj->login($user_email,$user_password);

}

//user register
if(isset($_POST['register'])){
    $user_name = $_POST['register-user-name'];
    $user_email = $_POST['register-user-email'];
    $user_password = $_POST['register-user-password'];
    $comfirm_password = $_POST['register-comfirm-password'];

    $lib_obj->register($user_name,$user_email,$user_password,$comfirm_password);

}


//logout
if(isset($_POST['logout'])){
    $lib_obj->logout();
}

//private chat register
if(isset($_POST['user_select'])){

    $my_id = $_POST['my-id'];
    $my_name= $_POST['my-name'];
    $selected_user_id = $_POST['selected-user-id'];
    $chat_name = $_POST['add-private-chat-name'];
    $lib_obj->private_member_add($my_id,$my_name,$selected_user_id,$chat_name);
}

//group chat register
if(isset($_POST['users_select'])){

    $my_id = $_POST['my-id'];
    $my_name= $_POST['my-name'];

    //if not selected user : "nothing"
    if(isset($_POST['selected-user-id'])){
        $selected_user_id = $_POST['selected-user-id'];
    }else {
        $selected_user_id = "nothing";
    }
    
    $chat_name = $_POST['add-group-chat-name'];
    $lib_obj->group_member_add($my_id,$my_name,$selected_user_id,$chat_name);
}

// if(isset($_POST['get_userid'])){

//     header('Content-Type: application/json');
//     header("Access-Control-Allow-Origin: *");

//     $param = htmlspecialchars($_POST["userid"]);

//     $container = $lib_obj->get_users_data();
//     echo json_encode($container);

// } 

?>