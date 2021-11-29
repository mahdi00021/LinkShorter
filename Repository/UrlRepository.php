<?php

namespace Application\Repository;


use Application\utils\Utils;

class UrlRepository implements IRepository
{

    public $conn;
    public $db_connection;

    public function __construct()
    {
        $this->db_connection = new \Application\Data\Database();
        $this->conn = $this->db_connection->dbConnection();
    }

    public function create($url, $date)
    {

        $query = "SELECT * FROM urls WHERE url = '" . $url . "' ";
        $result = $this->conn->prepare($query);
        $result->execute();
        if ($result->rowCount() > 0) {

        } else {
            $short_code = Utils::generateUniqueID();

            $this->conn->beginTransaction();
            $sql = "INSERT INTO urls(url, short_code, hits) VALUES('" . $url . "', '" . $short_code . "', '0')";


            if ($this->conn->prepare($sql)->execute() == TRUE) {
                echo json_encode("success insert url!");
                $this->conn->commit();
            } else {
                $this->conn->rollBack();
                echo json_encode("Unknown Error Occured");
            }

        }

    }

    public function delete($short_code)
    {

        $query = "Delete FROM urls WHERE short_code = '" . $short_code . "' ";
        $this->conn->beginTransaction();

        if ($this->conn->prepare($query)->execute() == true) {
            $this->conn->commit();
            echo json_encode("success deleted !");

        } else {
            $this->conn->rollBack();
            echo json_encode("fails !");
        }


    }

    public function update($short_code, $url)
    {

        $query = "UPDATE urls set url ='" . $url . "' WHERE short_code = '" . $short_code . "' ";

        $this->conn->beginTransaction();

        if ($this->conn->prepare($query)->execute() == true) {
            $this->conn->commit();
            echo json_encode("success updated !");

        } else {
            $this->conn->rollBack();
            echo json_encode("fails !");
        }


    }

    public function find($url)
    {

        $query = "SELECT * FROM urls WHERE url = '" . $url . "' ";
        $res = $this->conn->prepare($query);
        if ($res->execute() == true) {

            $row = $res->fetchAll();

            $data = [
                'short_code' => $row['short_code']
            ];

            echo json_encode($data);

        } else {
            echo json_encode("fails !");
        }

    }

}