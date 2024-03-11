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
}
?>