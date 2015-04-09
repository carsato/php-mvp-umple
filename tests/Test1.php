<?php

include dirname(__file__).'/../app/src/MVP.php';

Class MVPTest extends PHPUnit_Framework_TestCase{
  public function testMVPRuns(){
    $mvp = New MVP();

    $this->assertInstanceOf('MVP', $mvp, 'Not MVP instance');

    $mvp = New MVP();
    $mvp->bootstrap();
    $hasResponse = $mvp->run();
    $response = $mvp->getResponse();


    $this->assertNotEmpty($mvp->getViews(),'Views not empty');
    $this->assertNotEmpty($mvp->getModules(),'Modules not empty');
    // $this->assertNotEmpty($mvp->getData(),'Data not empty');
    $this->assertNotEmpty($mvp->getStatus(),'Status not empty');
    $this->assertNotEmpty($mvp->getModulesList(),'ModuleList not empty');
    $this->assertNotEmpty($mvp->getResponse(),'Response not empty');
    $this->assertTrue($hasResponse, 'Response is true');
  }
}
