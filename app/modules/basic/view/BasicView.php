<?php

class BasicView{
  public function view(){
    return array(
      'body3' => array(
        __file__ => array(
        '<div id="div1"> body 3',
        '<div id="div2">'.__file__.' '.__class__.' '.__function__.' 1</div>',
        '</div>',
        '#vars' => array(
          'var1' => 1,
          'var2' => 2,
        ),
        'body4' => array(
          'hola body 4',
          )
        ),
      )
    );
  }
}
