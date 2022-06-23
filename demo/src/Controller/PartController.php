<?php

namespace App\Controller;

use App\Entity\Part;
use App\Entity\Supplier;
use App\Form\Type\PartType;
use App\Repository\PartRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartController extends Controller
{
    /**
     * @Route("/part", name="part")
     */
    public function index(): Response
    {
        return $this->render('part/index.html.twig', [
            'controller_name' => 'PartController',
        ]);
    }
    /**
     * @Route("add/part", name="addPart")
     */
    public function addPartAction(Request $req, ManagerRegistry $res): Response
    {
        $part = new Part();
        $form = $this->createForm(PartType::class, $part);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $part->setName($data->getName());
            $part->setPrice($data->getPrice());
            $part->setSupplier($data->getSupplier());
            $part->setQuantity($data->getQuantity());
            
            $entity->persist($part);
            $entity->flush();

            return $this->json([
                'id'=>$part->getId()
            ]);
        }

        return $this->render('part/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("edit/part/{id}", name="editPart")
     */
    public function editPartAction(Request $req, ManagerRegistry $res, PartRepository $repo, int $id): Response
    {
        $part = $repo->find($id);
        $form = $this->createForm(PartType::class, $part);

        $form->handleRequest($req);
        $entity = $res->getManager();

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $part->setName($data->getName());
            $part->setPrice($data->getPrice());
            $part->setSupplier($data->getSupplier());
            $part->setQuantity($data->getQuantity());
            
            $entity->persist($part);
            $entity->flush();

            return $this->json([
                'id'=>$part->getId()
            ]);
        }

        return $this->render('part/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
