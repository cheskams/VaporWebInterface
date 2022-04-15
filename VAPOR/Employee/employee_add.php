<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VAPOR New Employee</title>
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

<h3>Add Employee</h3>
<h5 style="margin-left:45px"><i>Enter Details</i></h5>

<form style="margin-left:50px" action="add_success.php" method="post">
  <label for="name">Full Name:</label><br>
  <input type="text" id="name" name="name"><br><br>
  <label for="salary">Salary:</label><br>
  <input type="text" id="salary" name="salary"><br><br>
  <label for="hours">Hours:</label><br>
  <input type="text" id="hours" name="hours"><br><br>
  <input type="submit" value="Add Employee">
</form>

</body>
</html>
