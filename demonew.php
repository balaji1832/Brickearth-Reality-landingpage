<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "bmconfig.php";  // Make sure this file exists in same folder

header('Access-Control-Allow-Origin: *'); 

if(isset($_SERVER['HTTP_REFERER'])) {
    $url = $_SERVER['HTTP_REFERER'];
    $urldomain = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
}

if(($_POST && $urldomain=="www.brickearthrealty.com") || 
   ($_POST && $urldomain=="brickearthrealty.com") || 
   ($_POST && $urldomain=="localhost")) {

    if (empty($_POST['name'])) {
        echo 'Some Fields are Missing';
    } else {
        $phone = mysqli_real_escape_string($con, $_POST['mobileno']);

        $Singlequery = "SELECT mobileno FROM enquiry_chola_leads WHERE mobileno='$phone'"; 
        $GetIdResult = mysqli_query($con, $Singlequery);
    
        if (mysqli_num_rows($GetIdResult) > 0) {
            echo '<script language="javascript">';
            echo 'alert("Entered Mobile Number Already Exists. Kindly Enter a New Mobile No"); location.href="https://brickearthrealty.com/"';
            echo '</script>';   
        } else {
            $name  = mysqli_real_escape_string($con, $_POST['name']);
            $email = mysqli_real_escape_string($con, $_POST['email']);

            $qry = "INSERT INTO enquiry_chola_leads (name, email, mobileno, date) 
                    VALUES('$name', '$email', '$phone', NOW())";
                           
            if (!mysqli_query($con, $qry)) {
                echo "Error: " . $qry . "<br>" . mysqli_error($con);
                exit;
            }

            header('Location: thankyou.html');
            exit;     
        }
    }
}
?>
