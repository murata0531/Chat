<?php


// header
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// post_user_id
// post_chat_id
if(isset($_POST['post_user_id']) && isset($_POST['post_chat_id'])) {

    // escape
    $userId =  htmlspecialchars($_POST['post_user_id']);
    $chatId =  htmlspecialchars($_POST["post_chat_id"]);

    if(isset($_POST["post_message"])){
        $chatMsg =  htmlspecialchars($_POST["post_message"]);
    }

    if(isset($_POST["post_isfile"])){
        $chatIsfile =  htmlspecialchars($_POST["post_isfile"]);
    }

    $result;
    $result_value;

    try {
        // connect DB
        $pdo = new PDO("mysql:host=localhost; dbname=library_am; charset=utf8", 'root', '');
    
        //prepared statement
        //Exists : message & file
        if(isset($chatMsg) && isset($chatIsfile)){
            $stmt = $pdo->prepare('insert into message_logs(chat_id,user_id,message,isfile) values(:cid,:uid,:msg,:isf)');
        //Exists : message only
        }else if(isset($chatMsg)) {
            $stmt = $pdo->prepare('insert into message_logs(chat_id,user_id,message) values(:cid,:uid,:msg)');
        //Exists : file only
        }else if(isset($chatIsfile)){
            $stmt = $pdo->prepare('insert into message_logs(chat_id,user_id,isfile) values(:cid,:uid,:isf)');
        }

        // bind value
        $cid = $chatId;
        $uid = $userId;

        if(isset($chatMsg)){
            $msg = $chatMsg;
        }
        
        if(isset($chatIsfile)){
            $isf = $chatIsfile;
        }

        $stmt->bindValue(':cid', $cid, PDO::PARAM_INT);
        $stmt->bindValue(':uid', $uid,PDO::PARAM_INT);

        if(isset($msg)){
            $stmt->bindValue(':msg', $msg);
        }

        if(isset($isf)){
            $stmt->bindValue(':isf', $isf);
        }
    
        // execute query
        
        if($stmt->execute()){
        
            $result = "ok";
            $insert_id = $pdo->lastInsertId();
            $select_sql = "SELECT * FROM message_logs WHERE log_id = '$insert_id'";

            $stmt = $pdo->query($select_sql);

            $result_value = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }else {
            $result = "bad";
            $result_value = "no data";
        }
        
        // disconnect
        $pdo = null;
    
    } catch(PDOException $e) {
        
        echo $e->getMessage();
        die();
    }

    echo json_encode(['result' => $result,'result_value' => $result_value]);

}
?>