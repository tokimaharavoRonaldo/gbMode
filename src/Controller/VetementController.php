<?php

namespace App\Controller;

use App\Entity\Vetement;
use App\Repository\VetementRepository;
// use Knp\Bundle\PaginatorBundle\Definition\PaginatorInterface;
use Knp\Component\Pager\PaginatorInterface as PagerPaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VetementController extends AbstractController
{
    /**
     * @Route("/vetement", name="app_vetement")
     */
    public function index(
        VetementRepository $vetement,
        // PaginatorInterface $paginatorAwareInterface,
        PagerPaginatorInterface $paginator,
        Request $request
        ): Response{
            $data=$vetement->all();
            $vetement=$paginator->paginate(
                $data,
                $request->query->getInt('page',1),
                10
            );

        return $this->render('vetement/index.html.twig', [
            'vetements' => $vetement
        ]);
    }

    /**
     * @Route("/vetement/show/{slug}", name="app_show")
     */
    public function show(Vetement $vetement): Response
    {
        // $data=$vetementRepository->show()
        return $this->render('vetement/show.html.twig', [
            'vetements' => $vetement
        ]);
    }

    /**
     * @Route("/vetement/filter", name="app_filter_product")
     */
    public function filter(
        VetementRepository $vetement,
        // PaginatorInterface $paginatorAwareInterface,
        PagerPaginatorInterface $paginator,
        Request $request
    ): Response
    {
       
        $search=$request->query->get('search');
         $data= $vetement->filter($search);
         $vetement=$paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            10
        );
        //  dd($data);
        return $this->render('vetement/index.html.twig', [
            'vetements' => $vetement
        ]);
    }
}
