<?php
class ProjectView{
  public function view(){
    return array(
      'body3' => array(
        __class__. ' body3 ' .__function__,
        'asldfjsldfk',
        ),
      'body2' => array(
        'body 2',
        'inside body 2' => array(
          '<div>this ',
          'is ',
          'inside ',
          'body 2</div>',
          )
        ),
      );
  }
}
