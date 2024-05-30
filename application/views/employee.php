<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <title>Product Management</title>
</head>
<body>
    <div class="container-fluid mt-2 p-0 p-2">
        <div class="card">
            <div class="card-body p-0 p-2">
                <div class="row">
                    <div class="col-4">
                        <form action="<?php echo base_url() ?>empController/Employeeinsertupdate" method="post"
                            enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold">Employee Name*</label>
                                <input type="text" class="form-control form-control-sm" name="name"
                                    id="name" required>
                            </div>                       
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold">Nic*</label>
                                <input type="number" class="form-control form-control-sm" name="nic"
                                    id="nic" required>
                            </div>
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold">Contact number*</label>
                                <input type="text" class="form-control form-control-sm" name="contact"
                                    id="contact" required>
                            </div>
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold">City*</label>
                                <input type="text" class="form-control form-control-sm" name="city"
                                    id="city" required>
                            </div>
                            <div class="form-group mt-2 text-right" style="padding-top: 5px;">
                                <button type="submit" id="submitBtn" class="btn btn-primary btn-sm px-5">
                                    <i class="far fa-save"></i>&nbsp;Add</button>
                            </div>

                            <input type="hidden" name="recordOption" id="recordOption" value="1">
                            <input type="hidden" name="recordID" id="recordID" value="">
                        </form>
                    </div>
                    <div class="col-8">
                        <div class="scrollbar pb-3" id="style-2">
                            <table class="table table-bordered table-striped table-sm nowrap"
                                id="tblemployee">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>NIC</th>
                                        <th>Contact number</th>
                                        <th>City</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "includes/footerscripts.php"; ?>

<script>
$(document).ready(function() {

    $('#tblemployee').DataTable({
			"destroy": true,
			"processing": true,
			"serverSide": true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			responsive: true,
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, 'All'],
			],
			"buttons": [{
					extend: 'csv',
					className: 'btn btn-success btn-sm',
					title: 'Employee  Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
				{
					extend: 'pdf',
					className: 'btn btn-danger btn-sm',
					title: 'Employee  Information',
					text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
				},
				{
					extend: 'print',
					title: 'Employee  Information',
					className: 'btn btn-primary btn-sm',
					text: '<i class="fas fa-print mr-2"></i> Print',
					customize: function (win) {
						$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');
					},
				},
				// 'copy', 'csv', 'excel', 'pdf', 'print'
			],
			ajax: {
				url: "<?php echo base_url() ?>scripts/employeelist.php",
				type: "POST", // you can use GET
				// data: function(d) {}
			},
			"order": [
				[0, "desc"]
			],
			"columns": [{
					"data": "id"
				},
				{
					"data": "name"
				},
				{
					"data": "nic"
				},
				{
					"data": "contact"
				},
				{
					"data": "city"
				},
                {
                "data": null,
                "className": "text-right",
                "defaultContent": '<button class="btn btn-warning btn-sm btnEdit" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i>Edit</button> <button class="btn btn-danger btn-sm btnDelete" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i>Delete</button>'
                }
                
			],
            drawCallback: function (settings) {
				$('[data-toggle="tooltip"]').tooltip();
			}
		});

    $('#tblemployee tbody').on('click', '.btnEdit', function () {
        var data = $('#tblemployee').DataTable().row($(this).parents('tr')).data();
        var id = data.id;
        var r = confirm("Are you sure you want to edit this?");
        if (r == true) {
            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: '<?php echo base_url() ?>empController/edit_product',
                success: function(result) { 
                    var obj = JSON.parse(result);

                    $('#recordID').val(obj.id); 
                    $('#name').val(obj.name);
                    $('#nic').val(obj.nic);
                    $('#contact').val(obj.contact);
                    $('#city').val(obj.city); 
                    $('#recordOption').val('2');
                    $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
                }
            });
        }
    });

    $('#tblemployee tbody').on('click', '.btnDelete', function() {
        var data = $('#tblemployee').DataTable().row($(this).parents('tr')).data();
        var id = data.id;
        var q = confirm("Are you sure you want to delete this?");
        if (q == true) {
        $.ajax({
            type: "POST",
            data: { id: id },
            url: '<?php echo base_url() ?>empController/delete_product',
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