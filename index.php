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
        ['name' => 'Club Ham', 'class' => food , 'price' => 3.20],
        ['name' => 'Club Cheese', 'class' => food, 'price' => 3],
        ['name' => 'Club Cheese & Ham', 'class' => food, 'price' => 4],
        ['name' => 'Club Chicken', 'class' => food , 'price' => 4],
        ['name' => 'Club Salmon', 'class' => food , 'price' => 5],
        ['name' => 'Cola', 'class' => drinks ,'price' => 2],
        ['name' => 'Fanta', 'class' => drinks ,'price' => 2],
        ['name' => 'Sprite', 'class' => drinks , 'price' => 2],
        ['name' => 'Ice-tea', 'class' => drinks ,'price' => 3],
    ];
}
//defining all variables as empty at start of loading the page
$email = $street = $streetnumber = $city = $zipcode = $emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = '';

// if sessions exists use session else leave empty

//validating variables and saving them inside of the session when validated and correct.
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    $street = $_SESSION["street"];
    $streetnumber = $_SESSION["streetnumber"];
    $city = $_SESSION["city"];
    $zipcode = $_SESSION["zipcode"];
    $deliverytime = deliveryTime();


    if(empty($emailErr && $streetErr && $streetnumberErr && $cityErr && $zipcodeErr)){
        $orderMessage = "Your order is succesfully completed";
    }

    else{
        $orderMessage = "Please fill in the required fields";
    }

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Please fill in your email adress";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $_SESSION["email"] = $email;
        }
    }

    if (empty($_POST["street"])) {
        $streetErr = "Please fill in your street name";
    } else {
        $street = test_input($_POST["street"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
            $streetErr = "Only letters and white space allowed";
        } else {
            $_SESSION["street"] = $street;
        }
    }

    if (empty($_POST["streetnumber"])) {
        $streetnumberErr = "Please fill in your streetnumber";
    }
    else {
        $streetnumber = test_input($_POST["streetnumber"]);
        if (!preg_match('#[0-9]#', $streetnumber)) {
            $streetnumberErr = "Only use numbers";
        } else {
            $_SESSION["streetnumber"] = $streetnumber;
        }
    }

    if (empty($_POST["city"])) {
        $cityErr = "Please fill in the name of your city";
    }
    else {
        $city = test_input($_POST["city"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $cityErr = "Only letters and white space allowed";
        } else {
            $_SESSION["city"] = $city;
        }
    }

    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Please fill in your email adress";
    }
    else {
        $zipcode = test_input($_POST["zipcode"]);
        if (!preg_match('#[0-9]{4}#', $zipcode)) {
            $zipcodeErr = "Only use numbers, max. 4 numbers allowed.";
        } else {
            $_SESSION["zipcode"] = $zipcode;
        }
    }
    if(empty($emailErr && $streetErr && $streetnumberErr && $cityErr && $zipcodeErr)){
        $orderMessage = "Your order is succesfully completed";
    }

    else{
        $orderMessage = "Please fill in the required fields";
    }
}
function deliveryTime() {
    if(isset($_POST["express_delivery"]) && $_POST['express_delivery'] == "5"){
        $deliverytime = "Your order will be delivered in 45 minutes";
    }
    else{
        $deliverytime = "Your order will be delivered 2 hours";
    }
    return $deliverytime;
}


// input checker for form data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function totalValue(){
if (isset($_POST["products"])){
    $food = $_POST["products"];
    $count = count($food);
    for ($i=o;$i<$count;$i++){
        if ($food[$i]==1){
        }

    }

}
}
$totalValue = 0;
whatIsHappening();

require 'form-view.php';