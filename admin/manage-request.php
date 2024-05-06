<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage request</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //REmoving Session Message
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br/><br/><br>/

                <!-- Button to Add Admin -->
                <a href="add-request.php" class="btn-primary">New CSR</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>CSR Ref.</th>
                        <th>Request Date</th>
                        <th>Customer Name</th>
                        <th>Description</th>
                        <th>Quotation</th>
                        <th>Customer PO</th>
                        <th>Costing Sheet</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>VAT</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Salesperson</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the requests from database
                        $sql = "SELECT * FROM tbl_request"; // DIsplay the Latest request at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //request Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the request details
                                $id = $row['id'];
                                $request_date = $row['request_date'];
                                $customer_name = $row['customer_name'];
                                $description = $row['description'];
                                $quotation = $row['quotation'];
                                $customer_po = $row['customer_po'];
                                $costing_sheet = $row['costing_sheet'];
                                $currency = $row['currency'];
                                $price = $row['price'];
                                $vat = $row['vat'];
                                $total = $row['total'];
                                $status = $row['status'];
                                $salesperson = $row['sales_person'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo "TS" . date("Y") . "/" . sprintf('%03d', $sn++); ?></td>
                                        <td><?php echo $request_date; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td>
                                            <?php
                                                // Check whether quotation attachment is available or not
                                                if ($quotation != "") {
                                                    // Display quotation image
                                                    ?>
                                                    <a href="<?php echo SITEURL; ?>uploads/quotation/<?php echo $quotation; ?>" target="_blank">View Quotation</a>
                                                <?php
                                                } else {
                                                    echo "<div class='error'>Please attach quotation.</div>";
                                                }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                                // Check whether purchase order attachment is available or not
                                                if ($customer_po != "") {
                                                    // Display purchase order image
                                                    ?>
                                                    <a href="<?php echo SITEURL; ?>uploads/po/<?php echo $customer_po; ?>" target="_blank">View Purchase Order</a>
                                                <?php
                                                } else {
                                                    echo "<div class='error'>Please attach purchase order.</div>";
                                                }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                                // Check whether costing sheet attachment is available or not
                                                if ($costing_sheet != "") {
                                                    // Display costing sheet image
                                                    ?>
                                                    <a href="<?php echo SITEURL; ?>uploads/costing/<?php echo $costing_sheet; ?>" target="_blank">View Costing Sheet</a>
                                                <?php
                                                } else {
                                                    echo "<div class='error'>Please attach costing sheet.</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $currency; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $vat; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $salesperson; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-request.php?id=<?php echo $id; ?>" class="btn-secondary">Update request</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Request not Available
                            echo "<tr><td colspan='12' class='error'>No request available</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>