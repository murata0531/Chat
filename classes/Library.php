<?php
include 'Database.php';

class Library extends Database {

    //register
    public function register($name,$email,$password,$comfirm){

        $errors = [];

        if (!preg_match("/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}$/i", $password)) {
            $errors[] = "Please enter the password with at least 8 characters including uppercase letters, lowercase letters and numbers.";
            //complete
            //print_r($errors);

        }

        if($password != $comfirm){
            $errors[] = 'not comfirm your password';
            //complete
            // print_r($errors);
        }

        if(empty($errors)){

            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(user_name,user_email,user_password)VALUES('$name','$email','$pass_hash')";
            $result = $this->conn->query($sql);
    
            if($result == TRUE){
                
                $result_sql = "SELECT * FROM users WHERE user_email = '$email'";

                $complete_result = $this->conn->query($result_sql);

                if($complete_result == FALSE){
                    $errors[] = 'Wrong email address or password.';
                }else {
                    if($complete_result->num_rows > 0){
                        $row = $complete_result->fetch_assoc();
                        $_SESSION['id'] = $row['user_id'];
                        $_SESSION['icon'] = $row['user_icon'];
                        $_SESSION['name'] = $row['user_name'];
                        if(isset($_SESSION['id'])){
                            header('location:./Home.php');
                        }
                    }
                }
            }else {
                die('ERROR: '.$this->conn->error);
            }
        }else {
            header('location:./UI?=' . $errors);
            exit();
        }
    }

    //Login
    public function login($email,$password){


        $sql = "SELECT * FROM users WHERE user_email = '$email'";

        // $sql = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$pass_hash'";
        $result = $this->conn->query($sql);

        if($result == FALSE){
            $_SESSION['login-error'] = 'Wrong email address or password.';
        }else {
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();

                if(password_verify($password,$row['user_password']) == FALSE){
                    $_SESSION['login-error'] = 'Wrong email address or password.';
                }else {
                    if(isset($_SESSION['login-error'])){
                        unset($_SESSION['login-error']);
                    }
                }
            }else {
                $_SESSION['login-error'] = 'Wrong email address or password.';
            }
        }

