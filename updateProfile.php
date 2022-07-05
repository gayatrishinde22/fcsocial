<?php
    require('connection.php');  
    print_r($_POST);
    $user_name=$_POST['user_name'];
    $user_type=$_POST['user-type'];
    $user_bio=$_POST['user_bio'];
    $dept_name=$_POST['dept_name'];
    $phone_number=$_POST['phone_number'];
    $user_type_details=$_POST['user-type-details']; 
    $user_class="";
    $user_passout_year="";
    $user_position="";
    $error="";
    
    if(!isset($user_name)){
        $error='Name cannot be empty!'.'<br>';
     }
    if(!isset($user_bio)){
        $error='Bio cannot be empty!Setting it to default value';
        $user_bio="Hey there!I am on FC Social!";
    }
    if($user_type=="Select user type"){
        $error='Please select user type'.'<br>';
    }
    if($dept_name=="Select your department"){
        $error="Please select your department";
    }
    if(!isset($phone_number)||strlen($phone_number)!=10){
        $error="Invalid Phone Number"."<br>";
    }
    if(!isset($user_type_details)){
        switch($user_type){
            case "Faculty":
                $error="Please enter your position".'<br>';
                break;
            case "Alumni":
                $error="Please enter your academic years"."<br>";
                break;
            case "Student":
                $error="Please enter your class"."<br>";
                break;
        }
    }

    if($error==""){
        echo "<br>No errors";
        switch($user_type){
            case "Student":
                $user_class=$user_type_details;
                $user_type=0;
                break;
            case "Faculty":
                $user_position=$user_type_details;
                $user_type=1;
                break;
            case "Alumni":
                $user_passout_year=$user_type_details;
                $user_type=2;
                break;
        }
        echo $user_type;
        $user_id=$_SESSION['user_id'];
        $query1="UPDATE users SET user_name='$user_name',user_type=$user_type,user_bio='$user_bio',dept_name='$dept_name',user_phone='$phone_number',user_class='$user_class',user_position='$user_position',user_passout_year='$user_passout_year' WHERE user_id=$user_id";
       $result=pg_fetch_array(pg_query($db,$query1));
        print_r($result);
       if($result==0){
            header("Location:profile.php");
        }
    }
?>