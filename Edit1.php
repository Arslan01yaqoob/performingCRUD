<?php
$serverAddress = 'localhost';
$username = 'root';
$password = '';
$dbname = 'jacket';

$con = new mysqli($serverAddress, $username, $password, $dbname);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $newName = $_POST['new_name'];
    $newPrice = $_POST['new_price'];

    $sqlUpdate = "UPDATE product SET name = '$newName', price = '$newPrice' WHERE id = $id";

    if (mysqli_query($con, $sqlUpdate)) {
        echo "Record with ID $id updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM product WHERE id = $id";
    $resultSelect = $con->query($sqlSelect);

    if ($resultSelect->num_rows == 1) {
        $rowSelect = $resultSelect->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here -->
</head>

<body>
    <form action="Edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $rowSelect['id']; ?>">

        <label for="new_name">New Name:</label>
        <input type="text" name="new_name" value="<?php echo $rowSelect['name']; ?>" required>

        <label for="new_price">New Price:</label>
        <input type="text" name="new_price" value="<?php echo $rowSelect['price']; ?>" required>

        <button type="submit" class="btn btn-primary">Update Record</button>
    </form>
</body>

</html>

<?php
    } else {
        echo "Record not found";
    }
} else {
    echo "Invalid or missing ID parameter";
}

mysqli_close($con);
?>
