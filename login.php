<?php
            require 'connection.php';
             if(isset($_POST['email']) && isset($_POST['password'])){
                $email=$_POST['email'];
                $query="SELECT * FROM Users WHERE user_email='$email'";
                $result=pg_query($db,$query);
                $result = pg_fetch_array($result);
                if($result==null){
                    echo "1";
                }
                else if(password_verify($_POST['password'],$result['user_password'])){
                   echo "2";
                    $_SESSION['user_id']=$result['user_id'];
                } else {
                    echo "3";
                }
            }
        ?>