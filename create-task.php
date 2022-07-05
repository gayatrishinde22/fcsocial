<?php
    require('connection.php');
    if(isset($_POST['task-title'])!=NULL && isset($_POST['task-from-date'])!=NULL && isset($_POST['task-to-date'])!=NULL){
        //echo $_POST['task-title'].", ".$_POST['task-des']." , ".$_POST['task-from-date'].", ".$_POST['task-to-date'];
        if($_POST['task-from-date'] > $_POST['task-to-date'] ){
            echo "
                <script>
                    alert('Please check the dates');
                    window.location.href = \"tasks.php\";
                </script>
            ";
        }
        else{
           // echo "Vaild date";
            $task_title=$_POST['task-title'];
            $task_des=$_POST['task-des'];
            $task_from_date=$_POST['task-from-date'];
            $task_to_date=$_POST['task-to-date'];
            $user_id=$_SESSION['user_id'];
            $query="INSERT INTO tasks(task_title,task_description,task_validity,task_start,task_end,user_id) VALUES('$task_title','$task_des','TRUE','$task_from_date','$task_to_date',$user_id) RETURNING *";
            $result=pg_query($db,$query);
            $result=pg_fetch_array($result);
            print_r($result);
            header("Location:tasks.php");
        }
    }
?>