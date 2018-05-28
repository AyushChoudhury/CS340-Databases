<!-- EXPLORE PAGE -->

<!DOCTYPE HTML>

<?php

require "./server/connectvars.php";
session_start();
ini_set('display_errors', 1);
error_reporting(E_ERROR);
if (!isset($_SESSION['id']) || $_SESSION['type'] != 'Company') {
  $url = "./index.php";
  echo "<script type='text/javascript'>document.location.href = '$url';</script>";
}
else {

  ?>

  <html>
  <head>
    <title>Settings - FindMeAJob</title>
    <link type="text/css" rel="stylesheet" href="./css/Semantic-UI-CSS-master/semantic.css"/>
    <link type="text/css" rel="stylesheet" href="./css/stylesheet.css"/>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/semantic.js"></script>
    <script type="text/javascript" src="./css/Semantic-UI-CSS-master/components/dropdown.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script>
    $(document).ready(function() {
      $("#siteheader").load("companyheader.html");
    });
    function validateCompanyForm() {
      var nameField = document.forms['companyForm']['name'];
      var emailField = document.forms['companyForm']['email'];
      var descriptionField = document.forms['companyForm']['description'];
      if (nameField == null || nameField == "" ||
      emailField == null || emailField == "" ||
      descriptionField == null || descriptionField == "") {
        alert("Please fill all required fields before submitting!");
        return false;
      }
      else return true;
    }
    </script>
  </head>
  <body>
    <div class="siteheader" id="siteheader"></div>

    <div class="mainbody">
      <left class="sectionheader"><h1>Settings</h1></left>
      <div class="ui divider"></div><br>
      <form name="companyForm" onsubmit="return validateCompanyForm()" action="./server/update_company.php" method="post" id="companyForm">
        <div class="elem" style="display: none">
           <input class="inputbox" type="number" name="companyID" value="<?php echo $_SESSION['id']; ?>" readonly>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Company Name: <input class="inputbox" type="text" name="name" value="<?php echo $_SESSION['name']; ?>"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Email: <input class="inputbox" type="email" name="email" value="<?php echo $_SESSION['email']; ?>"><br><br>
        </div>
        <div class="elem">
          <span class="requirednote">*</span>
          Company Description: <input class="inputbox" type="text" name="description" value="<?php echo $_SESSION['description']; ?>"><br><br>
        </div>
        <input class="ui blue button" type="submit" value="Save Changes">

      </div>
    </body>
    </html>

    <?php
  }
  ?>
