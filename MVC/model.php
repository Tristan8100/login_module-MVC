<?php

    class DB {
        private $host = 'localhost';
        private $db = 'notes';
        private $user = 'root';
        private $pass = '';
        private $conn;

        public function connect(){
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

    class model extends DB{

        public function loginselect($em){
            $sql = 'SELECT * FROM user WHERE user_email = :em';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':em',  $em);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function selectID($id){
            $sql = 'SELECT * FROM user WHERE user_ID = :id';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':id',  $id);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function createaccount($uf, $us, $up){
            $sql = "INSERT INTO user (user_fullname, user_email, user_password) VALUES (:uf, :us, :up)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':uf', $uf);
            $stmt->bindParam(':us', $us);
            $stmt->bindParam(':up', $up);
            if ($stmt->execute()) {
                return $this->loginselect($us);
            } else {
                return false;
            }
        }

        public function insertcode($code, $id){
            $sql = "UPDATE user SET user_code = :code WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function selectcode($code){
            $sql = 'SELECT * FROM user WHERE user_code = :code';
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':code',  $code);
            if($stmt->execute()){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function updatestatus($id){
            $sql = "UPDATE user SET user_status = :stat WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(':stat', "REGISTERED");
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return $this->deletecode($id);
            } else {
                return false;
            }
        }

        public function deletecode($id){
            $sql = "UPDATE user SET user_code = :code WHERE user_ID = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(':code', NULL, PDO::PARAM_NULL);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

?>