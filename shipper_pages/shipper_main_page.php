<?php
    session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Shopee web</title>
        <link rel="stylesheet" href="../resources/css/style.css">
        <link rel="stylesheet" href="../resources/css/queries.css">
    </head>
    <body>
        <header>
          <?php require '../php_scripts/general_header.php'?>
        </header> 
            <section class="shipper-main-page">
                <!-- <h1>Welcome to the HUB</h1>
                <div class="order-container">
                    <div class="field">Order ID</div>
                    <div class="field">Buyer ID</div>
                    <div class="field">Total amount</div>
                    <div class="field">Status</div>
                </div>
                <div class="order-container">
                    <div class="field">1</div>
                    <div class="field">1</div>
                    <div class="field">20000</div>
                    <div class="field">active</div>
                </div> -->
                <?php
                  $orderList = [];
                  $distributionHubList = [];
                  $curDistributionHub = $_SESSION['current_user']['distributionHub'];
                  echo '<h1> Welcome to '.$curDistributionHub.'</h1>';
                  $file = "../dbFiles/Order.db.csv";
                  $file_handle = fopen($file, "r");
                  flock($file_handle, LOCK_SH);
                  while($line = fgets($file_handle)){
                      $orderList[] = explode(",", $line);
                  }
                  if($file_handle == false){
                      die("Error opening file: ". $file);
                  }
                  flock($file_handle, LOCK_UN);
                  fclose($file_handle);

                  $fileDis = "../dbFiles/DistributeHub.csv";
                  $fileHandle = fopen($fileDis, "r");
                  flock($fileHandle, LOCK_SH);
                  while($line = fgets($fileHandle)){
                      $distributionHubList[] = explode(",", $line);
                  }
                  if($fileHandle == false){
                      die("Error opening file: ". $fileDis);
                  }
                  flock($fileHandle, LOCK_UN);
                  fclose($fileHandle);
                  $curDistributionHubID = "a";
                  for($j = 0; $j < count($distributionHubList); $j++){
                      if($curDistributionHub == $distributionHubList[$j][1]){
                          $curDistributionHubID = $distributionHubList[$j][0];
                      }
                  }

                  $orderInCurHubList = [];
                  for($i = 0; $i < count($orderList); $i++){
                      if($curDistributionHubID == $orderList[$i][5]){
                          if($orderList[$i][4] == "active" || $orderList[$i][4] == "delivered"){
                              array_push($orderInCurHubList, $orderList[$i]);
                          }
                      }
                  }

                  echo '
                  <div class="order-container-field">
                  <div class="field">Order ID</div>
                  <div class="field">Buyer ID</div>
                  <div class="field">Total amount</div>
                  <div class="field">Status</div>
                  </div>
                  ';

                  foreach($orderInCurHubList as $order){
                      $str = serialize($order);
                      $strenc = urlencode($str);

                      echo 
                      '<div class ="order-container">
                        <a href="./order_detail.php?data=' . $strenc .' ">
                          <div class="field">'.$order[0].'</div>
                          <div class="field">'.$order[1].'</div>
                          <div class="field">'.$order[7].'</div>
                          <div class="field">'.$order[4].'</div>
                        </a>
                      </div>';
                  }
                ?>
            </section>
        <footer>
            <ul>
              <li><a href="../sub-pages/About.html">About</a></li>
              <li><a href="../sub-pages/Copyright.html">Copyright</a></li>
              <li><a href="../sub-pages/Policy.html">Policy</a></li>
              <li><a href="../sub-pages/Helpslink.html">Helps link</a></li> 
            </ul>
        </footer>
    </body>
</html>