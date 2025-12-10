@if(!Auth::check() || !Auth::user()->isAdmin())
    <script>window.location.href = "{{ url('/') }}";</script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TaskFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            background-color: #6c757d;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            background: white;
            padding: 2rem 0;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 2rem;
        }

        .admin-badge {
            background-color: #dc3545;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            color: #6c757d;
            font-weight: 500;
        }

        .user-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #007bff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .user-stats {
            background: #f1f5f9;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            color: #475569;
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
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-shield-check me-2"></i>TaskFlow Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
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
                    <h1 class="mb-2">Admin Dashboard</h1>
                    <p class="text-muted mb-0">Monitor users, todos, and system activity</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('todos.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-list-check me-1"></i>My Todos
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-house me-1"></i>Main Site
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <div class="stats-number">{{ $totalUsers }}</div>
                    <div class="stats-label">Total Users</div>
                    <div class="mt-2">
                        <i class="bi bi-people text-primary" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <div class="stats-number">{{ $totalTodos }}</div>
                    <div class="stats-label">Total Todos</div>
                    <div class="mt-2">
                        <i class="bi bi-check2-square text-success" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <div class="stats-number text-success">Active</div>
                    <div class="stats-label">System Status</div>
                    <div class="mt-2">
                        <i class="bi bi-activity text-info" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">User Management</h3>
                    <small class="text-muted">Click on a user to view their todos</small>
                </div>
                <div class="row">
                    @forelse($users as $user)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <div class="user-card">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="user-avatar me-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user-stats">
                                        <i class="bi bi-check2-square me-1"></i>
                                        {{ $user->todos->count() }} todos
                                    </div>
                                    <a href="{{ route('admin.user.todos', $user) }}" class="btn btn-view btn-sm">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                                <h5 class="text-muted mt-3">No users found</h5>
                                <p class="text-muted">Users will appear here once they register</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Todos Table -->
        <div class="row">
            <div class="col-12">
                <div class="todos-table">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <h3 class="mb-0">Recent Todos</h3>
                        <small class="text-muted">Latest 20 todos from all users</small>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Attachments</th>
                                    <th>User</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allTodos as $todo)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold text-primary">#{{ $todo->id }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $todo->title }}</div>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;" title="{{ $todo->description }}">
                                                {{ Str::limit($todo->description, 50) }}
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
                                            <div class="fw-semibold">{{ $todo->user->name }}</div>
                                            <small class="text-muted">{{ $todo->user->email }}</small>
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
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center py-5">
                                                <i class="bi bi-check2-square text-muted" style="font-size: 3rem;"></i>
                                                <h5 class="text-muted mt-3">No todos found</h5>
                                                <p class="text-muted">Todos will appear here once users create them</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($allTodos->hasPages())
                        <div class="d-flex justify-content-center p-3 border-top bg-light">
                            {{ $allTodos->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ url('/') }}" class="btn btn-outline-primary btn-admin">
                        <i class="bi bi-house me-2"></i>Back to Main Site
                    </a>
                    <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary btn-admin">
                        <i class="bi bi-list-check me-2"></i>View My Todos
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
