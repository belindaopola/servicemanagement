<?php include('partials/menu.php'); ?>

<!DOCTYPE html>
<html>
<head>
<title>Add Customer</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>

</style>
</head>

<body>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Customer</h1>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
            <label for="inputCustomerName" class="col-sm-1 col-form-label">Customer Name:</label>
                <div class="col-sm-3"> 
                <input type="text" id="customer-name" name="customer_name" placeholder="Enter Customer Name" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputContact" class="col-sm-1 col-form-label">Contact:</label>
                <div class="col-sm-3">
                <input type="text" id="contact" name="contact" placeholder="Enter Customer Contact" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputEmail" class="col-sm-1 col-form-label">Email:</label>
                <div class="col-sm-3">
                <input type="email" id="email" name="email" placeholder="Enter Customer Email" class="form-control">
                </div>
            </div>
            <div class="row mb-4">
            <label for="InputAddress" class="col-sm-1 col-form-label">Address:</label>
                <div class="col-sm-3">
                <textarea type="text" id="address" name="address" placeholder="Enter Customer Address" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-4">
            <label for="inputPassword" class="col-sm-1 col-form-label">Password:</label>
                <div class="col-sm-3">
                <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" >
                </div>
            </div>
            <div class="row mb-4">
            <label for="inputFeatured" class="col-sm-1 col-form-label">Featured:</label>
                <div class="col-sm-3">
                <input class="form-check-input" type="radio" name="featured" id="featuredyes" value="Yes">
                <label class="form-check-label" for="featuredRadio">Yes</label>
                <input class="form-check-input" type="radio" name="featured" id="featuredno" value="No">
                <label class="form-check-label" for="featuredRadio">No</label>
                </div>
            </div>
            <div class="row mb-4">
            <label for="inputActive" class="col-sm-1 col-form-label">Active:</label>
                <div class="col-sm-3">
                <input class="form-check-input" type="radio" name="active" id="activeyes" value="Yes">
                <label class="form-check-label" for="activeRadio">Yes</label>
                <input class="form-check-input" type="radio" name="active" id="activeno" value="No">
                <label class="form-check-label" for="activeRadio">No</label>
                </div>
            </div>
            <button type="submit" name="submit" value="Add Customer" class="btn btn-primary col-sm-1">Add Customer</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

<?php include('partials/footer.php'); ?>

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