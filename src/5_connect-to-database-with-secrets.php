<?php
  $local = getenv("MY_DB_HOST");
  $user  = getenv("MY_DB_USER");
  $pass  = trim(file_get_contents(getenv("MY_DB_PASSWORD_FILE")));
  $db    = getenv("MY_DB_DATABASE");

  echo "Arguments: mysqli_connect('$local', '$user', '$pass', '$db');" . PHP_EOL;

  $conn = mysqli_connect($local, $user, $pass, $db);

  if ($conn) echo "Successful connection" . PHP_EOL;
  else die ('Connection failed');
?>

