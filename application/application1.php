<?php

namespace Application;

use Flight;
use RouteMap\Core\Application;

class application1 extends Application {
	public function router() {
		Flight::route('/hello', function() {
			echo 'hello, world';
		});
		Flight::route('/var/@var', function($var){
			echo "get var = $var";
		});
		Flight::route('/redirect', function() {
			Flight::redirectOutside('/application2/var/456');
		});
    }
}