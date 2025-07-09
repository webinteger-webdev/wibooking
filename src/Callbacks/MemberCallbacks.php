<?php

namespace Webinteger\WiBooking\Callbacks;

use Contao\CoreBundle\Exception\AccessDeniedException;
use Contao\Database;
use Contao\DataContainer;
use Contao\Input;

class MemberCallbacks
{
    /**
     * Verhindert das Löschen, wenn dem Mitglied Objekte zugewiesen sind
     */
    public function preventDeleteIfHasProperties(DataContainer $dc): void
    {
        $memberId = $dc->id;

        $count = Database::getInstance()
            ->prepare("SELECT COUNT(*) AS count FROM tl_property WHERE owner = ?")
            ->execute($memberId)
            ->count; // 'count' ist das Alias aus SQL

        if ($count > 0) {
            throw new AccessDeniedException('Dieser Benutzer kann nicht gelöscht werden, da ihm Objekte zugewiesen sind.');
        }
    }

    /**
     * Fügt den Fullname automatisch zusammen.
     */
    public function generateFullname(DataContainer $dc): void
    {
        if (!$dc->id) {
            return;
        }

        $db = Database::getInstance();
        $member = $db->prepare("SELECT firstname, lastname FROM tl_member WHERE id = ?")
            ->execute($dc->id);

        if ($member->numRows) {
            $fullname = trim($member->firstname . ' ' . $member->lastname);

            $db->prepare("UPDATE tl_member SET fullname = ? WHERE id = ?")
                ->execute($fullname, $dc->id);
        }
    }

    public function filterByAgency(DataContainer $dc)
    {
        $agencyId = Input::get('agency');
        if ($agencyId) {
            // Filter für das Backend-Listing setzen
            $GLOBALS['TL_DCA']['tl_member']['list']['sorting']['root'] = [];
            $GLOBALS['TL_DCA']['tl_member']['list']['sorting']['filter'][] = ['wiAgency=?', $agencyId];
        }
    }
}
