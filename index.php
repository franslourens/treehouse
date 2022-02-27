<?php
  require_once("form.class.php");
?>
<!DOCTYPE html>
<html>
<head>
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
  font-family: "Courier New";
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

div.error {
  color: #a94442;
  background-color: #f2dede;
  border-color: #ebccd1;
  padding:1px 20px 1px 20px;
}

hr {
  margin: auto;
  width: 40%;
}
</style>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</head>
<body>
<div class="bgimg">
  <div class="topleft">
    <p></p>
  </div>
  <div class="middle">
    <h1>COMING SOON</h1>
    <p>
    <?php
      $validation = array();
      $validation["rules"] = array("name" => "required", "email" => array("required" => true, "email" => true));
      $validation["messages"] = array("name" => "name required", "email" => "email required");

      $f = new Form("newsletter","post","", $validation, true);

      if($_REQUEST) {
        $email = $_REQUEST['email'];
        $result = $f->save($_POST);

        if($f->errors()) {
          echo $f->errors();
        } else {
          echo $email . "<a onclick=\"location.href='/list.php'\"> added</a> successfully.";
        }
      }
     ?>
    </p>

    <?php

    if(!$_REQUEST) {
      $f->add(new Text(array("name" => "name")));
      $f->add(new Text(array("name" => "email")));
      $f->add(new Submit("Signup"));
      $html = $f->show();

      echo $html["start"];

      foreach ($html as $key => $element) {
        if(!in_array($key, array('start', 'submit', 'end'))) {

    ?>
          <div class="field">
              <label class="label" style="color:white;font-family: 'Courier New';" for="<?php echo ucfirst($key) ?>"><?php echo ucfirst($key) ?></label>

              <div class="control">
                <?php echo $element ?>
              </div>
          </div>
    <?php
        }
      }
    ?>

    <div class="field">
          <?php echo $html["submit"]; ?>
    </div>

    <?php
      echo $html["end"];
    }
    ?>

  </div>
  <div class="bottomleft">
    <p></p>
  </div>
</div>

</body>
</html>
