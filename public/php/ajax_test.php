<?php
        $perY = $_POST['perY'];
        $perX = $_POST['perX'];

        try {
                // DBへ接続
                $pdo = new PDO('mysql:host=localhost; dbname=laravel_task_app; charset=utf8', 'laravel_raiku', 'raiku0619');
        
                // SQL作成
                $sql = "INSERT INTO tasks (
                        top_position, left_position
                ) VALUES (
                        '$perY', '$perX'
                )";
        
                // SQL実行
                $res = $pdo->query($sql);
        
        } catch(PDOException $e) {
                echo $e->getMessage();
                die();
        }
        
        // 接続を閉じる
        $pdo = null;

?>