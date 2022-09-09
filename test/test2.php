<?php
$fp = fopen('php://output', 'w');
fwrite($fp, 'Hello World!'); //User will see Hello World!
fclose($fp);
?>