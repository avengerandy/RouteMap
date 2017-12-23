<?php

namespace Application;

use Flight;
use RouteMap\Core\Application;

class applicationTest extends Application {
	public function router() {
		Flight::route('/hello', function() {
			echo 'applicationTest hello, world';
		});
		Flight::route('/var/@var', function($var){
			echo "applicationTest get var = $var";
		});
    }
}
