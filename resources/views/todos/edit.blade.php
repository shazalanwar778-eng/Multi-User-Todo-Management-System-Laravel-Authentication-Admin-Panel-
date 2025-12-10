<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Todo - TaskFlow</title>
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
            padding: 3rem 0;
            border-bottom: 1px solid #dee2e6;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }

        .form-header {
            background-color: #ffc107;
            color: #333;
            padding: 2rem;
            text-align: center;
        }

        .form-header-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .form-body {
            padding: 2.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25);
        }

        .file-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: #ffc107;
            background: #fff3cd;
        }

        .file-upload-icon {
            font-size: 2.5rem;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        .current-file {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .current-file img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 6px;
            object-fit: cover;
        }

        .btn-custom {
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
            color: #111827;
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
                        <a class="nav-link active" href="{{ route('todos.edit', $todo) }}">Edit Todo</a>
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
                <div class="col-md-8 text-center">
                    <h1 class="mb-3">Edit Todo</h1>
                    <p class="text-muted">Update your task information</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="form-card">
                    <!-- Form Header -->
                    <div class="form-header">
                        <div class="form-header-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h3 class="mb-0">Update Task</h3>
                        <p class="mb-0 opacity-75">Modify task details and attachments</p>
                    </div>

                    <!-- Form Body -->
                    <div class="form-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('todos.update', $todo) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">
                                            <i class="bi bi-tag me-2"></i>Task Title *
                                        </label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title" value="{{ old('title', $todo->title) }}"
                                               placeholder="Enter a clear, descriptive title for your task"
                                               required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-textarea-resize me-2"></i>Description *
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="4"
                                                  placeholder="Provide detailed information about this task..."
                                                  required>{{ old('description', $todo->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="image" class="form-label">
                                            <i class="bi bi-image me-2"></i>Image (Optional)
                                        </label>

                                        @if($todo->image)
                                            <div class="current-file mb-3">
                                                <img src="{{ $todo->getImageUrl() }}" alt="Current Image">
                                                <div class="flex-grow-1">
                                                    <strong>Current Image</strong>
                                                    <br>
                                                    <small class="text-muted">Will be replaced if you upload a new one</small>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="file-upload-area" onclick="document.getElementById('image').click()">
                                            <div class="file-upload-icon">
                                                <i class="bi bi-cloud-upload"></i>
                                            </div>
                                            <p class="mb-1 fw-bold">Click to upload new image</p>
                                            <p class="text-muted small">JPEG, PNG, JPG, GIF up to 2MB</p>
                                            <input type="file" class="d-none @error('image') is-invalid @enderror"
                                                   id="image" name="image" accept="image/*">
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="attachment" class="form-label">
                                            <i class="bi bi-paperclip me-2"></i>Attachment (Optional)
                                        </label>

                                        @if($todo->attachment)
                                            <div class="current-file mb-3">
                                                <div class="bg-primary text-white rounded p-2">
                                                    <i class="bi bi-file-earmark me-2"></i>
                                                    <strong>{{ $todo->getAttachmentFilename() }}</strong>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <strong>Current File</strong>
                                                    <br>
                                                    <small class="text-muted">Will be replaced if you upload a new one</small>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="file-upload-area" onclick="document.getElementById('attachment').click()">
                                            <div class="file-upload-icon">
                                                <i class="bi bi-file-earmark"></i>
                                            </div>
                                            <p class="mb-1 fw-bold">Click to upload new file</p>
                                            <p class="text-muted small">PDF, DOC, ZIP, Images up to 5MB</p>
                                            <input type="file" class="d-none @error('attachment') is-invalid @enderror"
                                                   id="attachment" name="attachment"
                                                   accept=".pdf,.doc,.docx,.txt,.zip,.rar,.jpg,.jpeg,.png,.gif">
                                        </div>
                                        @error('attachment')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('todos.show', $todo) }}" class="btn btn-cancel btn-custom">
                                            <i class="bi bi-arrow-left me-2"></i>Cancel
                                        </a>
                                        <button type="submit" class="btn btn-warning btn-custom">
                                            <i class="bi bi-check-circle me-2"></i>Update Todo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // File upload area click handling
        document.querySelectorAll('.file-upload-area').forEach(area => {
            area.addEventListener('click', function() {
                const input = this.querySelector('input[type="file"]');
                if (input) {
                    input.click();
                }
            });

            // Prevent click on file input from triggering twice
            area.querySelector('input[type="file"]').addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // Update file upload area when file is selected
        document.getElementById('image').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const area = this.closest('.file-upload-area');
                area.innerHTML = `
                    <div class="file-upload-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <p class="mb-1 fw-bold text-success">${file.name}</p>
                    <p class="text-muted small">File selected successfully</p>
                `;
            }
        });

        document.getElementById('attachment').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const area = this.closest('.file-upload-area');
                area.innerHTML = `
                    <div class="file-upload-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <p class="mb-1 fw-bold text-success">${file.name}</p>
                    <p class="text-muted small">File selected successfully</p>
                `;
            }
        });
    </script>
</body>
</html>
