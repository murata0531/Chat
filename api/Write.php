<?php


// 文字コード設定
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

if(isset($_POST["posttest"])) {
    // numをエスケープ(xss対策)
    $param = htmlspecialchars($_POST["posttest"]);
    $result;
    
    try {
        // DBへ接続
        $pdo = new PDO("mysql:host=localhost; dbname=library_am; charset=utf8", 'root', '');
    
        // プリペアドステートメントで SQLをあらかじめ用意しておく
        $stmt = $pdo->prepare('select * from users where user_id = :id and user_name = :name');
        // 値をバインド
        $id = 14;
        $name = 'okkko';
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
    
        // executeでクエリを実行
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(empty($result)){
            $result = "bad";
        }
        
        // 接続を閉じる
        $pdo = null;
    
    } catch(PDOException $e) {
        
        echo $e->getMessage();
        die();
    }

    echo json_encode($result);

}
?>