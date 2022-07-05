<?php
require ('connection.php');
//my_file is the name for input tag in the form
//following if condition is checking if 'name' of current file exisits or name,
//this name is the name of file in user's computer
//print_r($_FILES);
if($_FILES['my_file']['error']!=0){
    echo "<script>alert('Please select an image!');window.location.href = \"profile.php\";</script>";
}
else if (($_FILES['my_file']['name']!="")){
// Where the file is going to be stored
//in our case the target dir is
// 'res\\profile-pictures\\'
 $target_dir = "res\\profile-pictures\\"; //setting the target dir
 $file = $_FILES['my_file']['name']; // getting file name
 $path = pathinfo($file); //complete path of source location
 $filename = $path['filename'];  //filename without extension
 $ext = $path['extension']; // extension of file
 $temp_name = $_FILES['my_file']['tmp_name']; //temporary name given to file by form
 $path_filename_ext = $target_dir.$filename.".".$ext; //path with filename and its extension
 //array of expected arrray extensions
    $exp_ext = array("png","jpg","jpeg");
    //checks if the selected file is an image or not
    if(in_array($ext,$exp_ext)){
        echo "<br>Given file is an image";
    }else{
        echo "<br>Please select an image";
    }
    //add all the part related to uploading the image in the if block i.e queries and their exeucution
    //maybe we can go to the page where we accept the image after executing the script
    //following if condition Checks if file already exists
    if (file_exists($path_filename_ext)) {
     echo "Sorry, file already exists.";
     }else{
        //this part is executed if the file is new
        //following function uploads the file to target dir
     move_uploaded_file($temp_name,$path_filename_ext); //move uploded file
     echo "Congratulations! File Uploaded Successfully.";
    //uploading the file in the desired directory

    //after uploading the file to target dir we need to insert that record in the table

    //inserting all other attributes other than the image name
    // it returns all the data in that row
    //in the case of posts we'll be inserting details(except image_name) like post-date,post-time,caption,etc
    $new_id=$_SESSION['user_id'];
    $old = "res\\profile-pictures\\".$filename.".".$ext;
    $new = "res\\profile-pictures\\".$new_id.".".$ext;
    //echo old name just to check if its correct,lol you can skip that echo statement
    echo $old;
    //example address can be 'res\\profile-pictures\\12.png'
    $new_with_ext= $new_id.".".$ext;
    //renaming the file
    rename($old,$new);
    //inserting the image in the database with its name
    $query = "UPDATE users SET user_profile_picture='$new_with_ext' WHERE user_id=$new_id";
    $result= pg_query($db, $query);
    pg_close($db);
    //image can be accessed like this
    //here $new_with_ext is just the image_name where image_id is current image_id
    header("Location:profile.php");
 }
}
?>
