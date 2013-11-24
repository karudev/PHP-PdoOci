<?php

include './PdoOci.php';

//phpinfo();

$pdo = new PdoOci();
$pdo->prepare("select * from demo_customers");
$pdo->execute();
$data = $pdo->fetchAll();
print_r($data);die();
?>
