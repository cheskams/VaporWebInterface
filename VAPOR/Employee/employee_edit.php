<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: green;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 30%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  border-radius: 12px;
}

</style>
</head>
<body style="background-color:black; color: white">

<img src="../vapor logo.png" width=300px>

<div class="navbar">
  <a href="#home">Home</a>
  <div class="dropdown">
    <button class="dropbtn">Customer Functions
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../Customer/customer_list.php">See All</a>
      <a href="../Customer/customer_add.php">New</a>
      <a href="../Customer/customer_search.php">Search</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Product Functions
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../Product/product_list.php">See All</a>
      <a href="../Product/product_add.php">New</a>
      <a href="../Product/product_search.php">Search</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Promo Functions
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">See All</a>
      <a href="#">New</a>
      <a href="#">Search</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Employee Functions
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="employee_list.php">See All</a>
      <a href="employee_add.php">New</a>
      <a href="employee_search.php">Search</a>
    </div>
  </div>
</div>

<?php

$id_needed = $_GET['id'];

$url = "http://75.156.172.79:8000/store/employee/" . $id_needed;

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
$options = array(CURLOPT_URL =>$url,
                CURLOPT_HTTPHEADER => array('Accept: application/json'),
                 CURLOPT_HEADER => true,
                 CURLOPT_RETURNTRANSFER => true
                );

curl_setopt_array($ch, $options);

// grab URL and pass it to the browser
$response = curl_exec($ch);

$table = explode("{",$response);
$variables = $table[1];

$attributes = explode(",", $variables);

    //handle attr[0]
    $separate = explode(":",$attributes[0]); //ID
    $this_id = $separate[1]; //no need to remove quotes because ID is int
    //handle attr[1]
    $separate = explode(":",$attributes[1]); //Name
    $this_name = str_replace('"', "", $separate[1]); //remove quotes
    //handle attr[2]
    $separate = explode(":",$attributes[2]); //Salary
    $this_salary = str_replace('"',"",$separate[1]); //remove quotes
    //handle attr[3]
    $separate = explode(":",$attributes[3]); //Hours
    $this_hours = str_replace('"',"",$separate[1]);
    $this_hours = str_replace(']',"",$this_hours); //remove end bracket
    $this_hours = str_replace('}',"",$this_hours); //remove curly brace
    //attr[3] may exist but it is null
    
    $select_this = "employee_select.php?id=" . $this_id;
    $delete_this = "employee_delete.php?id=" . $this_id;
    
    //Create Table Row with this Info
    
    echo "<h3>Employee Details</h3><br>
          <table><tr>";
    echo "<th>ID</th>";
    echo "<td>" . $this_id . "</td></tr>";
    echo "<tr><th>Name</th>";
    echo "<td>" . $this_name . "</td></tr>";
    echo "<tr><th>Salary</th>";
    echo "<td>$" . $this_salary . " /hr</td></tr>";
    echo "<tr><th>Hours</th>";
    echo "<td>" . $this_hours . "</td></tr>";
    echo "</table>";

// close cURL resource, and free up system resources
curl_close($ch);
?>
<h5 style="margin-left:45px"><i>Enter New Details Below</i></h5>
<form style="margin-left:50px" action="edit_confirmation.php" method="post">
  <label for="id_code">Please enter Employee ID:</label><br>
  <input type="text" id="id_code" name="id_code"> <br><br>
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name"><br><br>
  <label for="salary">Salary:</label><br>
  <input type="text" id="salary" name="salary"><br><br>
  <label for="hours">Hours:</label><br>
  <input type="text" id="hours" name="hours"><br><br>
  <input type="submit" value="Edit">

</form>


</body>
</html>
