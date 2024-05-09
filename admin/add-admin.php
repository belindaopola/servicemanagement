<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html>
<head>
<title>Add Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>

</style>
</head>

<body>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php 
            if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">
            <div class="row mb-4">
            <label for="inputFullName" class="col-sm-1 col-form-label">Full Name:</label>
                <div class="col-sm-3">
                <input type="text" id="full-name" name="full_name" placeholder="Enter Name" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputUsername" class="col-sm-1 col-form-label">Username:</label>
                <div class="col-sm-3">
                <input type="text" id="username" name="username" placeholder="Enter Username" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="inputPassword" class="col-sm-1 col-form-label">Password:</label>
                <div class="col-sm-3">
                <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" >
                </div>
            </div>

            <button type="submit" name="submit" value="Add Admin" class="btn btn-primary col-sm-1">Add Admin</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    } 
?>

<?php include('partials/footer.php'); ?>