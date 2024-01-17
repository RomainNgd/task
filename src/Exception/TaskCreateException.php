<?php
namespace App\Exception;
use Exception;

class TaskCreateException extends Exception
{
    protected $message = "Une erreur est survenue dans la création de la tache";

}