<?php

namespace Application\App;


use Application\App\UrlCreate;
use Application\App\UrlDelete;
use Application\App\UrlUpdate;
use Application\Caching\RedisCache;
use Application\utils\Utils;
use DateTime;

class FactoryUrlClass
{

    public function urlFactory($type, $url, $short_code)
    {

        if ($type == "create") {

            $create = new UrlCreate();
            $date = new DateTime();
            $date = $date->getTimestamp();
            $create->createUrl($url, $date);

        } elseif ($type == "delete") {

            $delete = new UrlDelete();
            $delete->deleteUrl($short_code);

        } elseif ($type == "update") {

            $update = new UrlUpdate();
            $update->updateUrl($short_code, $url);

        } elseif ($type == "getUrl") {

            $redis = new RedisCache();
            $data = $redis->getdata();
            $need = array_search($short_code, $data, true);
            header("Location: " . Utils::GetRedirectUrl($need));
            exit();
        }


    }

}