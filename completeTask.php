<!-- Update task validity field to false -->
<!-- To be added: If we want to show both ongoing and completed task, then formatting will have to be changed -->
<?php
    require('connection.php');
    $task_id=intval($_GET['q']);
    echo "$task_id";
    $query="UPDATE tasks SET task_validity='f' WHERE task_id=$task_id";
    pg_query($db,$query);
    header("Location:tasks.php");
?>
