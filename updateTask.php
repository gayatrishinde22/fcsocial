<?php
    require('connection.php');
    // Check if all things are set, check if dates are okay.
    // To be added: display error properly
    $task_id=$_POST['task-id'];
    if(isset($_POST['task-title'])!=NULL && isset($_POST['task-from-date'])!=NULL && isset($_POST['task-to-date'])!=NULL){
        echo $_POST['task-title'].", ".$_POST['task-des']." , ".$_POST['task-from-date'].", ".$_POST['task-to-date'];
      if($_POST['task-from-date'] > $_POST['task-to-date'] ){
            echo "
                <script>
                    alert('Please check the dates');
                    window.location.href = \"editTask.php?q=$task_id\";
                </script>
            ";
        }
        else{
            echo "Vaild date";
            $task_id=$_POST['task-id'];
            $task_title=$_POST['task-title'];
            $task_des=$_POST['task-des'];
            $task_from_date=$_POST['task-from-date'];
            $task_to_date=$_POST['task-to-date'];
            $user_id=$_SESSION['user_id'];
            echo $task_des;
            $query="UPDATE tasks SET task_title='$task_title',task_description='$task_des',task_start='$task_from_date',task_end='$task_to_date' WHERE task_id=$task_id";
            $result=pg_query($db,$query);
            $result=pg_fetch_array($result);
            print_r($result);
            // Redirect to tasks page
            header("Location:tasks.php");
        }
    }
?>
