<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function create(array $data): Task
    {
        $data['user_id'] = auth()->id();

        return Task::create($data);
    }

    public function update(
        Task $task,
        array $data
    ): bool {

        return $task->update($data);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}