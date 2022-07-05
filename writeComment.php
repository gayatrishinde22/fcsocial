<?php
    require('connection.php');
     $current_date=date('Y-m-d');
     $current_time=date('H:i:s');
     $user_id = intval($_POST['user']);
     $comment_content = $_POST['comment-content'];
     $post_id = $_POST['post'];

     $query = "INSERT INTO comments(comment_content,comment_date,comment_time,user_id,post_id) values('$comment_content','$current_date','$current_time',$user_id,$post_id) RETURNING *";

     $result  =  pg_query($query);
     $result = pg_fetch_assoc($result);
     echo $result['comment_id'];
?>