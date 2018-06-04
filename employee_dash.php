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

  $applications = array();
  $stmt = $mysqli->prepare("SELECT P.*, C.Name AS CompanyName, C.Email AS Contact FROM Positions P, Applications A, Companies C WHERE A.PositionID=P.PositionID AND P.CompanyID=C.CompanyID AND A.ApplicantID=? ORDER BY A.dateCreated DESC LIMIT 5");
  $stmt->bind_param('i', $_SESSION['id']);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
      $applications[] = $row;
    }
  }
  ?>

  <!-- EMPLOYEE DASHBOARD PAGE -->

  <!DOCTYPE HTML>

  <html>
  <head>
    <title>Dashboard - FindMeAJob</title>
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
      <left class="sectionheader"><h1>Dashboard</h1></left>
      <div class="ui divider"></div><br>

      <div style="display: inline-block">
        <h2>Recently Submitted Applications</h2>
        <table class="ui padded celled table" style="max-width: 100%; max-height: 50vw; display: block; overflow-y:auto">
          <thead>
            <tr>
              <th>Job Title</th>
              <th>Company</th>
              <th>Start Date</th>
              <th>Location</th>
              <th>Contact</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($applications as $app): ?>
              <tr>
                <td><?php echo $app['EmployeeType']; ?></td>
                <td><?php echo $app['CompanyName']; ?></td>
                <td><?php echo date('M d, Y', strtotime($app['StartDate'])); ?></td>
                <td><?php echo $app['Location']; ?></td>
                <td><?php echo $app['Contact']; ?></td>
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
