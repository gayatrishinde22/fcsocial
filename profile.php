<?php
    require('header.php');
?>

<html>
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class='page-title'>
                Your Profile
        </div>
        <div class='clear'></div>
        <?php     
            $user_id=$_SESSION['user_id'];
            $query="SELECT * FROM users WHERE user_id=$user_id";
            $result=pg_fetch_array(pg_query($db,$query));
            $user_name=$result['user_name'];
            $user_bio=$result['user_bio'];
            $dept_name=$result['dept_name'];
            $user_type=$result['user_type'];
            switch($user_type){
                case 0:
                    $user_type='Student';
                      $user_details='Class : '.$result['user_class'];
                    break;
                case 1:
                    $user_type='Faculty';
                     $user_details='Designation :'.$result['user_position'];
                    break;
                case 2:
                    $user_type='Alumni';
                     $user_details='Academic years : '.$result['user_passout_year'];
                    break;
            }
            $user_profile_picture=$result['user_profile_picture'];
            if($user_profile_picture==NULL || $user_profile_picture==""){
                $user_profile_picture='profile-img.png';
            }
            $new_with_ext='res/profile-pictures/'.$user_profile_picture;
            echo "
                <div id='profile-test-main'>
                    <div id='profile-test-left'>
                        <div id='profile-test-data'>
                            <div id='profile-test-name-details'>
                            <p id='profile-test-name'>
                                $user_name
                            </p>
                            <p id='profile-test-details'>
                                $user_details
                            </p>
                        </div>
                        <div class='clear'></div>
                        <p id='profile-test-type'>
                            $user_type at Department of $dept_name
                        </p>
                        <p id='profile-test-user-bio'>
                            $user_bio
                        </p>
                        </div>
                        <div id='profile-test-buttons'>
                            <a id='profile-test-edit-profile' class='profile-test-button' href='editProfile.php'>
                                Edit Profile
                            </a>
                            
                            <form method='post' id='change-profile-picture-form' action='change-profile-picture.php' enctype='multipart/form-data'>
                                <input type='file' accept='image/*' name='my_file' id='new-profile-picture'/>
                                <input type='submit' id='profile-test-profile-picture' class='profile-test-button' value='Update Profile Picture'/>
                            </form>
                        </div>
                    </div>
                    <div id='profile-test-right'>
                        <img id='profile-test-img' src='$new_with_ext'>
                    </div>
                </div>
            ";
        ?>
        <div class='clear'></div>
        <?php
            $query = "SELECT * FROM posts WHERE user_id=$user_id";
            $post_data = pg_query($query);
            while($row=pg_fetch_assoc($post_data)){
                  $user_id=$row['user_id'];
                  $query="SELECT * FROM users WHERE user_id=$user_id";
                  $user_data=pg_query($db,$query);
                  $user_data=pg_fetch_assoc($user_data);
                   $post_content = $row['post_content'];
                  $post_caption=$row['post_caption'];
                  $post_id = $row['post_id'];
                  //print_r($user_data);

                  //fetching user details
                  $user_name=$user_data['user_name'];
                  if($user_data['user_profile_picture']){
                      $user_profile_picture=$user_data['user_profile_picture'];
                  }
                  else{
                      $user_profile_picture='res/profile-pictures/profile-img.png';
                  }
                echo "<center>";
                  if($row['post_type']==1){
              //image type post
              //add style to post caption
              echo "
            
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

                              <a class='comment-btn' type='button' href='commentsOnPost.php?q=$post_id' name=button'>Comments</a>
                            </div>
                          </div>
                    </div>

              ";
          }else{
              //text type post

              echo "

                <div class='post-full-body'>
                  <div class='post-body-head'>
                    <img class='post-body-head-pfp' src='res/profile-pictures/profile-img.png' />
                    <h1 class='post-body-head-name' onclick=window.location.href='viewProfile.php?q=$user_id';>$user_name</h1>
                  </div>
                  <div class='post-body-tail'>
                      <p class='post-body-tail-text'>$post_content</p>
                    <div class='post-body-tail-btns'>

                      <a class='comment-btn' type='button' href='commentsOnPost.php?q=$post_id' name='button'>Comments</a>
                    </div>
                  </div>
                </div>

              ";

          }
                echo "</center>";
            }
        ?>
    </body>
</html>