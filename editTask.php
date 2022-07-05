<?php
//edit task page updated
//changes to be made
//add limit for characters on task des and title
    require('header.php');
    $task_id=intval($_GET['q']);
    echo $task_id;
    $query="SELECT * FROM tasks WHERE task_id=$task_id";
    $result=pg_query($db,$query);
    $result=pg_fetch_array($result);
    //print_r($result);
    $task_title=$result['task_title'];
    $task_des=$result['task_description'];
    $task_from_date=$result['task_start'];
    $task_to_date=$result['task_end'];
    //echo $task_des;
?>
<html>
    <head>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Questrial'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
        <link rel='stylesheet' href='styles.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    </head>
    <body>
        <div class='page-title'>
                Edit Task
        </div>
        <div class='clear'></div>
        <div class='task-main-div' id='create-task-div'>
            <form name='create-task-form' action='updateTask.php' method='post'>
                <input type='text' name='task-title' id='task-title' placeholder='Task Title' class='create-task-text-input' value ='<?php echo $task_title ; ?>' required>
                <div class='left-no-border'>From date :</div>
                <input type='date' name='task-from-date' id='task-from-date' class='create-task-text-input task-date' placeholder='From date' required value =<?php echo $task_from_date;?>>
                <div class='left-no-border'>To date :</div>
                <input type='date' name='task-to-date' id='task-to-date' class='create-task-text-input task-date' placeholder='To date' value =<?php echo $task_to_date;?> required>
                <div class='clear'></div>
                <textarea type='text' name='task-des' class='create-task-text-input' maxlength='30' value='<?php echo $task_des ;?>' placeholder='Task Description' id='task-des'><?php echo $task_des ;?></textarea>
                <input type='hidden' value='<?php echo $task_id?>' name='task-id'>
                <input type='submit' id='task-submit' name='submit-task' value="Update task">
            </form>
</div>
    </body>
</html>