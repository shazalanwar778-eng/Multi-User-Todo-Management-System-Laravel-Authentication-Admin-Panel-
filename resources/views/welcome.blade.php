<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Professional Todo Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .hero-section {
            padding: 100px 0;
            color: white;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #4ade80;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-custom {
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .stats-section {
            background: rgba(255, 255, 255, 0.05);
            padding: 60px 0;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #4ade80;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-check2-square me-2"></i>TaskFlow
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm ms-2" href="{{ route('register') }}">Get Started</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <span class="nav-link">Welcome, {{ Auth::user()->name }}</span>
                        </li>
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @guest
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="hero-title">Master Your Tasks with TaskFlow</h1>
                        <p class="hero-subtitle">
                            Organize your life with our professional todo management system.
                            Create, manage, and track your tasks with ease.
                        </p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-light btn-custom btn-lg">
                                <i class="bi bi-rocket-takeoff me-2"></i>Start Managing Tasks
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-custom btn-lg">
                                Sign In
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="https://via.placeholder.com/500x400/667eea/ffffff?text=Task+Management" alt="Task Management" class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="text-white mb-3">Powerful Features</h2>
                        <p class="text-white-50">Everything you need to manage your tasks efficiently</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-card text-center">
                            <div class="feature-icon">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                            <h5 class="text-white">Easy Task Creation</h5>
                            <p class="text-white-75">Create tasks quickly with our intuitive interface</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card text-center">
                            <div class="feature-icon">
                                <i class="bi bi-images"></i>
                            </div>
                            <h5 class="text-white">File Attachments</h5>
                            <p class="text-white-75">Attach images and documents to your tasks</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card text-center">
                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h5 class="text-white">Secure & Private</h5>
                            <p class="text-white-75">Your tasks are safe and accessible only to you</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="stat-number">1000+</div>
                        <p class="text-white-75">Tasks Completed</p>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-number">50+</div>
                        <p class="text-white-75">Active Users</p>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-number">24/7</div>
                        <p class="text-white-75">Always Available</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2 class="text-white mb-4">Ready to Get Organized?</h2>
                        <p class="text-white-75 mb-4">Join thousands of users who trust TaskFlow for their task management needs.</p>
                        <a href="{{ route('register') }}" class="btn btn-light btn-custom btn-lg">
                            <i class="bi bi-arrow-right me-2"></i>Create Your Account Now
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <!-- Dashboard Section for Logged-in Users -->
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h1 class="text-white mb-3">Welcome back, {{ Auth::user()->name }}!</h1>
                        <p class="text-white-75">Manage your tasks efficiently</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card bg-white shadow-lg">
                            <div class="card-body text-center p-5">
                                <div class="mb-4">
                                    <i class="bi bi-check2-square text-primary" style="font-size: 4rem;"></i>
                                </div>
                                <h4 class="mb-3">Your Todo Dashboard</h4>
                                <p class="text-muted mb-4">Access your personal task management system</p>
                                <div class="d-grid gap-3">
                                    <a href="{{ route('todos.index') }}" class="btn btn-primary btn-lg">
                                        <i class="bi bi-list-check me-2"></i>View My Todos
                                    </a>
                                    <a href="{{ route('todos.create') }}" class="btn btn-success btn-lg">
                                        <i class="bi bi-plus-circle me-2"></i>Create New Todo
                                    </a>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-lg">
                                            <i class="bi bi-shield me-2"></i>Admin Dashboard
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endguest

    <!-- Footer -->
    <footer class="text-center py-4 text-white-50">
        <div class="container">
            <p class="mb-0">&copy; 2025 TaskFlow. Professional Todo Management System.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
