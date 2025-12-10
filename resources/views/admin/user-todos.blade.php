@if(!Auth::check() || !Auth::user()->isAdmin())
    <script>window.location.href = "{{ url('/') }}";</script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Todos - TaskFlow Admin</title>
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
            margin-bottom: 2rem;
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

        .user-profile-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            text-align: center;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #64748b;
            font-weight: 500;
        }

        .todos-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            color: #374151;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .file-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.5rem;
            background: #f1f5f9;
            border-radius: 6px;
            font-size: 0.75rem;
            color: #475569;
        }

        .btn-admin {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        .btn-view {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            color: white;
        }

        .btn-view:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
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
                        <a class="nav-link active" href="{{ route('admin.user.todos', $user) }}">{{ $user->name }}'s Todos</a>
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
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="bi bi-house me-1"></i>Main Site
                        </a>
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
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">{{ $user->name }}'s Todo Management</h1>
                    <p class="text-muted mb-0">Monitor and manage {{ $user->name }}'s tasks</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- User Profile Card -->
        <div class="user-profile-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h3 class="mb-1">{{ $user->name }}</h3>
                    <p class="mb-2 opacity-75">{{ $user->email }}</p>
                    <div class="d-flex gap-3">
                        <div class="text-center">
                            <div class="fw-bold fs-4">{{ $userTodos->total() }}</div>
                            <small>Total Todos</small>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold fs-4">{{ $userTodos->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                            <small>This Week</small>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold fs-4">{{ $userTodos->where('created_at', '>=', now()->startOfDay())->count() }}</div>
                            <small>Today</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="opacity-75">
                        <small>Member since</small>
                        <div class="fw-semibold">{{ $user->created_at->format('M j, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Todos Table -->
        <div class="row">
            <div class="col-12">
                <div class="todos-table">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <h3 class="mb-0">{{ $user->name }}'s Todos</h3>
                        <small class="text-muted">{{ $userTodos->total() }} total todos</small>
                    </div>
                    <div class="table-responsive">
                        @if($userTodos->count() > 0)
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Attachments</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userTodos as $todo)
                                        <tr>
                                            <td>
                                                <span class="fw-semibold text-primary">#{{ $todo->id }}</span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $todo->title }}</div>
                                            </td>
                                            <td>
                                                <div class="text-truncate" style="max-width: 250px;" title="{{ $todo->description }}">
                                                    {{ Str::limit($todo->description, 100) }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($todo->image || $todo->attachment)
                                                    <div class="d-flex gap-1">
                                                        @if($todo->image)
                                                            <span class="file-indicator">
                                                                <i class="bi bi-image"></i>
                                                                Image
                                                            </span>
                                                        @endif
                                                        @if($todo->attachment)
                                                            <span class="file-indicator">
                                                                <i class="bi bi-paperclip"></i>
                                                                File
                                                            </span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>{{ $todo->created_at->format('M j, Y') }}</div>
                                                <small class="text-muted">{{ $todo->created_at->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.todo.show', $todo) }}" class="btn btn-view btn-admin">
                                                    <i class="bi bi-eye me-1"></i>View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            @if($userTodos->hasPages())
                                <div class="d-flex justify-content-center p-3 border-top bg-light">
                                    {{ $userTodos->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-check2-square text-muted" style="font-size: 3rem;"></i>
                                <h5 class="text-muted mt-3">No todos found</h5>
                                <p class="text-muted">{{ $user->name }} hasn't created any todos yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-admin">
                        <i class="bi bi-arrow-left me-2"></i>Back to Admin Dashboard
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-admin">
                        <i class="bi bi-house me-2"></i>Main Site
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
