<?php


namespace App\Controller;


use App\Entity\OrderItem;
use Dompdf\Dompdf;
use Dompdf\Options;
use Sasedev\MpdfBundle\Factory\MpdfFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        // Configure Dompdf según sus necesidades
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Crea una instancia de Dompdf con nuestras opciones
        $dompdf = new Dompdf($pdfOptions);

        // Recupere el HTML generado en nuestro archivo twig
        $html = $this->renderView("OrderPdf.html.twig", $data = [
            'order' => $order,
            'total' => $total
        ]);

        //Cargar HTML en Dompdf
        $dompdf->loadHtml($html);

        // (Opcional) Configure el tamaño del papel y la orientación 'vertical' o 'vertical'
        $dompdf->setPaper('A4', 'portrait');

        // Renderiza el HTML como PDF
        $dompdf->render();

        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

        // Envía una respuesta de texto
        return new Response("¡El archivo PDF se ha generado correctamente!");


    }

}