<?php

$GLOBALS['TL_CSS'][] = 'bundles/wibooking/backend.css|static';

$GLOBALS['BE_MOD']['wibooking'] = [
    'wibooking_settings' => [
        'callback' => \Webinteger\WiBooking\Controller\BackendModule\SettingsController::class,
        'icon' => 'bundles/wibooking/images/icon.svg', // если у тебя есть своя иконка
    ],
];
