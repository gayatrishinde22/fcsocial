<?php
    require('header.php');
?>
<html>
    <head>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Questrial'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
        <link rel='stylesheet' href='styles.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    </head>
    <body>
  <!-- Tasks styling for all tasks   -->
        <div class='page-title'>
                Tasks
        </div>
        <div class='clear'></div>
        <div class='task-main-div' id='create-task-div'>
            <form name='create-task-form' action='create-task.php' method='post'>
                <input type='text' name='task-title' id='task-title' placeholder='Task Title' class='create-task-text-input' required>
                <div class='left-no-border'>From date :</div>
                <input type='date' name='task-from-date' id='task-from-date' class='create-task-text-input task-date' placeholder='From date' required>
                <div class='left-no-border'>To date :</div>
                <input type='date' name='task-to-date' id='task-to-date' class='create-task-text-input task-date' placeholder='To date' required>
                <div class='clear'></div>
                <textarea type='text' name='task-des' class='create-task-text-input' placeholder='Task Description' id='task-des'></textarea>
                <input type='submit' id='task-submit' name='submit-task' value="Create Task">
            </form>
        </div>
<!-- Get all saved tasks, and then display them using php   -->
        <?php
            $user_id = $_SESSION['user_id'];
            //getting total number of tasks assigned to current user
            $query = "SELECT COUNT(*) FROM tasks WHERE user_id=$user_id";
            $result = pg_query($query);
            $result= pg_fetch_array($result);
            $n=$result['count'];
            $query = "SELECT * FROM tasks WHERE user_id=$user_id";
            $result = pg_query($query);

            while($row=pg_fetch_assoc($result)){
                $task_id=$row['task_id'];
                $task_title=$row['task_title'];
                $task_description=$row['task_description'];
                $task_from_date = $row['task_start'];
                $task_to_date = $row['task_end'];
                if($row['task_validity']=='t'){
                    $task_status="Not Completed";
                }
                else{
                    $task_status="Completed";
                }
                if($task_status=="Not Completed"){
                     echo "
            <div class='existing-task-main-div existing-task'>
            <div class='exisiting-task-title'>$task_title</div>
            <div class='existing-task-date'>Task starts on : $task_from_date</div>
            <div class='clear'></div>
            <div class='existing-task-description'>$task_description</div>
            <div class='existing-task-date'>Task ends on : $task_to_date</div>
            <div class='clear'></div>
            <div class='existing-task-status'>Task Status : $task_status</div>
            <div class='existing-task-buttons'>
                <button class='existing-task-button edit' id='$task_id' onclick='editTask(this.id)'>Edit Task</button>
                <button class='existing-task-button complete' id='$task_id' onclick='completeTask(this.id)'>Complete Task</button>
            </div>
        </div>
        ";
                }
            }
        ?>
  <!-- Script to execute edit tasks       -->
        <script type='text/javascript'>
        function editTask(str) {
          if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
          } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  window.location.href='editTask.php?q='+str;
              }
            };
            xmlhttp.open("GET","editTask.php?q="+str,true);
            xmlhttp.send();
          }
        }
          function completeTask(str) {
          if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
          } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  window.location.href='completeTask.php?q='+str;
              }
            };
            xmlhttp.open("GET","completeTask.php?q="+str,true);
            xmlhttp.send();
          }
        }
        </script>
    </body>
</html>
