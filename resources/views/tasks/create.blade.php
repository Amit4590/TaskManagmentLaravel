@extends('layouts.app')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="mb-0">Create Task</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label"> Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                @error('title')
                    <small class="text-danger"> {{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label"> Description </label>
                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Pending"> Pending</option>
                    <option value="Completed"> Completed </option>
                </select>

                @error('status')
                    <small class="text-danger"> {{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label class="form-label"> Due Date </label>
                <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control">

                @error('due_date')
                    <small class="text-danger"> {{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary"> Save Task </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection