<?php include 'Librarian.php';?>
<html>
    <head>
        <!-- My name:  charnjot singh 
            My student number: 6549111
            My email address: cs080@uowmail.edu.au
            Assignment number: 3-->
        <link rel="stylesheet" href="gauge.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
       <br></br>
       <h3 class="fw-bold mb-5">search by ISBN, Title, Author, or Status</h3>
       
    <form class="d-flex" action="" method="post">
        
        <input type="taxt" name="Search" autocomplete="off" placeholder="Search" aria-label="Search" ></input>
         <button class="btn btn-outline-success" type="submit" name= "submit">Search</button>
       </form>
    <?php
    
        try {
            $conn = mysqli_connect ("localhost", "root", "");
    
            $DBName = "Digital_Library";
            $result = mysqli_select_db($conn,$DBName);
            $TableName = "resource";
        }
        catch (mysqli_sql_exception $e) {
            $Body .= "<p>Unable to connect to the database </p>\n";
            ++$errors;
       }
       if(isset($_POST["submit"])){  
            $info = array();
           
            $search = stripslashes($_POST['Search']);
            $sql = "SELECT bookNo,ISBN,title,author,publisher,cost_per_day, status, extended_cost FROM $TableName where ISBN  LIKE '%".$search."%'
            or title  LIKE '%".$search."%'
            or author  LIKE '%".$search."%'
            or status  LIKE '%".$search."%'
            ";
            $qRes = mysqli_query($conn, $sql);
                if (mysqli_num_rows($qRes) > 0) {
                    while (($Row = mysqli_fetch_assoc($qRes))!= FALSE)
                    $info[] = $Row;
                    mysqli_free_result($qRes);
                }    
   
        echo' <table class=table table-striped>';
        echo'<thead>';
        echo'<tr>';
        echo'<th scope="col">bookNo</th>';
        echo'<th scope="col">ISBN</th>';
        echo' <th scope="col">title</th>';
        echo' <th scope="col">author</th>';
        echo'<th scope="col">publisher</th>';
        echo'<th scope="col">status</th>';
        echo' <th scope="col">cost_per_day</th>';
        echo' <th scope="col">extended_cost</th>';
        echo'</tr>';
        echo'</thead>';
        foreach ($info as $infom) {
            echo'<tbody>';
            echo'<tr>';
            echo'<th scope="row">'. htmlentities($infom['bookNo']) .'</th>';
            echo'<td>'. htmlentities($infom['ISBN']) .'</td>';
            echo'<td>'. htmlentities($infom['title']) .'</td>';
            echo'<td>'. htmlentities($infom['author']) .'</td>';
            echo'<td>'. htmlentities($infom['publisher']) .'</td>';
            echo'<td>'. htmlentities($infom['status']) .'</td>';
            echo'<td>'. htmlentities($infom['cost_per_day']) .'</td>';
            echo'<td>'. htmlentities($infom['extended_cost']) .'</td>';
            echo'</tr>';
            echo'</tbody>';
        }
        echo'</table>';
   }
   echo'<form class="d-flex" action="firstpage.php" method="post">';
        
   echo'<p>.  List of all resource   .</p>';
   echo'<button class="btn btn-outline-success" type="submit" name= "find">Search</button>';
   echo'</form>';
   if(isset($_POST["find"])){
       $info = array();
            $sql = "SELECT bookNo,ISBN,title,author,publisher,cost_per_day, status, extended_cost FROM $TableName ";
            $qRes = mysqli_query($conn, $sql);
                if (mysqli_num_rows($qRes) > 0) {
                    while (($Row = mysqli_fetch_assoc($qRes))!= FALSE)
                    $info[] = $Row;
                    mysqli_free_result($qRes);
                }    
   
        echo' <table class=table table-striped>';
        echo'<thead>';
        echo'<tr>';
        echo'<th scope="col">bookNo</th>';
        echo'<th scope="col">ISBN</th>';
        echo' <th scope="col">title</th>';
        echo' <th scope="col">author</th>';
        echo'<th scope="col">publisher</th>';
        echo'<th scope="col">status</th>';
        echo' <th scope="col">cost_per_day</th>';
        echo' <th scope="col">extended_cost</th>';
        echo'</tr>';
        echo'</thead>';
        foreach ($info as $infom) {
            echo'<tbody>';
            echo'<tr>';
            echo'<th scope="row">'. htmlentities($infom['bookNo']) .'</th>';
            echo'<td>'. htmlentities($infom['ISBN']) .'</td>';
            echo'<td>'. htmlentities($infom['title']) .'</td>';
            echo'<td>'. htmlentities($infom['author']) .'</td>';
            echo'<td>'. htmlentities($infom['publisher']) .'</td>';
            echo'<td>'. htmlentities($infom['status']) .'</td>';
            echo'<td>'. htmlentities($infom['cost_per_day']) .'</td>';
            echo'<td>'. htmlentities($infom['extended_cost']) .'</td>';
            echo'</tr>';
            echo'</tbody>';
        }
        echo'</table>'; 
   }
   echo'<form class="d-flex" action="firstpage.php" method="post">';
   echo'<p>.  List of all resource   .</p>';
   echo'<div class="row">';
   echo'<div class="col-md-6 mb-4">';
   echo'<select class="select" name="status">';
        echo'<option value="available">available</option>';
        echo'<option value="borrowed">borrowed</option> ';
        echo'<option value="extended">extended</option> ';
        echo'</select> ';
        echo'<button class="btn btn-outline-success" type="submit" name= "SFind">Search</button>';
    echo'</div>';
    echo'</div> ';
    echo'</form>';
    if(isset($_POST["SFind"])){
    $status = stripslashes($_POST['status']);
    $info = array();
            $sql = "SELECT bookNo,ISBN,title,author,publisher,cost_per_day, status, extended_cost FROM $TableName where status = '$status' ";
            $qRes = mysqli_query($conn, $sql);
                if (mysqli_num_rows($qRes) > 0) {
                    while (($Row = mysqli_fetch_assoc($qRes))!= FALSE)
                    $info[] = $Row;
                    mysqli_free_result($qRes);
                }    
   
        echo' <table class=table table-striped>';
        echo'<thead>';
        echo'<tr>';
        echo'<th scope="col">bookNo</th>';
        echo'<th scope="col">ISBN</th>';
        echo' <th scope="col">title</th>';
        echo' <th scope="col">author</th>';
        echo'<th scope="col">publisher</th>';
        echo'<th scope="col">status</th>';
        echo' <th scope="col">cost_per_day</th>';
        echo' <th scope="col">extended_cost</th>';
        echo'</tr>';
        echo'</thead>';
        foreach ($info as $infom) {
            echo'<tbody>';
            echo'<tr>';
            echo'<th scope="row">'. htmlentities($infom['bookNo']) .'</th>';
            echo'<td>'. htmlentities($infom['ISBN']) .'</td>';
            echo'<td>'. htmlentities($infom['title']) .'</td>';
            echo'<td>'. htmlentities($infom['author']) .'</td>';
            echo'<td>'. htmlentities($infom['publisher']) .'</td>';
            echo'<td>'. htmlentities($infom['status']) .'</td>';
            echo'<td>'. htmlentities($infom['cost_per_day']) .'</td>';
            echo'<td>'. htmlentities($infom['extended_cost']) .'</td>';
            echo'</tr>';
            echo'</tbody>';
        }
        echo'</table>'; 
    }
    echo'<form class="d-flex" action="firstpage.php" method="post">';
   echo'<p>.change the status of resource  here . </p>';
   echo'<br></br>';
   
    echo'<div class="row">';
    echo'<div class="col-md-6 mb-4">';
            echo'<div class="form-outline">';
                echo'<input type="text" name="ISBN" class="form-control form-control-lg" />';
                echo'<label class="form-label" for="form3Example1n">ISBN of resource</label>';
            echo'</div>';
        echo'</div>';
        echo'<div class="col-md-6 mb-4">';
            echo'<div class="form-outline">';
                echo'<input type="text" name="Title" class="form-control form-control-lg" />';
                echo'<label class="form-label" for="form3Example1m1">Title  of resource</label>';
            echo'</div>';
        echo'</div>';
        echo'<div class="col-md-6 mb-4">';
             echo'<div class="form-outline">';
                echo'<input type="text" name="Author" class="form-control form-control-lg" />';
                echo'<label class="form-label" for="form3Example1n1">Author of resource</label>';
            echo'</div>';
        echo'</div>';
        echo'<div class="col-md-6 mb-4">';
             echo'<div class="form-outline">';
                echo'<input type="text" name="status" class="form-control form-control-lg" />';
                echo'<label class="form-label" for="form3Example1n1">add new status here </label>';
            echo'</div>';
        echo'</div>';
        echo'<div class="col-md-6 mb-4">';
        echo'<div class="form-outline">';
           echo'<button type="submit" name="statusChange"class="btn btn-warning btn-lg ms-2">change status</button>';
       echo'</div>';
   echo'</div>';
    echo'</div>';
    echo'</form>';
    if(isset($_POST["statusChange"])){
        if (empty($_POST['ISBN'])) {
        ++$errors;
        $Body .= "<p>You need to enter ISBN.</p>\n";
        }
        else {
        $ISBN = stripslashes($_POST['ISBN']);}
        if (empty($_POST['Title'])) {
        ++$errors;
        $Body .= "<p>You need to enter Title.</p>\n";
        }
        else {
        $Title = stripslashes($_POST['Title']);}
        if (empty($_POST['Author'])) {
         ++$errors;
        $Body .= "<p>You need to enter Author.</p>\n";
        }
        else {
            $Author = stripslashes($_POST['Author']);}
        if (empty($_POST['status'])) {
         ++$errors;
        $Body .= "<p>You need to enter Author.</p>\n";
        }
        else {
            $status = stripslashes($_POST['status']);}

            $sql = "UPDATE $TableName SET status  = '$status'  where ISBN = '$ISBN' and Title = '$Title' AND Author= '$Author' ";
            $qRes = mysqli_query($conn, $sql);
           // ECHO $sql;

           
        }

   ?>         
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
