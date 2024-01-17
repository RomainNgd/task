<?php
namespace App\Exception;
use Exception;

class TaskDeleteException extends Exception
{
    protected $message = "Une erreur est survenue dans la supression de la tache";

}