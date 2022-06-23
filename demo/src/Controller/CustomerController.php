<?php

namespace App\Controller;
use App\Entity\Customer;
use App\Form\Type\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

date_default_timezone_set("Asia/Ho_Chi_Minh");
class CustomerController extends AbstractController
{
    /**
     * @Route("/customer", name="customer")
     */
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }
  // /**
  //  * @Route("/customers/all/ascending", name="showCusAsc")
  //  */
  // public function showCusAscAction(CustomerRepository $repo): Response
  // {
  //   $cus = $repo->findByCusAsc();
  //   return $this->json($cus);
  // }
  // /**
  //  * @Route("/customers/all/descending", name="showCusDesc")
  //  */
  // public function showCusDescAction(CustomerRepository $repo): Response
  // {
  //   $cus = $repo->findByCusDesc();
  //   return $this->json($cus);
  // }

  /**
   * @Route("/customers/all/ascending", name="cusAsc")
   */
  public function cusAscAction(CustomerRepository $repo): Response
  {
    $cus = $repo->findByCusAsc();
    return $this->json($cus);
  }
  /**
   * @Route("/customers/all/descending", name="cusDesc")
   */
  public function cusDescAction(CustomerRepository $repo): Response
  {
    $cus = $repo->findByCusDesc();
    return $this->json($cus);
  }
  /**
   * @Route("/customers/{id}", name="cusID")
   */
  public function cusIdAction(CustomerRepository $repo, int $id): Response
  {
    $cusId = $repo->findByCusIdSale($id);
    return $this->json($cusId);
  }
  /**
   * @Route("/add/customer", name="addCus")
   */
  public function addCusAction(Request $req, ManagerRegistry $res): Response
  {
    $customer = new Customer();
    $form = $this->createForm(CustomerType::class, $customer);

    $form->handleRequest($req);
    $entity = $res->getManager();

    if($form->isSubmitted() && $form->isValid()){
      $data = $form->getData();
      $customer->setName($data->getName());
      $customer->setBirthDate($data->getBirthDate());

      $date = $customer->getBirthDate()->format('Y');
      $curdate = date('Y');
      $young = 0;
      if(($curdate - $date) >= 18 && ($curdate - $date) < 21){
        $young = 1;
      }
      $customer->setIsYoungDriver($young);

      $entity->persist($customer);
      $entity->flush();

      return $this->json([
        'id'=>$customer->getID()
      ]);
    }

    return $this->render('customer/index.html.twig', [
      'form' => $form->createView()
    ]);
  }
  /**
   * @Route("/edit/customer/{id}", name="editCus")
   */
  public function editCusAction(Request $req, ManagerRegistry $res, CustomerRepository $repo, int $id): Response
  {
    $customer = $repo->find($id);
    $form = $this->createForm(CustomerType::class, $customer);

    $form->handleRequest($req);
    $entity = $res->getManager();

    if($form->isSubmitted() && $form->isValid()){
      $data = $form->getData();
      $customer->setName($data->getName());
      $customer->setBirthDate($data->getBirthDate());

      $date = $customer->getBirthDate()->format('Y');
      $curdate = date('Y');
      $young = 0;
      if(($curdate - $date) >= 18 && ($curdate - $date) < 21){
        $young = 1;
      }
      $customer->setIsYoungDriver($young);

      $entity->persist($customer);
      $entity->flush();

      return $this->json([
        'id'=>$customer->getID()
      ]);
    }

    return $this->render('customer/index.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
