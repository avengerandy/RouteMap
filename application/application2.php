<?php

namespace Application;

use Flight;
use RouteMap\Core\Application;

class application2 extends Application {
	public function router() {
		Flight::route('/hello', function() {
			echo '(application2)hello, world';
		});
		Flight::route('/var/@var', function($var){
			echo "(application2)get var = $var";
		});
    }
}
