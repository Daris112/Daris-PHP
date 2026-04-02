<?php
try {
    include('connect.php');

    if(isset($_POST['update'])) {

        $fileId = $_POST['id'];
        $fileName = $_POST['fileName'];
        $fileDescription = $_POST['description'];
        $fileQuantity = $_POST['quantity'];
        $filePrice = $_POST['price'];

        $fileUpload = $_FILES['fileUpload']['name'];
        $fileUpload_tmp = $_FILES['fileUpload']['tmp_name'];

        if(!move_uploaded_file($fileUpload_tmp, "../assets/$fileUpload")) {
            echo "<script>alert('You can't upload this image!')</script>";
        }

        if($fileName == '' || $fileDescription == '' || $fileUpload == '' || $fileQuantity == '' || $filePrice == '') {
            echo "<script>alert('Ndonjera prej fushave eshte e zbrazet')</script>";
            echo "<script>window.open('viewFile.php','_self');</script>";
            exit();
        } else {    
            $update_query = "UPDATE upload SET
                name = :name,
                photo = :photo,
                quantity = :quantity,
                price = :price,
                details = :details
                WHERE id = :id";
            
            $query = $conn->prepare($update_query);

            $query->bindParam(':name', $fileName);
            $query->bindParam(':photo', $fileUpload);
            $query->bindParam(':quantity', $fileQuantity);
            $query->bindParam(':price', $filePrice);
            $query->bindParam(':details', $fileDescription);
            $query->bindParam(':id', $fileId);

            if($query->execute()) {
                echo "<script>alert('File is updated!')</script>";
                echo "<script>window.open('viewInsert.php','_self');</script>";
            }
        }
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>