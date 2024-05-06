<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Customer</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter name of customer">
                    </td>
                </tr>

                <tr>
                    <td>Contact: </td>
                    <td>
                        <input type="text" name="contact" placeholder="+254700000000">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email">
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <textarea name="address" cols="30" rows="5" placeholder="The Crescent Business Centre, Off Parklands Road"></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Customer" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the customer to the Database
                
                //Get the Data from Form
                $customer_name = $_POST['name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //Check whether radio buttons for featured and active are checked or not
                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No"; // Setting the default value
                $active = isset($_POST['active']) ? $_POST['active'] : "No"; // Setting the default value

                // Insert Into Database
                $sql2 = "INSERT INTO tbl_customer (customer_name, customer_contact, customer_email, customer_address, featured, active) VALUES ('$customer_name', '$customer_contact', '$customer_email', '$customer_address', '$featured', '$active')";
                
                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether data inserted or not
                if($res2)
                {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Customer Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-customer.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Customer.</div>";
                    header('location:'.SITEURL.'admin/add-customer.php');
                }
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
