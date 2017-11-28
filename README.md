
# RouteMap
 ***
 > A high readability PHP combination framework that grouping routers by path-segment #1

## Components

* [**Flight**](http://flightphp.com) - An extensible micro-framework for PHP

* [**Medoo**](https://medoo.in) - The Lightest PHP database framework to accelerate development

* [**Collect**](https://github.com/tightenco/collect) - A Collections-only split from Laravel's Illuminate Support

## Grouping Routers Features

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
https://domain_name/application1/var1/
```
create application1.php from
```
/
+ /application
  + /application1.php
```

* ### Router setting
In application1.php, method router is for routers setting
```php
namespace Application;

use Flight;
use RouteMap\Core\Application;

class application1 extends Application {
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
https://domain_name/application1/
```
will see
```
hello, world
```

## License

RouteMap is under the MIT license.