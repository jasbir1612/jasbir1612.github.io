<?php


include "phpqrcode/qrlib.php";
require_once('mail/class.phpmailer.php');

$name = $_POST['name'];
$email = $_POST['email'];
$phno= $_POST['phno'];

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {


        if(empty($name)||empty($email)||empty($phno))
            {

              header("Location: forms/register.html");

            }

     else
     {
        echo"hey";
         $conn=mysqli_connect("localhost","u920426802_bindy","Kawal_2167","u920426802_bindy");

         $sql1="Select * from details order by sid desc LIMIT 1";
         $res=mysqli_query($conn,$sql1);
         $row=mysqli_fetch_array($res);
         $id=$row['sid'];
         echo $id;
         $bid=$id+1;
         $stmt=$conn->prepare("INSERT INTO details(sid,name,email,phno) VALUES (?,?,?,?)");
         $stmt->bind_param("isss",$bid,$name,$email,$phno);
         $what=$stmt->execute();
         $stmt->close();





            /**********qrcode******************/
            if($what==true)
            {
            $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
            $PNG_WEB_DIR = 'temp/';
            if (!file_exists($PNG_TEMP_DIR))
             mkdir($PNG_TEMP_DIR);
            $filename = $PNG_TEMP_DIR.'test.png';
            $errorCorrectionLevel = 'H';
            $matrixPointSize = 5;
            $filename = $PNG_TEMP_DIR.'test'.md5($id.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
            QRcode::png($bid, $filename, $errorCorrectionLevel, $matrixPointSize, 4);
           echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';



           $file=$PNG_WEB_DIR.basename($filename);
           $fname=basename($filename);


                 require_once "mail/PHPMailerAutoload.php";

                  //PHPMailer Object
                  $mail = new PHPMailer;

                  //From email address and name
                  $mail->From = "bindyaboutique@gmail.com";
                  $mail->FromName = "Kawal Bhatia";

                  //To address and name
                  $mail->addAddress($email,$name);



                  //Send HTML or Plain Text email
                  $mail->isHTML(true);

                  $mail->Subject = "REGISTERATION ID";
                  $mail->Body = "<i>Dear $name</i><br>
                  <p>

                    You have successfully registered for Bindya Boutique. Your REGISTERATION ID is BB-<b>$bid</b>.<br>
                    Thank you for registering with us.
                    Use this ID to Give your Measurement

                    </p>



                  ";
                  $mail->AltBody = "This is the plain text version of the email content";
                  $mail->addAttachment("temp/$fname","Qrcode.png"); //Filename is optional

                  if(!$mail->send()) {
                      echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo 'Message has been sent';
                            }


                /*==================email=================*/


                header("Location: forms/register.html");



        }
    }
  }

?>
