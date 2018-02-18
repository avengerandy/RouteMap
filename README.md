
# RouteMap

 > A PHP web framework that grouping routers by path

## Depend

* [**Flight**](http://flightphp.com) - An extensible micro-framework for PHP

## Grouping Routers

* ### index.php
  RouteMap's index.php is like this
  ```php
  require 'vendor/autoload.php';

  use RouteMap\Core\ApplicationFactory;

  $app = ApplicationFactory::create();
  $app->router();
  $app->start();
  ```

* ### ApplicationFactory
  ApplicationFactory will create application by path-segment #1  
  if request url is
  ```
  https://domain_name/Index/var1/
  ```
  then create Index.php from
  ```
  /
  + /application
    + /Index.php
  ```

* ### Router setting
  In Index.php, method router is for routers setting
  ```php
  namespace Application;

  use Flight;
  use RouteMap\Core\Application;

  class Index extends Application {
    public function router() {
      Flight::route('/', function() {
          echo 'hello, world';
      });
      Flight::route('/var/@var', function($var){
          echo 'get var = ' . $var;
      });
    }
  }
  ```

* ### Example
  request url
  ```
  https://domain_name/Index/
  ```
  will see "hello, world"

  request url
  ```
  https://domain_name/Index/var/5
  ```
  will see "get var = 5"

* ### Depend
  RouteMap router features is dependent on Flight  
  more router features please see [**Flight - Routing**](http://flightphp.com/learn/#routing)

## Config
* ### Config File
  RouteMap Config File location
  ```
  /
  + /config
    + /config.php
  ```
  it return with php array format

* ### Config Class
  RouteMap wrapper Flight config features by a Config Class  
  It will auto load RouteMap config file automatically  
  get it instance by getInstance ( it use Singleton Pattern )
  ```php
  use RouteMap\Core\Config;
  
  $config = Config::getInstance();
  ```
* ### Depend
  RouteMap config features is dependent on Flight  
  it can also set config by array and object  
  see [**Flight - Variables**](http://flightphp.com/learn/#variables)

## License

RouteMap is under the MIT license.