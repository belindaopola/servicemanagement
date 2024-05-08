<?php include('partials/menu.php'); ?>

<?php 
    if(isset($_SESSION['add'])) //Checking whether the Session is Set of Not
    {
        echo $_SESSION['add']; //Display the SEssion Message if SEt
        unset($_SESSION['add']); //Remove Session Message
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Create CSR</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<div class="container">
</head>

<body>
<h2 class="text-center text-black">Create New CSR</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<section>

<div class="row mb-4">
    <label for="customerName" class="col-sm-3 col-form-label">Customer Name:</label>
    <div class="col-sm-5">
    <input type="text" id="customer-name" placeholder="Customer Name" class="form-control">
    </div>
</div>
<div class="row mb-4">
    <label for="productDescription" class="col-sm-3 col-form-label">Product Description:</label>
    <div class="col-sm-5">
    <input type="text" id="product-description" placeholder="Product Description" class="form-control">
    </div>
</div>
<div class="row mb-4">
    <label for="quotation" class="col-sm-3 col-form-label">Add Quotation:</label>
    <div class="col-sm-5">
    <input type="file" id="quotation"  class="form-control">
    </div>
</div>
<div class="row mb-4">
    <label for="customerPO" class="col-sm-3 col-form-label">Add Customer's PO:</label>
    <div class="col-sm-5">
    <input type="file" id="customer-po"  class="form-control">
    </div>
</div>
<div class="row mb-4">
    <label for="costingSheet" class="col-sm-3 col-form-label">Add Costing Sheet:</label>
    <div class="col-sm-5">
    <input type="file" id="costing-sheet"  class="form-control">
    </div>
</div>
<div class="row mb-4">
    <label for="currency" class="col-sm-3 col-form-label">Currency:</label>
    <div class="col-sm-5">
    <select name="currency">
        <option value="KES">KES</option>
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
    </select>
    </div>
</div>
<div class="row mb-4">
    <label for="price" class="col-sm-3 col-form-label">Price:</label>
    <div class="col-sm-5">
    <input type="number" id="price" placeholder="Enter Price" class="form-control">
    </div>
</div>
<div class="row mb-4">
    <label for="vat" class="col-sm-3 col-form-label">Enter VAT Amount:</label>
    <div class="col-sm-5">
    <input type="number" id="vat" placeholder="Enter VAT Amount" class="form-control">
    </div>
</div>
<div class="row mb-4">
    <label for="status" class="col-sm-3 col-form-label">Status:</label>
    <div class="col-sm-5">
    <select name="status">
        <option value="Pending">Pending</option>
        <option value="Approved">Approved</option>
        <option value="Delivered">Delivered</option>
        <option value="Cancelled">Cancelled</option>
    </select>
    </div>
</div>
<div class="row mb-4">
    <label for="salesPerson" class="col-sm-3 col-form-label">Sales Person:</label>
    <div class="col-sm-5">
    <input type="text" id="sales-person" placeholder="Sales Person" class="form-control">
    </div>
</div>
    <button id="save_btn" type="save" class="btn btn-primary col-sm-1" name="save">Save</button>
</form>

<?php
    // Process the value from form and save it in the database
    // Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {
    // Get the data from form
    // Retrieve and sanitize form data
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $product_desc = mysqli_real_escape_string($conn, $_POST['description']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $vat = mysqli_real_escape_string($conn, $_POST['vat']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $salesperson = mysqli_real_escape_string($conn, $_POST['salesperson']);

    // Upload Quotation
    if ($_FILES['quotation']['error'] === UPLOAD_ERR_OK) {
        $quotation = $_FILES['quotation']['name'];
        $quotation_ext = pathinfo($quotation, PATHINFO_EXTENSION);
        // Get the last inserted ID
        $q_last_id_query = "SELECT MAX(id) AS q_last_id FROM tbl_request"; // Fetch the last inserted ID
        $q_result = mysqli_query($conn, $q_last_id_query);
        $q_row = mysqli_fetch_assoc($q_result);
        $q_last_id = $q_row['q_last_id'];
        $quotation_new_name = "Quotation_TS" . date("Y") . "_" . sprintf('%03d', $q_last_id+1) . '.' . $quotation_ext; // Serialize from last inserted ID
        // Document renamed successfully
        $quotation_path = 'uploads/quotation/' . $quotation_new_name; // Specify the correct directory for the quotation
        move_uploaded_file($_FILES['quotation']['tmp_name'], $quotation_path);
        $quotation = $quotation_new_name;
    } else {
        $quotation = "";
    }

    // Upload Customer PO
    if ($_FILES['customer_po']['error'] === UPLOAD_ERR_OK) {
        $customer_po = $_FILES['customer_po']['name'];
        $customer_po_ext = pathinfo($customer_po, PATHINFO_EXTENSION);
        // Get the last inserted ID
        $p_last_id_query = "SELECT MAX(id) AS p_last_id FROM tbl_request"; // Fetch the last inserted ID
        $p_result = mysqli_query($conn, $p_last_id_query);
        $p_row = mysqli_fetch_assoc($p_result);
        $p_last_id = $p_row['p_last_id'];
        $customer_po_new_name = "Customer PO_TS" . date("Y") . "_" . sprintf('%03d', $p_last_id+1) . '.' . $customer_po_ext; // Serialize from last inserted ID
        // Document renamed successfully
        $customer_po_path = 'uploads/po/' . $customer_po_new_name;
        move_uploaded_file($_FILES['customer_po']['tmp_name'], $customer_po_path);
        $customer_po = $customer_po_new_name;
    } else {
        $customer_po = "";
    }

    // Upload Costing Sheet
    if ($_FILES['costing_sheet']['error'] === UPLOAD_ERR_OK) {
        $costing_sheet = $_FILES['costing_sheet']['name'];
        $costing_sheet_ext = pathinfo($costing_sheet, PATHINFO_EXTENSION);
        // Get the last inserted ID
        $c_last_id_query = "SELECT MAX(id) AS c_last_id FROM tbl_request"; // Fetch the last inserted ID
        $c_result = mysqli_query($conn, $c_last_id_query);
        $c_row = mysqli_fetch_assoc($c_result);
        $c_last_id = $c_row['c_last_id'];
        $costing_sheet_new_name = "Costing_TS" . date("Y") . "_" . sprintf('%03d', $c_last_id+1) . '.' . $costing_sheet_ext; // Serialize from last inserted ID
        // Document renamed successfully
        $costing_sheet_path = 'uploads/costing/' . $costing_sheet_new_name;
        move_uploaded_file($_FILES['costing_sheet']['tmp_name'], $costing_sheet_path);
        $costing_sheet = $costing_sheet_new_name;
    } else {
        $costing_sheet = "";
    }

        // Calculate total
        $total = $price + $vat;

        // Update the database with the file names
        $sql3 = "INSERT INTO tbl_request SET
        customer_name='$customer_name',
        description='$product_desc',
        quotation='$quotation',
        customer_po='$customer_po',
        costing_sheet='$costing_sheet',
        price='$price',
        vat='$vat',
        total='$total',
        currency ='$currency',
        status='$status',
        sales_person='$salesperson'
        "; 

        // Execute query and save data in database
        $res3 = mysqli_query($conn, $sql3);

        //Check if the query was successful
        if($res3==true)
        {
            //Add new
            $_SESSION['add'] = "<div class='success'>request Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-request.php');
        }
        else
        {
            //Failed to add new
            $_SESSION['add'] = "<div class='error'>Failed to Update request.</div>";
            header('location:'.SITEURL.'admin/manage-request.php');
        }
    }
?>   

<div class="clearfix"></div>

<!-- product Menu Section Ends Here -->
<?php include('partials/footer.php'); ?>

</div>
</section>  
</body>
</html> 