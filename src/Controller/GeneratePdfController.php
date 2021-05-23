<?php


namespace App\Controller;


use App\Entity\OrderItem;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GeneratePdfController extends AbstractController
{
    /**
     * @Route("generar_pdf/{id}", name="generar_pdf", methods={"POST","GET"})
     * @param Pdf $pdf
     */
    public function generarPdf(Pdf $pdf, Request $request){
        $idOrder = $request->get('id');
        $order = $this->getDoctrine()
            ->getRepository(OrderItem::class)
            ->findBy(['orderRef'=> $idOrder]);
        $total = 0;
        foreach ($order as $orTot){
            $total+= $orTot->getTotal();
        }
        $html = $this->renderView("OrderPdf.html.twig", $data = [
            'order' => $order,
            'total' => $total
        ]);

        $filename = "pedido$idOrder.pdf";
        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            $filename,
            $this->redirectToRoute('user_index')
        );


    }
}