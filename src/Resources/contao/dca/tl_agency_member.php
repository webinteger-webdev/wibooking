<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_agency_member'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ptable'           => 'tl_agency',
        'doNotCopyRecords' => true,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id'        => 'primary',
                'pid'       => 'index',
                'member_id' => 'index',
            ],
        ],
    ],
    'list' => [
        'sorting' => [
            'mode'        => 4,
            'fields'      => ['member_id'],
            'flag'       => 1,
            'panelLayout' => 'filter;search,limit',
            'headerFields' => ['agencyName'],
            'disableGrouping' => true,
            'child_record_callback' => ['Webinteger\WiBooking\Classes\AgencyMember', 'listMembers'],
        ],
        'global_operations' => [],
        'operations' => [
            'edit'   => ['label' => &$GLOBALS['TL_LANG']['tl_agency_member']['edit'], 'href' => 'act=edit', 'icon' => 'edit.svg'],
            'delete' => ['label' => &$GLOBALS['TL_LANG']['tl_agency_member']['delete'], 'href' => 'act=delete', 'icon' => 'delete.svg', 'attributes' => 'onclick="return confirm(\'%s\')"'],
        ],
    ],
    'palettes' => [
        'default' => '{member_legend},member_id',
    ],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        'pid' => [
            'foreignKey' => 'tl_agency.agencyName',
            'relation' => ['type' => 'belongsTo', 'load' => 'eager'],
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        'member_id' => [
            'label' => &$GLOBALS['TL_LANG']['tl_agency_member']['member_id'],
            'exclude' => true,
            'inputType' => 'select',
            'foreignKey' => 'tl_member.fullname',
            'relation' => ['type' => 'hasOne', 'load' => 'eager'],
            'eval' => ['mandatory' => true, 'chosen' => true, 'tl_class' => 'w50'],
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        // weitere Felder nach Bedarf
    ],
];
