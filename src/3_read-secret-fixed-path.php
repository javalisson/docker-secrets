<?php
  $secret = file_get_contents("/run/secrets/secret-phrase");
  echo $secret . PHP_EOL;
?>
