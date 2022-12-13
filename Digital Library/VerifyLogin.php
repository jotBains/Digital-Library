<?php
session_start();
?>
<html>
    <head>
            <!-- My name:  charnjot singh 
            My student number: 6549111
            My email address: cs080@uowmail.edu.au
            Assignment number: 3-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <?php
    $errors = 0;
    $DBName = "Digital_Library";
    try {
        $conn = mysqli_connect("localhost", "root", "",$DBName );
    
        $TableName = "userinfo";
        $SQLstring = "SELECT ID, name, userType FROM $TableName" . " where Email='" . stripslashes($_POST['email']) ."' and password_MD5='" .(stripslashes($_POST['password'])) . "'";
        echo $SQLstring;
        $qRes = mysqli_query($conn, $SQLstring);

        if (mysqli_num_rows($qRes)==0) {
            echo "<p>The e-mail address/password " . " combination entered is not valid. </p>\n";
            ++$errors;
        }
        else {
            $Row = mysqli_fetch_assoc($qRes);
            $ID = $Row['ID'];
            $Name = $Row['name'];
            $userType =  $Row['userType'];
            $_SESSION['ID'] = $ID;
                if ($userType=="Borrower"){
                    $_SESSION['ID'] = $ID;
                    header("location:borrowerFirstPage.php"); 
                }
                if ($userType=="Librarian"){
                    $_SESSION['ID'] = $ID;
                    header("location:firstpage.php"); 
                }
        } 
}
    catch(mysqli_sql_exception $e) {
        echo "<p>Error: unable to connect/insert record in the database.</p>";
        ++$errors;
}
    if ($errors > 0) {
	echo "<p>Please use your browser's BACK button to return " . " to the form and fix the errors indicated.</p>\n";
    }
    if ($errors == 0) {
	//echo "<form method='post' " . " action='AvailableOpportunities.php?" . SID . "'>\n";
	//echo "<input type='hidden' name='internID' " . " value='$InternID'>\n";
	//echo "<input type='submit' name='submit' " . " value='View Available Opportunities'>\n";
	//echo "</form>\n"; 
	//echo "<p><a href='AvailableOpportunities.php?" . "internID=$InternID'>Available " . " Opportunities</a></p>\n";
    }
?>
    
    
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>