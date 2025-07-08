<?php

declare(strict_types=1);

namespace App\SharedDomain\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;

class RootRedirectController extends AbstractController
{
    public function __construct(
        private readonly RouterInterface $router,
    ) {
    }

    #[Route(path: '/', name: 'root_redirect')]
    public function __invoke(Request $request): RedirectResponse
    {
        return new RedirectResponse(
            $this->router->generate('admin_dashboard', ['_locale' => $request->getLocale() ?: 'en'])
        );
    }
}
