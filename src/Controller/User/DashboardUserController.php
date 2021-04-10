<?php
namespace App\Controller\User;



use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Productos;
use App\Entity\User;
use App\Repository\OrderItemRepository;
use App\Repository\UserRepository;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class DashboardUserController extends AbstractController
{

    private $userRepository;
    private $cartSessionStorage;
    private $entityManager;
    private $security;

    /**
     * CartManager constructor.
     *
     * @param CartSessionStorage $cartStorage
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param Security $security
     */
    public function __construct(
        CartSessionStorage $cartStorage,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        Security $security

    ) {
        $this->cartSessionStorage = $cartStorage;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->security = $security;
    }

    /**
     * @Route("/userPanel", name="userPanel")
     */

    public function getCurrUser()
    {
        $idUser = $this->userRepository->findOneBy(['email' => $this->cartSessionStorage->getIdUser($this->security->getUser())]);
        $user = $this->entityManager->getRepository(User::class)->findBy([
            'id' =>$idUser]);
        $id = $user[0]->getId();

        return $this->redirectToRoute('user_edit',['id'=>$id]);

    }

    /**
         * @Route("/userPanelPedidos", name="userPanelPedidos")
     */

    public function getCurrUserOrders()
    {
        $idUser = $this->userRepository->findOneBy(['email' => $this->cartSessionStorage->getIdUser($this->security->getUser())]);
        $user = $this->entityManager->getRepository(User::class)->findBy([
            'id' =>$idUser]);
        $id = $user[0]->getId();


        $order = $this->getDoctrine()
            ->getRepository(Order::class)
            ->findBy(['id_cliente'=> $id]);

       /* foreach ($order as $orders)
        $idOrder = $orders->getId();
        dump($idOrder);
        $order = $this->getDoctrine()
            ->getRepository(OrderItem::class)
            ->findBy(['order_ref'=> $id]);

       foreach ($idOrder as $idO){
            $order = $this->getDoctrine()
                ->getRepository(OrderItem::class)
                ->findBy(['order_ref'=> $idO]);
        }*/
       return $this->render('user/user_orders.html.twig', [
            'order' => $order,

        ]);
    }
    /**
     * @Route("detallesPedido/{id}", name="order_details", methods={"POST","GET"})
     */
    public function viewOrderDetails(Request $request){
        $idOrder = $request->get('id');
        $order = $this->getDoctrine()
            ->getRepository(OrderItem::class)
            ->findBy(['orderRef'=> $idOrder]);
    dump($order);
       /* $cont = 0;
        dump($order);
        $productsArray = Array();
        foreach ($order as $or){

            $order[$cont]->getProduct()->getId();

            $producto = $this->getDoctrine()
                ->getRepository(Productos::class)
                ->findBy(['id'=> $order[$cont]->getProduct()->getId()]);
            array_push($productsArray,$producto);

            $cont++;
        }
        dump($productsArray);
        /*$order = $this->getDoctrine()
            ->getRepository(OrderItem::class)
            ->findBy(['orderRef'=> $request->get('id')]);
        foreach ($order as $a){
            dump($a->getProduct());

*/
       return $this->render('user/order_detail.html.twig', [
            'order' => $order,


        ]);  }


}
?>
