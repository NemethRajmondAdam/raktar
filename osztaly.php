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

        public function getLocal(): array
        {
            $query="SELECT * FROM raktarok";

            return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
        }
}
?>