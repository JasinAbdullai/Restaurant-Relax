<?php
//checking connection and connecting to a database
require_once('connection/config.php');

//retrive promotions from the specials table
$result=@$link->query("SELECT * FROM specials")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=@$link->query("SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME; ?>:Specials</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
<link href="style/style.css"  rel="stylesheet" type="text/css">
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="member-index.php">Home</a></li>
  <li><a href="foodzone.php">Menu</a></li>
  <li><a href="specialdeals.php">Order Online</a></li>
  <li><a href="member-index.php">My Account</a></li>
  <li><a href="contactus.php">Contact Us</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name">Relax Restaurant</div>
</div>

<div id="center">

  <h1>SPECIAL DEALS</h1>
  <hr>
  <p>Check out our special deals below. These are for a limited time only. Make your decision now.</p>
  <h3>Note: In order to create your order, please go to Menu and choose Specials under categories list.</h3>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<table width="850" align="center">
    <CAPTION><h3>SPECIAL DEALS</h3></CAPTION>
        <tr>
                <th>Promo Photo</th>
                <th>Promo Name</th>
                <th>Promo Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Promo Price</th>
        </tr>
        <?php
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                while ($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=images/'. $row['special_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['special_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['special_name']."</td>";
                    echo "<td width='250' align='left'>" . $row['special_description']."</td>";
                    echo "<td>" . $row['special_start_date']."</td>";
                    echo "<td>" . $row['special_end_date']."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row['special_price']."</td>";
                    echo "</td>";
                    echo "</tr>";
                    }
            mysqli_free_result($result);
            mysqli_close($link);
?>
</table>
  </div>
</div>
<?php include 'footer.php'; ?>
</div>

</body>
</html>
