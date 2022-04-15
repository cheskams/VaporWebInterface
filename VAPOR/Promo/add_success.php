<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VAPOR Product View</title>
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
      <a href="promo_list.php">See All</a>
      <a href="promo_add.php">New</a>
      <a href="#">Search</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Employee Functions
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="../Employee/employee_list.php">See All</a>
      <a href="../Employee/employee_add.php">New</a>
      <a href="../Employee/employee_search.php">Search</a>
    </div>
  </div>
</div>

<?php

$new_id = $_POST['id'];
$new_disc = $_POST['discount'];
$new_start = $_POST['start'];
$new_end = $_POST['end'];

$data = [
          'item_code' => $new_id,
          'discount' =>$new_disc,
          'start_date'=> $new_start,
          'end_date'=> $new_end
          ];
          

$url = "http://75.156.172.79:8000/store/promotion/add";

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
$options = array(CURLOPT_URL =>$url,
                 CURLOPT_HEADER => true,
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_POSTFIELDS => $data
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
$separate = explode(":",$attributes[1]); //Discount
$this_discount = str_replace('"', "", $separate[1]); //remove quotes
//handle attr[2]
$separate = explode(":",$attributes[2]); //Start Date
$this_start = str_replace('"',"",$separate[1]); //remove quotes
//attr[3]
$separate = explode(":",$attributes[2]); //End Date
$this_end = str_replace('"',"",$separate[1]); //remove quotes
$this_end = str_replace('}',"",$this_end); //remove curly brace

//Create Table with this Info

echo "<h3>Promotion " . $this_id . "</h3>";
echo "<h5>Details:</h5>";
echo "<table>
      <tr>";
echo "<th>ID</th>";
echo "<td>" . $this_id . "</td> </tr>";
echo "<tr><th>Discount</th>";
echo "<td>" . $this_discount . "%</td></tr>";
echo "<tr><th>Start Date</th>";
echo "<td>" . $this_start . "</td></tr>";
echo "<tr><th>End Date</th>";
echo "<td>" . $this_end . "</td></tr>
      </table>";
    
echo "<h3>Item added successfully.</h3>";

// close cURL resource, and free up system resources
curl_close($ch);
?>
    
<br><br>
<button class="button" style="margin-left=20px" onclick="window.location.href='product_list.php'" > Return to Product List </button>
    
</body>
</html>
