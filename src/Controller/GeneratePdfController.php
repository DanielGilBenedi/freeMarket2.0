<?php


namespace App\Controller;


use App\Entity\OrderItem;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GeneratePdfController extends AbstractController
{
    /**
     * @Route("generar_pdf/{id}", name="generar_pdf", methods={"POST","GET"})

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
        $options = new Options();
        $options->set('defaultFont', 'Roboto');


        $dompdf = new Dompdf($options);

        $data = array(
            'headline' => 'my headline'
        );
        $html = $this->renderView("OrderPdf.html.twig", $data = [
            'order' => $order,
            'total' => $total
        ]);


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("order-$idOrder.pdf", [
            "Attachment" => true
        ]);


    }

}