<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Insert</title>
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="products">
      
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

        <div class="product">

            <img src="uploads/<?php echo $fileUpload;?>">

            <h3>
                <a href="produkti.php?id=<?php echo $fileId ?>">
                <?php echo $fileName;?>
                </a>
            </h3>

            <div class="price">
            $<?php echo $filePrice;?>
            </div>

            <div class="quantity">
            Quantity: <?php echo $fileQuantity;?>
            </div>

            <div class="description">
            <?php echo $description;?>
            </div>
            <div class="delete">
                <button><a href="delete.php?delete=<?php echo $fileId;?>" onclick="return confirm ('A jeni i sigurt!')">Delete</a></button>
            </div>
            <div class= "update">
                <button><a href="update.php?update=<?php echo $fileId;?>">Update</a></button>
            </div>
        </div>     
    <?php
        }

    }
    catch(PDOException $e){
        echo'Connection failed:'.$e-> getMessage();
    }
?>
</div>
</body>