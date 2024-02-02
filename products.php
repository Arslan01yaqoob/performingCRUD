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
        <div class="row product-page1">
            <div>
                <h1>ALL Products of store</h1>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $serverAddress = 'localhost';
                        $username = 'root';
                        $password = '';
                        $dbname = 'jacket';

                        $con = new mysqli($serverAddress, $username, $password, $dbname);
                        
                        $sql = "SELECT * FROM product";
                        $result = $con->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <tr>
                          <th scope="row">' . $row['id'] . '</th>
                          <td><img class="product-img" src="images/' . $row['image'] . '" alt=""></td>    
                          <td>' . $row['name'] . '</td>
                          <td>' . $row['price'] . '</td>
                          <td>' . $row['description'] . '</td>
                          <td>
                                 <button class="btn btn-info">
                                      <a href="Edit.php?id=' . $row['id'] . '" style="color: white; text-decoration: none;">Edit info</a>
                                 </button>
                          </td>
                          <td>
                         <button class="btn btn-danger" onclick="confirmDelete(' . $row['id'] . ')">
                               <a href="delete.php?id=' . $row['id'] . '" style="color: white; text-decoration: none;">Delete Record</a>
                         </button>
                          </td>  
                              </tr>';
                            }
                        }
                        ?>


                    </tbody>
                </table>
                <a href="inserting-page.php" class="btn btn-success" >Add New</a>


            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmDelete(id) {
        var confirmation = confirm("Are you sure you want to delete this record?");
        if (confirmation) {
            // If the user clicks "OK" in the confirmation dialog, redirect to delete.php
            window.location.href = 'delete.php?id=' + id;
        } else {
            // If the user clicks "Cancel" in the confirmation dialog, do nothing
        }
    }
</script>



</body>

</html>