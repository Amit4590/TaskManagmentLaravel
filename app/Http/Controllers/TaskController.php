<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Upload;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Task::query()->ownedBy(auth()->id())->search(request('search'))->filterStatus(request('status'))->latest()->paginate(10)->withQueryString();

        $uploads = Upload::query()->where('user_id', auth()->id())->latest()->get();

        return view('tasks.index', compact('tasks', 'uploads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse {
        $this->taskService->create(
            $request->validated()
        );
        return redirect()->route('tasks.index')->with('success','Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View {
        $this->authorize('manage', $task);  
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse {
        $this->authorize('manage', $task);
        $this->taskService->update($task, $request->validated());
        return redirect()->route('tasks.index')->with('success','Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse {
        $this->authorize('manage', $task);
        $this->taskService->delete($task);
        return back()->with('success', 'Task deleted successfully.');
    }
}
