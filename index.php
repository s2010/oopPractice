<?php


use Todo\Models\Task;
use Todo\TaskManager;
use Todo\Storage\DatabaseTaskStorage;


require_once  'vendor/autoload.php';

//db connection
$db = new PDO ('mysql:host=127.0.0.1;dbname=todo', 'root', 'root');
$storage = new DatabaseTaskStorage($db);
$manager = new TaskManager($storage);


$task = new Task();
$task->setDescription('A new Task');
$task->setDue(new DateTime);

$storedTask = $manager->addTask($task);
//you can redirect using $storedTask->getId(); and show Task based on id