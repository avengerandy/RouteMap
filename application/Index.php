<?php

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