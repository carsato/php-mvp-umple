<?php

class BasicView{
  public function view(){
    return array(
      '<div>',
      '<div>'.__class__.' '.__function__.' 1</div>',
      '<div>'.__class__.' '.__function__.' 2</div>',
      '<div>'.__class__.' '.__function__.' 3</div>',
      '<div>'.__class__.' '.__function__.' 4</div>',
      '</div>',
      '#vars' => array(
        'var1' => 1,
        'var2' => 2,
      ),
    );
  }
}
