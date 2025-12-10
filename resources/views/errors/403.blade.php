<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - TaskFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border: none;
            max-width: 500px;
            width: 100%;
        }

        .error-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }

        .error-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .error-body {
            padding: 2.5rem;
            text-align: center;
        }

        .btn-error {
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <!-- Error Header -->
        <div class="error-header">
            <div class="error-icon">
                <i class="bi bi-shield-x"></i>
            </div>
            <h1 class="mb-2">Access Denied</h1>
            <p class="mb-0 opacity-75">You don't have permission to access this resource</p>
        </div>

        <!-- Error Body -->
        <div class="error-body">
            <div class="mb-4">
                <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mb-3">403 - Forbidden</h4>
            <p class="text-muted mb-4">
                Sorry, you don't have the required permissions to view this page.
                This area is restricted to administrators only.
            </p>

            <div class="d-grid gap-3">
                <a href="{{ url('/') }}" class="btn btn-primary btn-error">
                    <i class="bi bi-house me-2"></i>Go to Homepage
                </a>
                <a href="{{ route('todos.index') }}" class="btn btn-outline-primary btn-error">
                    <i class="bi bi-list-check me-2"></i>View My Todos
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-error w-100">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout & Try Different Account
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
