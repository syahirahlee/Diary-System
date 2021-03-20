<!--This post status page which contains a form that allows a user to submit and save their status post to the database-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- External CSS file for the website design-->
	<link rel="stylesheet" type="text/css" href="style/style.css"> 
    <title>Post Status Page</title>
</head>
<body>
    <!--Header-->
    <div class= "header"> 
        <h1>Status Posting System</h1>
    </div>
    <!--Navigation bar-->
    <div class= "navbar">
        <a href="index.html">Home</a>
        <a class="active" href="poststatusform.php">Post Status</a>
        <a href="searchstatusform.html">Search Status</a>
        <a href="about.html">About</a>
    </div>

    <!--form that accepts user input and save them to database-->
    <div class="content">
        <form action="poststatusprocess.php" method="POST">
        <!--appropriate message is displayed below textfield according to the accepted data input for each field when user hovers it, and hides when it does not-->
        <!--status code-->
        <div class="inputdata">
            <br><label for="statuscode">Status Code (required):</label> 
            <input type="text" name="statuscode" size="5"/>  
        </div>
        <div class="hide">Status code (5 characters long) must start with an uppercase letter “S” followed by 4 number</div><br>
        <!--status description-->
        <div class="inputdata">
            <label for="status">Status (required): </label>  
            <input type="text" name="status"/> </div>
        <div class="hide">Status can only contain alphanumeric characters including spaces, comma, period (full stop), 
            exclamation point and question mark. Other characters/symbols are not allowed.</div><br>
        <!--radio button options -->
        <label for="share">Share: </label> 
        <input type="radio" id="public" name="share" value="public"/> 
        <label for="public">Public</label> 
        <input type="radio" id="friends" name="share" value="friends"/> 
        <label for="friends">Friends</label> 
        <input type="radio" id="onlyme" name="share" value="onlyme"/> 
        <label for="onlyme">Only Me</label> 
        <br><br>
        <!--fetch current date-->
        <label for="date">Date: </label>
        <input type="date" id="date" name="date" value="<?php echo date("d/m/Y") ?>">
        <br><br>
        <!--permission type-->
        <label for="permission">Permission: </label>
        <input type="checkbox" id="like" name="permission" value="Allow Like">
        <label for="like">Allow Like</label>
        <input type="checkbox" id="comment" name="permission" value="Allow Comment">
        <label for="comment">Allow Comment</label>
        <input type="checkbox" id="share" name="permission" value="Allow Share">
        <label for="share">Allow Share</label>
        <br><br>
        <!--button to submit all data entered by user into database table-->
        <input type="submit" value="Post">
        <!--button to reset/erase all data entered-->
        <input type="reset" value="Reset">
    </form>
    </div>

    <!--Footer-->
    <div class="footer">
        <br><br>
        <a href="index.html">Return to Home Page</a> 
    </div>

</body>
</html>