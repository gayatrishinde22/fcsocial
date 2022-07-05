<?php
    $db=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=preethy1970") or die('connection failed');
    $insertUser="INSERT INTO Users(user_name, user_password, user_bio,user_email) VALUES('Mike Rockatansky','1234567890','Hey there!','mike.r@gmail.com')";
    pg_query($insertUser);
?>
