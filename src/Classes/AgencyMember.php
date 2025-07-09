<?php

namespace Webinteger\WiBooking\Classes;

use Contao\Image;
use Contao\Backend;
use Contao\StringUtil;
use Contao\MemberModel;
use Contao\DataContainer;
use Symfony\Component\HttpFoundation\RequestStack;
use Contao\Database;

class AgencyMember
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function listMembers(array $row): string
    {
        if (!isset($row['member_id']) || !$row['member_id']) {
            return 'Kein Mitglied verknüpft';
        }
        $member = MemberModel::findByPk($row['member_id']);
        return $member && $member->fullname ? $member->fullname : 'Unbekanntes Mitglied';
    }

    public function editOwners(array $row, string $href, string $label, string $title, string $icon, string $attributes): string
    {
        $request = $this->requestStack->getCurrentRequest();
        $baseUrl = $request ? $request->getRequestUri() : '';
        $url = $baseUrl . (strpos($baseUrl, '?') === false ? '?' : '&') . $href . '&id=' . $row['id'];

        return '<a href="' . $url . '" title="' . StringUtil::specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }

    public function addAgencyLabel(array $row, string $label, \Contao\DataContainer $dc = null): string
    {
        $memberId = $row['id'];
        $agencyName = $this->findAgencyNameByMemberId($memberId);

        if ($agencyName) {
            $label .= ' <span style="color:#999;padding-left:10px;">[' . $agencyName . ']</span>';
        }

        return $label;
    }

    private function findAgencyNameByMemberId(int $memberId): ?string
    {
        $result = Database::getInstance()
            ->prepare("
                SELECT a.agencyName
                FROM tl_agency_member am
                JOIN tl_agency a ON am.pid = a.id
                WHERE am.member_id = ?
                LIMIT 1
            ")
            ->execute($memberId);

        if ($result->numRows) {
            return $result->agencyName;
        }

        return null;
    }
}
