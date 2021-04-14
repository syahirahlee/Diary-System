<!--This process post status page validates the submitted data from the post status page, save them to database table 
and generate appropriate HTML output according to the user’s request.
-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- External CSS file for the website design-->
	<link rel="stylesheet" type="text/css" href="style/style.css"> 
    <title>Process Post Status Page</title>
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
    <!--process post status form-->
    <div class="content">
        <?php
            /*declare database variables
            $db_host = " ";
			$db_user = " ";
			$db_password = " ";
			$db_name = " ";*/

            //get sql login info 
            require_once('../../conf/sqlinfo.inc.php');
            //create MySQL database connection, display error message and end script if unsuccessful
            $db_connect = @mysqli_connect($db_host,$db_user,$db_password)
                or die("<p>The connection to database server is unavailable.<p>" 
                . "<p>Error code " . mysqli_connect_errno()  
                . ": " . mysqli_connect_error() . "</p>");
            //display message for successful connection
            //echo "<p>The connection to database server is successful.</p>";

            //use MySQL database, display error message and end script if unsuccessful
            @mysqli_select_db($db_connect, $db_name)
				or die("<p>The database is not available!</p>"
                . "<p>Error code " . mysqli_errno($db_connect)
                . ": " . mysqli_error($db_connect) . "</p>");
            //display message for successful selection of database
            //echo "<p>The selected database is successfully opened.</p>";

            //check if table database exist, display error message and end script if otherwise
            $db_table = "status";		
			$sql_tbl = "SHOW TABLES LIKE '$db_table';";		
			$query_tblresult = @mysqli_query($db_connect, $sql_tbl)
				or die("<p>The table does not exist.</p>"
				. "  <p>Error code " . mysqli_errno($db_connect)
				. ": " . mysqli_error($db_connect) . "</p>");

            //check if the correct request method in form is used to access the page 
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
            //check status code and status fields are not empty
            if (!empty($_POST['statuscode']) && !empty($_POST['status'])) 
            {
                //retrieve data from the post status form
                $code = $_POST["statuscode"];
                $desc = $_POST["status"];
                $share = $_POST["share"];
                $date = date("d/m/Y", strtotime($_POST["Date"])); //date format displayed in HTML Side
                $date_db = $_POST["Date"]; //date format for the sql side
                $permission = $_POST["permission"];

                //data validation using regular expressions
                $codepattern = "/^[S]{1}[\d]{4}$/";    //regex for status code : start with “S” followed by 4 number
                $statpattern = "/^[a-zA-Z0-9\s,.!?]+$/";   //regex for status: only contain alphanumeric characters

                if (preg_match ($codepattern, $code) && preg_match ($statpattern, $desc))
                {
                    //validate date input
                    if (!empty($date))
                    {
                        $validDate = validateDate($date); //call validateDate function
            
                        if ($validDate==true)
                        {
                            //SQL command to check status code must be unique, ensure no duplicates in database found
                            $sql_code = "SELECT * FROM $db_table WHERE statusCode = '$code' ";
                            $coderesult = @mysqli_query($db_connect, $sql_code)
                            or die("<p>Failed to execute query for status code.</p>"
                            . "  <p>Error code " . mysqli_errno($db_connect)
                            . ": " . mysqli_error($db_connect) . "</p>");

                            //if status code entered matches in database table
                            //mysqli_num_rows() function : to find the number of records returned from the query
                            $numRows = mysqli_num_rows($coderesult);
                            if ($numRows!=0 )
                            {
                                //display error message - include home page and post status page links and end script
                                die	("<p>The status code entered exists in the database! Please try again</p>");
                            }
                        
                            //if more than 1 permission type is checked, save all of them to the same single "permission" column in status table
                            $chck="";  
                            foreach($permission as $check_p)  
                            {  
                                $chck .= $check_p." ";  
                            }  
                        
                            //save all the valid input fields to database
                            //SQL command to add all the data into the status table
                            $sql_add = "INSERT into $db_table"
                            ."(statusCode, statusDesc, share, datePosted, permissionType)"
                            . "VALUES"
                            ."('$code','$desc','$share', '$date_db', '$chck')";

                            $result_add = @mysqli_query($db_connect, $sql_add)
                            or die("<p>Failed to execute query for insert data.</p>"
                            . "  <p>Error code " . mysqli_errno($db_connect)
                            . ": " . mysqli_error($db_connect) . "</p>");

                            //display confirmation message
                            echo "<p>Status post data has been successfully saved!<p>";

                        }
                        else //invalid date input
                        {
                            echo "<p>The date entered is invalid. Please try again</p>";
                        }
                    }
                    else //display error message for empty date field
                    {
                        echo "<p>Date field cannot be empty! Please choose the date and submit again.</p>";
                    }
                }
                else //display error message for invalid status code and status data
                {
                    echo "<p>Status code and Status must follow the format instructions. <br>
                    Status Code: Starts with “S”, followed by 4 number (5 characters long) <br>
                    Status: Can only contain alphanumeric characters (including spaces, comma, period (full stop), exclamation point and question mark. <br>
                    Please try again.</p>";
                }
            }
            else //display error message for empty fields of status code and status
            {
                echo "<p>Status code and Status cannot be empty! Please fill in the fields and submit again.</p>";
            }
            }
            else //display error message for incorrect form request method used
            {
                echo "Incorrect form request method!";
            }

            //Validate date function to ensure input date is correct
            function validateDate($date, $format = 'd/m/Y'){
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) === $date;
            }

            //close database connection
            mysqli_close($db_connect);
        ?>
    </div>
    <!--Footer-->
    <div class="footer">
        <br><br>
        <a href="index.html">Return to Home Page</a>  |
        <a href="poststatusform.php">Post a new status</a> 
    </div>
</body>
</html>