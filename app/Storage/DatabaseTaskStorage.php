<?php

namespace Todo\Storage;
use PDO;
use Todo\Models\Task;
use Todo\Storage\Contracts\TaskStorageInterface;

/**
 *
 */
class DatabaseTaskStorage implements TaskStorageInterface
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function store(Task $task)
    {
        $statement = $this->db->prepare("
        INSERT INTO tasks (description , due, complete)
        VALUES (:description , :due, :complete)
        ");

        $statement->execute($this->buildColumns($task));

        return $this->db->lastInsertId();
    }

    public function update(Task $task)
    {
        $statement = $this->db->prepare("

        UPDATE tasks
        SET    description = :description,
               due = :due,
               complete = :complete
        WHERE id = :id 
        
        ]");

        $statement->execute($this->buildColumns($task, [
            'id' => $task->getId(),
        ]));
 
        return $this->get($task->getId());
    }

    public function get($id)
    {
        $statement = $this->db->prepare("
        SELECT id, description , due, complete
        FROM tasks
        WHERE id = :id
        ");

        $statement->setFetchMode(PDO::FETCH_CLASS, Task::Class);

        $statement->execute([
            'id' => $id,
        ]);

        return $statement->fetchAll();
    }

    public function all()
    {
        $statement = $this->db->prepare("
        SELECT id, description , due, complete
        FROM tasks
        ");

        $statement->setFetchMode(PDO::FETCH_CLASS, Task::Class);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function buildColumns(Task $task, array $additional = [])
    {
        return array_merge([
            'description' => $task->getDescription(),
            'due'  => $task->getDue()->format('Y-m-d'),
            'complete' => $task->getComplete() ? 1 : 0 ,
        ], $additional);
    }


}
