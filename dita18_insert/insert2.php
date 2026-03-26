
<?php
try {
    include('connect.php');

    if (isset($_POST['produktet'])) {

        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $details = $_POST['details'];

        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];

        if ($name == '' || $price == '' || $quantity == '' || $photo == '') {
            echo "<script>alert('Any input is Empty');</script>";
        } else {

            // Check if product already exists
            $select = "SELECT * FROM produktet WHERE name = :name LIMIT 1";
            $query = $conn->prepare($select);
            $query->bindParam(':name', $name);
            $query->execute();
            $exist = $query->fetch(PDO::FETCH_ASSOC);

            if ($exist) {
                echo "<script>alert('This product already exists!');</script>";
            } else {

                move_uploaded_file($photo_tmp, "../uploads/$photo");

                $insert = "INSERT INTO produktet(name, price, quantity, details, photo)
                           VALUES(:name, :price, :quantity, :details, :photo)";

                $query = $conn->prepare($insert);
                $query->bindParam(':name', $name);
                $query->bindParam(':price', $price);
                $query->bindParam(':quantity', $quantity);
                $query->bindParam(':details', $details);
                $query->bindParam(':photo', $photo);

                if ($query->execute()) {
                    echo "<script>alert('Product inserted successfully');</script>";
                }
            }
        }
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Product</title>
</head>

<body>

<form method="post" enctype="multipart/form-data">
    Name: <input type="text" name="name"><br><br>

    Price: <input type="number" step="0.01" name="price"><br><br>

    Quantity: <input type="number" name="quantity"><br><br>

    Details: <textarea name="details" cols="30" rows="10"></textarea><br><br>

    Photo: <input type="file" name="photo"><br><br>

    <input type="submit" name="upload" value="Insert">
    <input type="reset" value="Cancel">
</form>

<a href="viewInsert.php">Home</a>

</body>
</html>
