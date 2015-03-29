<?php

include dirname(__file__).'/../app/src/Application.php';
include dirname(__file__).'/../app/src/Request.php';
include dirname(__file__).'/../app/src/Response.php';
include dirname(__file__).'/../app/src/Router.php';

Class ApplicationTest extends PHPUnit_Framework_TestCase{
  public function testApplicationRuns(){
    $app = New Application();
    $responseString = $app->run()->displayResponse();
    $request = $app->getRequest();
    $response = $app->getResponse();
    $router = $app->getRouter();
    $this->assertInstanceOf('Request', $request, 'Request empty');
    $this->assertInstanceOf('Response', $response, 'Response empty');
    $this->assertInstanceOf('Router',$router, 'not instance of Router');
    $this->assertNotEmpty($responseString, 'Response string empty');
  }

  public function testRequest(){
    $app = New Application();
    $req = $app->buildRequest();

    $path = $req->getPath();
    $method = $req->getMethod();


    $this->assertNotEmpty($path,'Path is empty');
    $this->assertNotEmpty($method,'Path is empty');
  }
}
