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
                Edit Your Profile
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
            $user_phone_number=$result['user_phone'];
            $user_class="";
            $user_passout_year="";
            $user_position="";
            switch($user_type){
                case 0:
                    $user_class=$result['user_class'];
                    break;
                case 1:
                    $user_position=$result['user_position'];
                    break;
                case 2:
                    $user_passout_year=$result['user_passout_year'];
                    break;
            }
            switch($user_type){
                case 0:
                    $user_type='Student';
                    break;
                case 1:
                    $user_type='Faculty';
                    break;
                case 2:
                    $user_type='Alumni';
                    break;
            }
            $user_profile_picture=$result['user_profile_picture'];
            if($user_profile_picture==NULL || $user_profile_picture==""){
                $user_profile_picture='profile-img.png';
            }
            $new_with_ext='res/profile-pictures/'.$user_profile_picture;
            ?>
        <div class='clear'></div>
        <?php
            $dept_array = array('Select your department','Marathi','Hindi','Economics','English','French','Geography','German','Gymkhana','History','Philosophy','Political Science','Psychology','Sanskrit','Sociology','Digital Art and Animation','Media and Communication','Animation','Biotechnology','Botony','Chemistry','Computer Science','Electronics Science','Environmental Science','Geology','Mathematics','Microbiology','Photography','Physics','Statistics','Zoology');
            $user_type_array=array('Select user type','Student','Faculty','Alumni');
            echo "
                <form action='updateProfile.php' method='POST' id='editProfileForm'>
                    <input type='text' id='edit-profile-name' placeholder='Your Name' name='user_name' value='$user_name' required/>
                    <select id='user-type' name='user-type'>";
            foreach($user_type_array as $type){
                        if($type==$user_type){
                            $statement = "<option id='$type' name='$type' selected>$type</option>";
                        }
                        else{
                             $statement = "<option id='$type' name='$type'>$type</option>";
                        }
                        echo $statement;
                    }   
            echo "
                 </select>
                    <textarea id='edit-profile-bio' placeholder='Your bio' name='user_bio'>$user_bio</textarea>
                     <select id='dept-name' name='dept name'>";
                    foreach($dept_array as $dept){
                        if($dept==$dept_name){
                            $statement = "<option id='$dept' name='$dept' selected>$dept</option>";
                        }
                        else{
                             $statement = "<option id='$dept' name='$dept'>$dept</option>";
                        }
                        echo $statement;
                    }   
            echo " 
                     </select>
                    <input type='text' id='edit-phone-number' placeholder='Your phone number' name='phone_number' value='$user_phone_number'/>";
    
            switch($user_type){
                case 0:
                    echo "<input type='text' placeholder='Your Class  Eg. SYBSC B' id='user-class' value='$user_class' class='user-type-details' name='user-type-details'/>";
                    break;
                case 1:
                    echo "<input type='text' placeholder='Your Position Eg. Assistant Prof.' id='user-position' value='$user_position' class='user-type-details' name='user-type-details'/>";
                    break;
                case 2:
                    echo "<input type='text' placeholder='Your academic year  Eg. 2015-2020' id='user-passout-year' value='$user_passout_year' class='user-type-details' name='user-type-details'/>";
                    break;
            }
            echo"
                    <br>
                   <input type='submit' id='submit-edit-form'/>
                </form>
            ";
        ?>
    </body>
    <script type='text/javascript'>
        $( "#user-type" ).change(function() {
          //alert( "Handler for .change() called."+this.value);
            $("#user-class").remove();
            $("#user-position").remove();
            $("#user-passout-year").remove();
            $("#submit-edit-form").remove();
            switch($(this).val()){
                case "Faculty":
                    $("<input type='text'/>")
                     .attr("id","user-position")
                     .attr("class","user-type-details")
                     .attr("placeholder","Your Position Eg. Assistant Prof.")
                     .attr("value","<?php echo $user_position;?>")
                     .attr("name","user-type-details")
                     .appendTo("#editProfileForm");
                    break;
                case "Student":
                    $("<input type='text'/>")
                     .attr("id","user-class")
                     .attr("class","user-type-details")
                     .attr("placeholder","Your Class  Eg. SYBSC B")
                     .attr("name","user-type-details")
                     .attr("value","<?php echo $user_class;?>")
                     .appendTo("#editProfileForm");
                    break;
                case "Alumni":
                    $("<input type='text'/>")
                     .attr("id","user-passout-year")
                     .attr("class","user-type-details")
                     .attr("value","<?php echo $user_passout_year;?>")
                     .attr("name","user-type-details")
                     .attr("placeholder","Your academic year  Eg. 2015-2020")
                     .appendTo("#editProfileForm");
                    break;
            }
             $("<input type='submit'/>")
             .attr("id","submit-edit-form")
             .appendTo("#editProfileForm");
        });
    
    </script>
</html>
      