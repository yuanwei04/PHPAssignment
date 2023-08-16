<!DOCTYPE html>
<html lang="en">

<head>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="request.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!--Font Awesome link [for icon]-->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <!--import the font "Lato" from the Google Fonts service-->
</head>

<body>
    <!--top nav bar-->
    <div class="menu">
        <img src="Logo header.png" alt="logo">
        <p id="logoTitle">Food Help Centre</p>
        <ul>
            <li><a href="a-homepage.php">Home</a></li>
            <li><a href="a-about.html">About</a></li>
            <li>
                <a href="#">Services</a>
                <div class="dropDown">
                    <a href="a-foodbankInfo.html">Food Bank</a>
                    <a href="a-requestarea.php">Requests</a>
                </div>
            </li>
            <li><a href="a-contact.php">Contact</a></li>
            <li style="margin-right:0;"><a href="a-login.php">Login</a></li>
            <li style="margin-right:0;"><a href="a-profile.php">
                    <i class="fas fa-user-circle" style="font-size:23px;"></i></a>
            </li>
        </ul>
    </div>

    <table border="1">
        <tr>
            <td>Account ID</td>
            <td>ItemDonate</td>
            <td>FoodBankNo</td>
            <td>Edit Data</td>
        </tr>
        <?php

        include("a-DBconnect.php");

        $retrive_details = "SELECT a.accountID, a.itemDonate, a.foodBankNo
        FROM fooddonation a, account b, foodbank c
        WHERE a.accountID = b.accountID
        AND a.foodBankNo = c.foodBankNo";

        $execute_details = mysqli_query($conn, $retrive_details);

        while ($record = mysqli_fetch_array($execute_details)) {
            $data_details = array(
                'accountID' => $record['accountID'],
                'itemDonate' => $record['itemDonate'],
                'foodBankNo' => $record['foodBankNo']
            );

            echo "<tr>
            <td>" . $record["accountID"] . "</td>
            <td>" . $record["itemDonate"] . "</td>
            <td>" . $record["foodBankNo"] . "</td>
            <td>
                <a href='edit_details.php?" . http_build_query($data_details) . "'>Edit</a>
            </td>
            </tr>";
        }

        mysqli_close($conn);
        ?>

    </table>
</body>

</html>