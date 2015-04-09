<?php

use StampTemplateEngine\StampTE as StampTE;

class SystemView{
  public function view(){
    return array(
      'about.html' => array(
        'about' => array(
          '#render' => true,
          '#module' => 'system',
          '#view'   => 'SystemView',
          '#method' => 'viewAView',
        ),
      ),
    );
  }

  public function viewAView(){
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
            array(
              'pizza',
              'name' => 'Margherita',
              'price' => '3.2',
              ),
          ),
        ),
      ),
    );
  }

  public function layoutRender($args){
    // $args = reset($args);
    $template_file = $args['template_file'];

    $template = file_get_contents($template_file);
    if(!$template){
      $template_file = dirname(__file__).'/../layout.html';
      $template_file = dirname(__file__).'/../../../vendor/IronSummitMedia/startbootstrap-modern-business/about.html';
      $template = file_get_contents($template_file);
    }
    $args['template'] = $template;


    // print_r($args);
    $args['data'] = $args['slots'];
    return $this->stampteLayoutRender($args);
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
    if(!$template){
      $template_file = $args['template_file'];
      $template = file_get_contents($template_file);
      if(!$template){
        throw new Exception("No template or template_file for $this view", 1);
      }
    }

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

  public function stampteLayoutRender(){
    $file = dirname(__file__).'/../../../vendor/gabordemooij/stamp/StampTE.php';
    require_once $file;
    $args = func_get_args();
    $args = reset($args);
    $template = $args['template'];

    $data = $args['data'];
    $se = new StampTE($template);

    // print '<br>-----------------<br>';
    // print '<pre>'.print_r(htmlentities($template),true).'</pre>';

    //render slots
    foreach($data as $key => $dat){
      try{
        if(isset($dat['#markup'])){
          $d = array($key => $dat['#markup']);
          $slot = $se->get($key);
          $se->add($slot);
          $se->injectAll($d,true);
        }
      }
      catch(Exception $e){

      }

    }

    return (string)$se;

  }
}
