<?php
// product insert karne ka setup
$serverAddress = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jacket';
$con = new mysqli($serverAddress, $username, $password, $dbname);
if (isset($_POST['upload'])) {
    
    
    $Pname = $_POST['Name'];
    $Pprice = $_POST['Price'];
    $Pdescription = $_POST['description'];


    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $temp_name = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];

    $t = time();


    $file_destination = "images/" . $t . $file_name;
    $Iname = $t . $file_name;

    if ($file_type == 'image/jpg' || $file_type == 'image/png' || $file_type == 'image/jpeg') {
        move_uploaded_file($temp_name, $file_destination);
    }
    $sql = "INSERT INTO product(`name`,`price`,`description`,`image`) VALUES ('$Pname','$Pprice','$Pdescription','$Iname')";
    if ($con->query($sql) == TRUE) {
        echo 
        '
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Your product has been save successfully
          </div>
          <div class="modal-footer">
          <a href="products.php">
            <button type="button" class="btn btn-primary">See all Products</button>
            </a>
            </div>
        </div>
      </div>
    </div>    
    <script>
        // Trigger the modal automatically
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"));
            myModal.show();
        });
    </script>';
    } else {
        echo 'nahi hona';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row page1">
            <div class="inner-p1">
                <div class="box">
                    <h1>Enter your product detail</h1>
                    <form method="POST" action="inserting-page.php" enctype="multipart/form-data">
                        <div class="col-11">
                            <input type="text" class="form-control" placeholder="Name" name="Name" aria-label="Name">
                        </div>
                        <div class="row" style="height: 2vh;"></div>
                        <div class="col-11">
                            <input type="number" class="form-control" placeholder="Price" name="Price"
                                aria-label="price">
                        </div>
                        <div class="row" style="height: 2vh;"></div>
                        <div class="col-11">
                            <input type="text" class="form-control" placeholder="Description" name="description"
                                aria-label="description">
                        </div>
                        <div class="row" style="height: 2vh;"></div>
                        <div class="col-6">
                            <input type="file" class="form-control" placeholder="image" name="image" aria-label="image">
                        </div>
                        <div class="row" style="height: 2vh;"></div>
                        <button name="upload" type="submit" class="btn btn-info">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>