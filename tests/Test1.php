<?php

include dirname(__file__).'/../app/src/MVP.php';

Class MVPTest extends PHPUnit_Framework_TestCase{
  public function testMVPRuns(){
    $mvp = New MVP();

    $this->assertInstanceOf('MVP', $mvp, 'Not MVP instance');

    $hasResponse = $mvp->run();
    $response = $mvp->getResponse();


    $this->assertNotEmpty($mvp->getViews(),'Views not empty');
    $this->assertTrue($hasResponse, 'Response is true');
    $this->assertNotEmpty($mvp->getResponse(),'Response not empty');
  }
}
