<?php

class SystemView{
  public function view(){
    return array(
      '<div>',
      __class__.' '.__function__.' div1',
      __class__.' '.__function__.' div2',
      ' </div>',
    );
  }
}
