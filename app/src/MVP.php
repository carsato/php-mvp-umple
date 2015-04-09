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
  private $modules;
  private $views;
  private $response;

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
    $this->modules = NULL;
    $this->views = NULL;
    $this->response = NULL;
    $this->setStatus(self::$StatusListening);
  }

  //------------------------
  // INTERFACE
  //------------------------

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

  public function setResponse($aResponse)
  {
    $wasSet = false;
    $this->response = $aResponse;
    $wasSet = true;
    return $wasSet;
  }

  public function getModules()
  {
    return $this->modules;
  }

  public function getViews()
  {
    return $this->views;
  }

  public function getResponse()
  {
    return $this->response;
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

        // $this->view = New View();
        $this->modules = $this->getModulesList();
        $this->callViews();
    }
    elseif ($this->status == self::$StatusView)
    {
      // print __function__.' '.$this->status.'<br />';
        // $view = New View();
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
    $this->views['#slots'] = array();
    foreach($this->modules as $module){
      include dirname(__file__).'/../modules/'.$module['name'].'/view/'.$module['view'].'.php';
      $view = New $module['view'];
      // $this->views['#slots'] = array_replace_recursive($this->views['#slots'], $view->view());
    }
    foreach($this->modules as $module){
      $view = New $module['view'];
      $route_view_array = $view->view();
      foreach($route_view_array as $route => $view_array){
        if($route == $_GET['q']){
          $this->views['#slots'] = array_replace_recursive($this->views['#slots'], $view_array);
        }
      }
    }
    $this->render($this->views['#slots']);

    $pre_render = '<pre>'.print_r($this->views,true).'</pre>';
    // print $this->render($this->views);
    $post_render = '<pre>'.print_r($this->views,true).'</pre>';
    $this->_log($this->views);
    $this->_log($post_render);


    $render = array(
      '#module' => 'system',
      '#view'   => 'SystemView',
      '#method' => 'layoutRender',
      '#args'   => array(
        'slots' => $this->views['#slots'],
        'template_file' => dirname(__file__).'/../vendor/IronSummitMedia/startbootstrap-modern-business/'.$_GET['q'],
      ),
    );
    $file = dirname(__file__).'/../modules/'.$render['#module'].'/view/'.$render['#view'].'.php';
    require_once $file;
    $view = New $render['#view'];
    $this->response = $view->{$render['#method']}($render['#args']);
  }

  public function request_path()
  {
    static $path;

    if (isset($path)) {
      return $path;
    }

    if (isset($_GET['q']) && is_string($_GET['q'])) {
      // This is a request with a ?q=foo/bar query string. $_GET['q'] is
      // overwritten in drupal_path_initialize(), but request_path() is called
      // very early in the bootstrap process, so the original value is saved in
      // $path and returned in later calls.
      $path = $_GET['q'];
    }
    elseif (isset($_SERVER['REQUEST_URI'])) {
      // This request is either a clean URL, or 'index.php', or nonsense.
      // Extract the path from REQUEST_URI.
      $request_path = strtok($_SERVER['REQUEST_URI'], '?');
      $base_path_len = strlen(rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/'));
      // Unescape and strip $base_path prefix, leaving q without a leading slash.
      $path = substr(urldecode($request_path), $base_path_len + 1);
      // If the path equals the script filename, either because 'index.php' was
      // explicitly provided in the URL, or because the server added it to
      // $_SERVER['REQUEST_URI'] even when it wasn't provided in the URL (some
      // versions of Microsoft IIS do this), the front page should be served.
      if ($path == basename($_SERVER['PHP_SELF'])) {
        $path = '';
      }
    }
    else {
      // This is the front page.
      $path = '';
    }

    // Under certain conditions Apache's RewriteRule directive prepends the value
    // assigned to $_GET['q'] with a slash. Moreover we can always have a trailing
    // slash in place, hence we need to normalize $_GET['q'].
    $path = trim($path, '/');

    return $path;
  }


  /**
   * 
   * Returns the requested URL path of the page being viewed.
   * 
   * Examples:
   * - http://example.com/node/306 returns "node/306".
   * - http://example.com/drupalfolder/node/306 returns "node/306" while
   * base_path() returns "/drupalfolder/".
   * - http://example.com/path/alias (which is a path alias for node/306) returns
   * "path/alias" as opposed to the internal path.
   * - http://example.com/index.php returns an empty string (meaning: front page).
   * - http://example.com/index.php?page=1 returns an empty string.
   * 
   * @return
   * The requested Drupal URL path.
   * 
   * @see current_path()
   */
   public function bootstrap()
  {
    $_GET['q'] = $this->request_path();
  }

  //------------------------
  // DEVELOPER CODE - PROVIDED AS-IS
  //------------------------
  
  // line 107 business-logic.ump
  public function render (&$element) 
  {
    if(isset($element['#render'])){
      $render = $element;
      $file = dirname(__file__).'/../modules/'.$render['#module'].'/view/'.$render['#view'].'.php';
      require_once $file;
      $view = New $render['#view'];
      $element[] = $view->{$render['#method']}($render['#args']);
      foreach($render as $key => $val){
        unset($element[$key]);
      }
      $this->render($element);

    }
    elseif(!isset($element['#markup'])){
      if(is_array($element)){
        $element['#markup'] = array();
        foreach($this->children_elements($element) as $key => $children){
          $this->render($element[$key]);
          if(isset($element[$key]['#render'])){
            $render = $element[$key];
            $file = dirname(__file__).'/../modules/'.$render['#module'].'/view/'.$render['#view'].'.php';
            require_once $file;
            $view = New $render['#view'];
            $element[$key]['#markup'] = $view->{$render['#method']}($render['#args']);
          }
          elseif(!isset($element[$key]['#markup'])){
            if(is_array($element[$key])){
              $element[$key]['#markup'] = $this->render($element[$key]);
            }
          }
          if(is_array($element[$key])){
            $element['#markup'][] = $element[$key]['#markup'];
          }
          else{
            $element['#markup'][] = $element[$key];
          }
        }

      }
      else{
        // $this->_log(__function__. ' element 2');
        // $this->_log($element);
        // $element = array('#markup'=>$element);
        return $element;
      }

    }


    if(isset($element['#markup']) && is_array($element['#markup'])){
      $element['#markup'] = implode('',$element['#markup']);
      return $element['#markup'];
    }


    return $element['#markup'];
  }

// line 165 business-logic.ump
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

// line 176 business-logic.ump
  public function _log ($var) 
  {
    if(isset($_GET['log']) && $_GET['log'] == 1){
      print '<pre>'.print_r($var,true).'</pre>';
    }
  }

}
?>