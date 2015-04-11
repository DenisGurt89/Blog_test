<?php

include 'lib/db.php';

$db = new Db();

$q = $db->query('SHOW DATABASES');
print_r($q->assoc());