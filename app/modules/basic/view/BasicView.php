<?php

class BasicView{
  public function view(){
    $my_view = $this->viewMyView();
    return array(
      'services.html' => array(
        'messages' => array(
          '#render' => true,
          '#module' => 'basic',
          '#view'   => 'BasicView',
          '#method' => 'viewMyView',
        ),
      ),
      'index.html' => array(
        'panel1' => array(
          '#render' => true,
          '#module' => 'basic',
          '#view'   => 'BasicView',
          '#method' => 'viewMyView',
        ),
      ),
    );
  }

  public function viewMyView(){
    return array(
      'part1' => array(
        '#render' => true,
        '#module' => 'system',
        '#view'   => 'SystemView',
        '#method' => 'stampteRender',
        '#route'  => 'about.html',
        '#args' => array(
          'template_file' => dirname(__file__).'/table.html',
          'data' => array(
            array(
              'id' => 'pizza',
              'name' => 'Margherita 1',
              'price' => '1.2',
              ),
            array(
              'pizza',
              'name' => 'Margherita 2',
              'price' => '2.2',
              ),
            array(
              'pizza',
              'name' => 'Margherita 3',
              'price' => '3.2',
              ),
          ),
        ),
      ),
      'subtitle' => array('This is dinamic content'),
    );
  }
}
