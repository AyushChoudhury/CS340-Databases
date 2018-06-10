<?php
session_start();
require "./server/connectvars.php";
ini_set('display_errors', 1);
error_reporting(E_ERROR);

if (!isset($_SESSION['id']) || $_SESSION['type'] != 'Company') {
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
  $stmt = $mysqli->prepare("SELECT * FROM Positions WHERE CompanyID=? ORDER BY StartDate ASC LIMIT 5");
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
    <title>Dashboard - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("companyheader.html");
    });
    </script>
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <left class="sectionheader"><h1>Dashboard</h1></left>
      <div class="ui divider"></div><br>

      <div style="display: inline-block">
        <h2>Upcoming Positions</h2>
        <table class="ui padded celled table" style="max-width: 100%; max-height: 50vw; display: block; overflow-y:auto">
          <thead>
            <tr>
              <th>Job Title / Employee Type</th>
              <th>Start Date</th>
              <th>Location</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($positions as $pos): ?>
              <tr>
                <td><?php echo $pos['EmployeeType']; ?></td>
                <td><?php echo date('M d, Y', strtotime($pos['StartDate'])); ?></td>
                <td><?php echo $pos['Location']; ?></td>
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
