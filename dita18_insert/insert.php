<?php
include('connect.php');

// Ensure uploads folder exists
if (!is_dir("uploads")) {
    mkdir("uploads", 0777, true);
}

if(isset($_POST['insert'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $details = $_POST['details'];

    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];

    if($name == '' || $price == '' || $quantity == '' || $photo == '') {
        echo "<script>alert('Any input is empty');</script>";
    } else {

        // Check for duplicates
        $check = $conn->prepare("SELECT * FROM produktet WHERE name = :name OR photo = :photo LIMIT 1");
        $check->execute([
            ':name' => $name,
            ':photo' => $photo
        ]);

        $exist = $check->fetch(PDO::FETCH_ASSOC);

        if($exist) {
            echo "<script>alert('Product already exists!');</script>";
        } else {

            // Rename file to avoid duplicates
            $newPhoto = uniqid() . "_" . $photo;

            // Move uploaded file
            if(move_uploaded_file($tmp, "uploads/" . $newPhoto)) {

                // Insert into database
                $insert = $conn->prepare("
                    INSERT INTO produktet (name, price, quantity, details, photo)
                    VALUES (:name, :price, :quantity, :details, :photo)
                ");

                $insert->execute([
                    ':name' => $name,
                    ':price' => $price,
                    ':quantity' => $quantity,
                    ':details' => $details,
                    ':photo' => $newPhoto
                ]);

                echo "<script>alert('Product inserted successfully');</script>";
            } else {
                echo "<script>alert('File upload failed!');</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Products</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        form {
            width: 400px;
            margin: 30px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        textarea {
            resize: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>

</head>
<body>

<h2>Insert Product</h2>

<form method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name">

    <label>Price:</label>
    <input type="number" step="0.01" name="price">

    <label>Quantity:</label>
    <input type="number" name="quantity">

    <label>Details:</label>
    <textarea name="details"></textarea>

    <label>Photo:</label>
    <input type="file" name="photo">

    <input type="submit" name="insert" value="Insert Product">
    <a href='viewInsert.php'>View Insert</a>
</form>

</body>
</html>