<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Insert</title>
    <style>
        table,
        td,
        th {
            border: 2px solid black;
            border-collapse: collapse;
            width: 500px;
            height: 50px;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td>File Id</td>
            <td>File Name</td>
            <td>File Price</td>
            <td>File Quantity</td>
            <td>Description</td>
            <td>File Upload</td>
        </tr>
<?php
    try{
        include('connect.php');

        $select = "SELECT * FROM produktet";
        $query = $conn ->query($select) ;

        while($row = $query -> fetch(PDO::FETCH_ASSOC)){
            $fileId= $row['id'];
            $fileName = $row['name'];
            $fileUpload = $row['photo'];
            $fileQuantity = $row['quantity'];
            $filePrice = $row['price'];
            $description = substr($row['details'],0,100);

            ?>

            <tr>
                <td><?php echo $fileId;?></td>
                <td><?php echo $fileName;?></td>
                <td><?php echo $filePrice;?></td>
                <td><?php echo $fileQuantity;?></td>
                <td><?php echo $description;?></td>
                <td><img src="../uploads/<?php echo $fileUpload;?>" width = "80" height = "60"></td>
            </tr>
    <?php
        }

    }
    catch(PDOException $e){
        echo'Connection failed:'.$e-> getMessage();
    }
?>
</table>
</body>