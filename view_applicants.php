<?php
session_start();
require "./connectvars.php";
ini_set('display_errors', 1);
error_reporting(E_ERROR);

if (!isset($_SESSION['id']) || $_SESSION['type'] != 'Company') {
	$url = "./index.php";
	echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
else {

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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

			<div class="siteheader" id="siteheader"></div>

			<?php
			// change the value of $dbuser and $dbpass to your username and password

			$conn = mysqli_connect('classmysql.engr.oregonstate.edu', 'cs340_choudhay', 'deadmentellnotales', 'cs340_choudhay');

			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}

			// query to select all information from applicants table
			$query = "SELECT AN.Name, AN.Email, AN.Skills
			FROM Applicants AN, Applications AT
			WHERE AN.ApplicantID=AT.ApplicantID
			AND AT.PositionID=110;";

			// Get results from query
			$result = mysqli_query($conn, $query);
			if (!$result) {
				die("Query to show fields from table failed");
			}
			// get number of columns in table
			$fields_num = mysqli_num_fields($result);
			echo "<h1>Users:</h1>";
			echo "<table id='t01' border='1'><tr>";

			// printing table headers
			for($i=0; $i<$fields_num; $i++) {
				$field = mysqli_fetch_field($result);
				echo "<td><b>$field->name</b></td>";
			}
			echo "</tr>\n";
			while($row = mysqli_fetch_row($result)) {
				echo "<tr>";
				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable
				foreach($row as $cell)
				echo "<td>$cell</td>";
				echo "</tr>\n";
			}

			mysqli_free_result($result);
			mysqli_close($conn);
			?>
		</body>

	</head>
	<body>

		</html>

		<?php
	}
}
?>
