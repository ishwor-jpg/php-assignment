<?php
class App
{
  protected $controller = 'PostController';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseUrl();

    if (isset($url) && !empty($url) && file_exists('./controllers/' . ucfirst($url[0]) . 'Controller.php')) {
      $this->controller = ucfirst($url[0]) . 'Controller';
      unset($url[0]);
    }

    require_once './controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    $this->params = $url ? array_values($url) : [];
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  private function parseUrl()
  {
    if (isset($_SERVER['REQUEST_URI'])) {
      $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
      return $url ? explode('/', $url) : [];
    }

    return [];
  }
}
