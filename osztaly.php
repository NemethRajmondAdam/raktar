<?php

class Osztaly{
    protected $mysqli;
        function __construct($host='localhost', $user='root', $password='', $db='raktar')
        {
            $this->mysqli=new mysqli($host, $user, $password, $db);
            if ($this->mysqli->connect_errno)
            {
                throw new Exception($this->mysqli->connect_errno);
            }
        }

        function __destruct()
        {
            $this->mysqli->close();
        }

        public function getStores(): array
        {
            $query="SELECT * FROM stores";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function getProductsById($id): array
        {
            $query="SELECT * FROM products WHERE id_store = $id";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function getStoreById($id)
        {
            $result = $this->mysqli->query("SELECT name FROM stores WHERE id = $id");
            $store = $result->fetch_assoc();
            if (isset($store['name'])) {
                return $store['name'];    
            }
            return "";
        }
        
        public function getAllFromProducts($id)
        {
            $query="SELECT * FROM products WHERE id_store = $id";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function getRows($id)
        {            
            $result = $this->mysqli->query("SELECT name FROM row WHERE id = $id");
            $rows = $result->fetch_assoc();
            if (isset($rows['name'])) {
                return $rows['name'];    
            }
            return "";
        }

        public function getColls($id)
        {            
            $result = $this->mysqli->query("SELECT name FROM columns WHERE id = $id");
            $cols = $result->fetch_assoc();
            if (isset($cols['name'])) {
                return $cols['name'];    
            }
            return "";
        }
        public function getShelves($id)
        {            
            $result = $this->mysqli->query("SELECT name FROM shelves WHERE id = $id");
            $shelves = $result->fetch_assoc();
            if (isset($shelves['name'])) {
                return $shelves['name'];    
            }
            return "";
        }

        public function getAllRows():array
        {
            $query="SELECT * FROM row";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function getAllCols():array
        {
            $query="SELECT * FROM columns";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function getAllShelves():array
        {
            $query="SELECT * FROM shelves";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function Keres($string):array
        {
            $query = "SELECT * FROM products WHERE name = '$string'";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function new($raktar,$sor,$oszlop,$polc,$nev,$ar,$db,$minDb){
            if (empty($this->Keres($nev))) {
                $query="INSERT INTO products (id_store,id_row,id_column,id_shelf,name,price,quantity,min_quantity ) VALUES ($raktar, $sor, $oszlop, $polc, '$nev', $ar, $db, $minDb)";

                if ($this->mysqli->query($query) == TRUE) {
                    echo "Az adatok sikeresen feltöltve.";
                }
                else {
                    echo "Hiba az adatok feltöltése közben.". $this->mysqli->error;
                }
            }
            else{
                echo"";
            }

        }

}

?>