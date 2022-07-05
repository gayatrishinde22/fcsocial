<?php
           require('connection.php');
           date_default_timezone_set('Asia/Kolkata');
           $post_contents=$_POST['text-post'];
           $date = date('Y-m-d');
           $time=date('H:i:s');
           $query="INSERT INTO posts(post_type,post_content,user_id,post_date,post_time) values(0,'$post_contents',$_SESSION[user_id],'$date','$time') RETURNING *";
           $result= pg_query($db, $query);
           $result=pg_fetch_array($result);
           if(isset($result)){
                header("Location:userFeed.php");
           }else{
               echo "Something went wrong";
           }
?>
