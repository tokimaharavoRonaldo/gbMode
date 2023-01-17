<?php
namespace App\Twig;

use App\Repository\AproposRepository;
use App\Repository\CategorieRepository;
use App\Service\Panier\PanierService;
use PhpParser\Node\Expr\Cast\Array_;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension{
private $categorieRepository;
private $aproposRepository;
private $panierService;

public function __construct(CategorieRepository $categorieRepository,AproposRepository $aproposRepository,PanierService $panierService){
$this->categorieRepository=$categorieRepository;
$this->aproposRepository=$aproposRepository;
$this->panierService=$panierService;
}

public function getFunctions(){
    return [
        new TwigFunction('categorieNavbar',[$this,'categorie']),
        new TwigFunction('aproposFooter',[$this,'apropos']),
        new TwigFunction('panierNavbar',[$this,'panier'])

    ];
}

public function categorie(): array
{
return $this->categorieRepository->findAll();
}

public function apropos()
{
return $this->aproposRepository->apropos();
}
public function panier()
{
return $this->panierService->nmbreProductOnPanier();
}

}