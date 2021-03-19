<?php

include 'classes/Library.php';

$lib_obj = new Library;

if(isset($_POST['login'])){

    //debug complete
    // print_r("UPPER CASE!");

    $user_email = $_POST['user-email'];
    $user_password = $_POST['user-password'];

    $lib_obj->login($user_email,$user_password);

}

if(isset($_POST['register'])){
    $user_name = $_POST['register-user-name'];
    $user_email = $_POST['register-user-email'];
    $user_password = $_POST['register-user-password'];
    $comfirm_password = $_POST['register-comfirm-password'];

    $lib_obj->register($user_name,$user_email,$user_password,$comfirm_password);

}


//register is temp-complete


if(isset($_POST['update-book'])){

    $book_id = $_POST['book-id'];
    $book_name = $_POST['book-name'];
    $book_genre = $_POST['book-genre'];
    $book_author = $_POST['book-author'];
    $date_added = $_POST['book-date-added'];
    $lib_obj->update_book($book_id,$book_name,$book_genre,$book_author,$date_added);
}

if(isset($_POST['logout'])){
    $lib_obj->logout();
}

if(isset($_POST['user_select'])){

    $my_id = $_POST['my-id'];
    $my_name= $_POST['my-name'];
    $selected_user_id = $_POST['selected-user-id'];
    $chat_name = $_POST['add_private_chat_name'];
    $lib_obj->private_member_add($my_id,$my_name,$selected_user_id,$chat_name);
}

// if(isset($_POST['get_userid'])){

//     header('Content-Type: application/json');
//     header("Access-Control-Allow-Origin: *");

//     $param = htmlspecialchars($_POST["userid"]);

//     $container = $lib_obj->get_users_data();
//     echo json_encode($container);

// } 

?>