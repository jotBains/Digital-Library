<?php
/*
<!-- My name:  charnjot singh 
            My student number: 6549111
            My email address: cs080@uowmail.edu.au
            Assignment number: 3--> */
session_start();
$Body = "";
$errors = 0;
$email = "";

if (empty($_POST['email'])) {
	++$errors;
	$Body .= "<p>You need to enter an e-mail address.</p>\n";
	}
else {
	$email = stripslashes($_POST['email']);
	if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)*(\.[a-z]{2,3})$/i", $email) == 0) {
		
		++$errors;
		$Body .= "<p>You need to enter a valid " . "e-mail address.</p>\n";
		$email = "";
	}
}

if (empty($_POST['password'])) {
	++$errors;
	$Body .= "<p>You need to enter a password.</p>\n"; 
	$password = "";
}
else {
	$password = stripslashes($_POST['password']);
}

if ($errors == 0) {
    try {
        $conn = mysqli_connect ("localhost", "root", "");

		$DBName = "Digital_Library";
		$result = mysqli_select_db($conn,$DBName);
        $TableName = "userinfo";
        $sql = "SELECT count(*) FROM $TableName" . " where Email='" . $email . "'";
        $qRes = mysqli_query($conn, $sql);
		$Row = mysqli_fetch_row($qRes);
		if ($Row[0]>0) {
			$Body .= "<p>The email address entered (" . htmlentities($email) . ") is already registered.</p>\n";
			++$errors;
		}
	}
    catch (mysqli_sql_exception $e) {
        $Body .= "<p>Unable to connect to the database </p>\n";
        ++$errors;
   }
}
if ($errors > 0) {
	$Body .= "<p>Please use your browser's BACK button to return" . " to the form and fix the errors indicated.</p>\n";
}

if ($errors == 0) {
	$first = stripslashes($_POST['name']);
	$last = stripslashes($_POST['Surname']);
    $phone = stripslashes($_POST['phone']);
    try {
        $sql = "INSERT INTO $TableName " . " (Email, name, Surname, password_MD5,phone) " . " VALUES(  '$email','$first', '$last', '$password','$phone')";
        mysqli_query($conn, $sql);
		$ID = mysqli_insert_id($conn);
		$_SESSION['ID'] = $ID;
        mysqli_close($conn);
		//setcookie("internID", $InternID); //setcookie() must be first statement before any output is send to the server. That is enabled by $Body
    }
    catch (mysqli_sql_exception $e) {
        $Body .= "<p>Unable to insert record</p>";
        ++$errors;
    }
}
if ($errors == 0) {
	//$InternName = $first . " " . $last;
    header("location:Borrower.php"); 
    
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
echo $Body;
?>
</body>
</html>