        if(!isset($_SESSION['login-error'])){

            $_SESSION['id'] = $row['user_id'];
            $_SESSION['icon'] = $row['user_icon'];
            $_SESSION['name'] = $row['user_name'];

            if(isset($_SESSION['id'])){
                header('location:./Home.php');
            }
        }else {
            //post request
            // header('location:./UI?error=' . $error,true,307);

            //get request
            header('location:./UI?error=' . $error);

            exit();
        }
    }

    public function url_param_change($par=Array(),$op=0){
        $url = parse_url($_SERVER["REQUEST_URI"]);
        if(isset($url["query"])) parse_str($url["query"],$query);
        else $query = Array();
        foreach($par as $key => $value){
            if($key && is_null($value)) unset($query[$key]);
            else $query[$key] = $value;
        }
        $query = str_replace("=&", "&", http_build_query($query));
        $query = preg_replace("/=$/", "", $query);
        return $query ? (!$op ? "?" : "").htmlspecialchars($query, ENT_QUOTES) : "";
    }

    // loout
    public function logout(){

        if(isset($_SESSION['name'])){
            unset($_SESIION['name']);
        }

        if(isset($_SESSION['icon'])){
            unset($_SESIION['icon']);
        }

        if(isset($_SESSION['id'])){
            unset($_SESIION['id']);
        }

        header('location:./UI');
        exit();
    }

    //all user select
    public function get_users_data($get_id){

        $sql = "SELECT * FROM users WHERE user_id <> '$get_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0){

            $return_container = array();

            while($row = $result->fetch_assoc()){
                $return_container[] = $row;
            }

            return $return_container;

        }else {
            return FALSE;
        }
    }

    //my data select
    public function get_my_data($my_id){

        $sql = "SELECT * FROM users WHERE user_id = '$my_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0){
            $return_container;
            $return_container = $result->fetch_assoc();
            

            return $return_container;

        }else {
            return FALSE;
        }
    }

    //private member add
    public function private_member_add($my_id,$my_name,$selected_user_id,$temp_name = null){

        // opponent_user_name select
        $opponent_sql = "SELECT * FROM users WHERE user_id = '$selected_user_id'";
        $opponent_result = $this->conn->query($opponent_sql);

        if($opponent_result->num_rows > 0){
           
            $oppo_row[] = $opponent_result->fetch_assoc();
            $oppo_name = $oppo_row[0]['user_name'];
        }

        // Check private_member : already registered?
        $select_sql = "SELECT user_id FROM namings WHERE user_id = '$my_id' AND opponent_id = '$selected_user_id'";
        $select_result = $this->conn->query($select_sql);

        if($select_result->num_rows == 0){

            //If the chat name is not set, use the opponent name as the chat name
            if($temp_name == null){
                $chat_name = $oppo_name;
            }else {
                $chat_name = $temp_name;
            }

            
            //insert chat room
            $add_chat_sql = "INSERT INTO chat(chat_type)VALUES(1)";
            $add_chat_result = $this->conn->query($add_chat_sql);

            if($add_chat_result == TRUE){

                //select chat_id
                $chat_sql = "SELECT LAST_INSERT_ID() as cid";
                $chat_result = $this->conn->query($chat_sql);

                if($chat_result == TRUE){

                    $chat_row[] = $chat_result->fetch_assoc();
                    $chat_id = $chat_row[0]['cid'];

                    // add my_id to chat management
                    $my_chat_management_sql = "INSERT INTO chat_management(user_id,chat_id)VALUES('$my_id','$chat_id')";

                    $my_chat_management_result = $this->conn->query($my_chat_management_sql);
        
                    if($my_chat_management_result == TRUE){
                        
                        // add opponent_id to chat management
                        $opponent_chat_management_sql = "INSERT INTO chat_management(user_id,chat_id)VALUES('$selected_user_id','$chat_id')";
                        $opponent_chat_management_result = $this->conn->query($opponent_chat_management_sql);
            
                        if($opponent_chat_management_result == TRUE){
                            
                            //Set the my chat name
                            $add_sql = "INSERT INTO namings(user_id,opponent_id,chat_id,chat_name)VALUES('$my_id','$selected_user_id','$chat_id','$chat_name')";
                            $add_result = $this->conn->query($add_sql);

                            if($add_result == TRUE){
                        
                                //set the opponent chat name
                                $add_opponent_sql = "INSERT INTO namings(user_id,opponent_id,chat_id,chat_name)VALUES('$selected_user_id','$my_id','$chat_id','$my_name')";
                                $add_opponent_result = $this->conn->query($add_opponent_sql);
                    
                                if($add_opponent_result == TRUE){
                                    print_r("ok");
                                }
                            }
                        }
                    }
                }
            }
        }

        header('location:./home.php');
    }

    //group member add
    public function group_member_add($my_id,$my_name,$selected_user_id,$chat_name){

        // if not selected user
        if($selected_user_id == 'nothing'){

        }else {
            //insert chat room
            $add_chat_sql = "INSERT INTO chat(chat_type)VALUES(0)";
            $add_chat_result = $this->conn->query($add_chat_sql);

            if($add_chat_result == TRUE){

                //select chat_id
                $chat_sql = "SELECT LAST_INSERT_ID() as cid";
                $chat_result = $this->conn->query($chat_sql);

                if($chat_result == TRUE){

                    $chat_row[] = $chat_result->fetch_assoc();
                    $chat_id = $chat_row[0]['cid'];

                    // add my_id to chat management
                    $my_chat_management_sql = "INSERT INTO chat_management(user_id,chat_id)VALUES('$my_id','$chat_id')";

                    $my_chat_management_result = $this->conn->query($my_chat_management_sql);
        
                    if($my_chat_management_result == TRUE){
                        
                        //Set the group chat name
                        $add_sql = "INSERT INTO group_namings(chat_name,chat_id)VALUES('$chat_name','$chat_id')";
                        $add_result = $this->conn->query($add_sql);

                        if($add_result == TRUE){
                    
                            // add opponent_id to chat management
                            for($i = 0; $i < count($selected_user_id); $i++){

                                $tmp_user_id = $selected_user_id[$i];

                                $opponent_chat_management_sql = "INSERT INTO chat_management(user_id,chat_id)VALUES('$tmp_user_id','$chat_id')";
                                $opponent_chat_management_result = $this->conn->query($opponent_chat_management_sql);
                    
                                if($opponent_chat_management_result == TRUE){
                                    print_r("ok");
                                }
                            }
                        }
                    }
                }
            }
        }

        header('location:./home.php');
    }

    // Private chat to which I belong.
    public function get_my_private_chat($my_id){

        $sql = "SELECT * FROM namings WHERE user_id = '$my_id'";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0){

            $return_container = array();

            while($row = $result->fetch_assoc()){
                $return_container[] = $row;
            }

            return $return_container;

        }else {
            return FALSE;
        }
    }

    // Group chat to which I belong.
    //chat_id, chat_name
    public function get_my_group_chat($my_id){

        $sql = "SELECT group_namings.chat_id,group_namings.chat_name
                FROM chat,chat_management,group_namings 
                WHERE chat.chat_id = chat_management.chat_id AND chat_management.chat_id = group_namings.chat_id
                    AND chat_management.user_id = '$my_id'
                    AND chat.chat_type = 0
                ";

        $result = $this->conn->query($sql);

        if($result->num_rows > 0){

            $return_container = array();

            while($row = $result->fetch_assoc()){
                $return_container[] = $row;
            }

            return $return_container;

        }else {
            return FALSE;
        }
    }

    //top chat data
    //chat_id,chat,name
    public function get_top_chat($my_id){

        //max last_modify chat
        $sql = "SELECT chat.chat_id,chat.chat_type,last_modify
                from chat,chat_management 
                WHERE chat.chat_id = chat_management.chat_id
                AND chat_management.user_id = '$my_id'
                order by last_modify desc LIMIT 1";


        $result = $this->conn->query($sql);

        if($result == TRUE){

            $row = $result->fetch_assoc();

            //if:0 ->group / 1 -> private
            if($row['chat_type'] == 0){

                $group_id = $row['chat_id'];
                $group_sql = "SELECT chat_id,chat_name FROM group_namings WHERE chat_id = '$group_id'";
                $group_result = $this->conn->query($group_sql);

                if($group_result == TRUE){

                    $group_row = $group_result->fetch_assoc();
                    $return_container = $group_row;
                }

            }else if($row['chat_type'] == 1){

                $private_id = $row['chat_id'];
                $private_sql = "SELECT chat_id,chat_name FROM namings WHERE chat_id = '$private_id' AND user_id = '$my_id'";
                $private_result = $this->conn->query($private_sql);

                if($private_result == TRUE){

                    $private_row = $private_result->fetch_assoc();
                    $return_container = $private_row;
                }
            }

            return $return_container;

        }else {
            return "nothing";
        }
    }
}

?>