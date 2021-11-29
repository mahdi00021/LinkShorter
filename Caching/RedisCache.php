<?php

namespace Application\Caching;


use Redis;

class RedisCache
{

    public function getdata()
    {

        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->auth('REDIS_PASSWORD');

        $key = 'urls';
        $db_connection = new \Application\Data\Database();
        $conn = $db_connection->dbConnection();

        if (!$redis->get($key)) {

            $sql = "SELECT * FROM urls";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $urls[] = $row;
            }

            $redis->set($key, serialize($urls));
            $redis->expire($key, 3600);

        } else {

            $urls = unserialize($redis->get($key));

        }

        return $urls;

    }

}