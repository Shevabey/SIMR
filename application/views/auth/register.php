<!DOCTYPE html>
<html>

<head>

    <title>Register SIMRS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container py-4">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                <div class="card p-4 shadow">

                    <h3 class="text-center mb-4">
                        Register
                    </h3>

                    <form method="post" action="<?= site_url('auth/register') ?>">

                        <div class="mb-3">
                            <input type="text" name="nama" class="form-control" placeholder="Nama">
                        </div>

                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <button class="btn btn-success w-100">
                            Register
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
