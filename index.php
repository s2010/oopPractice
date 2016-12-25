<?php

use Todo\Models\Task;
use Todo\TaskManager;
use Todo\Storage\DatabaseTaskStorage;


session_start();

require_once  'vendor/autoload.php';

//db conection

$db = new PDO ('mysql:host=127.0.0.1;dbname=todo', 'root', 'root');

$manager = new TaskManager(new DatabaseTaskStorage($db));

$task = new Task();
$task->setDescription('Learn To Bellive and Have Fun');
//
//foreach(range(1, 100) as $number) {
//    if ($number % 3 != 0 && $number % 5 != 0) {
//        echo $number . '<br>';
//        continue;
//    }
//    if ($number % 3 == 0) echo 'Fizz';
//    if ($number % 5 == 0) echo 'Buzz';
//    echo '<br>';
//}
//
//$numbers = [1,2,3,4,5,6,78,6];
//
//foreach ($numbers as $number){
//    if (!$number % 2 == 0 )
//    {
//        echo $number . '<br>';
//    }
//}