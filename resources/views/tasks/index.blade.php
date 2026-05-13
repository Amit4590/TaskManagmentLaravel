@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold"> My Tasks</h3>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary"> Create Task</a>
</div>

<form method="GET" class="card card-body mb-4 shadow-sm">
    <div class="row">
        <div class="col-md-4">
            <label class="form-label"> Search</label>
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by title">
        </div>

        <div class="col-md-3">
            <label class="form-label"> Status </label>
            <select name="status" class="form-select">
                <option value=""> All </option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}> Pending </option>
                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}> Completed</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-success w-100"> Filter </button>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary w-100"> Reset</a>
        </div>
    </div>
</form>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th width="180"> Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="fw-semibold"> {{ $task->title }} </div>
                        <small class="text-muted"> {{ Str::limit($task->description, 50) }}</small>
                    </td>
                    <td>
                        @if($task->status->value == 'Completed')
                            <span class="badge bg-success"> Completed</span>
                        @else
                            <span class="badge bg-warning text-dark"> Pending </span>
                        @endif
                    </td>
                    <td>
                        {{ $task->due_date?->format('d M Y') }}
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm"> Edit </a>
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete task?')"> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted">
                            No tasks found.
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $tasks->links() }}
</div>

<hr class="my-5">
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0"> Multiple File Upload </h5>
    </div>
    <div class="card-body">
        <form id="uploadForm">
            @csrf
            <div class="mb-3">
                <input type="file" name="files[]" multiple class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            </div>
            <button type="submit" class="btn btn-primary">
                Upload Files
            </button>
        </form>
        <div id="uploadMessage" class="mt-3"></div>
        <div id="previewContainer" class="row mt-4"></div>
    </div>
</div>

<hr class="my-5">
<h4 class="mb-4"> Uploaded Files</h4>
<div class="row">
    @forelse($uploads as $upload)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                @php
                    $extension = pathinfo($upload->file, PATHINFO_EXTENSION);
                @endphp
                @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <img src="{{ $upload->file_url }}" class="card-img-top" style="height:220px;object-fit:cover;">
                @elseif($extension == 'pdf')
                    <div class="p-5 text-center">
                        <p class="mb-0"> PDF File </p>
                    </div>
                @endif
                <div class="card-body">
                    <small class="text-muted d-block mb-2">
                        {{ basename($upload->file) }}
                    </small>
                    <a href="{{ $upload->file_url }}" target="_blank" class="btn btn-primary btn-sm w-100">
                        View File
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-light border">
                No uploaded files found.
            </div>
        </div>
    @endforelse

</div>

<script>

const uploadForm = document.getElementById('uploadForm');
uploadForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const response = await fetch("{{ route('upload.files') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        }
    });

    const data    = await response.json();
    const message = document.getElementById('uploadMessage');
    if (data.success) {
        message.innerHTML = `
            <div class="alert alert-success">
                Files uploaded successfully.
            </div>
        `;
        uploadForm.reset();
    }
});

document.querySelector('input[name="files[]"]').addEventListener('change', function(e) {
    const previewContainer      = document.getElementById('previewContainer');
    previewContainer.innerHTML  = '';
    Array.from(e.target.files).forEach(file => {
        const col = document.createElement('div');
        col.classList.add('col-md-3', 'mb-3');
        if (file.type.includes('image')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                col.innerHTML = `
                    <div class="card">
                        
                            <img src="${event.target.result}" class="card-img-top" style="height:200px;object-fit:cover;">
                        
                    </div>
                `;

                previewContainer.appendChild(col);
            };

            reader.readAsDataURL(file);

        } else {
            col.innerHTML = `
                
                    <div class="card p-4 text-center">
                        <strong>PDF File</strong>
                        <small>${file.name}</small>
                    </div>
                
            `;

            previewContainer.appendChild(col);
        }
    });
});

</script>

@endsection