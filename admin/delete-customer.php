<?php 
    //Include COnstants Page
    include('../config/constants.php');

    //echo "Delete customer Page";

    if(isset($_GET['id'])) 
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID 
        $id = $_GET['id'];

        //2. Delete customer from Database
        $sql = "DELETE FROM tbl_customer WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //3. Redirect to Manage customer with Session Message
        if($res==true)
        {
            //customer Deleted
            $_SESSION['delete'] = "<div class='success'>customer Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-customer.php');
        }
        else
        {
            //Failed to Delete customer
            $_SESSION['delete'] = "<div class='error'>Failed to Delete customer.</div>";
            header('location:'.SITEURL.'admin/manage-customer.php');
        }

        
    }
    else
    {
        //Redirect to Manage customer Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-customer.php');
    }

?>