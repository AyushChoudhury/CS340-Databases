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
	$positionID = $_GET['id'];
	?>

	<!DOCTYPE HTML>

	<html>
	<head>
		<title>View All Applications for Position - FindMeAJob</title>
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

			<?php
			// change the value of $dbuser and $dbpass to your username and password

			$conn = mysqli_connect('classmysql.engr.oregonstate.edu', 'cs340_choudhay', 'deadmentellnotales', 'cs340_choudhay');

			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}

			// query to select all information from applicants table
			$query = "SELECT AN.Name, AN.Email, AN.Skills, AT.ResumeCV, AT.CoverLetter, R.Name, R.Email, R.PhoneNumber
			FROM Applicants AN, Applications AT, Reference R
			WHERE AN.ApplicantID=AT.ApplicantID
			AND AT.ApplicationID=R.ApplicationID
			AND AT.PositionID=?;";

			// Get results from query
			$stmt = mysqli_prepare($conn, $query);
			$stmt->bind_param('i', $positionID);
			$stmt->execute();
			$result = $stmt->get_result();
			if (!$result) {
				die("Query to show fields from table failed");
			}
			// get number of columns in table
			$fields_num = mysqli_num_fields($result);
			echo "<left class='sectionheader'><h1>View Applicants for Position #" . $positionID . "</h1></left><br>";
			echo "<div class='ui divider'></div><br>";
			echo "<div style='display: inline-block'>";
			echo "<table class='ui padded celled table' style='max-width: 100%; max-height: 50vw; display: block; overflow-y:auto'>";
			echo "<thead><tr>";

			// printing table headers
			echo "<th>Name</th>";
			echo "<th>Email</th>";
			echo "<th>Skills</th>";
			echo "<th>Resume/CV</th>";
			echo "<th>Cover Letter</th>";
			echo "<th>Reference Name</th>";
			echo "<th>Reference Email</th>";
			echo "<th>Reference Phone Number</th>";
			echo "</tr>\n<tbody>";
			while($row = mysqli_fetch_row($result)) {
				echo "<tr>";
				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable
				foreach($row as $cell)
				echo "<td>$cell</td>";
				echo "</tr>\n";
			}
			echo "</tbody></table></div>";

			mysqli_free_result($result);
			mysqli_close($conn);
			?>
		</div>
	</body>

	</html>

		<?php
}
?>
