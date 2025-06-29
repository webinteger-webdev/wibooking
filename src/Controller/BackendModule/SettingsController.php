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
        // Получить Request вручную, если нужно
        $container = System::getContainer();
        $requestStack = $container->get('request_stack');
        $request = $requestStack->getCurrentRequest();

        // Твой код
        $this->Template->headline = 'WI Booking Einstellungen';
        $this->Template->text = 'Hier kannst du deine Grundeinstellungen konfigurieren.';
    }
}
