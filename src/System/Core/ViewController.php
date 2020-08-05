<?php

namespace System\Core;

/**
 * ViewController Class
 *
 * @version 0.0.1
 */
class ViewController
{
  /**
   * @param Array $data
   */
  public $data = [];
  private $_parameters = [];

  /**
   * Render the View page by name
   * 
   * @param String $view view file name
   * @param Array $data data to use on frontend page
   * @param String $extension extension of file, by default is ".php"
   */
  public function view(String $view, array $data = [], String $extension = 'php')
  {
    $viewFile = sprintf(VIEWS_PATH . '/%s.%s', $view, $extension);
    if (file_exists($viewFile)) {
      require_once $viewFile;
    }
  }

  public function getParam(String $name = null)
  {
    $results = array_filter(
      $this->_parameters,
      function (String $value, $key) use ($name) {
        return (trim(strtolower($key)) === trim(strtolower($name)));
      },
      ARRAY_FILTER_USE_BOTH
    );
    if (count($results) > 0) {
      return array_shift($results);
    }
    return null;
  }

  public function setParams($parameters = [])
  {
    $this->_parameters = $parameters;
  }
}
