<DOCTYPE html>
    <html>

    <head>
        <title>Insert to WEB</title>
    </head>

    <body>
        <div>
            <?php
            try{
                include('connect.php');

                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $select = "SELECT * FROM produktet WHERE id=:id";
                    $query = $conn -> prepare ($select);
                    $query->bindParam(':id',$id);
                    $query-> execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);

                    $fileId= $row['id'];
                    $fileName = $row['name'];
                    $fileUpload = $row['photo'];
                    $fileQuantity = $row['quantity'];
                    $filePrice = $row['price'];
                    $description = substr($row['details'],0,100);
                
            ?>
            <h2>
                <a href="insert.php">
                    <?php echo $description;?>
                </a>

            </h2>
            <img src="uploads/<?php echo $fileUpload;?>" alt="">
            <p>
                <?php echo $description ?>

            </p>
            <?php
                }

                }
                catch(PDOException $e){
                    echo'Connection failed:'.$e-> getMessage();
                }
            ?>
        </div>

    </body>

    </html>