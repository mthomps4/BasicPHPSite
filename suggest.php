<?php
$pageTitle = "Suggest a Media Item";
$section = "suggest";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        //var_dump($_POST);
        //$name = trim($_POST["name"]);//Trim removes all white spaces making sure there is a value
        //$email = trim($_POST["Email"]);
        //$details = trim($_POST["details"]);

        $name = trim(filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING)); //filter_input allows to filter data and check for errors before POST
        $email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
        $details = trim(filter_input(INPUT_POST,"details",FILTER_SANITIZE_SPECIAL_CHARS)); //Allows all forms of text

        if($name == "" || $email == "" || $details == ""){
          echo "Please enter in the required fields: Name, Email, and Details";
          exit;
        }

        //if address field was filled out -- Kill the evil spambot
        if($_POST["address"] != ""){
          echo "Bad form input";
          exit;
        }

        require("inc/PHPMailer/class.phpmailer.php");
        $mail = new PHPMailer;

        if(!$mail->ValidateAddress($email)){
          echo "Invalid Email Address";
          exit;
        }


          $emailBody = "";
          $emailBody .= "Name: " . $name . "\n";
          $emailBody .= "Email: " . $email . "\n";
          $emailBody .= "Details: " . $details . "\n";
          echo $emailBody;

          //$mail->isSMTP();                                      // Set mailer to use SMTP
          //$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
          //$mail->SMTPAuth = true;                               // Enable SMTP authentication
          //$mail->Username = 'user@example.com';                 // SMTP username
          //$mail->Password = 'secret';                           // SMTP password
          //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          //$mail->Port = 587;                                    // TCP port to connect to

          $mail->setFrom($email, $name);
          $mail->addAddress('matthew.thompson.a@gmail.com', 'Matt T');     // Add a recipient
          //$mail->addAddress('ellen@example.com');               // Name is optional
          //$mail->addReplyTo('info@example.com', 'Information');
          //$mail->addCC('cc@example.com');
          //$mail->addBCC('bcc@example.com');

          //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
          //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
          $mail->isHTML(false); //false for plain text           // Set email format to HTML

          $mail->Subject = 'Basic PHP Form Test from ' . $name;
          $mail->Body    = $emailBody;
          //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          //ALT BODY FOR PLAIN TEXT IF HTML TRUE

          if(!$mail->send()) {
              echo 'Message could not be sent. PHPMailer not set for production.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
              exit;
          }

      header("location:suggest.php?status=thanks");
    }
?>


<?php include("inc/header.php"); ?>
<div class="section page">
      <div class="wrapper">
        <h1> Suggest a Media Item </h1>
        <?php if(isset($_GET["status"]) && $_GET['status'] == "thanks") {
          echo "<p> Thanks for the email! I will check out your suggestion(s) soon.</p>" ;
        } else{
        ?>
        <p> If you think I am missing something let me know!</p>

        <form method="post" action="suggest.php">
          <table>
            <tr>
              <th><label for="name">Name: </label></th>
              <td><input type="text" name="name" id="name"><td>
            </tr>

            <tr>
              <th><label for="email">Email: </label></th>
              <td><input type="text" name="email" id="email"><td>
            </tr>

            <tr>
              <th><label for="details">Suggest Item Details: </label></th>
              <td><input type="textarea" name="details" id="details"><td>
            </tr>

            <tr style="display:none"> <!-- hides from use and helps with spam robots -->
              <th><label for="address">Address: </label></th>
              <td><input type="text" name="address" id="details">
                <p> Please leave this field blank. </p><td> <!-- For screen reading accecibility a 'just in case' for human interaction -->
            </tr>
          </table>

          <input type="submit" value="Send">




        </form>
        <?php } ?>
      </div>

  <?php include("inc/footer.php"); ?>
