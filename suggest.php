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
        if($_Post["address"] != ""){
          echo "Bad form input";
          exit;
        }


      echo "<pre>";
          $emailBody = "";
          $emailBody .= "Name: " . $name . "\n";
          $emailBody .= "Email: " . $email . "\n";
          $emailBody .= "Details: " . $details . "\n";
          echo $emailBody;
      echo "</pre>";

      //To Do: Send Email
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
