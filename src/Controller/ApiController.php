<?php


namespace App\Controller;


use App\Repository\CategoriasRepository;
use App\Repository\MarcasRepository;
use App\Repository\ProductosRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController
{

    private $productosRepository;
    private $categoriasRepository;
    private $marcasRepository;

    public function __construct(ProductosRepository $productosRepository, CategoriasRepository $categoriasRepository, MarcasRepository $marcasRepository)
    {
        $this->productosRepository = $productosRepository;
        $this->categoriasRepository = $categoriasRepository;
        $this->marcasRepository = $marcasRepository;
    }

    /**
     *
     * @Route ("/get_products", name="get_products", methods={"GET"})
     */
    public function getProducts() : JsonResponse{

        $products = $this->productosRepository->findAll();
       $data = Array();

        foreach ($products as $product){
           array_push($data,$product = [
                'id' => $product->getId(),
                //'id_marca'=> $product->getIdMarca(),
                //'id_categoria' => $product->getIdCategoria(),
                'fecha' => $product->getFecha(),
                'cod_referencia' => $product->getCodReferencia(),
                'nombre' => $product->getNombre(),
                'precio' => $product->getPrecio(),
                'peso' => $product->getPeso(),
                'descripcion' => $product->getDescripcion(),
                'ean' => $product->getEan(),
                'imagen' => $product->getImagen(),
                'stock' => $product->getStock(),
            ]);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     *
     * @Route ("/get_products/{id}", name="get_products_id", methods={"GET"})
     */
    public function getProductsById($id) : JsonResponse{

        $products = $this->productosRepository->findOneBy(['id' => $id]);
        $data = [
            'id' => $products->getId(),
            'id_marca'=> $products->getIdMarca(),
            'id_categoria' => $products->getIdCategoria(),
            'fecha' => $products->getFecha(),
            'cod_referencia' => $products->getCodReferencia(),
            'nombre' => $products->getNombre(),
            'precio' => $products->getPrecio(),
            'peso' => $products->getPeso(),
            'descripcion' => $products->getDescripcion(),
            'ean' => $products->getEan(),
            'imagen' => $products->getImagen(),
            'stock' => $products->getStock(),
        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     *
     * @Route ("/get_products_cat/{id}", name="get_products_idCat", methods={"GET"})
     */
    public function getProductsByCat($id) : JsonResponse{

        $products = $this->productosRepository->getProductosByCat($id);
        $data = Array();

        foreach ($products as $product){
            array_push($data,$product = [
                'id' => $product->getId(),
                'id_marca'=> $product->getIdMarca(),
                'id_categoria' => $product->getIdCategoria(),
                'fecha' => $product->getFecha(),
                'cod_referencia' => $product->getCodReferencia(),
                'nombre' => $product->getNombre(),
                'precio' => $product->getPrecio(),
                'peso' => $product->getPeso(),
                'descripcion' => $product->getDescripcion(),
                'ean' => $product->getEan(),
                'imagen' => $product->getImagen(),
                'stock' => $product->getStock(),
            ]);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }


    /**
     *
     * @Route ("/get_products_marca/{id}", name="get_products_idMarca", methods={"GET"})
     */
    public function getProductsByMarca($id) : JsonResponse{

        $products = $this->productosRepository->getProductosByMarc($id);
        $data = Array();

        foreach ($products as $product){
            array_push($data,$product = [
                'id' => $product->getId(),
                'id_marca'=> $product->getIdMarca(),
                'id_categoria' => $product->getIdCategoria(),
                'fecha' => $product->getFecha(),
                'cod_referencia' => $product->getCodReferencia(),
                'nombre' => $product->getNombre(),
                'precio' => $product->getPrecio(),
                'peso' => $product->getPeso(),
                'descripcion' => $product->getDescripcion(),
                'ean' => $product->getEan(),
                'imagen' => $product->getImagen(),
                'stock' => $product->getStock(),
            ]);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     *
     * @Route ("/get_categories", name="get_categories", methods={"GET"})
     */
    public function getCategories() : JsonResponse{

        $categories = $this->categoriasRepository->findAll();
        $data = Array();

        foreach ($categories as $product){
            array_push($data,$product = [
                'id' => $product->getId(),
                'fecha' => $product->getFecha(),
                'nombre' => $product->getNombre(),
                'descripcion' => $product->getDescripcion(),
                'imagen' => $product->getImagen(),
            ]);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     *
     * @Route ("/get_marcas", name="get_marcas", methods={"GET"})
     */
    public function getMarcas() : JsonResponse{

        $marcas = $this->marcasRepository->findAll();
        $data = Array();

        foreach ($marcas as $product){
            array_push($data,$product = [
                'id' => $product->getId(),
                'fecha' => $product->getFecha(),
                'nombre' => $product->getNombre(),
                'descripcion' => $product->getDescripcion(),
                'imagen' => $product->getImagen(),
            ]);
        }
        return new JsonResponse($data, Response::HTTP_OK);
    }
}