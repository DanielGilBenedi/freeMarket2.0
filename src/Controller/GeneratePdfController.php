<?php


namespace App\Controller;


use App\Entity\OrderItem;

use Sasedev\MpdfBundle\Factory\MpdfFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GeneratePdfController extends AbstractController
{
    /**
     * @Route("generar_pdf/{id}", name="generar_pdf", methods={"POST","GET"})

     */
    public function generarPdf(Request $request, MpdfFactory $MpdfFactory){
        $idOrder = $request->get('id');
        $order = $this->getDoctrine()
            ->getRepository(OrderItem::class)
            ->findBy(['orderRef'=> $idOrder]);
        $total = 0;
        foreach ($order as $orTot){
            $total+= $orTot->getTotal();
        }


        $mPdf = $MpdfFactory->createMpdfObject([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => 5,
            'margin_footer' => 5,
            'orientation' => 'P'
        ]);
        $mPdf->SetTopMargin("50");

        $mPdf->WriteHTML($this->renderView("OrderPdf.html.twig", $data = [
            'order' => $order,
            'total' => $total
        ]));
        return $MpdfFactory->createDownloadResponse($mPdf, "file.pdf");
    }

}