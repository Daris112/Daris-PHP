<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title> Update </title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        textarea {
            resize: none;
        }

        img {
            display: block;
            margin-top: 10px;
            border-radius: 5px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
<?php
try {
    include('connect.php');

    if(isset($_GET['update'])){
        $update_id = $_GET['update'];
        $select = "SELECT * FROM produktet WHERE id=:id";
        $query = $conn->prepare($select);
        $query->bindParam(':id', $update_id);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
?>

<form method='post' action="update_ID.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id'];?>">

    Name:
    <input type="text" name="fileName" value="<?php echo $row['name'];?>">
    <br><br>

    Photo:
    <input type="file" name="fileUpload">
    <img src="../assets/<?php echo $row['photo'];?>" width="100" height="100">
    <br><br>

    Quantity:
    <input type="number" name="quantity" value="<?php echo $row['quantity'];?>">
    <br><br>

    Price:
    <input type="text" name="price" value="<?php echo $row['price'];?>">
    <br><br>

    Description:
    <textarea name="description" cols="30" rows="10"><?php echo $row['details'];?></textarea>
    <br><br>

    <input type="submit" name="update" value="Update">
</form>

<?php 
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
</body>
</html>