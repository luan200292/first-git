<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends Controller
{
    /**
     * @Route("/car",name="car_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository(Car::class)->findAll();

        return $this->render('car/index.html.twig', array(
            'cars' => $cars,
        ));
    }

  /**
   * Finds and displays a car entity.
   *
   * @Route("/car/{id}", name="car_show")
   */
  public function showAction(Car $car)
  {
    return $this->render('car/show.html.twig', array(
      'car' => $car,
    ));
  }
  // /**
  //  * @Route("/cars/Opel", name="carsMake")
  //  */
  // public function carsMakeAction(CarRepository $repo): Response
  // {
  //   $cars = $repo->findByCar('Opel');
  //   return $this->json($cars);
  // }
  // /**
  //  * @Route("/cars/1/parts", name="carsParts")
  //  */
  // public function carsPartsAction(CarRepository $repo): Response
  // {
  //   $carsP = $repo->findByCarPart(1);
  //   return $this->json($carsP);
  // }
  
  /**
   * @Route("/cars/Opel", name="carsMake")
   */
  public function carsMakeAction(CarRepository $repo): Response
  {
    $car = $repo->findByCarMake('Opel');
    return $this->json($car);
  }
  /**
   * @Route("/cars/1/parts", name="carsPart")
   */
  public function carsPartAction(CarRepository $repo): Response
  {
    $carsP = $repo->findByCarParts(1);
    return $this->json($carsP);
  }
}
