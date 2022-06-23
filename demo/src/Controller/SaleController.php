<?php

namespace App\Controller;
use App\Entity\Sale;
use App\Repository\SaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaleController extends Controller
{
    /**
     * @Route("/sale", name="sale")
     */
    public function index(): Response
    {
        return $this->render('sale/index.html.twig', [
            'controller_name' => 'SaleController',
        ]);
    }
    /**
     * @Route("/Sales", name="sales")
     */
    public function salesAllAction(SaleRepository $repo): Response
    {
        $saAll = $repo->findByAllSales();
        return $this->json($saAll);
    }
    /**
     * @Route("/Sales/{id}", name="salesId")
     */
    public function salesIdAction(SaleRepository $repo, int $id): Response
    {
        $saId = $repo->findBySalesId($id);
        return $this->json($saId);
    }
    /**
     * @Route("/Sales/discounted", name="salesDis")
     */
    public function salesDisAction(SaleRepository $repo): Response
    {
        $saDis = $repo->findBySalesDis(0);
        return $this->json($saDis);
    }
    /**
     * @Route("/Sales/discounted/{per}", name="salesDisPer")
     */
    public function salesDisPerAction(SaleRepository $repo, float $per): Response
    {
        $saDis = $repo->findBySalesDis($per);
        return $this->json($saDis);
    }
}
