<?php

use StampTemplateEngine\StampTE as StampTE;

class SystemView{
  public function view(){
    return array(
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
          ),
        ),
      ),
    );
  }
  public function basicRender($string){
    return $string;
  }

  public function stampteRender(){
    $file = dirname(__file__).'/../../../vendor/gabordemooij/stamp/StampTE.php';
    require_once $file;
    $args = func_get_args();
    $args = reset($args);
    $template = $args['template'];

    $data = $args['data'];
    $se = new StampTE($template);

    //render slots
    foreach($data as $key => $dat){
      $slot_id = reset($dat);
      // print_r($dat);
      $slot = $se->get($slot_id);
      foreach($dat as $k => $d){
        $slot->set($k,$d);
      }
      $se->add($slot);
      $se->injectAll($dat);
    }

    return (string)$se;

  }
}
