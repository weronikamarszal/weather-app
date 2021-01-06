<?php

session_start();
session_unset();
session_destroy();
header("location: /test2/index.php");
exit();