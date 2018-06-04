<?php
session_start();
require "./server/connectvars.php";
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

  $positions = array();
  $stmt = $mysqli->prepare("SELECT P.*, C.Name AS CompanyName, C.Email AS Contact FROM Positions P, Companies C WHERE P.CompanyID=C.CompanyID AND P.PositionID NOT IN (SELECT PositionID FROM Applications WHERE ApplicantID=?) ORDER BY P.StartDate ASC");
  $stmt->bind_param('i', $_SESSION['id']);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
      $positions[] = $row;
    }
  }
  ?>

  <!DOCTYPE HTML>

  <html>
  <head>
    <title>Explore - FindMeAJob</title>
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
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <left class="sectionheader"><h1>Explore</h1></left>
      <div class="ui divider"></div><br>

      <div style="display: inline-block">
        <h2>Available Positions</h2>
        <table class="ui padded celled table" style="max-width: 100%; max-height: 50vw; display: block; overflow-y:auto">
          <thead>
            <tr>
              <th>Job Title</th>
              <th>Company</th>
              <th>Start Date</th>
              <th>Location</th>
              <th>Contact</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($positions as $pos): ?>
              <tr>
                <td><?php echo $pos['EmployeeType']; ?></td>
                <td><?php echo $pos['CompanyName']; ?></td>
                <td><?php echo date('M d, Y', strtotime($pos['StartDate'])); ?></td>
                <td><?php echo $pos['Location']; ?></td>
                <td><?php echo $pos['Contact']; ?></td>
                <td><a href="./apply.php?id=<?php echo $pos['PositionID']; ?>&title=<?php echo $pos['EmployeeType']; ?>&company=<?php echo $pos['CompanyName']; ?>" class="ui green button">Apply</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </body>
  </html>

  <?php
  $mysqli->close();
}
?>
