<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VAPOR Search Results</title>
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
  width: 100%;
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
      <a href="customer_list.php">See All</a>
      <a href="customer_add.php">New</a>
      <a href="customer_search.php">Search</a>
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
      <a href="../Employee/employee_list.php">See All</a>
      <a href="../Employee/employee_add.php">New</a>
      <a href="../Employee/employee_search.php">Search</a>
    </div>
  </div>
</div>

<?php

$query = $_POST['query'];

$data = [
          'username'=> $query
          ];
          

$url = "http://75.156.172.79:8000/store/customer/search";

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
$options = array(CURLOPT_URL =>$url,
                 CURLOPT_HEADER => true,
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_CUSTOMREQUEST => 'GET',
                 CURLOPT_POSTFIELDS => $data
                );

curl_setopt_array($ch, $options);

// grab URL and pass it to the browser
$response = curl_exec($ch);

$table = explode("[",$response);

$variables = explode("{",$table[1]);


if (sizeof($variables) > 1) {
  echo "<table>
  <tr>
  <th>Customer ID</th>
  <th>Name</th>
  <th>Username </th>
  <th>Address</th>
  <th>Email</th>
  <th>Password</th>
  <th></th>
  <th></th>
  </tr>";
  
  
  
  foreach($variables as &$value) {
    
    if (strlen($value) > 1) {
      $attributes = explode(",", $value);
  
      //handle attr[0]
    $separate = explode(":",$attributes[0]); //ID
    $this_id = $separate[1]; //no need to remove quotes because ID is int
    //handle attr[1]
    $separate = explode(":",$attributes[1]); //Name
    $this_name = str_replace('"', "", $separate[1]); //remove quotes
    //handle attr[2]
    $separate = explode(":",$attributes[2]); //Username
    $this_user = str_replace('"',"",$separate[1]); //remove quotes
    //attr[3]
    $separate = explode(":",$attributes[3]);//Address
    $this_address = str_replace('"',"",$separate[1]);
    //attr[4]
    $separate = explode(":",$attributes[4]); //Email
    $this_email = str_replace('"',"",$separate[1]);
    //attr[5]
    $separate = explode(":",$attributes[5]); //Password
    $this_pw = str_replace('"',"",$separate[1]);
    $this_pw = str_replace('}',"",$this_pw); //remove curly brace
    $this_pw = str_replace(']',"",$this_pw); //remove end bracket
    
    $select_this = "customer_select.php?id=" . $this_id;
    $delete_this = "customer_delete.php?id=" . $this_id;
    
    //Create Table Row with this Info
    
    echo "<tr>";
    echo "<td>" . $this_id . "</td>";
    echo "<td>" . $this_name . "</td>";
    echo "<td>" . $this_user . "</td>";
    echo "<td>" . $this_address . "</td>";
    echo "<td>" . $this_email . "</td>";
    echo "<td>" . $this_pw . "</td>";
    echo "<td> <a href=\"$select_this\">View</a> </td>
          <td> <a href=\"$delete_this\">Delete</a> </td>";
    echo "</tr>";


echo "</table>";


  
    
    }
  }
}
else {
  echo "<h3> No results found. Try again. </h3>";
}


// close cURL resource, and free up system resources
curl_close($ch);
?>
    
<br><br>
<button class="button" style="margin-left=20px" onclick="window.location.href='customer_list.php'" > See all </button>
    
</body>
</html>
