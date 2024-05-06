<?php 
    
    //Start Session
    session_start();
    
    //Create Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/symphony/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'symphony');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database

    include('login-check.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symphony Service Requests</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/symphony logo.png" alt="Symphony Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>

                    <li>
                        <a href="<?php echo SITEURL; ?>products.php">Create Request</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>logout.php">Logout</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->