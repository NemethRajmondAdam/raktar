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

        public function getInfoStore($id)
        {
            $result = $this->mysqli->query("SELECT id_store FROM products WHERE id = $id");
            $stores = $result->fetch_assoc();
            if (isset($stores['id_store'])) {
                return $this->getStoreById($stores['id_store']);    
            }
            return "";
        }

        public function getInfoRow($id)
        {
            $result = $this->mysqli->query("SELECT id_row FROM products WHERE id = $id");
            $rows = $result->fetch_assoc();
            if (isset($rows['id_row'])) {
                return $this->getRows($rows['id_row']);    
            }
            return "";
        }

        public function getInfoCol($id)
        {
            $result = $this->mysqli->query("SELECT id_column FROM products WHERE id = $id");
            $columns = $result->fetch_assoc();
            if (isset($columns['id_column'])) {
                return $this->getColls($columns['id_column']);    
            }
            return "";
        }

        public function getInfoShelf($id)
        {
            $result = $this->mysqli->query("SELECT id_shelf FROM products WHERE id = $id");
            $shelves = $result->fetch_assoc();
            if (isset($shelves['id_shelf'])) {
                return $this->getShelves($shelves['id_shelf']);    
            }
            return "";
        }

        public function getInfoName($id){
            $result = $this->mysqli->query("SELECT name FROM products WHERE id = $id");
            $names = $result->fetch_assoc();
            if (isset($names['name'])) {
                return $names['name'];    
            }
            return "";
        }

        public function getInfoPrice($id){
            $result = $this->mysqli->query("SELECT price FROM products WHERE id = $id");
            $prices = $result->fetch_assoc();
            if (isset($prices['price'])) {
                return $prices['price'];    
            }
            return "";
        }
        public function getInfoQuantity($id){
            $result = $this->mysqli->query("SELECT quantity FROM products WHERE id = $id");
            $quantities = $result->fetch_assoc();
            if (isset($quantities['quantity'])) {
                return $quantities['quantity'];
            }
            return "";
        }
        public function getInfoMin($id){
            $result = $this->mysqli->query("SELECT min_quantity FROM products WHERE id = $id");
            $mins = $result->fetch_assoc();
            if (isset($mins['min_quantity'])) {
                return $mins['min_quantity'];
            }
            return "";
        }

        public function update($id,$raktar,$sor,$oszlop,$polc,$nev,$ar,$db,$minDb){

            //echo "TESZT";

            $query="UPDATE products SET id_store=$raktar,id_row=$sor,id_column=$oszlop,id_shelf=$polc,name='$nev',price=$ar,quantity=$db,min_quantity=$minDb WHERE id =$id ";

            if ($this->mysqli->query($query) == TRUE) {
                echo "Az adatok sikeresen feltöltve.";
            }
            else {
                echo "Hiba az adatok feltöltése közben.". $this->mysqli->error;
            }
        }

        public function delete($id){
            $query = "DELETE FROM products WHERE id=$id;";
            
            if ($this->mysqli->query($query) == TRUE) {
                echo "Az adatokat sikeresen töröltük.";
            }
            else {
                echo "Hiba az adatok törlése közben.". $this->mysqli->error;
            }
        }

        public function kifogyo():array
        {
            $query = "SELECT * FROM `products` WHERE min_quantity>=quantity";
            
            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function dropTable($name)
        {
            $query = "DROP TABLE IF EXISTS $name";
        
            if ($this->mysqli->query($query) === TRUE) {
                echo "Az adatokat sikeresen töröltük.";
            } else {
                echo "Hiba az adatok törlése közben: " . $this->mysqli->error;
            }
        }
        public function import($name, $files)
        {
            
            if (isset($_POST["import"])) {
                $file = $_FILES[$files]["tmp_name"];
                $handle = fopen($file, "r");
                
                $header = fgetcsv($handle);
            
                while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                    $sql = "INSERT INTO $name (oszlop1, oszlop2, oszlop3) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $row[0], $row[1], $row[2]);
                    $stmt->execute();
            
                    if ($stmt->affected_rows > 0) {
                        echo "Sikeres importálás";
                    } else {
                        echo "Hiba: " . $sql . "<br>" . $conn->error;
                    }
                    
                    $stmt->close();
                }
                
                fclose($handle);
            }

        }
}

?>