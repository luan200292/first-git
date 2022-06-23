<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends Controller
{
    /**
     * @Route("/supplier", name="supplier")
     */
    public function index(): Response
    {
        return $this->render('supplier/index.html.twig', [
            'controller_name' => 'SupplierController',
        ]);
    }
    // /**
    //  * @Route("/supplier/locals", name="supplierLocal")
    //  */
    // public function supplierLocalAction(SupplierRepository $repo): Response
    // {
    //     $sup = $repo->findBySupLoc(0);
    //     return $this->json($sup);
    // }
    // /**
    //  * @Route("/supplier/importers", name="supplierImporters")
    //  */
    // public function supplierImportersAction(SupplierRepository $repo): Response
    // {
    //     $sup = $repo->findBySupImp(1);
    //     return $this->json($sup);
    // }
    // /**
    //  * @Route("/supplier/local", name="supLocal")
    //  */
    // public function supLocalAction(SupplierRepository $repo): Response
    // {
    //     $sup = $repo->findBySupLocal();
    //     return $this->json($sup);
    // }
    // /**
    //  * @Route("/supplier/importer", name="supImporter")
    //  */
    // public function supImpAction(SupplierRepository $repo): Response
    // {
    //     $sup = $repo->findBySupImporter();
    //     return $this->json($sup);
    // }

    /**
     * @Route("/suppliers/local", name="supLocal")
     */
    public function supLocalAction(SupplierRepository $repo): Response
    {
        $sup = $repo->findBySupLocal();
        return $this->json($sup);
    }
    /**
     * @Route("/suppliers/importer", name="supImporter")
     */
    public function supImporterAction(SupplierRepository $repo): Response
    {
        $sup = $repo->findBySupImporter();
        return $this->json($sup);
    }
}
