<?php
  $secret_file_path = getenv("SECRET_FILE_PATH");
  $secret_contents = file_get_contents($secret_file_path);
  echo $secret_contents . PHP_EOL;
?>
