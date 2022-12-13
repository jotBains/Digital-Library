<?php
session_start();
$Body = "";
$errors = 0;
$ID = 0;
/*
<!-- My name:  charnjot singh 
            My student number: 6549111
            My email address: cs080@uowmail.edu.au
            Assignment number: 3--> */
if (isset($_SESSION['ID']))
	$ID = $_SESSION['ID']; 
else {
	$Body .= "<p>You have not logged in or registered. Please return to the <a href='InternLogin.php'>Registration / Log In page</a>.</p>";
	++$errors;
}
if ($errors == 0) {
	if (isset($_GET['bookNo']))
		$bookNo = $_GET['bookNo'];
	else {
		$Body .= "<p>You have not selected an resource. Please return to the <a href='AvailableOpportunities.php?". SID . "'>Available Opportunities page</a>.</p>";
		++$errors;
	}
}

if ($errors == 0) {
    try {
        $conn = mysqli_connect("localhost", "root","");
	
		$DBName = "Digital_Library";
		$result = mysqli_select_db($conn, $DBName);
		
        $DisplayDate = date("Y-m-d");
        $DatabaseDate = date("Y-m-d H:i:s");
        $TableName = "borrowed_resource";
        $sql = "INSERT INTO $TableName (ID, bookNo, starting_date,due_date) VALUES ($ID, $bookNo, '$DatabaseDate','$DatabaseDate')";
        $qRes = mysqli_query($conn, $sql) ;
		$Body .= "<p>Your request for bookNo # " . " $bookNo has been entered on $DisplayDate.</p>\n";
        mysqli_close($conn);
    }
    catch (mysqli_sql_exception $e) {
        $Body .= "<p>Unable to execute the query.</p>\n";
        ++$errors;
    }
}

if ($ID > 0)
	$Body .= "<p>Return to the <a href='BorrowResource.php?". SID . "'>Borrow Resource</a> page.</p>\n";
else
	$Body .= "<p>Please <a href='login.php'>Register or Log In</a> to use this page.</p>\n";

if ($errors == 0)
	setcookie("LastRequestDate", urlencode($DisplayDate), time()+60*60*24*7); //, "/examples/internship/");
?>
<!DOCTYPE html>
<html>
<head>
<title>borrow resources</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<h1>borrow resources</h1>
<?php
echo $Body;
?>
</body>
</html>
