<?php

namespace Webinteger\WiBooking\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Webinteger\WiBooking\Entity\Property;

#[AsFrontendModule('property_list', category: 'WI Booking', label: 'Property List', template: 'mod_property_list')]
class PropertyListController extends AbstractFrontendModuleController
{
    public function __construct(
        private readonly Environment $twig,
        private readonly EntityManagerInterface $entityManager
    ) {}

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $properties = $this->entityManager
            ->getRepository(Property::class)
            ->findAll();

        return new Response($this->twig->render(
            '@WiBooking/frontend_module/mod_property_list.html.twig',
            [
                'properties' => $properties,
            ]
        ));
    }
}
