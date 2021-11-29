<?php

namespace Application\utils;


use Application\Data\Database;

class Utils
{

    public static function GetRedirectUrl($short_code)
    {

        $db_connection = new Database();
        $conn = $db_connection->dbConnection();
        $query = "SELECT * FROM urls WHERE short_code = '" . $short_code . "' ";
        $result = $conn->prepare($query);
        $result->execute();
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            // increase the hit
            $hits = $row['hits'] + 1;
            $sql = "update urls set hits='" . $hits . "' where id='" . $row['id'] . "' ";
            $conn->prepare($sql)->execute();

            return $row['url'];
        } else {
            echo json_encode("Invalid Link!");
        }
    }


    public static function generateUniqueID()
    {

        $db_connection = new Database();
        $conn = $db_connection->dbConnection();
        $token = substr(md5(uniqid(rand(), true)), 0, 3); // creates a 3 digit unique short id. You can maximize it but remember to change .htacess value as well
        $query = "SELECT * FROM urls WHERE short_code = '" . $token . "' ";
        $result = $conn->prepare($query);
        $result->execute();
        if ($result->rowCount() > 0) {
            self::generateUniqueID();
        } else {
            return $token;
        }
    }


}