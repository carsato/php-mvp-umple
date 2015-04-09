<?php

include dirname(__file__).'/../app/src/MVP.php';

Class MVPTest extends PHPUnit_Framework_TestCase{
  public function testMVPRuns(){

    $mvp = New MVP();
    $this->assertInstanceOf('MVP', $mvp, 'Not MVP instance');

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

  public function testMVPRendersASimpleArray(){
    $mvp = New MVP();
    $mvp->bootstrap();

    $render_array = array(
        'part1' => 'this is part 1',
        'part2' => ' this is part 2',
        'part3' => ' this is part 3',
    );

    $result_string = $mvp->render($render_array);
    $string_expected = 'this is part 1 this is part 2 this is part 3';
    $this->assertEquals($string_expected,$result_string, 'Render simple array OK');
  }

  public function testMVPRendersPizzaExampleView(){
    $mvp = New MVP();
    $mvp->bootstrap();

    $render_array = array(
      'a_render' => array(
        '#render' => true,
        '#module' => 'system',
        '#view'   => 'SystemView',
        '#method' => 'stampteRender',
        '#args' => array(
          'template' => "<table>
                              <thead>
                                  <tr><th>Pizza</th><th>Price</th></tr>
                              </thead>
                              <tbody>
                              <!-- cut:pizza -->
                                  <tr><td>
                                  #name#
                                  </td><td>
                                  #price#
                                  </td></tr>
                              <!-- /cut:pizza -->
                              </tbody>
                          </table>",
          'data' => array(
            array(
              'id' => 'pizza',
              'name' => 'Margherita',
              'price' => '1.2',
              ),
            array(
              'pizza',
              'name' => 'Margherita',
              'price' => '2.2',
              ),
            array(
              'pizza',
              'name' => 'Margherita',
              'price' => '3.2',
              ),
          ),
        ),
      ),
    );

    $result_string = $mvp->render($render_array);
    $string_expected = '<table>
                              <thead>
                                  <tr><th>Pizza</th><th>Price</th></tr>
                              </thead>
                              <tbody>
                                  <tr><td>
                                  Margherita
                                  </td><td>
                                  1.2
                                  </td></tr>
                                  <tr><td>
                                  Margherita
                                  </td><td>
                                  2.2
                                  </td></tr>
                                  <tr><td>
                                  Margherita
                                  </td><td>
                                  3.2
                                  </td></tr>
                              </tbody>
                          </table>';
    $this->assertEquals($string_expected,$result_string, 'Render a stamp example view OK');
  }

}
