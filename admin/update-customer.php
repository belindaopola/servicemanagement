<?php include('partials/menu.php'); ?>

<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected product
        $sql2 = "SELECT * FROM tbl_product WHERE id=$id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected product
        $title = $row2['title'];
        $current_section = $row2['section_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to Manage product
        header('location:'.SITEURL.'admin/manage-product.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Product/Service</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Description: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>section: </td>
                <td>
                    <select name="section">

                        <?php 
                            //Query to Get ACtive Categories
                            $sql = "SELECT * FROM tbl_section WHERE active='Yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                            //Check whether section available or not
                            if($count>0)
                            {
                                //section Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $section_title = $row['title'];
                                    $section_id = $row['id'];
                                    
                                    //echo "<option value='$section_id'>$section_title</option>";
                                    ?>
                                    <option <?php if($current_section==$section_id){echo "selected";} ?> value="<?php echo $section_id; ?>"><?php echo $section_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //section Not Available
                                echo "<option value='0'>section Not Available.</option>";
                            }

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="submit" value="Update product" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $section = $_POST['section'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];
                                   
               //2. Update the product in Database
                $sql3 = "UPDATE tbl_product SET 
                    title = '$title',
                    price = $price,
                    section_id = '$section',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and product Updated
                    $_SESSION['update'] = "<div class='success'>product Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
                else
                {
                    //Failed to Update product
                    $_SESSION['update'] = "<div class='error'>Failed to Update product.</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>