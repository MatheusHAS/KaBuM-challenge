<?php

namespace System\Core;

use System\Http\Response;

/**
 * ApiController Class
 *
 * @version 0.0.1
 */
class ApiController
{
  /**
   * @var Response $response
   */
  public $response = null;

  /**
   * @var array with parameters on route url
   */
  private $_parameters = [];

  public function __construct($parameters = [])
  {
    $this->_parameters = $parameters;
    $this->response = new Response();
    $this->response->addHeader('Content-Type: application/json; charset=UTF-8');
  }

  /**
   * Get response of ApiController
   */
  public function getResponse()
  {
    return $this->response;
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
