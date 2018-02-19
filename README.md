
<div style="text-align:center">
  <img src = "https://raw.githubusercontent.com/avengerandy/RouteMap/develop/routemap.png"/>
</div>

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

* ### Flight
  RouteMap router features is use Flight router  
  more router features please see [**Flight - Routing**](http://flightphp.com/learn/#routing)

## Redirect

* ### RedirectInside
  when you use Flight redirect method, your application(group) will automatically subjoin behind domain_name

* ### RedirectOutside
  if you want redirect to other application, you can use redirectOutside method that extension on Flight

* ### Example
  ```php
  class Index extends Application {
    public function router() {
      Flight::route('/', function() {
        Flight::redirect('/new/location');
      });
      ...
    }
  }
  ```
  request /Index will redirect to /Index/new/location

  ```php
  class Index extends Application {
    public function router() {
      Flight::route('/', function() {
        Flight::redirectOutside('/new/location');
      });
      ...
    }
  }
  ```
  request /Index will redirect to /new/location

* ### Flight
  redirectOutside just change the base url first, then call Flight::redirect  
  see more about redirect [**Flight - Redirect**](http://flightphp.com/learn/#redirects)

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

* ### Flight
  RouteMap config features is a wrapper from Flight  
  it can also set config by array and object  
  see [**Flight - Variables**](http://flightphp.com/learn/#variables)

* ### Extend
  if you want use your own class in RouteMap, composer's autoload is setting already
  ```php
  ...
  "autoload": {
    "psr-4": {
      "RouteMap\\": "src/", 
      "Application\\": "application/", 
      "Extend\\": "extend/"
    }
  }
  ...
  ```
  just put them in /extend folder and load with Extend namespace

## License

RouteMap is under the MIT license.