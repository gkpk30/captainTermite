<?php
    include 'includes/config.php';
    include 'includes/mysql.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/flexboxgrid32218.css">   
    <link rel="stylesheet" href="styles/style32218.css">
    <link rel="stylesheet" href="styles/fontawesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
        <nav >
                <header >
                        <a href="index.html">
                            <img class="logo"  src="images/website_logo_transparent_600X400.png">
                        </a>
    
                        <a class="toggle"> Menu</a>
                        <ul class="mainMenu">
                            
                            <li>
                                <a href="treatmenttypes.html">Treatment Types</a>
                            </li>
                            <li>
                                <a href="aboutus.html">About Us</a>
                            </li>
                            <li>
                                <a href="termiteinfo.html">Termite Info</a>
                            </li>
                        </ul>
                        <div style="clear:both;" ></div>
                        <a href="tel:18188226782" class="phone">
                            <p>Call Today (818) 822-6782</p></a>
                    </header>
        </nav>
<?php
        $dbconn = new DBCAPT;
        $dbconn->connect();

        
            echo '<br/>
                <form method="POST" action = "signinfiltered.php">
                    <label>Enter Your info to check your account. </label><br/>
                    <label>Email<input type="email" id="email" name ="email" /> </label><br/>
                    <label>Street Address<input type="address" id="address" name="address"/> </label><br/>
                    <input type="submit" value="submit"/>
                </form>
                ';
        
                

                if ($_SERVER["REQUEST_METHOD"] !=="POST") {
                    form();
                }
                else {
                    function filter_address($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        $length = strpos($data, ' ');
                        $data = substr($data, 0, $length);
                        return $data;
                    }
                   
                    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                    $address = filter_address($_POST['address']);
                               
                    $sql = "SELECT customerID, first_name, last_name, company_name, phone, email, address, city, zip, state, inspection_date, warranty, warranty_expiration  from customers where email = '" .$email . "' and
                    street_number = '" . $address . "'";
                    $result = $dbconn->runsql($sql);
                }
                if ($result->num_rows > 0) {
                    //output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo
                            "First Name: ". $row["first_name"]. 
                            " Last Name: ". $row["last_name"]. "<br />".
                            "Company Name: ". $row["company_name"]. "<br />".
                            "Email: " . $row["email"]. "<br />".
                            "Address: ". $row["address"]. "<br />".
                            "City: ". $row["city"]. "<br />".
                            "Zip: ". $row["zip"]. "<br />".
                            "State: ". $row["state"]. "<br />".
                            "Phone Number: ". $row["phone"]. "<br />".
                            "Inpection Date: ". $row["inspection_date"]. "<br />".
                            "Warranty purchased: ". $row["warranty"]. "<br />".
                            "Warranty Expiration: ". $row["warranty_expiration"]. "<br />".
                            "<br/>";
                        }
                    } else {
                        echo "email or address not found<br />";
                        echo $sql. "<br />";
                    }
    ?>
        


       <!--Footer-->

    <footer id="main-footer">
        <div class="container-fluid">
            <div class="row center-xs center-sm center md center-lg">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p>Captain Termite Control &copy; 2018 </p>
                </div>
            </div>
        </div>



    </footer>

    
</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('ul').toggleClass('active');
            $('.phone').toggleClass('active');
        })

    })
   
</script>
</html>