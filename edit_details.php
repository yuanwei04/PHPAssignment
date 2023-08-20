<?php

include("a-DBconnect.php");

if (!empty($_POST)) {
    $fooddonationID = mysqli_real_escape_string($conn, $_POST['fooddonationID']);
    $accountID = mysqli_real_escape_string($conn, $_POST['accountID']);
    $itemDonate = mysqli_real_escape_string($conn, $_POST["itemDonate"]);
    $foodBankNo = mysqli_real_escape_string($conn, $_POST["foodBankNo"]);

    if (empty($fooddonationID) or empty($accountID) or empty($itemDonate) or empty($foodBankNo)) {
        die("<script>alert('Please Enter Required Data');
        window.history.back();</script>");
    }

    $update_data = "UPDATE fooddonation SET
    fooddonationID = '$fooddonationID',
    accountID = '$accountID',
    itemDonate = '$itemDonate',
    foodBankNo = '$foodBankNo'
    WHERE accountID = '" . $_GET['accountID'] . "' ";

    if (mysqli_query($conn, $update_data)) {
        echo "<script>alert('Edit Success');
        window.location.href='details.php';</script>";
    } else {
        echo "<script>alert('Edit Not Sucessful');
        window.location.href='details.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/request.css" />
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

    <div class="table-div">
        <table border="1">
            <tr>
                <td>FoodDonationID</td>
                <td>Account ID</td>
                <td>ItemDonate</td>
                <td>FoodBankNo</td>
                <td>Edit Data</td>
            </tr>

            <tr>
                <form action='' method='POST'>
                    <td><input type="text" name="fooddonationID" value='<?php echo $_GET['fooddonationID']; ?>'></td>
                    <td><input type='text' name='accountID' value='<?php echo $_GET['accountID']; ?>'></td>
                    <td><input type='text' name='itemDonate' value='<?php echo $_GET['itemDonate']; ?>'></td>
                    <td><input type='text' name='foodBankNo' value='<?php echo $_GET['foodBankNo']; ?>'></td>
                    <td><input type='submit' value='Submit'></td>
                </form>
            </tr>
            <?php

            include("a-DBconnect.php");

            $retrive_details = "SELECT a.fooddonationID, a.accountID, a.itemDonate, a.foodBankNo
            FROM fooddonation a, account b, foodbank c
            WHERE a.accountID = b.accountID
            AND a.foodBankNo = c.foodBankNo";

            $execute_details = mysqli_query($conn, $retrive_details);

            while ($record = mysqli_fetch_array($execute_details)) {
                $data_details = array(
                    'fooddonationID' => $record['fooddonationID'],
                    'accountID' => $record['accountID'],
                    'itemDonate' => $record['itemDonate'],
                    'foodBankNo' => $record['foodBankNo']
                );

                echo "<tr>
                <td>" . $record['fooddonationID'] . "</td>
                <td>" . $record["accountID"] . "</td>
                <td>" . $record["itemDonate"] . "</td>
                <td>" . $record["foodBankNo"] . "</td>
                <td>
                <div>
                    <div>
                        <a class='edit_button' href='edit_details.php?" . http_build_query($data_details) . "'>Edit</a>
                    </div>
                    <div>
                        <a class='delete_button' href='delete.php?table=fooddonation&column=fooddonationID&pk=" . $record['fooddonationID'] . "'onClick=\"return confirm('You Want To Delete This Data?')\"> Delete </a>
                    </div>
                </div>
                </td>
                </tr>";
            }

            mysqli_close($conn);
            ?>

        </table>
    </div>

</body>

</html>