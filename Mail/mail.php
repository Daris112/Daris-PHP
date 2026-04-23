
<?php
    require 'phpold/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail ->isSMTP();
    
    $mail ->Host = 'smtp.gmail.com';
    $mail ->Port = 587;
    $mail ->SMTPAuth = true;
    $mail ->SMTPSecure = 'tls';
    
    $mail ->Username = 'darishodza12@gmail.com';
    $mail ->Password ='zfeb hnns vstr gwci';
    $mail ->setFrom('darishodza12@gmail.com','ShkollaDigjitalePrizren');
    $mail ->addAddress('darishodza12@gmail.com');
    $mail ->addReplyTo('darishodza12@gmail.com');
    
    $mail ->isHTML(true);
    $mail ->Subject = 'PHP Mailer Subject';
    $mail ->Body = '<h1>Daris Hodza</h1>';
    
    if(!$mail->send()){
        echo "Messages Could not be send!";
        echo 'Error: '. $mail->ErrorInfo;
    }
    else{
        echo "Message has been send!";
}
?>
