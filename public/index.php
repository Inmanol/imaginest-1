<?php

session_start();

if (isset($_SESSION['user']))
{
    header("location: ./home.php");
    exit();
}

require_once('../php/config/env.php');
require_once('../php/bbdd/connecta_db_persistent.php');
require_once('../php/app/helpers.php');

require_once('../php/config/validation.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errors = array();

    if (
        (sizeof($_POST) === 2 && isset($_POST['username']) && isset($_POST['password'])) ||
        (sizeof($_POST) === 3 && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['openSession'])))
    {
        require_once('../php/app/login.php');
    }
    else if (sizeof($_POST) === 1 && isset($_POST['forgotPasswordUsername']))
    {
        require_once('../php/app/forgotPassword.php');
    }
    else
    {
        // El formulario ha sido modificado por el usuario.
        $errors['noValidation'][] = VALIDATION['noValidation']['error']['msg'];
    }
}
else
{
    // toast
    if (sizeof($_GET) === 1 && isset($_GET['activationPending']))
    {
        require_once('../php/app/toast/activationPending.php');
    }
    else if (sizeof($_GET) === 2 && isset($_GET['activationCode']) && isset($_GET['email']))
    {
        require_once('../php/app/activation.php');
    }
    else if (sizeof($_GET) === 1 && isset($_GET['forgotPasswordPending']))
    {
        require_once('../php/app/toast/forgotPasswordPending.php');
    }
    else if (sizeof($_GET) === 1 && isset($_GET['forgotPasswordSuccess']))
    {
        require_once('../php/app/toast/forgotPasswordSuccess.php');
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo CONFIG['APP_NAME']; ?></title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/demo/favicon.ico" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    <link href="css/imaginest.css" rel="stylesheet" />
</head>
<body class="bodyAuthentication">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <h1><?php echo CONFIG['APP_NAME']; ?></h1>
            </a>
        </div>
    </nav>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-5">
                            <!-- Basic login form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Iniciar sesión</h3></div>
                                <div class="card-body">
                                    <?php echo $toast ?? NULL; ?>
                                    <!-- Login form-->
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                        <!-- Form Group (username / email address)-->
                                        <div class="form-group">
                                        <label class="small mb-1" for="username">Nombre de usuario o correo electrónico</label>
                                        <input type="text" id="username" class="form-control" name="username" <?php echo "minlength='" . VALIDATION['username']['length']['min'] . "' maxlength='" . VALIDATION['username']['length']['max'] . "'"; ?> placeholder="Nombre de usuario o correo electrónico" value="<?php if (!empty($data) && array_key_exists('login', $data)) echo $data['login']; else if (isset($_COOKIE['username'])) echo $_COOKIE['username']; else if (isset($_COOKIE['email'])) echo $_COOKIE['email'];?>" autocomplete="username" required autofocus>
                                        <?php if (!empty($errors) && array_key_exists('username', $errors)) echo "<p class='errors'>" . reset($errors['username']) . "</p>"; ?>
                                        </div>
                                        <!-- Form Group (password)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password" <?php echo "minlength='" . VALIDATION['password']['length']['min'] . "' maxlength='" . VALIDATION['password']['length']['max'] . "'"; ?> placeholder="Password" autocomplete="current-password" required>
                                            <?php if (!empty($errors) && array_key_exists('password', $errors)) echo "<p class='errors'>" . reset($errors['password']) . "</p>"; ?>
                                        </div>
                                        <!-- Form Group (remember password checkbox)-->
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="openSession" type="checkbox" name="openSession" <?php if (!empty($data) && array_key_exists('openSession', $data)) echo "checked=" . (boolean) $data['openSession']; else if (isset($_COOKIE['openSession'])) echo 'checked=' . (boolean) $_COOKIE['openSession'];?>>
                                                <label class="custom-control-label" for="openSession">Mantener la sesión iniciada</label>
                                            </div>
                                        </div>
                                        <!-- Form Group (login box)-->
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#forgotPassword">¿Olvidó su contraseña?</button>
                                        </div>
                                        <?php
                                            if (!empty($errors))
                                            {
                                                if (array_key_exists('noValidation', $errors))
                                                {
                                                    echo "<p class='errors'>" . reset($errors['noValidation']) . "</p>";
                                                }
                                            }
                                        ?>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.php">¿Necesitas una cuenta? ¡Regístrate!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer mt-auto footer-dark">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 small">Todos los derechos reservados &copy; <?php echo CONFIG['APP_NAME']; ?> &middot; <?php echo date("Y"); ?></div>
                        <div class="col-md-6 text-md-right small">
                            <a href="#!">Política de privacidad</a>
                            &middot;
                            <a href="#!">Términos y condiciones</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="forgotPasswordLabel">¿Olvidó su contraseña?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Forgot Password form-->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="forgotPasswordUsername" class="col-form-label">Nombre de usuario o correo electrónico</label>
                            <input type="text" class="form-control" id="forgotPasswordUsername" placeholder="Nombre de usuario o correo electrónico" name="forgotPasswordUsername" required>
                        </div>
                        <?php
                            if (!empty($errors))
                            {
                                if (array_key_exists('forgotPassword', $errors))
                                {
                                    echo "<p class='errors'>" . reset($errors['forgotPassword']) . "</p>";
                                }
                            }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Recuperar la contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Return to Top -->
    <div id="return-to-top">
        <svg class="fas fa-chevron-circle-up"></svg>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/general.js"></script>
    <script>
    $('#forgotPassword').on('shown.bs.modal', function () {
        $('#forgotPasswordUsername').trigger('focus')
    });
    <?php
        if (!empty($errors)) {

            if (array_key_exists('forgotPassword', $errors)) {
                echo "$('#forgotPassword').modal('show');";
            }
        }
    ?>
    </script>
</body>
</html>
