<!DOCTYPE html>
<html>

<head>

    <title>Login SIMRS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container py-4">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                <div class="card p-4 shadow">

                    <h3 class="text-center mb-4">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </h3>

                    <?php if ($this->session->flashdata('auth_error')): ?>
                        <div class="alert alert-danger py-2">
                            <?= $this->session->flashdata('auth_error') ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('auth/login') ?>">

                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                    <a href="<?= site_url('auth/register_view') ?>" class="btn btn-link w-100 mt-2">
                        <i class="bi bi-person-plus me-1"></i>Belum punya akun? Register
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
