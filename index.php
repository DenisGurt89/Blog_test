<?php

include 'lib/db.php';
include 'lib/base.php';

new App(substr($_SERVER['REQUEST_URI'], 2));