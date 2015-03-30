<?php


class SystemView{
  public function view(){
    return array(
      '#render' => array(
        '#module' => 'System',
        '#view'   => 'SystemView',
        '#method' => 'stampteRender',
        '#args' => array(
          'template' => " <table>
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
            'Margherita' => '7.00',
            'Funghi' => '7.50',
            'Tonno' => '8.00',
          ),
        ),
      ),
    );
  }

  public function stampteRender(){
    require dirname(__file__).'/../../../vendor/gabordemooij/stamp/StampTE.php';
    $args = func_get_args();
    $template = $args['template'];
    $data = $args['data'];
    $tpl = new StampTE($template);
    foreach($data as $name=>$value) {
    }
  }
}
