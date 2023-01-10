<?php

namespace Admin;

use mysqli;

class DataBase
{
    private static $conn;

    public static function createApiTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `api_table`(
            id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
            data_id INT(11) NOT NULL,
            name  VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            date VARCHAR(255) NOT NULL
        )
        ";

        mysqli_query(DataBase::connection(), $sql);
    }

    public static function createApiAdminTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `api_admin`(
            id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
            table_name  VARCHAR(255) NOT NULL,
            last_date  VARCHAR(255)  NOT NULL,
            last_time  VARCHAR(255)  NOT NULL
            )";
        mysqli_query(DataBase::connection(), $sql);
        Database::closeConnection();
    }


    public static function delete_all()
    {
        $sql = "DROP TABLE IF EXISTS api_admin, api_table";
        mysqli_query(Database::connection(), $sql);
        Database::closeConnection();
    }

    public static function connect()
    {
        DataBase::createApiTable();
        DataBase::createApiAdminTable();
    }

    public static function connection()
    {
        DataBase::$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Database connection issue");
        return  DataBase::$conn;
    }

    public static function  closeConnection()
    {
        mysqli_close(Database::connection());
    }

    public static function getData()
    {
        $data = array();
        foreach (mysqli_query(DataBase::connection(), "SELECT * FROM `api_table`") as $x) {
            array_push($data, $x);
        }
        Database::closeConnection();

        return $data;
    }

    public static function getAdminData()
    {
        if (mysqli_query(DataBase::connection(), "SELECT `id` FROM api_admin")->lengths)
            return intval(mysqli_fetch_assoc(mysqli_query(DataBase::connection(), "SELECT `id` FROM api_admin"))['id']);
        return NULL;
    }
    public static function getTableName()
    {
        if (mysqli_query(DataBase::connection(), "SELECT `table_name` FROM api_admin")->lengths)
            return (mysqli_fetch_assoc(mysqli_query(DataBase::connection(), "SELECT `table_name` FROM api_admin"))['table_name']);
        return NULL;
    }

    public static function save($data)
    {
        if (count(DataBase::getData()) > 0) {
            return DataBase::update($data);
        } else {
            for ($i = 0; $i < count($data) - 2; $i++) {
                $data_id = $data['id'][$i];
                $name = $data['fname'][$i];
                $lastname = $data['lname'][$i];
                $email = $data['email'][$i];
                $date = $data['date'][$i];
                $sql = "INSERT INTO api_table (`data_id`, `name`, `lastname`, `email`, `date`) VALUES ($data_id,'$name', '$lastname', '$email', '$date')";
                mysqli_query(DataBase::connection(), $sql);
            }
            $table_name = $_POST['table_name'];
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $sql = "INSERT INTO api_admin (`table_name`,`last_date`,`last_time`) VALUES ('$table_name','$date','$time')";
            mysqli_query(DataBase::connection(), $sql);
            Database::closeConnection();

            echo '<div class="notice notice-success is-dismissible api-notice">
      <p>Saved</p>
      </div>';
        }
    }

    public static function update($data)
    {
        mysqli_query(DataBase::connection(), "DELETE  FROM `api_table`");
        for ($i = 0; $i < count($data['id']); $i++) {
            $id = $data['id'][$i];
            $data_id = $data['data_id'][$i];
            $name = $data['name'][$i];
            $lastname = $data['lastname'][$i];
            $email = $data['email'][$i];
            $date = $data['date'][$i];
            $sql = "INSERT INTO api_table (`id`,`data_id`, `name`, `lastname`, `email`, `date`) VALUES ($id, $data_id,'$name', '$lastname', '$email', '$date')";
            mysqli_query(DataBase::connection(), $sql);
        }
        $admin_id = $_POST['admin_id'];
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $sql = "UPDATE api_admin SET last_date = '$date', last_time = '$time' WHERE id = $admin_id";
        mysqli_query(DataBase::connection(), $sql);
        Database::closeConnection();

        echo '<div class="notice notice-success is-dismissible api-notice">
      <p>Updated</p>
      </div>';
    }

    public static function reload()
    {
        mysqli_query(DataBase::connection(), "DELETE  FROM `api_table`");
        mysqli_query(DataBase::connection(), "DELETE  FROM `api_admin`");
        Database::closeConnection();
    }

    public static function getUpdateTime()
    {
        $sql = "SELECT * FROM `api_admin`";
        if (mysqli_query(DataBase::connection(), $sql)->num_rows) {
            $time = mysqli_fetch_assoc(mysqli_query(DataBase::connection(), $sql))["last_time"];
            return $time;
        }

        return date("H:i:s");
    }

    public static function getUpdateDate()
    {
        $sql = "SELECT * FROM api_admin";
        if (mysqli_query(DataBase::connection(), $sql)->num_rows)
            return mysqli_fetch_assoc(mysqli_query(DataBase::connection(), $sql))["last_date"];
        return date("Y-m-d");
    }
}
