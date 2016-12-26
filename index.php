<?php

use Todo\Models\Task;
use Todo\TaskManager;
use Todo\Storage\DatabaseTaskStorage;


session_start();
require_once  'vendor/autoload.php';

//db connection

$db = new PDO ('mysql:host=127.0.0.1;dbname=todo', 'root', 'root');

$manager = new TaskManager(new DatabaseTaskStorage($db));
$task = new Task();
$task->setDescription('Learn To Believe in what you build and Have Fun');