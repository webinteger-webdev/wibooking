<?php

use Contao\ArrayUtil;
use Contao\DC_Table;
use Contao\DataContainer;

$GLOBALS['TL_CSS'][] = 'bundles/wibooking/assets/backend/css/backend.css|static';

$GLOBALS['TL_WIA'] = [
    'configuration' => ['config'],
    'properties'    => ['property', 'property_groups'],
    'agencies'      => ['agency'],
];

// Dein Backend-Modul-Array vorbereiten
$wibookingModules = [
    'wibooking' => [
        'property' => [
            'tables' => ['tl_property'],
        ],
        'property_groups' => [
            'tables' => ['tl_property_group'],
            'hideInNavigation'  => true,
        ],
        'agency' => [
            'tables' => ['tl_agency', 'tl_agency_member'],
            'hideInNavigation' => true,
        ],
        'config' => [
            'tables' => ['tl_wibooking_config'],
            'hideInNavigation' => true,
        ],
        'wibooking_settings' => [
            'callback' => \Webinteger\WiBooking\Controller\BackendModule\SettingsController::class,
            'icon' => 'bundles/wibooking/images/icon.svg',
        ],
    ],
];

// Position "content" suchen
$contentPos = array_search('content', array_keys($GLOBALS['BE_MOD']));

// Modul direkt nach "content" einfügen
if ($contentPos !== false) {
    ArrayUtil::arrayInsert($GLOBALS['BE_MOD'], $contentPos + 1, $wibookingModules);
} else {
    // Falls "content" nicht gefunden wird (z. B. sehr spezielles Setup), einfach anhängen
    $GLOBALS['BE_MOD'] = array_merge($GLOBALS['BE_MOD'], $wibookingModules);
}
