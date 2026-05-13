@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">
            Edit Task
        </h4>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('tasks.update', $task->id) }}">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Title
                </label>

                <input type="text"
                       name="title"
                       value="{{ old('title', $task->title) }}"
                       class="form-control">

                @error('title')

                    <small class="text-danger">
                        {{ $message }}
                    </small>

                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="form-control">{{ old('description', $task->description) }}</textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Status
                </label>

                <select name="status"
                        class="form-select">

                    <option value="Pending"
                        {{ $task->status->value == 'Pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                    <option value="Completed"
                        {{ $task->status->value == 'Completed' ? 'selected' : '' }}>

                        Completed

                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Due Date
                </label>

                <input type="date"
                       name="due_date"
                       value="{{ $task->due_date?->format('Y-m-d') }}"
                       class="form-control">

            </div>

            <div class="d-flex gap-2">

                <button class="btn btn-primary">
                    Update Task
                </button>

                <a href="{{ route('tasks.index') }}"
                   class="btn btn-secondary">

                    Back

                </a>

            </div>

        </form>

    </div>

</div>

@endsection