<?php
  require_once("sql.class.php");
  require_once('submission.class.php');
?>
<!DOCTYPE html>
<html>
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  background-image: url('forestbridge.jpg');
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 25px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css">

</style>
<body>
<div class="bgimg">
  <div class="topleft">
    <p></p>
  </div>
  <div class="middle">
    <h1>Submissions</h1>
    <p></p>
    <?php
      $r = Submission::collection();

      $num = $r->num_rows;

      if ($num > 0) {

      	echo "<p>There are currently $num submissions.</p>\n";

      	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
      	<tr><td align="left"><b>Name</b></td><td align="right"><b>Email</b></td></tr>
      ';

      	while ($row = $r->fetch_object()) {
      		echo '<tr><td align="left">' . $row->name . '</td><td align="right">' . $row->email . '</td></tr>';
      	}

      	echo '</table>';

      	$r->free();
      	unset($r);

      } else {

      	echo '<p class="error">There are currently no submissions.</p>';

      }
    ?>

  </div>
  <div class="bottomleft">
    <p></p>
  </div>
</div>

</body>
</html>
