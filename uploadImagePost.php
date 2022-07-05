<?php
            require('connection.php');
            $caption=$_POST['post_caption'];
            $user_id=$_SESSION['user_id'];
            $current_date=date('Y-m-d');
            $current_time=date('H:i:s');

            if(($_FILES['my_file']['name']!== "")){
                $target_dir = "res\\posts\\";
                $file = $_FILES['my_file']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['my_file']['tmp_name'];
                $path_filename_ext = $target_dir.$filename.".".$ext;
                $exp_ext = array("png","jpg","jpeg");
                if(in_array($ext,$exp_ext)){
                    echo "<br>Given file is an image";
                }else{
                    echo "<br>Please select an image";
                }
                if (file_exists($path_filename_ext)) {
                    echo "Sorry, file already exists.";
                    }else{
                        move_uploaded_file($temp_name,$path_filename_ext);
                        echo "Congratulations! File Uploaded Successfully.";
                        $query="INSERT INTO posts(post_type,post_caption,user_id,post_date,post_time) values(1,'$caption',$user_id,'$current_date','$current_time') RETURNING *";
                        $result= pg_query($db, $query);
                        echo "result ".$result."<br>";
                        list($new_id) = pg_fetch_array($result);
                        print_r($new_id);
                         $old = "res\\posts\\".$filename.".".$ext;
                         $new = "res\\posts\\".$new_id.".".$ext;
                        // echo $old;
                         $new_with_ext= $new_id.".".$ext;
                         rename($old,$new);
                         $query="UPDATE posts SET post_content='$new' WHERE post_id='$new_id'";
                         $result= pg_query($db, $query);
                         pg_close($db);
                         echo "<img src='$new_with_ext'>";
                         header("Location:userFeed.php");
                    }
            }
        ?>
