<?php

namespace app\models;

use core\Database;

class Task
{
    public $id;
    public $is_done = false;
    public $text;

    public function update()
    {
        $db = Database::dbc();
        $sql = 'UPDATE task SET text = :text, is_done = :is_done WHERE id = :id';
        $st = $db->prepare($sql);

        return $st->execute([
            ':text' => $this->text,
            ':is_done' => $this->is_done,
            ':id' => $this->id,
        ]);
    }

    public static function findByID($id)
    {
        $db = Database::dbc();
        $sql = 'SELECT * FROM task WHERE id = :id';
        $st = $db->prepare($sql);
        $st->execute([
            ':id' => $id
        ]);

        $st->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        $task = $st->fetch();
        if ($task == false) {
            return null;
        }
        $task->id = intval($task->id);
        $task->is_done = intval($task->is_done);

        return $task;
    }

    public static function findAll()
    {
        $db = Database::dbc();
        $sql = 'SELECT * FROM task';
        $st = $db->prepare($sql);
        $st->execute();

        $st->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        return $st->fetchAll();
    }
}
