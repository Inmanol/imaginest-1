<?php

$body = <<< heredoc
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Activa tu cuenta</h1>
    <p>Activa tu cuenta clicando en el siguiente enlace: <a href="%s/index.php?activationCode=%s&email=%s" target="_blank">activaci&oacute;n</a></p>
    <footer>
        <h2>Equipo Imaginest</h2>
        <img src="%s/assets/img/demo/bg-masthead.jpg" style="height: 100px;" />
        <p><a href="%s" target="_blank">%s</a></p>
    </footer>
</body>
</html>
heredoc;
