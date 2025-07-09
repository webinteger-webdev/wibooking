<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_agency'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'sql' => [
            'engine' => 'InnoDB',
            'charset' => 'utf8mb4',
            'keys' => [
                'id' => 'primary',
            ],
        ],
        // Callback zum Verhindern des Löschens, wenn Eigentümer zugewiesen sind
        'ondelete_callback' => [
            ['Webinteger\WiBooking\Callbacks\AgencyCallbacks', 'checkOwnersBeforeDelete'],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['agencyName'],
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['agencyName'],
            'format' => '%s',
        ],
        'global_operations' => [],
        'operations' => [
            'edit' => [
                'label' => &$GLOBALS['TL_LANG']['tl_agency']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.svg',
            ],
            'delete' => [
                'label' => &$GLOBALS['TL_LANG']['tl_agency']['delete'],
                'href'  => 'act=delete',
                'icon'  => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'Wirklich löschen?\'))return false; Backend.getScrollOffset();"'
            ],
            'show' => [
                'label' => &$GLOBALS['TL_LANG']['tl_agency']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.svg',
            ],
            'owners' => [
                'label' => &$GLOBALS['TL_LANG']['tl_agency']['owners'],
                'href'  => 'table=tl_agency_member',
                'icon'  => 'group.svg',
                'button_callback' => ['Webinteger\WiBooking\Classes\AgencyMember', 'editOwners'],
            ],
        ],
    ],

    'palettes' => [
        'default' => '{agency_legend},agencyName;{address_legend},street,postal,city,country,phone,email;{bank_legend},bankName,iban,bic;{tax_legend},taxNumber;{logo_legend},logo',
    ],

    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],
        'agencyName' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['agencyName'],
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],

        // Adresse
        'street' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['street'],
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50 clr'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
        'postal' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['postal'],
            'inputType' => 'text',
            'eval' => ['maxlength' => 32, 'tl_class' => 'w50'],
            'sql' => "varchar(32) NOT NULL default ''",
        ],
        'city' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['city'],
            'inputType' => 'text',
            'eval' => ['maxlength' => 64, 'tl_class' => 'w50 clr'],
            'sql' => "varchar(64) NOT NULL default ''",
        ],
        'country' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['country'],
            'inputType' => 'select',
            'options' => ['DE' => 'Deutschland', 'US' => 'USA', 'FR' => 'Frankreich'],
            'eval' => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
            'sql' => "varchar(2) NOT NULL default ''",
        ],
        'phone' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['phone'],
            'inputType' => 'text',
            'eval' => ['maxlength' => 64, 'tl_class' => 'w50 clr'],
            'sql' => "varchar(64) NOT NULL default ''",
        ],
        'email' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['email'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'email', 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],

        // Bank
        'bankName' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['bankName'],
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50 clr'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
        'iban' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['iban'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'iban', 'maxlength' => 34, 'tl_class' => 'w50'],
            'sql' => "varchar(34) NOT NULL default ''",
        ],
        'bic' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['bic'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'alnum', 'maxlength' => 11, 'tl_class' => 'w50 clr'],
            'sql' => "varchar(11) NOT NULL default ''",
        ],

        // Steuer
        'taxNumber' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['taxNumber'],
            'inputType' => 'text',
            'eval' => ['maxlength' => 64, 'tl_class' => 'w50'],
            'sql' => "varchar(64) NOT NULL default ''",
        ],

        // Logo
        'logo' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency']['logo'],
            'inputType' => 'fileTree',
            'eval' => ['filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'w50'],
            'sql' => "binary(16) NULL",
        ],
    ],
];
