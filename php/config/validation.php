<?php

define('VALIDATION', array(
    'noValidation' => array(
        'error' => array(
            'msg' => "¡Los campos introducidos son incorrectos!",
        ),
    ),
    'noRegister' => array(
        'unique' => array(
            'msg' => "¡El nombre de usuario y/o el correo electrónico ya han sido registrados!",
        ),
    ),
    'username' => array(
        'error' => array(
            'msg' => "¡El nombre de usuario es incorrecto!",
        ),
        'required' => array(
            'msg' => "¡El nombre de usuario es un campo requerido!",
        ),
        'length' => array(
            'min' => 5,
            'max' => 60,
            'msg' => "¡El nombre de usuario no tiene la longitud correcta!",
        ),
    ),
    'email' => array(
        'error' => array(
            'msg' => "¡El correo electrónico es incorrecto!",
        ),
        'required' => array(
            'msg' => "¡El correo electrónico es campo requerido!",
        ),
        'length' => array(
            'min' => 5,
            'max' => 60,
            'msg' => "¡El correo electrónico no tiene la longitud correcta!",
        ),
    ),
    'firstname' => array(
        'error' => array(
            'msg' => "¡El nombre es incorrecto!",
        ),
        'required' => array(
            'msg' => "¡El nombre es un campo requerido!",
        ),
        'length' => array(
            'min' => 2,
            'max' => 60,
            'msg' => "¡El nombre no tiene la longitud correcta!",
        ),
    ),
    'lastname' => array(
        'error' => array(
            'msg' => "¡Los apellidos son incorrectos!",
        ),
        'required' => array(
            'msg' => "¡Los apellidos son requeridos!",
        ),
        'length' => array(
            'min' => 2,
            'max' => 60,
            'msg' => "¡Los apellidos no tienen la longitud correcta!",
        ),
    ),
    'password' => array(
        'error' => array(
            'msg' => "¡La contraseña es incorrecta!",
        ),
        'required' => array(
            'msg' => "¡La contraseña es un campo requerido!",
        ),
        'confirm' => array(
            'msg' => "¡Las contraseñas no coinciden!",
        ),
        'length' => array(
            'min' => 6,
            'max' => 60,
            'msg' => "¡La contraseña no tiene la longitud correcta!",
        ),
    ),
));
