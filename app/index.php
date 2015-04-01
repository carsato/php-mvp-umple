<?php


include dirname(__file__).'/src/MVP.php';



$mvp = New MVP();
$mvp->run();
$response = $mvp->getResponse();

print $response;
