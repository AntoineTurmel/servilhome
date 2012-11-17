<?php
$uptime = exec("cat /proc/uptime");
$uptime = split(" ",$uptime);
$uptime = $uptime[0];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Serveur</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="icon" type="image/png" sizes="16x16" href="images/fav16.png" />
		<link rel="stylesheet" type="text/css" href="style.css" />
    <script>
      var upSeconds=<?php echo $uptime; ?>;
      function doUptime() {
      var uptimeString = "Serveur en fonctionnement depuis :</br>";
      var secs = parseInt(upSeconds % 60);
      var mins = parseInt(upSeconds / 60 % 60);
      var hours = parseInt(upSeconds / 3600 % 24);
      var days = parseInt(upSeconds / 86400);
      if (days > 0) {
        uptimeString += days;
        uptimeString += ((days == 1) ? " jour" : " jours") + ", ";
      }
      if (hours > 0) {
        uptimeString += hours;
        uptimeString += ((hours == 1) ? " heure" : " heures") + ", ";
      }
      if (mins > 0) {
        uptimeString += mins;
        uptimeString += ((mins == 1) ? " minute" : " minutes") + ", ";
      }
        uptimeString += secs;
        uptimeString += ((secs == 1) ? " seconde" : " secondes");
        document.getElementById("uptime").innerHTML = uptimeString;
        upSeconds++;
      setTimeout("doUptime()",1000);
      }
    </script>
	</head>

  <body onLoad="doUptime();">
    <div id="top">
      <h2>Hello World.</h2>
      <div id="uptime">&nbsp;</div>
    </div>

    <div id="modules">
      <div class="module" id="hdd1">
      <?php
          $bytes = disk_free_space("/");
          $bytestotal = disk_total_space("/");
          $bytesused = $bytestotal - $bytes;
          $si_prefix = array( 'B', 'Ko', 'Mo', 'Go', 'To', 'Eo', 'Zo', 'Yo' );
          $base = 1024;
          $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
          echo 'Disque dur ' . sprintf('%1.2f' , $bytestotal / pow($base,$class)) . ' ' . $si_prefix[$class] . ' :<br/>';
          echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . ' restant<br/>';
          echo '<meter value="' . $bytesused . '" max="' . $bytestotal . '"></meter>';
      ?>
      </div>
      <div class="module" id="torrent">
        <a href="http://<? echo $_SERVER['HTTP_HOST']; ?>:8080/gui"><div class="icone"><img src="images/torrent.png" alt="bt icon"/></div>
        Torrent</a>
      </div>
    <!-- <div class="module" id="print">
      <a href="http://<? echo $_SERVER['HTTP_HOST']; ?>:631/admin"><div class="icone"><img src="/images/document-print.png" alt="printer icon"/></div>
      Imprimante</a>
    </div> -->
    <!-- <div class="module" id="box">
      <a href="http://192.168.1.1/"><div class="icone"><img src="/images/image.png" width="48" alt="icone"/></div>
      Box</a>
    </div> -->
    </div>
  </body>
</html>
