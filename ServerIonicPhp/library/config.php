<?php
define('DB_NAME','gestion_commande');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
date_default_timezone_set('Asia/Jakarta');
 