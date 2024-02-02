<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>delete page</title>


</head>
<body>
<?php

$serverAddress = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jacket';
$con = new mysqli($serverAddress, $username, $password, $dbname);


if(isset($_GET['id'])) {
    $id = $_GET['id'];
// data base se image ka path get karne ke liya selact query run kar gain
    $sqlSelect = "SELECT image FROM product WHERE id = $id";
    $resultSelect = $con->query($sqlSelect);
    
    if ($resultSelect->num_rows > 0) {
        $rowSelect = $resultSelect->fetch_assoc();
    
        // Get the image filename
        $imageFilename = $rowSelect['image'];
    
        // Folder sa image ko Delete karne ka liya
        if ($imageFilename !== 'default.jpg') {
            
            $imagePath = "images/" . $imageFilename;
            unlink($imagePath);
        }
    }



    // Perform the delete query
    $sql = "DELETE FROM product WHERE id = $id";
    

    if (mysqli_query($con, $sql)) {
        
        echo'
        <!-- Button trigger modal -->
        
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Deleted</h1>
              </div>
              <div class="modal-body">
                Your product has been Delete successfully
              </div>
              <div class="modal-footer">
              <a href="products.php">
                <button type="button" class="btn btn-primary">See Other Products</button>
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
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    echo "Invalid or missing ID parameter";
}



?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


