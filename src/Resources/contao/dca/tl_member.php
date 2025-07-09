<?php

$GLOBALS['TL_DCA']['tl_member']['fields']['fullname'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_member']['fullname'],
    'exclude' => true,
    'search' => true,
    'sorting' => false,
    'flag' => 1,
    'inputType' => 'text', // optional: nur zur Kontrolle, eigentlich nicht editierbar
    'eval' => ['readonly' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];


// Optional: ondelete_callback, falls gewünscht, um Löschen zu verhindern, wenn Eigentümer noch Objekte haben
$GLOBALS['TL_DCA']['tl_member']['config']['ondelete_callback'][] = [
    'Webinteger\WiBooking\Callbacks\MemberCallbacks',
    'preventDeleteIfHasProperties'
];

$GLOBALS['TL_DCA']['tl_member']['config']['onsubmit_callback'][] = [
    'Webinteger\WiBooking\Callbacks\MemberCallbacks',
    'generateFullname',
];

$GLOBALS['TL_DCA']['tl_member']['config']['onload_callback'][] = [
    'Webinteger\WiBooking\Callbacks\MemberCallbacks',
    'filterByAgency'
];
