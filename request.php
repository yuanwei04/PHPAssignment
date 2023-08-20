<?php

include('a-DBconnect.php');

if (!empty($_POST)) {
  $date = date("Y/m/d", strtotime($_POST['date']));
  $time = $_POST['time'];
  $contactNum = mysqli_real_escape_string($conn, $_POST['contactNum']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
  $state = mysqli_real_escape_string($conn, $_POST['state']);
  $itemDonate = mysqli_real_escape_string($conn, $_POST['itemDonate']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);

  if (empty($date) or empty($time) or empty($contactNum) or empty($address) or empty($postcode) or empty($state) or empty($itemDonate) or empty($city)) {
    die("<script>alert('Please Enter Required Data');
        window.history.back();</script>");
  }

  // SQL
  $save_db = "INSERT INTO fooddonation
  (date, time, contactNum, itemDonate, address, city, postcode, state)
  VALUES
  ('$date', '$time', '$contactNum', '$itemDonate', '$address', '$city', '$postcode', '$state')
  ";

  // Execute Query
  if (mysqli_query($conn, $save_db)) {
    echo "<script>alert('Successful.');</script>";
  } else {
    echo "<script>alert('Unscucessful.');
    window.history.back();</script>";
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

  <div class="container">
    <form action="" method="POST">
      <div class="row">
        <div class="col">
          <h3 class="title">Food Request Area</h3>
          <div class="inputBox">
            <span>Full name :</span>
            <input type="text" placeholder="John" name="name" />
          </div>

          <div class="inputBox">
            <span>Contact Number:</span>
            <input type="contact" placeholder="+60 160232287" name="contactNum" />
          </div>

          <div class="inputBox">
            <span>Items to donate</span>
            <input type="item" name="itemDonate" placeholder="Bread/Noodle/Rice......" />
          </div>

          <div class="inputBox">
            <label for="Date">Date to collect</label>
            <input type="date" id="date" name="date" /><br /><br />
            <label for="Time">Time to collect</label>
            <input type="time" id="time" name="time" value="" />
          </div>

          <div class="inputBox">
            <span>Address :</span>
            <input type="text" placeholder="room - street - locality" name="address" />
          </div>

          <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" placeholder="Cheras" />
          </div>

          <div class="flex">
            <div class="inputBox">
              <span>state :</span>
              <input type="text" placeholder="Kuala Lumpur" name="state" />
            </div>
            <div class="inputBox">
              <span>zip code :</span>
              <input type="text" placeholder="56100" name="postcode" />
            </div>
          </div>
        </div>
      </div>
      <input type="submit" value="Thank You Your Donation" class="submit-btn" />
    </form>
  </div>
</body>

</html>

<?php

mysqli_close($conn);
?>