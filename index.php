<?php
    require('connection.php');

?>
<html>
    <head>
        <title>Hey! Fergussonian..</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>

<!-- First Section, header and login block -->
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
        <div class="clear"></div>
        <div id="first-section">
           <div id="first-section-left">
               <div id="first-section-left-title">
                   <h1>Some catchy title</h1>
               </div>
               <div id="first-section-left-content">
                   <p>One line about our website and its purpose.</p>
               </div>
               <div id="first-section-left-small-content">
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sagittis commodo nisi, a egestas risus laoreet eget. Mauris eu odio ut sem porttitor euismod in eget est. Curabitur bibendum pulvinar augue nec sagittis. Quisque posuere gravida neque a pharetra. Duis lacinia porta libero, at cursus elit aliquet sed. Phasellus ac placerat nibh.
                   </p>
               </div>
           </div>
            <div id="first-section-right">
                <h1>Log In</h1>
                <br>
                <form action="index.php" method="post">
                    <input type="text" placeholder="Email Id" id="email" name="email"/>
                    <br>
                    <input type="password" placeholder="Password" id="password" name="password"/>
                    <br>
                    <center><input type="submit" id="log-in-button" class="intro-button" value="Submit"/></center>
                </form>
                <center><button id="sign-up-button" class="intro-button" onclick="window.location.href='signUp.php'">New user? Sign Up</button></center>
            </div>
        </div>
<!-- Check if fields are set, then execute script 
Using password_verify, extract the password and check if it is the same. If password is valid, then start session and redirect to user userFeed
To be added: if password/email is incorrect -->
        
        <!-- End of first section -->

<!-- Second section, features block -->
        <!-- Creating a div that acts as a row and dividing it into 3 columns so that an icon can be placed in each column -->
        <div class="row">
            <div class="column">
                <center>
                <i class="fas fa-hands-helping fa-5x"></i>
                <p class="desc">STAY CONNECTED</p>
                </center>
            </div>
            <div class="column">
                <center>
                <i class="fas fa-bell fa-5x "></i>
                <p class="desc">GET NOTIFIED</p>
                </center>
            </div>
            <div class="column">
                <center>
                <i class="fas fa-users fa-5x"></i>
                <p class="desc">COMMON PLATFORM</p>
                </center>
            </div>
          </div>
<!-- End of second section -->

<!-- Third section, image carousel -->
        <div class="clear"></div>
        <div id="second-section">
          <div class="slideshow-container">

            <div class="mySlides fade">
              <div class="numbertext">1 / 3</div>
              <center><img src="res/img1.jpg" style="width:100%;height:auto;"></center>
              <div class="text"><p>Want to keep yourself updated about different activities and events happening around the campus?<br>Don't worry we'll help you to improve your connections all over the campus.</p></div>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">2 / 3</div>
              <center><img src="res/img2.jpg" style="width:100%;height:auto;"></center>
              <div class="text">You'll get a platform to showcase your talent and post about your acheivements.</div>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">3 / 3</div>
              <center><img src="res/img3.jpg" style="width:100%;height:auto;"></center>
              <div class="text">Presenting you a platform where students, faculty and almni can interact with each other.</div>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
            <br>

            <div style="text-align:center">
              <span class="dot" onclick="currentSlide(1)"></span>
              <span class="dot" onclick="currentSlide(2)"></span>
              <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
<!-- End of third section -->

        <!-- Fourth section, creator block -->
                <div id="creator-section">
                  <h1 class="creator-heading">Meet the creators</h1>
                  <table class="creator-table">
                    <tr>
                      <td>
                        <img class="creator-img" src="res/pink.gif" alt="powerpuff-pink">
                        <p class="creator-text">Nidhi</p>
                      </td>
                      <td>
                        <img class="creator-img" src="res/blue.gif" alt="powerpuff-blue">
                        <p class="creator-text">Amita</p>
                      </td>
                      <td>
                        <img class="creator-img" src="res/green.gif" alt="powerpuff-green">
                        <p class="creator-text">Gayatri</p>
                      </td>
                    </tr>
                  </table>
                </div>
        <!-- End of fourth section -->


        <script type="text/javascript">
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
          showSlides(slideIndex += n);
        }

        function currentSlide(n) {
          showSlides(slideIndex = n);
        }

        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
           }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
           }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
        }

        </script>
        <script type='text/javascript'>
        
            $("#log-in-button").click(function(){
                if($("#email").val().length==0 || $("#password").val().length==0){
                    alert("Please fill both the fields!");
                }
                else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($("#email").val()))
                {
                    $.ajax({
                              method: 'post',
                              url: 'login.php',
                              data: {
                                'email': $("#email").val(),
                                'password':$("#password").val(),
                                'ajax': true
                              },
                              success: function(data) {
                                data = parseInt(data.substr(data.length-1));                   
                                switch(data){
                                    case 1:
                                        alert("No such account exists!");
                                        break;
                                    case 2:
                                        alert("valid credentials, Logging in");
                                        window.location.href="userFeed.php";
                                        break;
                                    case 3:
                                        alert("Invalid password!");
                                        break;
                                    default:
                                        alert("something went wrong!");
                                        break;

                                }
                              }
                        });  
                }
                else{
                    alert("You have entered an invalid email address!");   
                }
            });
        
        </script>
    </body>
</html>
