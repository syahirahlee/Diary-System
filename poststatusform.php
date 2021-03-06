<!--This post status page which contains a form that allows a user to submit and save their status post to the database-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- External CSS file for the website design-->
	<link rel="stylesheet" type="text/css" href="style/style.css"> 
    <link rel="stylesheet" type="text/css" href="style/form_style.css"> 
    <title>Post Status Page</title>
</head>
<body>
    <!--Header-->
    <div class= "header"> 
        <h1>Status Posting System</h1>
    </div>
    <!--Navigation bar-->
    <ul class= "navbar">
            <li><a href="index.html">Home</a></li>   
            <li><a class="active" href="poststatusform.php">Post Status</a></li>
            <li><a href="searchstatusform.html">Search Status</a></li>
            <li><a href="about.html">About</a></li>
    </ul>
    <!--form that accepts user input and save them to database-->
    <div class="container">
        <form action="poststatusprocess.php" method="POST">
        <!--status code-->
        <div class="row">
            <div class="inputdata">
                <p><label for="statuscode">Status Code (required)</label></p> 
            </div>
            <div class="field">
                <input type="text" name="statuscode" size="10" maxlength="5"  
                placeholder="Status code (5 characters long) must start with an uppercase letter āSā followed by 4 number."/>  
                <!--max character input is set to 5 and appropriate message is displayed according to status code field requirement-->
            </div>
        </div>
        <!--status description-->
        <div class="row">
            <div class="inputdata">
                <label for="status">Status (required)</label> 
            </div>
            <div class="field">
                <textarea name="status" style="height:80px" 
                placeholder="Status can only contain alphanumeric characters including spaces, comma, period (full stop), exclamation point and question mark. Other characters/symbols are not allowed."></textarea>
                <!--appropriate message is displayed according to status field requirement-->
            </div>
        </div>
        <div class="row">
            <div class="inputdata">
                <label for="share">Share</label> 
            </div>
            <div class="field">
                <!--share radio button options -->
                <input type="radio" id="public" name="share" value="Public"/> 
                <label for="public">Public</label> 
                <input type="radio" id="friends" name="share" value="Friends"/> 
                <label for="friends">Friends</label> 
                <input type="radio" id="onlyme" name="share" value="Only Me"/> 
                <label for="onlyme">Only Me</label>
            </div>
        </div>
        <div class="row">
            <div class="inputdata">
                <label for="date">Date</label>
            </div>
            <div class="field">
                <!--fetch current date-->
                <input type="date" id="date" name="Date" value="<?php echo date("Y-m-d");?>"required> 
                <!--since mysql only take date format as Y-m-d, html side displays d/m/y format-->
            </div>
        </div>
        <div class="row">
            <div class="inputdata">
                <label for="permission[]">Permission</label>
            </div>
            <div class="field">
                <!--list of permission type checkboxes-->
                <input type="checkbox" id="like" name="permission[]" value="Allow Like">
                <label for="like">Allow Like</label>
                <input type="checkbox" id="comment" name="permission[]" value="Allow Comment">
                <label for="comment">Allow Comment</label>
                <input type="checkbox" id="share" name="permission[]" value="Allow Share">
                <label for="share">Allow Share</label>
            </div>
        </div>
        <div class="row">
            <!--button to reset/erase all data entered-->
            <input type="reset" value="Reset">
            <!--button to submit all data entered by user into database table-->
            <input type="submit" value="Post">
        </div>
        </form>
    </div>
    <!--Footer-->
    <div class="footer">
        <br><br>
        <a href="index.html"><button type="button">Return to Home Page</button></a>
    </div>

</body>
</html>