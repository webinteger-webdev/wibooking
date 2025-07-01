<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_property_group'] = [
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
            'mode' => 1,
            'fields' => ['title'],
            'flag' => 1,
            'panelLayout' => 'filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['title', 'color'],
            'format' => '%s <span style="display:inline-block;width:10px;height:10px;border-radius:50%%;background-color:%s;margin-left:5px;border:1px solid #ccc;"></span>',
        ],
        'global_operations' => [
            'all' => [
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'  => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
            ],
        ],
        'operations' => [
            'edit' => [
                'label' => &$GLOBALS['TL_LANG']['tl_property_group']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.svg',
            ],
            'delete' => [
                'label' => &$GLOBALS['TL_LANG']['tl_property_group']['delete'],
                'href'  => 'act=delete',
                'icon'  => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'Wirklich löschen?\'))return false; Backend.getScrollOffset();"'
            ],
            'show' => [
                'label' => &$GLOBALS['TL_LANG']['tl_property_group']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.svg',
            ],
        ],
    ],
    'palettes' => [
        '__selector__' => [],
        'default' => '{title_legend},title,alias;{config_legend},label,color,note',
    ],
    'fields' => [
        'id' => [
            'search' => false,
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],
        'title' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property_group']['title'],
            'inputType' => 'text',
            'search' => true,
            'sorting' => true,
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
        'alias' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property_group']['alias'],
            'inputType' => 'text',
            'eval' => ['rgxp' => 'alias', 'unique' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'save_callback' => [
                ['Webinteger\WiBooking\Helper\AliasHelper', 'generateAlias']
            ],
            'sql' => "varchar(128) NOT NULL default ''",
        ],
        'label' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property_group']['label'],
            'exclude' => true,
            'inputType' => 'checkboxWizard',
            'sorting' => true,
            'options' => ['booking', 'backend'],
            'reference' => &$GLOBALS['TL_LANG']['tl_property_group']['label_options'],
            'eval' => ['multiple' => true, 'tl_class' => 'w50 clr', 'helpwizard' => true],
            'sql' => "blob NULL",
        ],
        'color' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property_group']['color'],
            'exclude' => true,
            'sorting' => true,
            'inputType' => 'select',
            'options' => ['#ff0000', '#00aaff', '#00cc66', '#ff9900', '#9966ff', '#ff66cc', '#999999'],
            'reference' => &$GLOBALS['TL_LANG']['tl_property_group']['color_options'],
            'eval' => [
                'includeBlankOption' => true,
                'tl_class' => 'w50',
            ],
            'sql' => "varchar(7) NOT NULL default ''",
        ],
        'note' => [
            'label' => &$GLOBALS['TL_LANG']['tl_property_group']['note'],
            'inputType' => 'textarea',
            'eval' => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
            'sql' => "text NULL",
        ],
    ],
];
