<?php
namespace App\Exception;

use Exception;

class TaskReadException extends Exception
{
    protected $message = "Une erreur est survenue dans la lecture de la tache";

}