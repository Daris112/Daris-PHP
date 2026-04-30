<?php
//index.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$message = '';

function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

if(isset($_POST["submit"]))
{
    $programming_languages = '';
    foreach($_POST["programming_languages"] as $row)
    {
        $programming_languages .= $row . ', ';
    }
    $programming_languages = substr($programming_languages, 0, 30);
    $path = 'upload/' . $_FILES["resume"]["name"];
    move_uploaded_file($_FILES["resume"]["tmp_name"], $path);
    
    $message = '
        <h3 align="center">Programmer Details</h3>
        <table border="1" width="100%" cellpadding="5" cellspacing="5">
            <tr>
                <td width="30%">Name</td>
                <td width="70%">'.$_POST["name"].'</td>
            </tr>
            <tr>
                <td width="30%">Address</td>
                <td width="70%">'.$_POST["address"].'</td>
            </tr>
            <tr>
                <td width="30%">Email Address</td>
                <td width="70%">'.$_POST["email"].'</td>
            </tr>
            <tr>
                <td width="30%">Progamming Language Knowledge</td>
                <td width="70%">'.$programming_languages.'</td>
            </tr>
            <tr>
                <td width="30%">Experience Year</td>
                <td width="70%">'.$_POST["experience"].'</td>
            </tr>
            <tr>
                <td width="30%">Phone Number</td>
                <td width="70%">'.$_POST["mobile"].'</td>
            </tr>
            <tr>
                <td width="30%">Additional Information</td>
                <td width="70%">'.$_POST["additional_information"].'</td>
            </tr>
        </table>
    ';
    

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    $mail = new PHPMailer;
    $mail->IsSMTP();                                //Sets Mailer tosend message using SMTP
    $mail->Host = 'smtp.gmail.com';     //Sets the SMTP hosts of your Email hosting, this for Godaddy
    $mail->Port = 587;                              //Sets the default SMTP server port
    $mail->SMTPAuth = true;                         //Sets SMTP authentication. Utilizes the Username and Password variables
    $mail->Username = 'darishodza12@gmail.com';                    //Sets SMTP username
    $mail->Password = 'pwid ftop nrer dptz';                    //Sets SMTP password
    $mail->SMTPSecure = 'tls';                          //Sets connection prefix. Options are "", "ssl" or "tls"
    
    $mail->From = $_POST["email"];                  //Sets the From email address for the message
    $mail->FromName = $_POST["name"];               //Sets the From name of the message
    $mail->AddAddress('darishodza12@gmail.com', 'Webslesson');     //Adds a "To" address
    $mail->WordWrap = 50;                           //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);                            //Sets message type to HTML
    $mail->AddAttachment($path);                    //Adds an attachment from a path on the filesystem
    $mail->Subject = 'Application for Programmer Registration';             //Sets the Subject of the message
    $mail->Body = $message;                         //An HTML or plain text message body
    if($mail->Send())                               //Send an Email. Return true on success or false on error
    {
        $message = '<div class="alert alert-success">Application Successfully Submitted</div>';
        unlink($path);
    }
    else
    {
        $message = '<div class="alert alert-danger">There is an Error</div>';
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send Email with Attachment in PHP using PHPMailer</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="page-wrap">
        <div class="container">
            <div class="application-card">
                <div class="form-heading">
                    <span class="form-icon">&#128206;</span>
                    <p class="eyebrow">Application form</p>
                    <h1>Programmer Registration</h1>
                    <p class="subtitle">Send your details and attach your resume in one step.</p>
                </div>

                <?php print_r($message); ?>

                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" placeholder="Enter your name" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" placeholder="Enter your address" class="form-control"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="you@example.com"
                                    required />
                            </div>
                            <div class="form-group">
                                <label>Programming Language Knowledge</label>
                                <select name="programming_languages[]" class="form-control" multiple required
                                    style="height:150px;">
                                    <option value=".NET">.NET</option>
                                    <option value="Android">Android</option>
                                    <option value="ASP">ASP</option>
                                    <option value="Blackberry">Blackberry</option>
                                    <option value="C">C</option>
                                    <option value="C++">C++</option>
                                    <option value="COCOA">COCOA</option>
                                    <option value="CSS">CSS</option>
                                    <option value="DHTML">DHTML</option>
                                    <option value="Drupal">Drupal</option>
                                    <option value="Flash">Flash</option>
                                    <option value="HTML">HTML</option>
                                    <option value="HTML 5">HTML 5</option>
                                    <option value="IPAD">IPAD</option>
                                    <option value="IPHONE">IPHONE</option>
                                    <option value="Java">Java</option>
                                    <option value="Java Script">Java Script</option>
                                    <option value="Joomla">Joomla</option>
                                    <option value="LAMP">LAMP</option>
                                    <option value="Linux">Linux</option>
                                    <option value="MAC OS">MAC OS</option>
                                    <option value="Magento">Magento</option>
                                    <option value="MySQL">MySQL</option>
                                    <option value="Oracle">Oracle</option>
                                    <option value="PayPal">PayPal</option>
                                    <option value="Perl">Perl</option>
                                    <option value="PHP">PHP</option>
                                    <option value="Ruby on Rails">Ruby on Rails</option>
                                    <option value="Salesforce.com">Salesforce.com</option>
                                    <option value="SEO">SEO</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Years of Experience</label>
                                <select name="experience" class="form-control" required>
                                    <option value="">Select Experience</option>
                                    <option value="0-1 years">0-1 years</option>
                                    <option value="2-3 years">2-3 years</option>
                                    <option value="4-5 years">4-5 years</option>
                                    <option value="6-7 years">6-7 years</option>
                                    <option value="8-9 years">8-9 years</option>
                                    <option value="10 or more years">10 or more years</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile" placeholder="Enter mobile number" class="form-control"
                                    pattern="\d*" required />
                            </div>
                            <div class="form-group">
                                <label>Resume</label>
                                <div class="file-field">
                                    <input type="file" name="resume" accept=".doc,.docx, .pdf" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Additional Information</label>
                                <textarea name="additional_information" placeholder="Tell us anything else we should know"
                                    class="form-control" required rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" name="submit" value="Submit Application" class="btn btn-info" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
