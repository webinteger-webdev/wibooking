<?php

namespace Webinteger\WiBooking\Callbacks;

use Contao\CoreBundle\Intl\Countries;

class CountryOptionsCallback
{
    private Countries $countries;

    public function __construct(Countries $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Hook: getCountries
     * 
     * @param array|null $countries  Bestehende Länder oder null
     * @param string|null $locale    Aktuelles Locale
     * @return array                Neue Liste der Länder als Code => Name
     */
    public function onGetCountries(?array $countries, ?string $locale): array
    {
        // Wenn keine Länder übergeben, neu laden
        if ($countries === null) {
            $countries = $this->countries->getCountries($locale);
        }

        // Debug: falls leer, mal einen Fallback setzen
        if (empty($countries)) {
            $countries = [
                'DE' => 'Deutschland',
                'US' => 'United States',
                'FR' => 'France',
                // ...
            ];
        }

        // Hier kannst du z.B. Länder ergänzen, entfernen oder anpassen
        // Beispiel: Ein Land hinzufügen (wenn es nicht existiert)
        // if (!isset($countries['XX'])) {
        //     $countries['XX'] = 'Mein Land';
        // }

        return $countries;
    }
}
