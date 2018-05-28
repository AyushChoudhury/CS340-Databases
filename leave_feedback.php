<!DOCTYPE HTML>

<?php
require "./server/connectvars.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);

if (!isset($_SESSION['id']) || $_SESSION['type'] != 'Employee') {
  $url = "./index.php";
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
else {

  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    $message = "Unable to connect to the database!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location: ../index.php");
    exit;
  }

  $companies = array();
  $stmt = $mysqli->prepare("SELECT CompanyID AS ID, Name FROM Companies");
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
      $companies[] = $row;
    }
  }

  ?>

  <html>
  <head>
    <title>Leave Feedback - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("employeeheader.html");
    });

    </script>
    <script>
    function validateFeedbackForm() {
      var chooseCoField = document.forms['feedbackForm']['chooseco'];
      var ratingField = document.forms['feedbackForm']['rating'];
      var commentField = document.forms['feedbackForm']['comment'];

      if (chooseCoField == null || chooseCoField == "") {
        alert("Please choose a company!");
        return false;
      }
      else {
        if (ratingField == null || ratingField == "" ||
            commentField == null || commentField == "") {
              alert("Please fill both forms before submitting");
              return false;
        }
        else return true;
      }
    }
    </script>
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <left class="sectionheader"><h1>Leave Feedback</h1></left>
      <div class="ui divider"></div><br>

      <p class="requirednote">* Denotes a required field</p><br>

      <form name="feedbackForm" onsubmit="return validateFeedbackForm()" action="./server/submit_feedback.php" method="post" id="feedbackForm">
        <input class="inputbox" type="text" name="applicantID" value="<?php echo $_SESSION['id']; ?>" style="display: none" readonly>
        <div class="elem">
          <span class="requirednote">*</span>
          <select class="ui search dropdown" name="chooseco" id="chooseco">
            <option value="">Choose company</option>
            <?php foreach ($companies as $co): ?>
              <option value="<?php echo $co['ID']; ?>"><?php echo $co['Name']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Rating: <input class="inputbox" type="number" name="rating" min="1" max="5">
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Comment: <input class="inputbox" type="text" name="comment"></textarea>
        </div>
        <input class="ui blue button" type="submit" value="Submit Feedback">
      </form>

    </div>
  </body>
  </html>

  <?php
  $mysqli->close();
}
?>
