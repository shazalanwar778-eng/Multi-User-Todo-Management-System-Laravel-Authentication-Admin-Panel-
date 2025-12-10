<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $todo->title }} - TaskFlow</title>
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
        }

        .todo-detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }

        .todo-header {
            background-color: #28a745;
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .todo-header-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .todo-content {
            padding: 2.5rem;
        }

        .description-section {
            background: #f8fafc;
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .image-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
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
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .file-icon {
            font-size: 3rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .file-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .file-link:hover {
            text-decoration: underline;
        }

        .info-section {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            padding: 1.5rem;
        }

        .btn-custom {
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
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
                        <a class="nav-link" href="{{ route('todos.index') }}">My Todos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('todos.show', $todo) }}">{{ $todo->title }}</a>
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
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <h1 class="mb-2">Todo Details</h1>
                    <p class="text-muted mb-0">View complete task information</p>
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
                        <div class="todo-header-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h2 class="mb-2">{{ $todo->title }}</h2>
                        <p class="mb-0 opacity-75">
                            <i class="bi bi-calendar me-1"></i>Created {{ $todo->created_at->format('M j, Y \a\t g:i A') }}
                        </p>
                    </div>

                    <!-- Todo Content -->
                    <div class="todo-content">
                        <!-- Description Section -->
                        <div class="description-section">
                            <h4 class="mb-3">
                                <i class="bi bi-textarea-resize me-2 text-primary"></i>Description
                            </h4>
                            <p class="mb-0 fs-5 lh-base">{{ $todo->description }}</p>
                        </div>

                        <!-- Image Section -->
                        @if($todo->image)
                            <div class="image-section">
                                <h4 class="mb-3">
                                    <i class="bi bi-image me-2 text-primary"></i>Attached Image
                                </h4>
                                <div class="text-center">
                                    <img src="{{ $todo->getImageUrl() }}" class="image-preview" alt="Todo Image">
                                </div>
                            </div>
                        @endif

                        <!-- Attachment Section -->
                        @if($todo->attachment)
                            <div class="file-card">
                                <div class="file-icon">
                                    <i class="bi bi-file-earmark"></i>
                                </div>
                                <h5>File Attachment</h5>
                                <p class="text-muted mb-3">{{ $todo->getAttachmentFilename() }}</p>
                                <a href="{{ $todo->getAttachmentUrl() }}" target="_blank" class="file-link">
                                    <i class="bi bi-download me-2"></i>Download/View File
                                </a>
                            </div>
                        @endif

                        <!-- Information Section -->
                        <div class="info-section">
                            <h5 class="mb-2">
                                <i class="bi bi-info-circle me-2"></i>Task Information
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Task ID:</strong> #{{ $todo->id }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Created:</strong> {{ $todo->created_at->format('M j, Y \a\t g:i:s A') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Last Updated:</strong> {{ $todo->updated_at->format('M j, Y \a\t g:i:s A') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    <span class="badge bg-success">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="bg-light p-4">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary btn-custom w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Todos
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('todos.edit', $todo) }}" class="btn btn-warning btn-custom w-100">
                                    <i class="bi bi-pencil me-2"></i>Edit Todo
                                </a>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" action="{{ route('todos.destroy', $todo) }}" class="d-inline w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-custom w-100"
                                            onclick="return confirm('Are you sure you want to delete this todo?')">
                                        <i class="bi bi-trash me-2"></i>Delete Todo
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
