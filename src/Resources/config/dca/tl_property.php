<?php

$GLOBALS['TL_DCA']['tl_property'] = [
    'config' => [
        'dataContainer' => 'Table',
        'sql' => ['keys' => ['id' => 'primary']]
    ],
    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['title']
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s'
        ]
    ],
    'palettes' => [
        'default' => '{title_legend},title'
    ],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'title' => [
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255],
            'sql' => "varchar(255) NOT NULL default ''"
        ]
    ]
];
