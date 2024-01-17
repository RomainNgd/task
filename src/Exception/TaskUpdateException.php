<?php
namespace App\Exception;

use Exception;

class TaskUpdateException extends Exception
{
    protected $message = "Une erreur est survenue dans la mise a jour de la tache";

}