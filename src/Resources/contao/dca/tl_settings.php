<?php

// WI Buchung Feld hinzufügen
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{wi_booking_legend},wi_booking_mode';

// Betriebsmodus-Feld
$GLOBALS['TL_DCA']['tl_settings']['fields']['wi_booking_mode'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['wi_booking_mode'],
    'inputType' => 'select',
    'options' => ['agency', 'owner'],
    'reference' => &$GLOBALS['TL_LANG']['tl_settings']['wi_booking_mode_options'],
    'eval' => ['tl_class' => 'w50', 'mandatory' => true],
    'sql' => "varchar(16) NOT NULL default 'agency'",
];
