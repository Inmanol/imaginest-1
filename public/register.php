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
        (4 <= sizeof($_POST) && sizeof($_POST) <=6 &&
        isset($_POST['username']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['confirmPassword'])))
    {
        require_once('../php/app/register.php');
    }
    else
    {
        // El formulario ha sido modificado por el usuario.
        $errors['noValidation'][] = VALIDATION['noValidation']['error']['msg'];
    }
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
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
                        <div class="col-lg-7">
                            <!-- Basic registration form-->
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Regístrate</h3></div>
                                <div class="card-body">
                                    <!-- Registration form-->
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                        <!-- Form Group (username)-->
                                        <div class="form-group">
                                            <label class="small mb-1" for="username">Nombre de usuario</label>
                                            <input type="text" id="username" class="form-control" name="username" <?php echo "minlength='" . VALIDATION['username']['length']['min'] . "' maxlength='" . VALIDATION['username']['length']['max'] . "'"; ?> placeholder="Nombre de usuario" value="<?php if (!empty($data) && array_key_exists('username', $data)) echo $data['username']; ?>" autocomplete="username" required autofocus>
                                            <?php if (!empty($errors) && array_key_exists('username', $errors)) echo "<p class='errors'>" . reset($errors['username']) . "</p>"; ?>
                                        </div>
                                        <!-- Form Row-->
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <!-- Form Group (first name)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="firstname">Nombre</label>
                                                    <input type="text" id="firstname" class="form-control" name="firstname" <?php echo "minlength='" . VALIDATION['firstname']['length']['min'] . "' maxlength='" . VALIDATION['firstname']['length']['max'] . "'"; ?> placeholder="Nombre" value="<?php if (!empty($data) && array_key_exists('firstname', $data)) echo $data['firstname']; ?>" autocomplete="name" >
                                                    <?php if (!empty($errors) && array_key_exists('firstname', $errors)) echo "<p class='errors'>" . reset($errors['firstname']) . "</p>"; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (last name)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="lastname">Apellidos</label>
                                                    <input type="text" id="lastname" class="form-control" name="lastname" <?php echo "minlength='" . VALIDATION['lastname']['length']['min'] . "' maxlength='" . VALIDATION['lastname']['length']['max'] . "'"; ?> placeholder="Apellidos" value="<?php if (!empty($data) && array_key_exists('lastname', $data)) echo $data['lastname']; ?>" autocomplete="family-name" >
                                                    <?php if (!empty($errors) && array_key_exists('lastname', $errors)) echo "<p class='errors'>" . reset($errors['lastname']) . "</p>"; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (email address) -->
                                        <div class="form-group">
                                            <label class="small mb-1" for="email">Correo electrónico</label>
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Correo electrónico" value="<?php if (!empty($data) && array_key_exists('email', $data)) echo $data['email']; ?>" autocomplete="email" required>
                                            <?php if (!empty($errors) && array_key_exists('email', $errors)) echo "<p class='errors'>" . reset($errors['email']) . "</p>"; ?>
                                        </div>
                                        <!-- Form Row    -->
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <!-- Form Group (password)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="password">Contraseña</label>
                                                    <input type="password" id="password" class="form-control" name="password" <?php echo "minlength='" . VALIDATION['password']['length']['min'] . "' maxlength='" . VALIDATION['password']['length']['max'] . "'"; ?> placeholder="Contraseña" autocomplete="new-password" required>
                                                    <?php if (!empty($errors) && array_key_exists('password', $errors)) echo "<p class='errors'>" . reset($errors['password']) . "</p>"; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Form Group (confirm password)-->
                                                <div class="form-group">
                                                    <label class="small mb-1" for="confirmPassword">Confirmar contraseña</label>
                                                    <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" placeholder="Confirmar contraseña" autocomplete="new-password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form Group (create account submit)-->
                                        <div class="form-group mt-4 mb-0">
                                            <button type="submit" class="mt-3 btn btn-primary w-100">Registrarse</button>
                                        </div>
                                        <?php
                                            if (!empty($errors))
                                            {
                                                if (array_key_exists('noValidation', $errors))
                                                {
                                                    echo "<p class='errors'>" . reset($errors['noValidation']) . "</p>";
                                                }
                                                else if (array_key_exists('noRegister', $errors))
                                                {
                                                    echo "<p class='errors'>" . reest($errors['noRegister']) . "</p>";
                                                }
                                            }
                                        ?>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="index.php">¿Tienes una cuenta? Inicia sesión</a></div>
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
    <!-- Return to Top -->
    <div id="return-to-top">
        <svg class="fas fa-chevron-circle-up"></svg>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/general.js"></script>
</body>
</html>
