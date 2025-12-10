<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todos - TaskFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            background-color: #007bff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            background: white;
            padding: 2rem 0;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 2rem;
        }

        .todo-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .todo-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .todo-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        .todo-description {
            color: #64748b;
            margin-bottom: 1rem;
        }

        .todo-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .file-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            background: #f1f5f9;
            border-radius: 6px;
            font-size: 0.875rem;
            color: #475569;
        }

        .btn-custom {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            border: 2px dashed #cbd5e1;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .stats-card {
            background: white;
            color: #333;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-check2-square me-2"></i>TaskFlow
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('todos.index') }}">My Todos</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="navbar-text me-3">Welcome, {{ Auth::user()->name }}</span>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-shield me-1"></i>Admin
                            </a>
                        </li>
                    @endif
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
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">My Todo List</h1>
                    <p class="text-muted mb-0">Manage and organize your tasks efficiently</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('todos.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Create Todo
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $todos->count() }}</div>
                    <div>Total Todos</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $todos->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                    <div>This Week</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $todos->where('created_at', '>=', now()->startOfDay())->count() }}</div>
                    <div>Today</div>
                </div>
            </div>
        </div>

        <!-- Todos List -->
        @forelse($todos as $todo)
            <div class="todo-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="todo-title">{{ $todo->title }}</h5>
                        <p class="todo-description">{{ Str::limit($todo->description, 150) }}</p>

                        <div class="todo-meta">
                            @if($todo->image || $todo->attachment)
                                <div class="file-indicator">
                                    @if($todo->image)
                                        <i class="bi bi-image"></i>
                                        <span>Image</span>
                                    @endif
                                    @if($todo->attachment)
                                        @if($todo->image)<span class="mx-2">•</span>@endif
                                        <i class="bi bi-paperclip"></i>
                                        <span>Attachment</span>
                                    @endif
                                </div>
                            @endif
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $todo->created_at->format('M j, Y \a\t g:i A') }}
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('todos.show', $todo) }}" class="btn btn-outline-primary btn-custom">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-outline-warning btn-custom">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('todos.destroy', $todo) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-custom"
                                        onclick="return confirm('Are you sure you want to delete this todo?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-check2-square"></i>
                </div>
                <h4>No todos yet</h4>
                <p class="text-muted mb-4">Get started by creating your first todo task</p>
                <a href="{{ route('todos.create') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Create Your First Todo
                </a>
            </div>
        @endforelse

        <!-- Back to Home -->
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                <i class="bi bi-house me-2"></i>Back to Home
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
