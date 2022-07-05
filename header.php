<?php
    require('connection.php');
?>
<html>
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            #search-box{
                margin-left: 35%;
                position: absolute;
                top: 20px;
                width: 40%;
            }
            #search_text{
                border:1px solid white;
                background-color: #EEEEEE;
            }
            #search-result{
                background-color: #EEEEEE;
                display: inline-block;
                margin-left: 11px;
                width: 90%;
                position: absolute;
                top:56px;
                border: 2px solid #666666;
                border-radius: 8px;
                z-index:1;
            }
            #search-result table{
                 padding: 10px;
                 background: #EEEEEE;
                 width: 100%;
                 
            }
           tr
            {
              border: 5px solid #666666;
                width: 100%;
            }
            td
            {
              background: #EEEEEE;
              padding: 10px 0;
              border-bottom: 1px solid #666666;
              width: 100%;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){

             load_data();

             function load_data(query)
             {
              $.ajax({
               url:"fetch.php",
               method:"POST",
               data:{query:query},
               success:function(data)
               {
                $('#search-result').html(data);
               }
              });
             }
             $('#search_text').keyup(function(){
              var search = $(this).val();
              if(search != '')
              {
               load_data(search);
              }
              else
              {
               load_data();
              }
             });
            });
        </script>
    </head>
    <body>
<!-- To check if user is logged in -->
    <?php
        if(!isset($_SESSION['user_id'])){
            header("Location:index.php");
        }
  //header
    echo "
        <div id='header'>
          <div id='header-left'>
              <div id='header-left-first'>
                  <h1>FC Social media</h1>
              </div>
              <div id='header-left-second'>
                  <p>FC college nahi FC bolo!</p>
              </div>
          </div>
          <div class='clear'></div>
          <div id='search-box'>
            <div class='form-group'>
                <div class='input-group'>
                 <input type='text' name='search_text' id='search_text' placeholder='Search by name' class='form-control' />
                </div>
               </div>
               <div id='search-result'></div>
            </div>
          </div>
        </div>
        <div id='nav-bar'>
           <div id='nav-bar-userfeed' class='nav-bar-box left'>
                <a href='userFeed.php'>User Feed</a>
           </div>
           <div id='nav-bar-suggestions' class='nav-bar-box left'>
                <a href='suggestion.php'>Suggestions</a>
           </div>
           <div id='nav-bar-tasks' class='nav-bar-box left'>
                <a href='tasks.php'>Tasks</a>
           </div>
           <div id='nav-bar-logout' class='nav-bar-box right'>
                <a href='logout.php'>Logout</a>
           </div>
           <div id='nav-bar-profile' class='nav-bar-box right'>
               <a href='profile.php'>Profile</a>
           </div>
        </div>";
        //echo $_SESSION['user_id'];
      ?>
    </body>
</html>
