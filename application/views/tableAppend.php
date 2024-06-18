<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Product Management</title>
</head>
<body>
    <div class="container-fluid mt-2 p-0 p-2">
        <div class="card">
            <div class="card-body p-0 p-2">
                <div class="row">
                    <div class="col-4">
                        <form method="post" name="sample"
                            enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold">Product Name*</label>
                                <input type="text" class="form-control form-control-sm" name="item_name"
                                    id="item_name" required>
                            </div>                      
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold">Product Price*</label>
                                <input type="number" class="form-control form-control-sm" name="price"
                                    id="price" required>
                            </div>
                            <div class="form-group mt-2 text-right" style="padding-top: 5px;">
                                <input type="button" name="add" value="add data" onclick=addStudent();>
                            </div>

                            <input type="hidden" name="recordOption" id="recordOption" value="1">
                            <input type="hidden" name="recordID" id="recordID" value="">
                        </form>
                    </div>
                    <div class="col-8">
                        <div class="scrollbar pb-3" id="style-2">
                            <table class="table table-bordered table-striped table-sm nowrap"
                                id="tblproduct">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">

    function addStudent() {
        var name = document.sample.item_name.value;
        var price = document.sample.price.value;

        var tr = document.createElement('tr');

        var td1 = tr.appendChild(document.createElement('td'));
        var td2 = tr.appendChild(document.createElement('td'));

        td1.innerHTML = name;
        td2.innerHTML = price;

        document.getElementById("tblproduct").appendChild(tr);


    }

</script>
</body>
</html>