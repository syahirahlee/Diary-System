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
    <ul class= "navbar">
        <li><a href="index.html">Home</a></li>   
        <li><a href="poststatusform.php">Post Status</a></li>
        <li><a class="active" href="searchstatusform.html">Search Status</a></li>
        <li><a href="about.html">About</a></li>
    </ul>
     <!--process search status form-->
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

            //use MySQL database, display error message and end script if unsuccessful
            @mysqli_select_db($db_connect, $db_name)
				or die("<p>The database is not available!</p>"
                . "<p>Error code " . mysqli_errno($db_connect)
                . ": " . mysqli_error($db_connect) . "</p>");

            //validate database "status" table exists, display error message and end script if otherwise
            $db_table = "status";		
			$sql_tbl = "SHOW TABLES LIKE '$db_table';";		
			$query_tblresult = @mysqli_query($db_connect, $sql_tbl)
				or die("<p>The table does not exist.</p>"
				. "  <p>Error code " . mysqli_errno($db_connect)
				. ": " . mysqli_error($db_connect) . "</p>");
            
            //check if the correct request method in form is used to access the page 
            if($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                //status search string needs to have value (status description) 
                if (isset($_GET['Search']))
                {
                    //retrieve keyword entered from form
                    $searchstring =$_GET['Search'];

                    //SQL command to search all status information records, to find any matched record in the status table
                    $sql_search = "SELECT * FROM $db_table WHERE statusDesc LIKE '%$searchstring%' ";
                    $result_search = @mysqli_query($db_connect, $sql_search)
                    or die("<p>Failed to execute search query.</p>"
                    . "  <p>Error code " . mysqli_errno($db_connect)
                    . ": " . mysqli_error($db_connect) . "</p>");

                    //when matches found is 1 or more, display all details of requested status information, includes Search Status page link
                    if(mysqli_num_rows($result_search) > 0) 
                    {
                        echo "<p><h3><strong>Status Information</strong></h3></p>";
                        //retrieve and display all the status record containing the matched keyword into rows
                        //mysqli_fetch_row()returns the fields in the current row of a resultset into an indexed array and moves the result pointer to the next row
                        echo "<table width='70%' border='1'>";
                        echo "<tr><th>Code</th><th>Status</th><th>Share</th><th>Date</th><th>Permission</th></tr>";
                        $rows  =  mysqli_fetch_row($result_search)
                        or die("<p>Failed to execute query to retrieve and display results.</p>"
                        . "  <p>Error code " . mysqli_errno($db_connect)
                        . ": " . mysqli_error($db_connect) . "</p>");;
                        
                        while ($rows) //loop for results
                        {
                            //retrieve and display each field/column in table

                            echo "<tr><td>{$rows[0]}</td>";  //status code
                            echo "<td>{$rows[1]}</td>";     //status
                            echo "<td>{$rows[2]}</td>";     //share
                            echo "<td>", date("d/m/Y", strtotime($rows[3])),"</td>";  //date in converted format
                            echo "<td>{$rows[4]}</td></tr>"; //permission type
                            $rows  =  mysqli_fetch_row($result_search);
                        }
                        echo "</table>";

                    }
                    else //when results found 0 matches in database for the searched keyword
                    {
                        echo "<p>There is no such status exists! Please try again.</p>";
                    }
                }
                else //display error message when search string is empty or incorrect format, include Search Status page link
                {
                    echo "<p>The search keyword is invalid! Please try again.</p>";
                }
        
            }
            else //display error message for incorrect form request method used
            {
                echo "Incorrect form request method!";
            }
            
            //close database connection
            mysqli_close($db_connect);
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