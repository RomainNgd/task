<?php
namespace App;

trait StatusTrait
{

    private string $status;

    private function notifier($message): void
    {
        if (isset($this->notification)) {
            $this->notification->notify($message);
        }
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
        $this->notifier("Le statut de la tâche a été mis à jour : $status");
    }

}