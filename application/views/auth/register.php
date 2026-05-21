<!DOCTYPE html>
<html>

<head>

    <title>Register SIMRS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center mt-5">

            <div class="col-md-4">

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
