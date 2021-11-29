<?php

namespace Application;
require "vendor/autoload.php";
include('Data\Database.php');
include('middlewares\Auth.php');
include('App\FactoryUrl\FactoryUrlClass.php');

use Application\App\FactoryUrlClass;
use Application\Data\Database;
use Application\middlewares\Auth;

class Main
{

    public function index($type, $url, $short_code)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: POST");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


        $allHeaders = getallheaders();
        $db_connection = new Database();
        $conn = $db_connection->dbConnection();
        $auth = new Auth($conn, $allHeaders);


        if ($auth->isAuth()) {

            $factory = new FactoryUrlClass();
            $factory->urlFactory($type, $url, $short_code);
            echo json_encode("ok");

        } else {
            echo json_encode("Not Authorized !");
        }


    }

}


$index = new Main();


if (isset($_REQUEST['type']) && isset($_REQUEST['url']) && isset($_REQUEST['short_code'])) {

    $type = $_REQUEST['type'];
    $url = $_REQUEST['url'];
    $short_code = $_REQUEST['short_code'];
    $index->index($type, $url, $short_code);
}


