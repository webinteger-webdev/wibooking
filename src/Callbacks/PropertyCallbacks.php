<?php

namespace Webinteger\WiBooking\Callbacks;

use Contao\Database;
use Contao\DataContainer;

class PropertyCallbacks
{
    public function listOwnerName(array $row, string $label, DataContainer $dc): string
    {
        // Hole Owner Name aus tl_member, falls gesetzt
        $ownerName = '-';
        if (!empty($row['owner'])) {
            $member = Database::getInstance()
                ->prepare("SELECT firstname, lastname FROM tl_member WHERE id = ?")
                ->execute($row['owner']);

            if ($member->numRows) {
                $ownerName = trim($member->firstname . ' ' . $member->lastname);
            }
        }

        // Erzeuge eigenes Label-HTML oder Text
        // Beispiel mit <strong> für bessere Lesbarkeit in der Backend-Liste
        $label = sprintf(
            '%s %s %s <strong>%s</strong>',
            $row['internal_title'] ?? '',
            $row['title'] ?? '',
            $row['internal_property_number'] ?? '',
            $ownerName
        );

        // return $label;

        return 'TEST LABEL';
    }
}
