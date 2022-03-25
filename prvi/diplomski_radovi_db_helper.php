<?php

class DiplomskiRadoviDBHelper {

    protected $db;
    //In order to acces $instance from a static fun i need to make it static as well
    private static $instance = null;

    private function __construct(DiplomskiPDO $db) {
        $this->db = $db;
    }

    public function findAll() {
        return $this->db->query("SELECT * FROM diplomski_radovi")->fetchAll();
    }

    public function insert($name, $text, $link, $oib) {
        $stmt = $this->db->prepare("INSERT INTO diplomski_radovi (name, text, link, oib) VALUES (?, ?, ?, ?)");
        $valid = $stmt->execute([$name, $text, $link, $oib]);
        return $valid;
    }

    public static function getInstance(DiplomskiPDO $db) {
        if (self::$instance == null) {
            self::$instance = new DiplomskiRadoviDBHelper($db);
        }
        return self::$instance;
    }

    public function destroy() {
        $this->db->destroy();
    }
}

