<?php


include dirname(__file__).'/src/MVP.php';
// include dirname(__file__).'/src/Application.php';
// include dirname(__file__).'/src/Request.php';
// include dirname(__file__).'/src/Response.php';
// include dirname(__file__).'/src/Router.php';


// print '<pre>'.print_r(get_declared_classes(),true).'</pre>';
$mvp = New MVP();
$mvp->run();
// print_r($mvp->getModules());
// print '<pre>'.print_r(get_declared_classes(),true).'</pre>';

// $app = New Application();

// print $app->run()->displayResponse();
//
