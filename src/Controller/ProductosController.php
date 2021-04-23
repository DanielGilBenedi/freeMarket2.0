<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Entity\Marcas;
use App\Entity\Productos;
use App\Form\AddToCartType;
use App\Form\ProductosModificarType;
use App\Form\ProductosType;
use App\Manager\CartManager;
use App\Repository\ProductosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/productos")
 */
class ProductosController extends AbstractController
{
    /**
     * @Route("/", name="productos_index", methods={"GET"})
     */
    public function index(ProductosRepository $productosRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $products = $productosRepository->findAll();
        $allAppointmentsQuery = $productosRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'null')
            ->getQuery();
        $products = $paginator->paginate(
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            12
        );
        return $this->render('productos/index.html.twig', [
            'productos' => $products,
        ]);
    }

    /**
     * @Route("/new", name="productos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $producto = new Productos();


        $form = $this->createForm(ProductosType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imagen']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/productos';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_BASENAME);

                $uploadedFile->move(
                    $destination,
                    $originalFilename
                );
                $producto->setImagen($originalFilename);
                $producto->setFecha(new \DateTime("now"));
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('productos_index');
        }

        return $this->render('productos/new.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productos_show", methods={"GET","POST"})
     * @param Productos $producto
     * @return Response
     */
    public function show(Productos $producto): Response
    {
        return $this->render('productos/show.html.twig', [
            'producto' => $producto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="productos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Productos $producto): Response
    {
        $form = $this->createForm(ProductosModificarType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productos_index');
        }

        return $this->render('productos/edit.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productos_delete", methods={"POST"})
     */
    public function delete(Request $request, Productos $producto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$producto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($producto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('productos_index');
    }

    /**
     * @Route("/view/{id}", name="product.detail")
     */
    public function detail(Productos $producto, Request $request, CartManager $cartManager)
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduct($producto);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $cartManager->save($cart);

            return $this->redirectToRoute('product.detail', ['id' => $producto->getId()]);
        }

        return $this->render('productos/detail.html.twig', [
            'producto' => $producto,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/productos", name="productos_categoria",  methods={"GET"})
     */
    public function prodCategoria(Categorias $categoria, Request $request, PaginatorInterface $paginator, ProductosRepository $productoRepository) : Response{


        $allAppointmentsQuery = $productoRepository->getProductosByCat($categoria->getId());
        $products = $paginator->paginate(
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            12
        );
        return $this->render('categorias/product_colection.html.twig', [
            'categorias' => $products,
        ]);
    }



    /**
     * @Route("/{id}/productos-marcas", name="productos_marca",  methods={"GET"})
     */
    public function prodMarca(Marcas $categoria, Request $request, PaginatorInterface $paginator, ProductosRepository $productoRepository) : Response{


        $allAppointmentsQuery = $productoRepository->getProductosByMarc($categoria->getId());
        $products = $paginator->paginate(
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            12
        );
        return $this->render('marcas/product_colection.html.twig', [
            'categorias' => $products,
        ]);
    }
}
