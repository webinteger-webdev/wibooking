<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_property'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'sql' => [
            'engine' => 'InnoDB',
            'charset' => 'utf8mb4',
            'keys' => [
                'id'    => 'primary',
                'alias' => 'index'
            ]
        ],
    ],

    'list' => [
        'sorting' => [
            'mode' => 2,
            'fields' => ['internal_title', 'title', 'owner'],
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit',
            'disableGrouping' => true,
            'headerFields' => ['internal_title', 'title', 'internal_property_number'],
            'defaultSearchField' => 'internal_title',
        ],
        'label' => [
            'fields' => ['internal_title', 'title', 'internal_property_number', 'owner:tl_member.fullname'],
            'showColumns' => true,
            'format' => '%s',
        ],
        'filter' => [
            'fields' => ['owner'],
        ],
        'operations' => [
            'edit' => [
                'label' => &$GLOBALS['TL_LANG']['tl_property']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.svg',
            ],
            'delete' => [
                'label' => &$GLOBALS['TL_LANG']['tl_property']['delete'],
                'href'  => 'act=delete',
                'icon'  => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'Wirklich löschen?\'))return false; Backend.getScrollOffset();"'
            ],
            'show' => [
                'label' => &$GLOBALS['TL_LANG']['tl_property']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.svg',
            ],
        ],
    ],

    'palettes' => [
        '__selector__' => [],
        'default' => '{title_legend},title,alias,internal_title,internal_property_number;{group_legend},propertyGroups;{owner_legend},owner;{publish_legend},tstamp',
    ],

    'fields' => [
        'id' => [
            'search' => false,
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        'title' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property']['title'],
            'inputType' => 'text',
            'search' => true,
            'sorting' => true,
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
        'alias' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property']['alias'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'alias', 'unique' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'save_callback' => [
                ['Webinteger\WiBooking\Helper\AliasHelper', 'generateAlias']
            ],
            'sql' => "varchar(128) NOT NULL default ''",
        ],
        'internal_title' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property']['internal_title'],
            'inputType' => 'text',
            'search' => true,
            'sorting' => true,
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
        'internal_property_number' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property']['internal_property_number'],
            'inputType' => 'text',
            'search' => true,
            'sorting' => true,
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
        'propertyGroups' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property']['propertyGroups'],
            'inputType' => 'select',
            'foreignKey' => 'tl_property_group.title',
            'relation' => ['type' => 'manyToMany', 'load' => 'lazy'],
            'eval' => [
                'multiple' => true,
                'chosen' => true,
                'tl_class' => 'w50 clr'
            ],
            'sql' => "blob NULL",
        ],
        'owner' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property']['owner'],
            'search' => true,
            'inputType' => 'select',
            'options_callback' => function () {
                $members = \Contao\Database::getInstance()
                    ->execute("SELECT id, firstname, lastname FROM tl_member ORDER BY lastname, firstname");

                $options = [];
                while ($members->next()) {
                    $options[$members->id] = $members->firstname . ' ' . $members->lastname;
                }
                return $options;
            },
            'eval' => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],

    ]
];
