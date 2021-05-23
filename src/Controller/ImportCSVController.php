<?php


namespace App\Controller;
//use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use App\Entity\Categorias;
use App\Entity\Marcas;
use App\Entity\Productos;
use App\Form\MasiveImportType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;


class ImportCSVController extends AbstractController
{
    // change these options about the file to read
  /*  private $csvParsingOptions = array(
        'finder_in' => 'app/Resources/',
        'finder_name' => 'countries.csv',
        'ignoreFirstLine' => true
    );*/


    /**
     * @Route("/carga_masiva", name="carga_masiva", methods={"GET","POST"})
     */
    public function cargaMasiva(Request $request){
        $producto = new Productos();
        $categoria = new Categorias();
        $form = $this->createForm(MasiveImportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['fichero']->getData();

            if ($uploadedFile) {
                $destination = $this->getParameter('kernel.project_dir') . '/public/uploads/CSV';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_BASENAME);

                $uploadedFile->move(
                    $destination,
                    $originalFilename
                );

                $array = Array();
                $fp = fopen ($destination.'/'.$originalFilename,"r");
                $count = 0;
                while ($data = fgetcsv ($fp, 1000, ",")) {
                    $count++;
                    if($count==1){
                        continue;
                    }else{
                        array_push($array,$data);
                    }

                }
                fclose ($fp);

                for($i = 0; $i < count($array); $i++){
                    $entityManager = $this->getDoctrine()->getManager();
                    $cate = $entityManager->getRepository(Categorias::class)->findOneBy(['nombre' => $array[$i][4]]);
                    $mar = $entityManager->getRepository(Marcas::class)->findOneBy(['nombre' => $array[$i][3]]);
                    $prod = $entityManager->getRepository(Productos::class)->findOneBy(['ean' => $array[$i][5]]);
                    if(isset($prod)){
                        continue;
                    }else{
                        $producto->setFecha(new \DateTime("now"));
                        $producto->setCodReferencia('1234');
                        $producto->setNombre($array[$i][1]);
                        $producto->setUrl($array[$i][0]);
                        $producto->setTitulo($array[$i][1]);
                        $producto->setDescripcion($array[$i][2]);
                        $producto->setIdMarca($mar);
                        $producto->setIdCategoria($cate);
                        $producto->setEan($array[$i][5]);
                        $producto->setPeso($array[$i][6]);
                        $producto->setStock($array[$i][7]);
                        $producto->setPrecio($array[$i][8]);
                        $producto->setImagen($array[$i][9]);



                        $entityManager->persist($producto);
                        $entityManager->flush();
                        $entityManager->clear();


                    }

                }

                //Llamamos a Categorias para obtener el nombre----queda hacer la relación con los campos para
                //subirlos a la base de datos con el ID referenciado

                //dump($product);


                $fileSystem = new Filesystem();
                $fileSystem->remove($destination.'/'.$originalFilename);

            }

        }
        return $this->render('productos/carga_masiva.html.twig', [
                'form' => $form->createView(),

        ]);
    }
}