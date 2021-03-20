<!--This process post status page validates the submitted string search from the search status page, 
read data from status database table and search for matched data in the status record, then generate
appropriate HTML output according to the user’s search request. -->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- External CSS file for the website design-->
	<link rel="stylesheet" type="text/css" href="style/style.css"> 
    <title>Search Status Result Page</title>
</head>
<body>
    <!--Header-->
    <div class= "header"> 
        <h1>Status Posting System</h1>
    </div>
    <!--Navigation bar-->
    <div class= "navbar">
        <a href="index.html">Home</a>
        <a href="poststatusform.php">Post Status</a>
        <a class="active" href="searchstatusform.html">Search Status</a>
        <a href="about.html">About</a>
    </div>
     <!--process search status form-->
    <div class="content">
        <?php
        
        ?>
    </div>
    <!--Footer-->
    <div class="footer">
        <br><br>
        <a href="searchstatusform.html">Search for another status</a> |  
        <a href="index.html">Return to Home Page</a> 
    </div>
</body>
</html>