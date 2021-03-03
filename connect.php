<?php
$pdo = new PDO('pgsql:host=<host>;dbname=<basisdata>', '<username>', '<password>');
if (!$pdo){
    echo "Not Connect :". pg_error();
    exit;    
}
?>
