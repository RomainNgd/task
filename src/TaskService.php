<?php

namespace App;

use App\Connection\DbConnectionTrait;
use App\Exception\TaskReadException;

class TaskService
{

    use DbConnectionTrait;
    public function findFirst(){
        $req = 'SELECT * FROM task';
        $stmt = $this->getDb()->prepare($req);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $res;
    }
    public function findLast(){
        $req = 'SELECT * FROM task';
        $stmt = $this->getDb()->prepare($req);
        $stmt->execute();
        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $lastRow = !empty($res) ? end($res) : null;

        return $lastRow;

    }


}