<?php

class BasicView{
  public function view(){
    return array(
      'services.html' => array(
        'messages' => array(
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
        ),
      ),
      'index.html' => array(
        'panel1' => array(
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
        ),
      ),
    );
  }
}
