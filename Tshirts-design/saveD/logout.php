<?php

session_start();
session_unset();
session_destroy();

header('location:../../signup_and_login/index.php');
