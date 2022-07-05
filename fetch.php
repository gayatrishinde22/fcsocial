<?php
        //fetch.php
       require('connection.php');
        $output = '<table>';
        $current_user=$_SESSION['user_id'];
        if(isset($_POST["query"]))
        {
         $user_name=$_POST['query'];
          echo "
            <script>
                console.log($user_name);
            </script>
          ";
          $query="SELECT * FROM users WHERE user_name LIKE '%".$user_name."%' AND user_id!=$current_user";
           
          $result =pg_query($query);
             while($row = pg_fetch_assoc($result))
             {
//                 print_r($row);
                   $name = $row['user_name'];
                   $user_id=$row['user_id'];
                   $position=$row['user_position'];
                    $output .= "
                       <tr class='search-row' id='$user_id' onclick=window.location.href='viewProfile.php?q='+this.id;>
                        <td id='$user_id'>$name  $position</td>
                       </tr>
                    ";
             }
             echo $output."</table>";
        }
?>