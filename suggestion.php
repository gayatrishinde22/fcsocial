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
                Suggestions
        </div>
        <div class='clear'></div>
        <div class='suggestions-main-div'>
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
                           $query="SELECT * FROM users WHERE user_id IN (" . implode(',', $GLOBALS['sugg']) . ")";
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
                        <div class='suggestions-box'>
                            <img class='suggestions-profile-picture' src='$new_with_ext' id=$user_id onclick='viewProfile(this.id);'></img>
                            <div class='suggestions-user-name' id=$user_id onclick='viewProfile(this.id);'>$user_name</div>
                        </div>
                        ";
                }
                    }
                  else{
                      echo "No Suggestions!";
                  }
                }
                $current_user_id=$_SESSION['user_id'];
                //change the query for better suggestions
                //displays users from the same department
                $query="SELECT * FROM users WHERE dept_name=(SELECT dept_name FROM users WHERE user_id=$current_user_id)AND user_id!=$current_user_id AND user_id NOT IN(SELECT connected_with from userConnections where user_is=$current_user_id);";
                $result=pg_query($db,$query);
                createSuggArray($result);
                
                //displays mutual friends
                $query="SELECT * FROM users WHERE user_id in(SELECT connected_with FROM userConnections where user_is IN(SELECT connected_with from userConnections where user_is=$current_user_id)  AND user_id!=$current_user_id) AND user_id!=$current_user_id";
                $result=(pg_query($db,$query));
                createSuggArray($result);
            
                //You can add your queries here 
            
                $sugg = array_unique($sugg);
                //DISPLAYING ALL COLLECTTIVE LIST WITH UNIQUE ELEMENTS
                display();
                
            ?>
        </div>
      <!-- To view suggestion people pages, go to viewProfile -->
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
