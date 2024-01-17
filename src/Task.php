<?php
namespace App;
use App\Connection\DbConnectionTrait;
use App\Exception\TaskCreateException;
use App\Exception\TaskDeleteException;
use App\Exception\TaskReadException;
use App\Exception\TaskUpdateException;

class Task extends BaseTask
{
    private $logger;
    private $notification;

    use StatusTrait;
    use DbConnectionTrait;

    public function __construct(?string $title, string $description, string $status)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setStatus($status);

        $this->logger = new class {
            public function log($message) {
                echo "<p style='color: blue'>Logging: $message </p><br>";
            }
        };

        $this->notification = new class {
            public function notify($message) {
                echo "<p style='color: #cc2255'>Notification : $message </p><br>";
            }
        };

    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function logTaskUpdate($message)
    {
        // Utiliser la classe anonyme pour effectuer l'action (logging)
        $this->logger->log($message);
    }

    public function __toString(): string
    {
        return  '<b> IDENTIFIANT : </b>' . $this->getId() .'<b> TITRE : </b>' . $this->getTitle() . '<br> <b>DESCRIPTION :</b>' . $this->getDescription(). '<br> <b>STATUS :</b>' . $this->getStatus();
    }

    /**
     * @throws TaskDeleteException
     */
    public function delete(): bool
    {
        try {
            $req = 'DELETE FROM task WHERE id = :id';
            $stmt = $this->getDb()->prepare($req);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();
            $isDelete = ($stmt->rowCount() > 0);
            $stmt->closeCursor();
            $this->logTaskUpdate("La tache avec l'id {$this->getId()} a été supprimé.");
            return $isDelete;
        } catch (\Exception){
            throw new TaskDeleteException();
        }

    }

    public function create(): bool
    {
        try {
            $req = 'INSERT INTO task (title, description, status) VALUES (:title, :description, :status)';
            $stmt = $this->getDb()->prepare($req);
            $stmt->bindValue(":title", $this->getTitle());
            $stmt->bindValue(":description", $this->getDescription());
            $stmt->bindValue(":status", $this->getStatus());
            $stmt->execute();
            $isCreate = ($stmt->rowCount() > 0);
            $stmt->closeCursor();
            $this->logTaskUpdate("Une tache de titre  {$this->getTitle()} a été créé.");
            return $isCreate;
        } catch (\Exception){
            throw new TaskCreateException();
        }
    }

    public function read()
    {
        try {
            $req = 'SELECT * FROM task WHERE id = :id';
            $stmt = $this->getDb()->prepare($req);
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $res;
        } catch (\Exception){
            throw new TaskReadException();
        }
    }

    public function update(): bool
    {
        try {
            $req = 'UPDATE task set title = :title, description = :description, status = :status WHERE id = :id';
            $stmt = $this->getDb()->prepare($req);
            $stmt->bindValue(":title", $this->getTitle());
            $stmt->bindValue(":description", $this->getDescription());
            $stmt->bindValue(":status", $this->getStatus());
            $stmt->bindValue(":id", $this->getId());
            $stmt->execute();
            $isUpdate = ($stmt->rowCount() > 0);
            $stmt->closeCursor();
            $this->logTaskUpdate("La tache avec l'id {$this->getId()} a été mise à jour.");
            return $isUpdate;
        } catch (\Exception $exception){
            throw new TaskUpdateException();
        }
    }
}