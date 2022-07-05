<?php
    require('header.php');
?>
<html>
    <head>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Questrial'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
        <link rel='stylesheet' href='styles.css'>
        <style>
        .hide{
            display:none;
        }

        .img-container{
            height:350px;
            width:30%;
            background-color:#EFEFEF;
            margin-top:0px;
            margin-left:130px;
        }

        .image-post-div{
            float:left;
        }


        input[type="file"] {
             display: none;
        }

        .custom-file-upload {
            /* text-align:center;
            margin-left:650px;
            margin-top:2px; */
            font-size:20px;
            width:370px;
            border:1px solid #4DB6AC;
            color: #4DB6AC;
            background-color: #FFFFFF;
            display: inline-block;
            padding: 15px 12px;
            cursor: pointer;
            text-align:center;
            border-radius:10px;
        }

        .custom-file-upload:hover{
            background-color:#4DB6AC;
            color:#FFFFFF;
        }

        .caption-container{
            float:left;
            margin-left:50px;
            width: 50%;
            height: 180px;
        }

        .caption-container>textarea{
            width:90%;
            height:195%;
            background-color: #EFEFEF;
            resize: none;
            padding: 10px 15px;
            border: 1px solid #cccccc;
            border-radius: 10px;
        }

        .image-post-submit-button{
            width:90%;
            margin-top:0px;
            height:35px;
            font-size:20px;
            color: #FFFFFF;
            background-color: #4DB6AC;
            border:1px solid #4DB6AC;
            border-radius:10px;

        }

        .image-post-submit-button:hover{
            background-color:#FFFFFF;
            color:#4BB6AC;
            cursor:pointer;
        }


        </style>
    </head>
    <body>
        <div class='page-title'>
                Create Post
        </div>
        <div class='clear'></div>
        <div id='post-type'>
            <div id='post-type-title'>
                Post type :  &nbsp;
                <input type="radio" name="tab" value="text-type" onclick="show1();" />
                    Text

                &nbsp;

                <input type="radio" name="tab" value="image-type" class="image-toggle" onclick="show2();" />
                    Image
            </div>
        </div>
        <div id='text-post-div' class="hide">
            <form action="uploadTextPost.php" method="POST"  enctype="multipart/form-data" >
                <div id='text-post-textbox'>
                    <textarea name="text-post" id='text-post-textbox-textarea' placeholder='Start typing...'></textarea>
                </div>
                    <input type="submit" value="Submit" id='text-post-submit-button'/>
            </form>
        </div>
        <div id='image-post-div' class="hide">
            <form action="uploadImagePost.php" method="POST"  enctype="multipart/form-data" >
                <div class="img-container">
                    <img id="output"style='height: 100%; width: 100%; object-fit: contain' />
                    <label class="custom-file-upload">
                        <input type="file" accept="image/*" name="my_file" id="file"  onchange="loadFile(event)" >Select Image
                    </label>
                </div>
                <div class="caption-container">
                    <textarea name="post_caption" id="image-post-textarea" placeholder='Write Caption...'></textarea>
                    <input type="submit" value="Submit" class="image-post-submit-button"/>
                </div>
            </form>
        </div>


        <script type="text/javascript">
            function show1(){
                document.getElementById('text-post-div').style.display ='block';
                document.getElementById('image-post-div').style.display='none';
            }
            function show2(){
                document.getElementById('image-post-div').style.display = 'block';
                document.getElementById('text-post-div').style.display='none';
            }
            var loadFile = function(event) {
	        var image = document.getElementById('output');
	        image.src = URL.createObjectURL(event.target.files[0]);
            };
    </script>
    </body>
</html>
