<?php 
    //Include Constants File
    include('../config/constants.php');

    //echo "Delete Page";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "")
        {
            //Image is Available. So remove it
            $path = "../images/section/".$image_name;
            //REmove the Image
            $remove = unlink($path);

            //IF failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the SEssion Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove section Image.</div>";
                //REdirect to Manage section page
                header('location:'.SITEURL.'admin/manage-section.php');
                //Stop the Process
                die();
            }
        }

        //Delete Data from Database
        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM tbl_section WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true)
        {
            //SEt Success MEssage and REdirect
            $_SESSION['delete'] = "<div class='success'>section Deleted Successfully.</div>";
            //Redirect to Manage section
            header('location:'.SITEURL.'admin/manage-section.php');
        }
        else
        {
            //SEt Fail MEssage and Redirecs
            $_SESSION['delete'] = "<div class='error'>Failed to Delete section.</div>";
            //Redirect to Manage section
            header('location:'.SITEURL.'admin/manage-section.php');
        }

 

    }
    else
    {
        //redirect to Manage section Page
        header('location:'.SITEURL.'admin/manage-section.php');
    }
?>