<?php

namespace app\controllers;

use core\Controller;
use core\exception\NotFoundException;
use app\models\Task;

class TodoController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::findAll();

        $this->render("index", [
            'tasks' => $tasks
        ]);
    }

    public function actionSwitch($id)
    {
        $task = Task::findByID($id);
        if ($task === null) {
            throw new NotFoundException;
        }

        $task->is_done = $task->is_done ? 0 : 1;
        $task->update();

        $this->redirect('index');
    }

    public function actionUpdate()
    {
        echo "hello from update";
    }
}
