<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="container" style="max-width: 400px; margin-top: 100px;">
    <div class="card p-4 shadow-sm">
        <h3 class="text-center mb-4"><i class="fas fa-lock"></i> Login Admin</h3>

        <!-- Flash message error -->
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Form login -->
        <form method="post" action="<?= site_url('auth/login'); ?>">
            <div class="mb-3">
                <label><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label><i class="fas fa-key"></i> Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>
    </div>
</div>
</body>
</html>
