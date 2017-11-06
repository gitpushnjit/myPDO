<?php
//by pg395
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'pg395');
define('USERNAME', 'pg395');
define('PASSWORD', 'r4Matf7xW');
define('CONNECTION', 'sql.njit.edu');

class dbConn{


    protected static $dbConnection;


    private function __construct() {

        try {

            self::$dbConnection = new PDO( 'mysql:host=' . CONNECTION .';dbname=' . DATABASE, USERNAME, PASSWORD );
            self::$dbConnection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch (PDOException $excep) {

            echo "The server gave error as: ".$excep->getMessage()."</br>";
        }

    }


    public static function getConnection() {


        if (!self::$dbConnection) {
          new dbConn();
        }
return self::$dbConnection;
    }
}


class collection {


    static public function getRecords() {

        $dbConnection = dbConn::getConnection();
        echo 'Connection Successful </br>';
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName.' where id < 6';
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $records =  $statement->fetchAll();
        return $records;
    }
}



class accounts extends collection {
    protected static $modelName = 'account';
}

class account {}


$accountRecords = accounts::getRecords();

echo "Total number of results are: ".count($accountRecords)."</br>";
echo "<table border=\"1\"><tr><th>id</th><th>email</th><th>fname</th><th>lname</th><th>phone</th><th>birthday</th><th>gender</th><th>password</th></tr>";
foreach($accountRecords as $tempRecord){

echo "<tr><td>".$tempRecord->id."</td><td>".$tempRecord->email."</td><td>".$tempRecord->fname."</td><td>".$tempRecord->lname."</td><td>".$tempRecord->phone."</td><td>".$tempRecord->birthday."</td><td>".$tempRecord->gender."</td><td>".$tempRecord->password."</td></tr>";
}
?>