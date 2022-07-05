<?php
    require ('connection.php');
?>
<html>
 <head>
	    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
        <link rel="stylesheet" href="styles.css">
    <title>
		Begin your journey with us!
	</title>
 </head>
 <body>
        <div id="header">
          <div id="header-left">
              <div id="header-left-first">
                  <h1>FC Social media</h1>
              </div>
              <div id="header-left-second">
                  <p>FC college nahi FC bolo!</p>
              </div>
          </div>
        </div>
        <div class="container">
        <div class="img-container"><img id="gif-img" src="https://media.giphy.com/media/IhDjGtQLzpxLETw2Jc/giphy.gif"></div>
            <div class="form-container">
                <h1 class="sign-up-header">SIGN UP</h1>
                <form method="post" action="signUp.php">
			        <center>
                        <input id="submit-form" name="name1" placeholder="Name" type="text" required></input>
                        <input id="submit-form" name="email" placeholder="Email id" type="email"></input>
                        <input id="submit-form" name="phoneNumber" placeholder="Phone Number" type="tel"></input>
			                  <input id="submit-form" name="password" placeholder="Password" type="password"></input><br>
                        <input id="submit-form" name="confirmpassword" placeholder="Confirm password" type="password"></input>
                        <br>
                        <input name="usertype" type="radio" value="0">&nbsp; &nbsp; Student &nbsp;</input>&nbsp;<input name="usertype" type="radio" value="1">&nbsp; &nbsp; Faculty &nbsp;</input>&nbsp;<input name="usertype" type="radio" value="2">&nbsp; &nbsp; Alumni &nbsp;</input>
                        
                        <br><br>
                        <input id="submit-btn" type="submit" name="signup"  value="Sign Up"></input>
                        <br><br>
                        <a href="index.php">Already have an account?</a>

			        </center>
		        </form>
            </div>
        </div>
</body>

<!-- User table creation: CREATE TABLE users(user_id serial PRIMARY KEY, user_name varchar(20), user_password varchar(20), user_phone char(10), user_bio varchar(20), dept_name int, user_profile_picture text, user_email varchar(20), user_type int, class varchar(20), position varchar(20), passout_year int); -->
<!-- Password_hash used to encrypt passwords, and all details are saved into users table -->
<?php
    unset($res);
    if (isset($_POST["email"])) {
    unset($res);
   // $db=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=preethy1970");
    $hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
    //echo $hash;
    $email = $_POST['email'];
    $checkQuery  = "SELECT user_id FROM users WHERE user_email='$email'";
    $res = pg_fetch_array(pg_query($checkQuery));
    if(isset($res[0])){
        echo '<script>alert("User with same email if already exists.")</script>';
    }else if(strcmp($_POST['password'],$_POST['confirmpassword'])!=0)    {
        echo '<script>alert("Both password fields are not matching!")</script>';
    }
    else{
        $query = "INSERT INTO users(user_name,user_password,user_email,user_phone,user_type,user_bio,user_profile_picture) VALUES('$_POST[name1]','$hash','$_POST[email]','$_POST[phoneNumber]','$_POST[usertype]','Hey there! I am on FC Social','profile-img.png') RETURNING user_id";
        // to set session variable
        $result=pg_fetch_array(pg_query($query));
        // set session variable
        $_SESSION['user_id']=$result['user_id'];
        echo "Sessio variabl set ".$_SESSION['user_id'];
        header("Location:editProfile.php");
    }
    unset($res);
  }
?>
