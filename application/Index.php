<?php

namespace Application;

use Flight;
use RouteMap\Core\Application;
use RouteMap\Core\DBFactory;

class Index extends Application {
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
        Flight::route('/db', function() {
            $db = DBFactory::getDB([
                'database_type' => 'mysql',
                'database_name' => 'event200_anlong',
                'server' => 'localhost',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8'
            ]);
            $datas = $db->select("news", '*');
            var_dump($datas);
        });
    }
}