<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
        }
        .card {
            border: none;
            border-radius: 1rem;
        }
        .btn-success {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock-fill fs-1 text-success"></i>
                <h3 class="mt-2">Đặt lại mật khẩu</h3>
                <p class="text-muted">Vui lòng nhập mật khẩu mới của bạn</p>
            </div>
            <form method="POST" action="{{ url('/submit-new-password') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="mb-3">
                    <label for="pass" class="form-label">Mật khẩu mới</label>
                    <input type="password" name="pass" id="pass" class="form-control" required placeholder="Nhập mật khẩu mới">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Đổi mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
