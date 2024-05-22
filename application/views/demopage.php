<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Product Management</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <!-- Form to add product -->
        <div class="col-md-4 border p-3">
            <form method="post" action="<?php echo site_url('PageController/add_product'); ?>" id="productForm">
                <fieldset>
                    <legend>Add Product</legend>
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date" id="date" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Unit Price:</label>
                        <input type="number" step="0.01" class="form-control" name="unit_price" id="unit_price" required>
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Selling Price:</label>
                        <input type="number" step="0.01" class="form-control" name="selling_price" id="selling_price" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn" >Add Product</button>
                </fieldset>
                <input type="hidden" class="form-control" name="recordOption" id="recordOption" value="1" required>
                <input type="hidden" name="recordID" id="recordID" value="">
            </form>

        </div>


        <!-- Table to display products -->
        <div class="col-md-8 border p-3">
            <fieldset>
                <legend>Products</legend>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Selling Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><?php echo $product['Product_name']; ?></td>
                                    <td><?php echo $product['date']; ?></td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td><?php echo $product['Unit_price']; ?></td>
                                    <td><?php echo $product['Selling_price']; ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-btn" 
                                        data-id="<?php echo $product['id']; ?>" 
                                        >Edit</button>
                                    </td>
                                    <td><button type="button" class="btn btn-danger btn-sm delete-btn" 
                                    data-id="<?php echo $product['id']; ?>"
                                    <?php echo site_url('PageController/delete_product'); ?>>delete</button></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No products available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var r = confirm("Are you sure you want to edit this?");
        if (r == true) {
            var id = $(this).data('id'); 
            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: '<?php echo base_url() ?>PageController/edit_product',
                success: function(result) { 
                    var obj = JSON.parse(result);

                    $('#id').val(obj.id); 
                    $('#product_name').val(obj.product_name);
                    $('#date').val(obj.date);
                    $('#quantity').val(obj.quantity);
                    $('#unit_price').val(obj.unit_price); 
                    $('#selling_price').val(obj.selling_price); 
                    $('#recordOption').val('');
                }
            });
        }
    });

    $('.delete-btn').on('click', function() {
        var q = confirm("Are you sure you want to delete this?");
        if (q == true) {
            var id = $(this).data('id');
        $.ajax({
            type: "POST",
            data: { id: id },
            url: '<?php echo base_url() ?>PageController/delete_product',
            success: function(response) {
                location.reload();
            }
        });
        }   
    });
});


</script>
</body>
</html>
