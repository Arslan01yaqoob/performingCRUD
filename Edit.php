<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row update-page1">
            
            <?php
            $serverAddress = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'jacket';

            $con = new mysqli($serverAddress, $username, $password, $dbname);
            // update query ka setup
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id'];


                $newName = $_POST['Name'];
                $newPrice = $_POST['Price'];
                $newDes = $_POST['description'];


                $file_name = $_FILES['image']['name'];
                $file_type = $_FILES['image']['type'];
                $temp_name = $_FILES['image']['tmp_name'];
                $file_size = $_FILES['image']['size'];



                $t = time();

                $file_destination = "images/" . $t . $file_name;


                $newimage = $t . $file_name;

                if ($file_type == 'image/jpg' || $file_type == 'image/png' || $file_type == 'image/jpeg') {
                    move_uploaded_file($temp_name, $file_destination);
                }

                $oldimg = $_POST['old-img'];



                // jab ap koi image update na karo phir yahi purani wali image lag jaye
                if (!empty($_FILES['image']['name'])) {

                    $file_name = $_FILES['image']['name'];
                    $imgaddress = $t . $file_name;
                } else {
                    $imgaddress = $oldimg;
                }
                ;
                // end


                    // jab nai image upload ho to purani delete ho jani caheya
                $sqlfd = "SELECT * FROM product WHERE id = $id";
                $resultfd = $con->query($sqlfd);
                foreach ($resultfd as $fd_row) {


                    if ($file_name == NULL) {
                        $image_data = $fd_row['image'];

                    }else{

                        if($img_path ="images/".$fd_row['image']){
                            unlink($img_path);
                            $imgaddress = $t . $file_name;
                        }

                    }

                }
            

                // insert query ko run karne ka liya
            
                $sqlUpdate = "UPDATE product SET name = '$newName', price = '$newPrice', description ='$newDes',image = '$imgaddress'   WHERE id = $id";

                if (mysqli_query($con, $sqlUpdate)) {
                    echo '<div class="alert alert-success" role="alert">Record with ID ' . $id . ' updated successfully</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error updating record: ' . mysqli_error($con) . '</div>';
                }
            }

            // jab ap input filed ko value give karne ka liya database sa data fetch karain
            
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];

                $sqlSelect = "SELECT * FROM product WHERE id = $id";
                $resultSelect = $con->query($sqlSelect);

                if ($resultSelect->num_rows == 1) {
                    $rowSelect = $resultSelect->fetch_assoc();
                    ?>



                    <h1>Update your product details</h1>
                    <div class="box">
                        <div class="row" style="height:7vh;"></div>
                        <form method="POST" action="Edit.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $rowSelect['id']; ?>">


                            <div class="col-11">
                                <input type="text" class="form-control" name="Name" value="<?php echo $rowSelect['name']; ?>"
                                    required>
                            </div>
                            <div class="row" style="height: 2vh;"></div>
                            <div class="col-11">
                                <input type="number" class="form-control" value="<?php echo $rowSelect['price']; ?>"
                                    name="Price" aria-label="price">
                            </div>
                            <div class="row" style="height: 2vh;"></div>
                            <div class="col-11">
                                <input type="text" class="form-control" placeholder="Description"
                                    value="<?php echo $rowSelect['description']; ?>" name="description">
                            </div>
                            <div class="row" style="height: 2vh;"></div>
                            <div class="col-6">

                                <input type="file" class="form-control" placeholder="image" name="image" aria-label="image">
                                <input type="hidden" name="old-img" value="<?php echo $rowSelect['image']; ?>">

                            </div>
                            <div class="row" style="height: 2vh;"></div>

                            <button name="upload" type="submit" class="btn btn-info">Confirm</button>

                        </form>
                    </div>
                    <?php
                } else {

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
                }
            }

            ?>




        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>