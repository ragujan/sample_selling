<?php
class connectDB {
    private $dbName;
    private $serverName;
    private $passWord;
    private $userName;

    public function connect(){
        $this -> dbName = 's2';
        $this -> serverName = 'localhost';
        $this -> passWord = 'ragJN100Mania';
        $this -> userName = 'root';


        try {
                
            $dsn = "mysql:host=".$this -> serverName.";dbname=".$this -> dbName;
            $pdoCon = new PDO($dsn,$this->userName,$this->passWord);
            $pdoCon ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $pdoCon;
        } catch (PDOException $th) {
            //throw $th;
            echo $th ->getMessage();
        }
    }
}

?>