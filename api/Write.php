<?php


// header
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// post_user_id
// post_chat_id
if(isset($_POST['post_user_id']) && isset($_POST['post_chat_id'])) {

    // escape
    $userId =  htmlspecialchars($_POST['post_user_id']);
    $chatId =  htmlspecialchars($_POST['post_chat_id']);
    $chatMsg =  htmlspecialchars($_POST['post_message']);
    $chatIsfile =  htmlspecialchars($_POST['post_isfile']);
    $chatExistsMessage = htmlspecialchars($_POST['post_existsMessage']);
    $chatExistsFile = htmlspecialchars($_POST['post_existsFile']);

    $result;
    $result_value;

    try {
        // connect DB
        $pdo = new PDO("mysql:host=localhost; dbname=library_am; charset=utf8", 'root', '');
    
        //prepared statement
        $stmt = $pdo->prepare('insert into message_logs(chat_id,user_id,message,isfile,exists_message,exists_file) values(:cid,:uid,:msg,:isf,:emsg,:efile)');
        

        // bind value
        $cid = $chatId;
        $uid = $userId;
        $msg = $chatMsg;
        $isf = $chatIsfile;
        $emsg = $chatExistsMessage;
        $efile = $chatExistsFile;

        $stmt->bindValue(':cid', $cid, PDO::PARAM_INT);
        $stmt->bindValue(':uid', $uid,PDO::PARAM_INT);
        $stmt->bindValue(':msg', $msg);
        $stmt->bindValue(':isf', $isf);
        $stmt->bindValue(':emsg',$emsg);
        $stmt->bindValue(':efile',$efile);

        // execute query
        if($stmt->execute()){
        
            $insert_id = $pdo->lastInsertId();
            $select_sql = "SELECT * FROM message_logs WHERE log_id = '$insert_id'";

            $stmt = $pdo->query($select_sql);
            $result_value = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //current time
            $current_date = $result_value[0]['date'];

            //update chat last_modify date to current time
            $update_sql = "UPDATE chat SET last_modify = '$current_date'";
            $update_result = $pdo->query($update_sql);

            if($update_result == TRUE){
                $result = "ok";
            }else {
                $result = "bad";
            }

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