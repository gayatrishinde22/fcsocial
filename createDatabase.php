<?php
    require(connection.php);
    $query1= "CREATE TABLE IF NOT EXISTS  Users (user_id SERIAL primary key, user_name varchar, user_password text, user_profile_picture text, user_bio text, user_phone varchar(10), user_email varchar unique, user_type integer, user_position varchar, user_class varchar, user_passout_year varchar, dept_name varchar)";
    $query2 ="CREATE TABLE IF NOT EXISTS  Posts (post_id SERIAL primary key, post_content text, post_type integer, post_caption text, post_likes integer, post_date date, post_time time, user_id integer references Users(user_id))";
    $query3="CREATE TABLE IF NOT EXISTS Tasks (task_id SERIAL primary key, task_title varchar, task_description varchar, task_validity boolean, task_start date, task_end date, user_id integer references Users(user_id))";
    $query4="CREATE TABLE IF NOT EXISTS UserConnections(user_is integer references Users(user_id), connected_with integer references Users(user_id))";
    $query5="CREATE TABLE IF NOT EXISTS Comments (comment_id SERIAL primary key, comment_content text, comment_date date, comment_time time, user_id integer references Users(user_id), post_id integer references Posts(post_id))";
    
    pg_query($query1);
    pg_query($query2);
    pg_query($query3);
    pg_query($query4);
    pg_query($query5);

    
?>