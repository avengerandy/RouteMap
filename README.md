
# RouteMap

 > A PHP combination framework that grouping routers by path-segment

## Components

* [**Flight**](http://flightphp.com) - An extensible micro-framework for PHP

* [**Medoo**](https://medoo.in) - The Lightest PHP database framework to accelerate development

* [**Collect**](https://github.com/tightenco/collect) - A Collections-only split from Laravel's Illuminate Support

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
  https://domain_name/applicationTest/var1/
  ```
  then create application1.php from
  ```
  /
  + /application
    + /applicationTest.php
  ```

* ### Router setting
  In applicationTest.php, method router is for routers setting
  ```php
  namespace Application;

  use Flight;
  use RouteMap\Core\Application;

  class applicationTest extends Application {
      public function router() {
          Flight::route('/', function() {
	          echo 'hello, world';
	      });
      }
  }
  ```

* ### Example
  request url
  ```
  https://domain_name/applicationTest/
  ```
  will see "hello, world"

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