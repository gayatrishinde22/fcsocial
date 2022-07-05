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

      <div class="wrapper-large">
  <div class="wrappercont moveleft">
    <div class="feed-head">
      <div class="feed-head-left">
        Feed
      </div>
      <div class="feed-head-right">
      <a href="createNewPost.php" style=' border-left: 1px solid #C4C4C4;padding:2px 10px;'>  Create new post</a>
      </div>
    </div>
    <!-- Posts repetitive code to be added into php , like and comment button functionality-->
    <!-- Image Post-->
    <?php
      $current_user = $_SESSION['user_id'];
      $query = "SELECT * from posts where user_id in (SELECT connected_with from userconnections where user_is=$current_user) ORDER BY post_date DESC,post_time DESC";
      $result = pg_query($query);
      while($row=pg_fetch_assoc($result)){
         //print_r($row);
          $user_id=$row['user_id'];
          $query="SELECT * FROM users WHERE user_id=$user_id";
          $user_data=pg_query($db,$query);
          $user_data=pg_fetch_assoc($user_data);
          $post_id=$row['post_id'];
           $post_content = $row['post_content'];
          $post_caption=$row['post_caption'];

          //print_r($user_data);

          //fetching user details
          $user_name=$user_data['user_name'];
          if($user_data['user_profile_picture']){
              $user_profile_picture=$user_data['user_profile_picture'];
          }
          else{
              $user_profile_picture='res/profile-pictures/profile-img.png';
          }
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
      }
    ?>
      <!--image post-->
      <!--
    <div class="post-full-body">
      <div class="post-body-head">
        <img class="post-body-head-pfp" src="res/profile-pictures/profile-img.png" />
        <h1 class="post-body-head-name">Name here</h1>
      </div>
      <div class="post-body-tail">
        <center>
          <img class="post-body-tail-img" src="res/profile-pictures/test-img.jpg" />
        </center>

        <div class="post-body-tail-btns">
          <button class="like-btn" type="button" name="button">sample button here</button>
          <button class="comment-btn" type="button" name="button">sample button here</button>
        </div>
      </div>
    </div>
-->
    <!-- Text post -->
    <!--
    <div class="post-full-body">
      <div class="post-body-head">
        <img class="post-body-head-pfp" src="res/profile-pictures/profile-img.png" />
        <h1 class="post-body-head-name">Name here</h1>
      </div>
      <div class="post-body-tail">
        <center>
          <textarea class="post-body-tail-text">sample text here</textarea>
        </center>

        <div class="post-body-tail-btns">
          <button class="like-btn" type="button" name="button">sample button here</button>
          <button class="comment-btn" type="button" name="button">sample button here</button>
        </div>
      </div>
    </div>
-->
    <!-- posts repetitive code end  -->

  </div>
  <div class="wrappercont moveright">
    <div class="suggest-head">
      <div class="suggest-head-left">
        Suggestions
      </div>
      <div class="suggest-head-right">
      <a href="suggestion.php" style=' border-left: 1px solid #C4C4C4;padding:2px 10px;'>  View all</a>
      </div>
    </div>
    <!-- suggestions repetitive code: complete-->
    <?php
      $sugg = array();
      function createSuggArray($result){
        while($row=pg_fetch_array($result)){
            $temp = $row[0];
            array_push($GLOBALS['sugg'],$temp);
         }
    }
      function display(){
          if(isset($GLOBALS['sugg']) && $GLOBALS['sugg']!=null){
              $query="SELECT * FROM users WHERE user_id IN (" . implode(',', $GLOBALS['sugg']) . ");";
          $result = pg_query($query);
          while($row=pg_fetch_assoc($result)){
               $user_name=$row['user_name'];
               $user_id=$row['user_id'];
               $user_profile_picture=$row['user_profile_picture'];

               if($user_profile_picture==NULL || $user_profile_picture==""){
                    $user_profile_picture='profile-img.png';
                }
                $new_with_ext='res/profile-pictures/'.$user_profile_picture;
                 echo "
                 <div class='suggest-content-body'>
                   <div class='suggest-content-body-left'>
                     <img class='suggest-content-body-left-img' src='$new_with_ext' id=$user_id onclick='viewProfile(this.id);' />
                   </div>
                   <div class='suggest-content-body-right'>
                     <div id=$user_id onclick='viewProfile(this.id);'>$user_name</div>
                   </div>
                 </div>
                ";
        }
          }
          else{
              echo "No suggestions";
          }
      }
        $current_user_id=$_SESSION['user_id'];
        //change the query for better suggestions
        $query="SELECT * FROM users WHERE dept_name=(SELECT dept_name FROM users WHERE user_id=$current_user_id)AND user_id!=$current_user_id AND user_id NOT IN(SELECT connected_with from userConnections where user_is=$current_user_id) LIMIT 5";
      
        $result=pg_query($db,$query);
        createSuggArray($result);
      
        //displays mutual friends
        $query="SELECT * FROM users WHERE user_id in(SELECT connected_with FROM userConnections where user_is IN(SELECT connected_with from userConnections where user_is=$current_user_id)  AND user_id!=$current_user_id) AND user_id!=$current_user_id";
        $result=(pg_query($db,$query));
        createSuggArray($result);
            
            
        $sugg = array_unique($sugg);
      
        display();
    ?>

    <!-- suggestions repetitive code end  -->
  </div>
</div>


<script type='text/javascript'>
function viewProfile(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          window.location.href='viewProfile.php?q='+str;
      }
    };
    xmlhttp.open("GET","viewProfile.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
    </body>
</html>
