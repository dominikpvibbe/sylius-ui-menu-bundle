<?php


namespace Vibbe\SyliusUiMenuBuilderPlugin\Controller;


use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vibbe\SyliusUiMenuBuilderPlugin\ViewRepository\MenuViewRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class ShowBySlugMenuAction
{
    /** @var ViewHandlerInterface  */
    private $viewHandler;

    /** @var MenuViewRepositoryInterface  */
    private $menuViewRepository;

    public function __construct(ViewHandlerInterface $viewHandler,
                                MenuViewRepositoryInterface $menuViewRepository)
    {
        $this->viewHandler    = $viewHandler;
        $this->menuViewRepository = $menuViewRepository;
    }

    public function __invoke(string $slug,Request $request)
    {
        $view = View::create($this->menuViewRepository->getOneBySlug($slug,$request->query->get('locale')), Response::HTTP_OK);
        try {
            return $this->viewHandler->handle($view);
        } catch (\InvalidArgumentException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }
    }
}
