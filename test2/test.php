<?php
require_once __DIR__ . '/vendor/autoload.php';

use HelloComposer\Hello;

$instance = Hello::validate("Type_A.xlsx");

echo $instance;