<?php
    require('header.php');
    $post_id = $_GET['q'];
    $current_user = $_SESSION['user_id'];
    $query = "SELECT * from posts where post_id=$post_id";
    $result = pg_query($query);
    $row=pg_fetch_assoc($result);
       //print_r($row);
        $user_id=$row['user_id'];
        $query="SELECT * FROM users WHERE user_id=$user_id";
        $user_data=pg_query($db,$query);
        $user_data=pg_fetch_assoc($user_data);
        $post_id=$row['post_id'];
         $post_content = $row['post_content'];
        $post_caption=$row['post_caption'];

        $user_name=$user_data['user_name'];
        if($user_data['user_profile_picture']){
            $user_profile_picture=$user_data['user_profile_picture'];
        }
        else{
            $user_profile_picture='res/profile-pictures/profile-img.png';
        }
        echo "<br><br>";
        if($row['post_type']==1){
            //image type post
            //add style to post caption
            echo "
                <center>
                   <div class='post-full-body'>
                        <div class='post-body-head'>
                          <img class='post-body-head-pfp' src='res/profile-pictures/$user_profile_picture' />
                          <h1 class='post-body-head-name' onclick=window.location.href='viewProfile.php?q=$user_id';>$user_name</h1>
                        </div>
                        <div class='post-body-tail'>
                          <center>
                            <img class='post-body-tail-img' src='$post_content' />

                          </center>
                           <p class='image-post-caption-content'>$post_caption</p>
                          <div class='post-body-tail-btns'>


                          </div>
                        </div>
                  </div>
                </center>
                  <div class='comment-header'>
                    <p>
                      Comments
                    </p>
                  </div>
                
                ";
                $query1 = "SELECT * FROM comments WHERE post_id=$post_id ORDER BY comment_date DESC,comment_time DESC";
                $result1 = pg_query($query1);
                while($row1 = pg_fetch_assoc($result1)){
                    //print_r($row1);
                    $comment_content = $row1['comment_content'];
                    $comment_uid= $row1['user_id'];
                    $query2= "SELECT * FROM users WHERE user_id=$comment_uid";
                    $result2 = pg_query($query2);
                    $result2 = pg_fetch_assoc($result2);
                    $comment_uname = $result2['user_name'];
                    $comment_upicture = $result2['user_profile_picture'];
                    $uimg = "res/profile-pictures/".$result2['user_profile_picture'];
                    echo "
                    <div class='single-comment'>
                      <div class='single-comment-pic-box'>
                          <img class='single-comment-pic' src='$uimg' />
                      </div>
                      <div class='single-comment-comment-box'>
                          <p><b>$comment_uname</b></p>
                          <p>  $comment_content</p>
                      </div>
                    </div>
                    ";

                }
                
                // Added comments styling changes over here, cant use hover effect since we're using inline CSS
                
                echo "
                <div style='padding-bottom: 10px;' >
                <center>
                <div style='float:left; width:80%; padding-left:50px;' >
                 <textarea id='add-comment-textarea'
                  style='
                  height:50px;
                  width:100%;
                  ' 
                  placeholder='Add text here...'>
                  </textarea>
                </div>
                <div style='float-left;'>
                  <button class='add-comment-button' onclick='addComment();'
                  style=
                  '
                  background-color:#4DB6AC;
                  color:white;
                  border:none;
                  width:250px;
                  height:50px;
                  font-size:17px;
                  hover: color:red;
                  '>ADD COMMENT</button>
                  </div>
                  </center>
                </div>
                ";



        }else{
            //text type post

            echo "
            <center>
              <div class='post-full-body'>
                <div class='post-body-head'>
                  <img class='post-body-head-pfp' src='res/profile-pictures/profile-img.png' />
                  <h1 class='post-body-head-name' onclick=window.location.href='viewProfile.php?q=$user_id';>$user_name</h1>
                </div>
                <div class='post-body-tail'>
                    <p class='post-body-tail-text'>$post_content</p>
                  <div class='post-body-tail-btns'>


                  </div>
                </div>
              </div>
              </center>
              <div class='comment-header'>
                <p>
                  Comments
                </p>
              </div>
           
            ";
            $query1 = "SELECT * FROM comments WHERE post_id=$post_id";
            $result1 = pg_query($query1);
            while($row1 = pg_fetch_assoc($result1)){
                $comment_content = $row1['comment_content'];
                $comment_uid= $row1['user_id'];
                $query2= "SELECT * FROM users WHERE user_id=$comment_uid";
                $result2 = pg_query($query2);
                $result2 = pg_fetch_assoc($result2);
                $comment_uname = $result2['user_name'];
                $comment_upicture = $result2['user_profile_picture'];
                $uimg = "res/profile-pictures/".$result2['user_profile_picture'];
                echo "
                <div class='single-comment'>
                  <div class='single-comment-pic-box'>
                      <img class='single-comment-pic' src='$uimg' />
                  </div>
                  <div class='single-comment-comment-box'>
                      <p><b>$comment_uname</b></p>
                      <p>  $comment_content</p>
                  </div>
                </div>
                ";

            }
             echo "
                <div style='padding-bottom: 10px;' >
                <center>
                <div style='float:left; width:80%; padding-left:50px;' >
                 <textarea id='add-comment-textarea'
                  style='
                  height:50px;
                  width:100%;
                  ' 
                  placeholder='Add text here...'>
                  </textarea>
                </div>
                <div style='float-left;'>
                  <button class='add-comment-button' onclick='addComment();'
                  style=
                  '
                  background-color:#4DB6AC;
                  color:white;
                  border:none;
                  width:250px;
                  height:50px;
                  font-size:17px;
                  hover: color:red;
                  '>ADD COMMENT</button>
                  </div>
                  </center>
                </div>
                ";

          }

?>
<html>
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
      <div id="<?php echo $current_user;?>" class='current_user_id'></div>
      <div id="<?php echo $post_id;?>" class='current_post_id'></div>
      <script type='text/javascript'>
        function addComment() {
                    $.ajax({
                              method: 'post',
                              url: 'writeComment.php',
                              data: {
                                'user': $(".current_user_id").attr('id'),
                                'comment-content':$("#add-comment-textarea").val(),
                                'post':$('.current_post_id').attr('id'),
                                'ajax': true
                              },
                              success: function(data) {
                                if(data){
                                    location.reload(true);
                                }
                              }
                        });  
        }
      </script>

    </body>
</html>
