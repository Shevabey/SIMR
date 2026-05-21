<!DOCTYPE html>
<html>

<head>

    <title>Login SIMRS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center mt-5">

            <div class="col-md-4">

                <div class="card p-4 shadow">

                    <h3 class="text-center mb-4">
                        Login
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
                        Belum punya akun? Register
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
