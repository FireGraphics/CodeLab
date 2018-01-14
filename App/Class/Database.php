<?php
class Database {
    private $db_host;
    private $db_dbname;
    private $db_username;
    private $db_password;
    private $pdo = null;

    /**
     * Database constructor.
     * @param $db_host
     * @param $db_dbname
     * @param $db_username
     * @param $db_password
     * fonction constructeur qui initialize les variables;
     */
    public function __construct($db_host, $db_dbname, $db_username, $db_password) {
        $this->db_host = $db_host;
        $this->db_dbname = $db_dbname;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
    }

    /**
     * @return null|PDO
     * fonction permettant de générer un pdo
     */
    private function getPDO() {
        if($this->pdo == null) {
            try {
                $pdo = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_dbname, $this->db_username, $this->db_password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return $this->pdo;
    }

    /**
     * @param $statement
     * @return array
     * fonction permettant d'effectuer des requètes query sur la base de donnée
     */
    public function query($statement, $class) {
        $pdo = $this->getPDO()->query($statement);
        $datas = $pdo->fetchAll(PDO::FETCH_CLASS, $class);
        return $datas;
    }

    public function prepare($statement, $values, $onlyOne = false, $class) {
        $pdo = $this->getPDO()->prepare($statement);
        $pdo->execute($values);

        if($onlyOne) {
            return $pdo->fetch();
        } else {
            return $pdo->fetchAll(PDO::FETCH_CLASS, $class);
        }
    }

    public function countRow($statement, $values = [], $novalues = false) {
        if($novalues) {
            $pdo = $this->getPDO()->query($statement);
            return $pdo->rowCount();
        } else {
            $pdo = $this->getPDO()->prepare($statement);
            $pdo->execute($values);
            return $pdo->rowCount();
        }
    }

    public function delete($statement, $values) {
        $pdo = $this->getPDO()->prepare($statement);
        $pdo->execute($values);
    }

    public function getDate($statement, $id) {
        $pdo = $this->getPDO()->prepare($statement);
        $pdo->execute($id);
        return $pdo->fetch();
    }

    public function insert($statement, $values = [], $onlyOne = false) {
        if($onlyOne) {
            $pdo = $this->getPDO()->query($statement);
        } else {
            $pdo = $this->getPDO()->prepare($statement);
            $pdo->execute($values);
        }
    }

    public function getNumberOfLikes($id) {
        $pdo = $this->getPDO()->prepare("SELECT * FROM likes WHERE idPost = ?");
        $pdo->execute($id);
        return $pdo->rowCount();
    }

    public function getUser($id, $class) {
        $pdo = $this->getPDO()->prepare("SELECT * FROM users WHERE id = ?");
        $pdo->execute(array($id));
        $pdo->setFetchMode(PDO::FETCH_CLASS, $class);
        return $pdo->fetch();
    }

    public function getCategory($id, $class) {
        $pdo = $this->getPDO()->prepare("SELECT * FROM categories WHERE id = ?");
        $pdo->execute(array($id));
        $pdo->setFetchMode(PDO::FETCH_CLASS, $class);
        return $pdo->fetch();
    }

    public function emailExist($email) {
        $pdo = $this->countRow("SELECT * FROM users WHERE email = ?", [$email]);
        if($pdo != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function usernameExist($username) {
        $pdo = $this->countRow("SELECT * FROM users WHERE username = ?", [$username]);
        if($pdo != 0) {
            return true;
        } else {
            return false;
        }
    }


}