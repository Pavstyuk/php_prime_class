<?php

require_once "class/Prime.php";

$prime = new Prime(1000);
$prime->printSeriesCli();

echo "\n\r";
echo $prime->calculateExec();
echo "\n\r";

echo round($prime->perfomanceAverage(), 3) . " ms";
echo "\n\r";
