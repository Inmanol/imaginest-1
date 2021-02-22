<?php

$body = <<< heredoc
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Recupere la contrase&ntilde;a de su cuenta</h1>
    <p>Recupere la contrase&ntilde;a de su cuenta clicando en el siguiente enlace: <a href="%s/forgotPassword.php?forgotPasswordCode=%s&email=%s" target="_blank">recuperaci&oacute;n</a></p>
    <p>El enlace caduca transcurridos 30 minutos de la petici&oacute;n de recuperaci&oacute;n.</p>
    <footer>
        <h2>Equipo Imaginest</h2>
        <img src="%s/assets/img/demo/bg-masthead.jpg" style="height: 100px;" />
        <p><a href="%s" target="_blank">%s</a></p>
    </footer>
</body>
</html>
heredoc;
