<?php

class BasicView{
  public function view(){
    return array(
      'body1' => array(
        __file__ => array(
        '<div id="div1">'.__file__.' '.__class__.' '.__function__.' 1</div>'
        ),
      )
    );
  }
}
