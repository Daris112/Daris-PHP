<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Insert</title>
    <style>
    body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    padding:20px;
}

/* container */
.products{
    display:grid;
    grid-template-columns: repeat(auto-fill,minmax(250px,1fr));
    gap:20px;
}

/* card */
.product{
    background:white;
    padding:15px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:0.3s;
}

.product:hover{
    transform:translateY(-5px);
}

/* image */
.product img{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:8px;
}

/* title */
.product h3{
    margin:10px 0 5px;
}

/* price */
.price{
    color:#007bff;
    font-weight:bold;
    font-size:18px;
}

.quantity{
    color:#555;
    margin:5px 0;
}

.description{
    color:#666;
    font-size:14px;
}
    </style>
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

            <h3><?php echo $fileName;?></h3>

            <div class="price">
            $<?php echo $filePrice;?>
            </div>

            <div class="quantity">
            Quantity: <?php echo $fileQuantity;?>
            </div>

            <div class="description">
            <?php echo $description;?>
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