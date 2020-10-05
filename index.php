<?php

//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();



function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}



if (!isset($_GET["food"]) == 1 or $_GET["food"]) {
    $products = [
        ['name' => 'Club Ham', 'price' => 3.20],
        ['name' => 'Club Cheese', 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'price' => 4],
        ['name' => 'Club Chicken', 'price' => 4],
        ['name' => 'Club Salmon', 'price' => 5]
    ];
} else {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}
//defining all variables as empty at start of loading the page
$email = $street = $streetnumber = $city = $zipcode = $emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = '';

// if sessions exists use session else leave empty
//if ($_SESSION["newsession"]) {
//     $email = $_SESSION["email"];
//}

//validating variables and saving them inside of the session when validated and correct.
 if (isset($_SESSION["email"])){
     $email = $_SESSION["email"];
     $street = $_SESSION["street"];
     $streetnumber = $_SESSION["streetnumber"];
     $city = $_SESSION["city"];
     $zipcode = $_SESSION["zipcode"];
 }
else if($_SERVER["REQUEST_METHOD"] == "POST"){
$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
} else {
    $_SESSION["email"] = $email;
}

$street = test_input($_POST["street"]);
if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
    $streetErr = "Only letters and white space allowed";
} else {
    $_SESSION["street"] = $street;
}

$streetnumber = test_input($_POST["streetnumber"]);
if (!preg_match('#[0-9]#', $streetnumber)) {
    $streetnumberErr = "Only use numbers";
} else {
    $_SESSION["streetnumber"] = $streetnumber;
}

$city = test_input($_POST["city"]);
if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
    $cityErr = "Only letters and white space allowed";
} else {
    $_SESSION["city"] = $city;
}

$zipcode = test_input($_POST["zipcode"]);
if (!preg_match('#[0-9]{4}#', $zipcode)) {
    $zipcodeErr = "Only use numbers, max. 4 numbers allowed.";
} else {
    $_SESSION["zipcode"] = $zipcode;
}
}


// input checker for form data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$totalValue = 0;
whatIsHappening();

require 'form-view.php';