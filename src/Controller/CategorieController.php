<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\VetementRepository;
use Knp\Component\Pager\PaginatorInterface as PagerPaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie/{slug}", name="app_categorie")
     */
    public function index(
        Categorie $categorie,
        VetementRepository $vetementRepository,
        PagerPaginatorInterface $paginator,
        Request $request
        ): Response{
        $data=$vetementRepository->findAllCategorie($categorie);
    // dd($data);

        // $data=$vetement->findAll();
        $vetement=$paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            10
        );

        return $this->render('categorie/index.html.twig', [
            'categorie' => $categorie,
            'vetements' => $vetement
        ]);
    }

    
}
