<?php


namespace App\Manager;


use App\Entity\Order;
use App\Entity\Productos;
use App\Entity\User;
use App\Factory\OrderFactory;
use App\Form\EventListener\RemoveCartItemListener;
use App\Repository\ProductosRepository;
use App\Repository\UserRepository;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Contracts\EventDispatcher\Event;


class CartManager
{
    /**
     * @var CartSessionStorage
     */
    private $cartSessionStorage;

    /**
     * @var OrderFactory
     */
    private $cartFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ProductosRepository
     */
    private $productoRepository;
    /**
     * @var Security
     */
    private $security;

    /**
     * CartManager constructor.
     *
     * @param CartSessionStorage $cartStorage
     * @param OrderFactory $orderFactory
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param Security $security
     * @param ProductosRepository $productoRepository
     */
    public function __construct(
        CartSessionStorage $cartStorage,
        OrderFactory $orderFactory,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Security $security,
        ProductosRepository $productoRepository
    ) {
        $this->cartSessionStorage = $cartStorage;
        $this->cartFactory = $orderFactory;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->productoRepository = $productoRepository;
    }

    /**
     * Gets the current cart.
     *
     * @return Order
     */
    public function getCurrentCart(): Order
    {
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = $this->cartFactory->create();
        }

        return $cart;
    }
    /**
     * Persists the cart in database and session.
     *
     * @param Order $cart
     */
    public function save(Order $cart): void
    {
        // Persist in database

        $idUser = $this->userRepository->findOneBy(['id' => $this->security->getUser()->getId()]);
        $cart->setIdCliente($idUser);
        $order = $this->cartSessionStorage->getCart();

        foreach ($order->getItems() as $orders){
            $product = $this->productoRepository->findOneBy(['id' => $orders->getProduct()->getId()]);
            dump($product);
            $product->setStock($product->getStock()-$orders->getCantidad());
        }

        $this->entityManager->persist($cart);
        $this->entityManager->flush();


        $this->cartSessionStorage->setCart($cart);


    }







}