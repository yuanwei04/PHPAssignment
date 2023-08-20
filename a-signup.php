<?php
include 'a-DBconnect.php';
//initialization
$email = "";
$pass = "";

if (isset($_POST['submit'])) //Validate submit
{
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) //Validate email
            $email = $_POST['email'];
        else
            $emailerror = "Email format is incorrect!"; //Alert message red
    } else {
        $emailerror = "Email is required";
    }



    if (!empty($_POST['password'])) {
        $pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#%&])[0-9A-Za-z!@#$%&]{8,12}$/'; //(?=.*[A-Za-z]) means at least one A-Za-z, 
        //!@#$%& as special character, {8,12} 8-12character
        if (preg_match($pattern, $_POST['password'])) //Validate password
        {
            $pass = $_POST['password'];
        } else {
            $passerror = "Password at least 8-12 with a uppercase, 
                  lowercase, number and special character!";
        } //Alert message red
    } else {
        $passerror = "Password is required";
    }

    if (!empty($email) && !empty($pass)) {
        $sql = "SELECT * FROM account WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $errormsg = "Email is already used";
            $email = "";
        } else {
            $code = rand(1, 9999);
            $userid = "U" . $code;
            $usertype = "user";
            $sql = "INSERT INTO account(accountid,email,password,accounttype)VALUES('$userid','$email','$pass','$usertype')";
            $result = mysqli_query($conn, $sql);


            header("Location:a-login.php");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Bank Website</title>
    <link href="css/a-signup.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <!--import the font "Lato" from the Google Fonts service-->

</head>

<body>

    <!--top nav bar-->
    <div class="menu">
        <ul>
            <li><a href="a-homepage.php">Home</a></li>
            <li><a href="a-about.html">About</a></li>
            <li><a href="a-login.php">Login</a></li>
            <li>
                <a href="#">Services</a>
                <div class="dropDown">
                    <a href="a-foodbankInfo.html">Food Bank</a>
                </div>

            </li>

            <li><a href="a-contact.html">Contact</a></li>
        </ul>
    </div>

    <div class="signUpForm">

        <h1 id="title">Create An Account</h1>
        <p id="subtitle">Join Us in the Fight Against Hunger</p>
        <form action="a-signup.php" method="POST">


            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Enter your email" value="<?= $email ?>">

            <?php if (!empty($emailerror)) { ?>
                <p class="error"><?php echo "$emailerror";
                                } ?></p>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password"><br>

                <?php if (!empty($passerror)) { ?>
                    <p class="error"><?php echo "$passerror";
                                    } ?></p>

                    <button type="submit" name="submit" id="signUpBtn">Sign Up</button>
                    <?php if (!empty($errormsg)) { ?>
                        <p class="error" style="text-align:center;"><?php echo "$errormsg";
                                                                } ?></p>
                        <hr>
                        <div class="login">
                            <p>Already have an account? <a href="a-login.html">Log In.</a></p>
                        </div>
        </form>
    </div>
</body>

</html>