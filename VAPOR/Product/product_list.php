<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>VAPOR Product List</title>
<style>
a:link {
  color: #aff797;
}
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

tr:nth-child(even) {
  background-color: #383838;
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
      <a href="product_list.php">See All</a>
      <a href="product_add.php">New</a>
      <a href="product_search.php">Search</a>
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

<h3>All Products</h3>

<?php
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
$options = array(CURLOPT_URL =>'http://75.156.172.79:8000/store/product/list?format=json',
                CURLOPT_HTTPHEADER => array('Accept: application/json'),
                 CURLOPT_HEADER => true,
                 CURLOPT_RETURNTRANSFER => true
                );

curl_setopt_array($ch, $options);

// grab URL and pass it to the browser
$response = curl_exec($ch);

$table = explode("[",$response);

$variables = explode("{",$table[1]);


echo "<table>
<tr>
<th>Item Code</th>
<th>Title</th>
<th>Price </th>
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
    $separate = explode(":",$attributes[1]); //Title
    $this_title = str_replace('"', "", $separate[1]); //remove quotes
    //handle attr[2]
    $separate = explode(":",$attributes[2]); //Price
    $this_price = str_replace('"',"",$separate[1]); //remove quotes
    $this_price = str_replace('}',"",$this_price); //remove curly brace
    $this_price = str_replace(']',"",$this_price); //remove end bracket
    //attr[3] may exist but it is null
    
    $select_this = "product_select.php?item=" . $this_id;
    $delete_this = "product_delete.php?item=" . $this_id;
    
    //Create Table Row with this Info
    
    echo "<tr>";
    echo "<td>" . $this_id . "</td>";
    echo "<td>" . $this_title . "</td>";
    echo "<td>$" . $this_price . "</td>";
    echo "<td> <a href=\"$select_this\">View</a> </td>
          <td> <a href=\"$delete_this\">Delete</a> </td>";
    echo "</tr>";

  
  }
}

echo "</table>";


// close cURL resource, and free up system resources
curl_close($ch);
?>


</body>
</html>
