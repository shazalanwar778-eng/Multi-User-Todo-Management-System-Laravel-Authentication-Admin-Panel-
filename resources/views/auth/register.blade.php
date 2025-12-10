<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaskFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }

        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .register-header-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .register-body {
            padding: 2.5rem;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-register {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .password-strength {
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .password-strength.weak { color: #ef4444; }
        .password-strength.medium { color: #f59e0b; }
        .password-strength.strong { color: #10b981; }

        .divider {
            text-align: center;
            position: relative;
            margin: 2rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider-text {
            background: white;
            padding: 0 1rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .form-check-input:checked {
            background-color: #10b981;
            border-color: #10b981;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <!-- Header -->
        <div class="register-header">
            <div class="register-header-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h2 class="mb-2">Join TaskFlow</h2>
            <p class="mb-0 opacity-75">Create your account and start managing tasks</p>
        </div>

        <!-- Body -->
        <div class="register-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Please check the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        <i class="bi bi-person me-2"></i>Full Name
                    </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}"
                           placeholder="Enter your full name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope me-2"></i>Email Address
                    </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}"
                           placeholder="Enter your email address" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">
                        <i class="bi bi-lock me-2"></i>Password
                    </label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" placeholder="Create a strong password" required>
                    <div id="passwordStrength" class="password-strength"></div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        <i class="bi bi-lock-fill me-2"></i>Confirm Password
                    </label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                           id="password_confirmation" name="password_confirmation"
                           placeholder="Confirm your password" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                        </label>
                    </div>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-success btn-register">
                        <i class="bi bi-person-plus me-2"></i>Create Account
                    </button>
                </div>

                <div class="divider">
                    <span class="divider-text">Already have an account?</span>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In Instead
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('passwordStrength');

            if (password.length === 0) {
                strengthIndicator.textContent = '';
                return;
            }

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            let strengthText = '';
            let strengthClass = '';

            if (strength <= 2) {
                strengthText = 'Weak password';
                strengthClass = 'weak';
            } else if (strength <= 4) {
                strengthText = 'Medium strength';
                strengthClass = 'medium';
            } else {
                strengthText = 'Strong password';
                strengthClass = 'strong';
            }

            strengthIndicator.textContent = strengthText;
            strengthIndicator.className = `password-strength ${strengthClass}`;
        });

        // Password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (confirmPassword && password !== confirmPassword) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
