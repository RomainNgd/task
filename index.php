<?php
require_once 'vendor/autoload.php';

use App\BaseTask;
use App\Task;

$service = new \App\TaskService();

echo '<h1>PREMIER TEST</h1> <br>';

echo '<h3>création objet</h3> <br>';
$task1 = new Task('test', 'test tes test test', BaseTask::STATUS_OPEN);
echo $task1 . '<br>';

echo '<h3>création en base</h3> <br>';
$task1->create();

echo '<h3>lecture en base </h3> <br>';
$readtask = $service->findLast();
$task1->setId($readtask['id']);
dump($task1->read());

echo '<h3>Mise a jour en base </h3> <br>';
$task1->setStatus(BaseTask::STATUS_FINISH);
$task1->update();
dump($task1->read());

echo '<h3>suppression en base </h3> <br>';
$task1->delete();
dump($task1->read());


echo '<h3>Sortir une excpetion </h3> <br>';

$faketask = new Task(null, 'fake', BaseTask::STATUS_FINISH);
try {
    $faketask->create();
} catch (\App\Exception\TaskCreateException $e) {
    echo $e->getMessage();
}
