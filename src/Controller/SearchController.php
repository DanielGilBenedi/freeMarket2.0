<?php


namespace App\Controller;




use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\SerializedName;


class SearchController extends AbstractController
{
    /**
     *
     * @Route("/search", name="search")
     */
   public function search(Request $request)
   {
  $data =  $request->get('productos');
      $datos = $this->getDoctrine()->getManager()->getRepository(Productos::class)->searchProd($data);

   $response = new JsonResponse();
   $response->setData($datos);
   dump($response);

   return $response;
   }
}