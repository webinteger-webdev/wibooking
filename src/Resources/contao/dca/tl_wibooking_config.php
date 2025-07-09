<?php

use Contao\DC_File;

$GLOBALS['TL_DCA']['tl_wibooking_config'] = [
    'config' => [
        'dataContainer' => DC_File::class,
        'closed' => true,
        'notDeletable'  => true,
    ],
    'palettes' => [
        '__selector__' => [],
        'default'      => '{wi_booking_mode_legend},wi_booking_mode',
    ],
    'fields' => [
        'wi_booking_mode' => [
            'label' => &$GLOBALS['TL_LANG']['tl_wibooking_config']['wi_booking_mode'],
            'inputType' => 'select',
            'options' => ['agency', 'owner'],
            'reference' => &$GLOBALS['TL_LANG']['tl_wibooking_config']['wi_booking_mode_options'],
            'eval' => ['tl_class' => 'w50', 'mandatory' => true],
        ],
    ],
];
