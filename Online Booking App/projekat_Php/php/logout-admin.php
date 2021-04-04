<?php

require('login_config.php');
session_destroy();
header("Location:../login-administrator.php");
    exit();

