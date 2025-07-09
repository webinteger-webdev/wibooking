<?php

namespace Webinteger\WiBooking\Controller\BackendModule;

use Contao\BackendModule;
use Contao\System;

/**
 * Class SettingsController
 *
 * Контроллер для управления настройками модуля Wi Booking в бэкенде Contao.
 */
class SettingsController extends BackendModule
{
    protected $strTemplate = 'be_wibooking_settings';

    public function generate(): string
    {
        return parent::generate();
    }

    protected function compile(): void
    {
        System::loadLanguageFile('tl_settings');

        // Получить Request вручную, если нужно
        $container = System::getContainer();
        $requestStack = $container->get('request_stack');
        $request = $requestStack->getCurrentRequest();

        // Agentur oder Eigentüner Mode
        // $mode = $GLOBALS['TL_CONFIG']['wi_booking_mode'];

        // Твой код
        // $this->Template->headline = 'WI Booking Einstellungen';
        // $this->Template->text = 'Hier kannst du deine Grundeinstellungen konfigurieren.';

        // $this->Template->groupUrl = 'contao?do=property_groups';
        // $this->Template->wisettings = 'contao?do=agency';

        // Version vorbereiten
        $composer = json_decode(file_get_contents(\Contao\System::getContainer()->getParameter('kernel.project_dir') . '/composer.lock'), true);
        $packages = [];

        foreach ($composer['packages'] as $package) {
            $packages[$package['name']] = $package['version'];
        }


        $this->Template->headline = $GLOBALS['TL_LANG']['tl_settings']['wi_booking_legend'] ?? null;
        $this->Template->version = $GLOBALS['TL_LANG']['tl_settings']['version'] . ': ' . (isset($packages['webinteger/wibooking']) ? $packages['webinteger/wibooking'] : '0.0.0');
        $this->Template->description = $GLOBALS['TL_LANG']['tl_settings']['wi_booking_description'] ?? null;

        $groups = [];

        // dd($GLOBALS['TL_WIA']);


        foreach ($GLOBALS['TL_WIA'] as $group => $modules) {

            // dump($group, $modules);

            $gp = [
                'alias'   => $group,
                'group'   => ($GLOBALS['TL_LANG']['tl_settings']['group_' . $group]),
                'modules' => []
            ];

            foreach ($modules as $module) {
                $link = 'contao?do=' . $module;

                $groupLabel = $GLOBALS['TL_LANG']['tl_settings']['group_' . $module];

                if (is_array($groupLabel)) {
                    $groupTitle = $groupLabel[0];
                    $groupDesc = $groupLabel[1];
                }

                $gp['modules'][] = [
                    'title' => $groupTitle,
                    'desc'  => $groupDesc,
                    'link'  => $link,
                ];
            }

            $groups[] = $gp;
        }

        $this->Template->groups = $groups;
    }
}
