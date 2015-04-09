<?php


error_reporting(E_ERROR|E_PARSE);

include dirname(__file__).'/src/MVP.php';

try{
  $mvp = New MVP();
  $mvp->bootstrap();
  $mvp->run();
  $response = $mvp->getResponse();
}
catch(Exception $e){
  $response = $e->getMessage();
}

print $response;




