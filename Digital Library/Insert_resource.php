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
    <?php include 'Librarian.php';
    $Body = "";
    $errors = 0;
    if ($errors == 0) {
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
    }
    if ($errors > 0) {
        $Body .= "<p>Please use your browser's BACK button to return" . " to the form and fix the errors indicated.</p>\n";
    }
    if(isset($_POST["submit"])){ 
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
    if (empty($_POST['cost_per_day'])) {
        ++$errors;
        $Body .= "<p>You need to enter cost_per_day.</p>\n";
        }
    else {
        $cost_per_day = stripslashes($_POST['cost_per_day']);}
    if (empty($_POST['Author'])) {
         ++$errors;
        $Body .= "<p>You need to enter Author.</p>\n";
        }
    else {
            $Author = stripslashes($_POST['Author']);}
    if (empty($_POST['Publisher'])) {
         ++$errors;
        $Body .= "<p>You need to enter Publisher.</p>\n";
        }
    else {
            $Publisher = stripslashes($_POST['Publisher']);}
    if (empty($_POST['extended_cost_per_day'])) {
         ++$errors;
        $Body .= "<p>You need to enter extended_cost_per_day.</p>\n";
        }
    else {
            $extended_cost_per_day = stripslashes($_POST['extended_cost_per_day']);}
    $status = stripslashes($_POST['status']);
    if ($errors == 0) {
        try {
            $sql = "INSERT INTO $TableName " . " (ISBN, title, author, publisher,status, cost_per_day,extended_cost) " . " VALUES(  '$ISBN','$Title', ' $Author', ' $Publisher',' $status',' $cost_per_day',' $extended_cost_per_day')";
            //echo $sql;
            mysqli_query($conn, $sql);
            //setcookie("internID", $InternID); //setcookie() must be first statement before any output is send to the server. That is enabled by $Body
        }
        catch (mysqli_sql_exception $e) {
            $Body .= "<p>Unable to insert record</p>";
            ++$errors;
        }
    }

    echo $Body;
       
    }
    ?>
    <section class="h-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 d-none d-xl-block">
              <img src="img4.png"
                alt="Sample photo" class="img-fluid"
                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-black">
                <h3 class="mb-5 text-uppercase">Please Insert Resource Here</h3>
                <form method="post" action="Insert_resource.php">
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="ISBN" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1n">ISBN</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="Title" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m1">Title</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="Author" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1n1">Author</label>
                    </div>
                  </div>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="Publisher" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example8">Publisher</label>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <select class="select" name="status">
                      <option value="available">available</option>
                      <option value="borrowed">borrowed</option>
                      <option value="extended">extended</option>
            
                    </select>

                  </div>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="cost_per_day" class="form-control form-control-lg" />
                  <label class="form-label" >cost per day</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="extended_cost_per_day" class="form-control form-control-lg" />
                  <label class="form-label" >extended cost per day</label>
                </div>
                <div class="d-flex justify-content-end pt-3">
                  <button type="submit" name="submit"class="btn btn-warning btn-lg ms-2">Submit form</button>
                  </div>
                </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>