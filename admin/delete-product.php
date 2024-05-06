<?php 
    //Include COnstants Page
    include('../config/constants.php');

    //echo "Delete product Page";

    if(isset($_GET['id'])) 
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID 
        $id = $_GET['id'];

        //2. Delete product from Database
        $sql = "DELETE FROM tbl_product WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //3. Redirect to Manage product with Session Message
        if($res==true)
        {
            //product Deleted
            $_SESSION['delete'] = "<div class='success'>product Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }
        else
        {
            //Failed to Delete product
            $_SESSION['delete'] = "<div class='error'>Failed to Delete product.</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }

        
    }
    else
    {
        //Redirect to Manage product Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-product.php');
    }

?>