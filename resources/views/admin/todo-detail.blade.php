@if(!Auth::check() || !Auth::user()->isAdmin())
    <script>window.location.href = "{{ url('/') }}";</script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $todo->title }} - TaskFlow Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            background: linear-gradient(135deg, #1e40af 0%, #3730a3 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            background: white;
            padding: 2rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .admin-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .todo-detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }

        .todo-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
        }

        .todo-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .todo-meta {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .todo-content {
            padding: 2.5rem;
        }

        .info-table {
            background: #f8fafc;
            border-radius: 8px;
            overflow: hidden;
        }

        .info-table th {
            background: #e2e8f0;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border: none;
        }

        .info-table td {
            padding: 0.75rem 1rem;
            border: none;
        }

        .image-preview {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .file-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
        }

        .file-icon {
            font-size: 2.5rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .file-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .file-link:hover {
            text-decoration: underline;
        }

        .btn-admin {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-shield-check me-2"></i>TaskFlow Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user.todos', $todo->user) }}">{{ $todo->user->name }}'s Todos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.todo.show', $todo) }}">{{ $todo->title }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            Welcome, {{ Auth::user()->name }}
                            <span class="admin-badge ms-2">Admin</span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <h1 class="mb-2">Todo Details</h1>
                    <p class="text-muted mb-0">Viewing {{ $todo->user->name }}'s task</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="todo-detail-card">
                    <!-- Todo Header -->
                    <div class="todo-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h1 class="todo-title">{{ $todo->title }}</h1>
                                <div class="todo-meta">
                                    <i class="bi bi-person me-1"></i>{{ $todo->user->name }} ({{ $todo->user->email }})
                                    <span class="mx-3">•</span>
                                    <i class="bi bi-calendar me-1"></i>{{ $todo->created_at->format('M j, Y \a\t g:i A') }}
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-light text-dark fs-6 px-3 py-2">
                                    <i class="bi bi-hash me-1"></i>{{ $todo->id }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Todo Content -->
                    <div class="todo-content">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <h4 class="mb-3">
                                        <i class="bi bi-textarea-resize me-2 text-primary"></i>Description
                                    </h4>
                                    <div class="bg-light p-4 rounded">
                                        <p class="mb-0 fs-5">{{ $todo->description }}</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h4 class="mb-3">
                                        <i class="bi bi-info-circle me-2 text-primary"></i>Task Information
                                    </h4>
                                    <table class="table info-table">
                                        <tr>
                                            <th width="30%">Task ID</th>
                                            <td>{{ $todo->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created By</th>
                                            <td>{{ $todo->user->name }} <small class="text-muted">({{ $todo->user->email }})</small></td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $todo->created_at->format('M j, Y \a\t g:i:s A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $todo->updated_at->format('M j, Y \a\t g:i:s A') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <h4 class="mb-3">
                                        <i class="bi bi-paperclip me-2 text-primary"></i>Attachments
                                    </h4>

                                    @if($todo->image)
                                        <div class="file-card mb-3">
                                            <div class="file-icon">
                                                <i class="bi bi-image"></i>
                                            </div>
                                            <h6>Image Attachment</h6>
                                            <div class="mb-3">
                                                <img src="{{ $todo->getImageUrl() }}" class="image-preview" alt="Todo Image">
                                            </div>
                                        </div>
                                    @endif

                                    @if($todo->attachment)
                                        <div class="file-card mb-3">
                                            <div class="file-icon">
                                                <i class="bi bi-file-earmark"></i>
                                            </div>
                                            <h6>File Attachment</h6>
                                            <p class="text-muted small mb-3">{{ $todo->getAttachmentFilename() }}</p>
                                            <a href="{{ $todo->getAttachmentUrl() }}" target="_blank" class="file-link">
                                                <i class="bi bi-download me-2"></i>Download/View File
                                            </a>
                                        </div>
                                    @endif

                                    @if(!$todo->image && !$todo->attachment)
                                        <div class="file-card">
                                            <div class="file-icon">
                                                <i class="bi bi-file-earmark-x"></i>
                                            </div>
                                            <h6>No Attachments</h6>
                                            <p class="text-muted small mb-0">This todo has no attached files</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="bg-light p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('admin.user.todos', $todo->user) }}" class="btn btn-outline-primary btn-admin w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Back to {{ $todo->user->name }}'s Todos
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-admin w-100">
                                    <i class="bi bi-house me-2"></i>Admin Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
