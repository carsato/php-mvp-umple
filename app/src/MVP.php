<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.22.0.5146 modeling language!*/

// <?php
class MVP
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //MVP Attributes
  private $view;
  private $modules;
  private $views;

  //MVP State Machines
  private static $StatusListening = 1;
  private static $StatusRequested = 2;
  private static $StatusView = 3;
  private static $StatusPresenter = 4;
  private static $StatusModel = 5;
  private $status;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct()
  {
    $this->view = NULL;
    $this->modules = NULL;
    $this->views = NULL;
    $this->setStatus(self::$StatusListening);
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setView($aView)
  {
    $wasSet = false;
    $this->view = $aView;
    $wasSet = true;
    return $wasSet;
  }

  public function setModules($aModules)
  {
    $wasSet = false;
    $this->modules = $aModules;
    $wasSet = true;
    return $wasSet;
  }

  public function setViews($aViews)
  {
    $wasSet = false;
    $this->views = $aViews;
    $wasSet = true;
    return $wasSet;
  }

  public function getView()
  {
    return $this->view;
  }

  public function getModules()
  {
    return $this->modules;
  }

  public function getViews()
  {
    return $this->views;
  }

  public function getStatusFullName()
  {
    $answer = $this->getStatus();
    return $answer;
  }

  public function getStatus()
  {
    if ($this->status == self::$StatusListening) { return "StatusListening"; }
    elseif ($this->status == self::$StatusRequested) { return "StatusRequested"; }
    elseif ($this->status == self::$StatusView) { return "StatusView"; }
    elseif ($this->status == self::$StatusPresenter) { return "StatusPresenter"; }
    elseif ($this->status == self::$StatusModel) { return "StatusModel"; }
    return null;
  }

  public function run()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusListening)
    {
      $this->exitStatus();
      $this->setStatus(self::$StatusRequested);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function processRequest()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusRequested)
    {
      $this->setStatus(self::$StatusView);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function returnRequest()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusRequested)
    {
      $this->setStatus(self::$StatusListening);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function notify()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusView)
    {
      $this->setStatus(self::$StatusPresenter);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function display()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusView)
    {
      $this->setStatus(self::$StatusRequested);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function updateModel()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusPresenter)
    {
      $this->setStatus(self::$StatusModel);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function updateView()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusPresenter)
    {
      $this->setStatus(self::$StatusView);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function getData()
  {
    $wasEventProcessed = false;
    
    $aStatus = $this->status;
    if ($aStatus == self::$StatusPresenter)
    {
      $this->setStatus(self::$StatusModel);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  private function exitStatus()
  {
    if ($this->status == self::$StatusListening)
    {
      // print __function__.' '.$this->status.'<br />';
    }
  }

  private function setStatus($aStatus)
  {
    $this->status = $aStatus;

    // entry actions and do activities
    if ($this->status == self::$StatusListening)
    {
      // print __function__.' '.$this->status.'<br />';
    }
    elseif ($this->status == self::$StatusRequested)
    {
      // print __function__.' '.$this->status.'<br />';
        $this->modules = $this->getModulesList();
        $this->callViews();
    }
    elseif ($this->status == self::$StatusView)
    {
      // print __function__.' '.$this->status.'<br />';
        $view = New View();
    }
    elseif ($this->status == self::$StatusPresenter)
    {
      // print __function__.' '.$this->status.'<br />';
    }
    elseif ($this->status == self::$StatusModel)
    {
      // print __function__.' '.$this->status.'<br />';
    }
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {}

   public function getModulesList()
  {
    $this->modules = array();
    foreach(glob(dirname(__file__)."/../modules/*/config/config.php") as $module){
    // foreach(glob(dirname(__file__)."/../modules/*/Module.php") as $module){
      // print $module;
      $moduleContents = include $module;
      $this->modules[] = $moduleContents;
    }
    return $this->modules;
  }

   public function callViews()
  {
    $this->views = array();
    foreach($this->modules as $module){
      include dirname(__file__).'/../modules/'.$module['name'].'/view/'.$module['view'].'.php';
      $view = New $module['view'];
      $this->views[] = $view->view();
    }
    $pre_render = '<pre>'.print_r($this->views,true).'</pre>';
    print $this->render($this->views);
    $post_render = '<pre>'.print_r($this->views,true).'</pre>';
    // print $pre_render.$post_render;
    // print '<pre>'.print_r($this->views,true).'</pre>';
    // print '<pre>'.print_r($this->render($this->views),true).'</pre>';
  }

  //------------------------
  // DEVELOPER CODE - PROVIDED AS-IS
  //------------------------
  
  // line 76 business-logic.ump
  public function render (&$element) 
  {
    if(!isset($element['#markup'])){
      if(is_array($element)){
        foreach($this->children_elements($element) as $key => $children){
          $this->render($element[$key]);
          if(isset($element[$key]['#markup'])){
            $element['#markup'][] = $element[$key]['#markup'];
          }
          else{
            if(!isset($element['#render'])){
              $element['#markup'][] = $this->render($element[$key]);
            }
            else{
              // print_r($element);
            }
          }
        }
        if(!isset($element['#render'])){
          $element['#markup'] = implode(' ',$element['#markup']);
        }
        else{
          $render = $element['#render'];
          $file = dirname(__file__).'/../modules/'.$render['#module'].'/view/'.$render['#view'].'.php';
          require_once $file;
          $view = New $render['#view'];
          $element['#markup'] = $view->{$render['#method']}($render['#args']);
        }
      }
      else{
        return $element;
      }
    }
    return $element['#markup'];
  }

// line 111 business-logic.ump
  public function children_elements ($elements) 
  {
    $children = array();
    foreach($elements as $key => $element){
      $padSimbolPos = strpos($key, '#');
      if($padSimbolPos === false || $padSimbolPos > 0){
        $children[$key] = $element;
      }
    }
    return $children;
  }

}
?>