<?php
session_save_path(getcwd() . "/tmp");
session_start();
session_unset();
session_destroy();
header("location: ./index.php");
exit();