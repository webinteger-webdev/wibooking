<?php

namespace Webinteger\WiBooking\Helper;

use Contao\StringUtil;
use Contao\Database;

class AliasHelper
{
    /**
     * Generate alias from title if not provided.
     */
    public function generateAlias(string $varValue, \Contao\DataContainer $dc): string
    {
        // Kein Alias angegeben: Aus Titel generieren
        if (!$varValue) {
            $varValue = StringUtil::generateAlias($dc->activeRecord->title);
        }

        // Prüfen, ob schon vorhanden
        $objAlias = Database::getInstance()
            ->prepare("SELECT id FROM tl_property_group WHERE alias=? AND id!=?")
            ->execute($varValue, $dc->id);

        if ($objAlias->numRows > 0) {
            throw new \Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
        }

        return $varValue;
    }
}
