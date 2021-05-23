<?php

namespace App\Controller;

use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Manager\CartManager;
use App\Repository\ProductosRepository;
use App\Repository\UserRepository;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class StripeController extends AbstractController
{
    /**
     * @var CartSessionStorage
     */
    private $cartSessionStorage;
    private $productoRepository;
    public function __construct(CartSessionStorage $cartStorage, ProductosRepository $productoRepository){
        $this->cartSessionStorage = $cartStorage;
        $this->productoRepository = $productoRepository;
    }
    /**
     * @Route("/stripe", name="stripe")
     */
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }
    /**
     * @Route("/checkout_session", name="checkout")
     */
    public function checkout(){
        $total =  $this->cartSessionStorage->getCart()->getTotal();
        $img = $this->cartSessionStorage->getCart()->getItems();
        $imagen = array();
        foreach ($img as $image){
            array_push($imagen,$image->getProduct()->getImagen());
        }
        $a = $total*100;

        Stripe::setApiKey('sk_test_51Ik3C3C3IOqzxw5IitUoHr0wHKmpPRpmiUI61KcGhq4UHhNtOqfkkz5oUsG0WsA4ioDFEwl84I5CFzuBYD9rlypX00kcIediJy');


        $checkout_session = \Stripe\Checkout\Session::create([

            'payment_method_types' => ['card'],

            'line_items' => [[

                'price_data' => [

                    'currency' => 'eur',

                    'unit_amount' =>  $a,

                    'product_data' => [

                        'name' => 'Pago Freemarket',

                        'images' => [$imagen],

                    ],

                ],

                'quantity' => 1,

            ]],

            'mode' => 'payment',

            'success_url' => $this->generateUrl('succesPay',[],UrlGeneratorInterface::ABSOLUTE_URL),

            'cancel_url' => $this->generateUrl('notSuccesPay',[],UrlGeneratorInterface::ABSOLUTE_URL),

        ]);


        return new JsonResponse(['id' => $checkout_session->id]);
    }

    /**
     * @Route("/session_succes", name="succesPay")
     */
    public function succesPay(){
        $id =  $this->cartSessionStorage->getCart()->getId();


        return $this->redirectToRoute('order_details',['id' => $id]);


    }


    /**
     * @Route("/not_session_succes", name="notSuccesPay")
     */
    public function notSuccesPay(){

    }
}