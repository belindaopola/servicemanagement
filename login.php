<?php 
    session_start(); // Start the session

    //Create Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost/symphony/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'symphony');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error()); //Database Connection

    if(isset($_POST['submit']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']); // You should consider using a more secure method for password hashing

        // SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // Execute the Query
        $res = mysqli_query($conn, $sql);

        // Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it

            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL);
            exit(); // Always exit after a header redirect
        }
        else
        {
            //User not Available and Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'login.php');
            exit(); // Always exit after a header redirect
        }
    }
?>

<html>
    <head>
        <title>Login - Service Request System</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form Ends Here -->

            <p class="text-center">Created By - <a href="#">Belinda Opola</a></p>
        </div>
    </body>
</html>
