<?php

namespace Webinteger\WiBooking\Callbacks;

use Contao\CoreBundle\Exception\AccessDeniedException;
use Contao\Database;
use Contao\DataContainer;
use Contao\Backend;
use Contao\Input;
use Contao\Image;

class AgencyCallbacks extends Backend
{
    /**
     * Prüft vor dem Löschen einer Agentur, ob dieser noch Benutzer (Eigentümer) zugewiesen sind.
     *
     * @throws AccessDeniedException
     */
    public function checkOwnersBeforeDelete(DataContainer $dc): void
    {
        $agencyId = $dc->id;

        // Prüfen, ob Benutzer mit dieser Agentur verknüpft sind
        $count = Database::getInstance()
            ->prepare("SELECT COUNT(*) FROM tl_user WHERE wiAgency = ?")
            ->execute($agencyId)
            ->count();

        if ($count > 0) {
            throw new AccessDeniedException('Die Agentur kann nicht gelöscht werden, da noch Eigentümer damit verknüpft sind.');
        }
    }

    /**
     * Button generieren
     */
    public function ownersButton($row, $href, $label, $title, $icon, $attributes)
    {
        $href .= '&id=' . $row['id'];

        return '<a href="' . $this->addToUrl($href) . '" title="' . htmlspecialchars($title, ENT_QUOTES) . '"' . $attributes . '>' .
            Image::getHtml($icon, $label) . '</a> ';
    }
}
