<?php

namespace App\Controller;
use App\Entity\Cv;
use App\Form\CvType;

use App\Repository\CvRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CvController extends AbstractController
{
    /**
     * @Route("/cv", name="cv")
     */
    public function index(CvRepository $cvrepository): Response
    {
        return $this->render('cv/index.html.twig', [
            'cvs' => $cvrepository->findAll(),

        ]);

    }

    /**
     * @Route("/cvadmin", name="cvadmin")
     */
    public function viewadmin(CvRepository $cvrepository): Response
    {
        return $this->render('cv/Admincv.html.twig', [
            'cvs' => $cvrepository->findAll(),
        ]);
    }

    /**
     * @Route("/choix", name="choix")
     */
    public function viewchoix(CvRepository $cvrepository): Response
    {
        return $this->render('cv/choix.html.twig', [
            'cvs' => $cvrepository->findAll(),
        ]);
    }

    /**
     * @Route("/tam1", name="tam1")
     */
    public function viewtam1(CvRepository $cvrepository): Response
    {
        return $this->render('cv/tam1.html.twig', [
            'cvs' => $cvrepository->findAll(),
        ]);
    }

    /**
     * @Route("/tam2", name="tam2")
     */
    public function viewtam2(CvRepository $cvrepository): Response
    {
        return $this->render('cv/tam2.html.twig', [
            'cvs' => $cvrepository->findAll(),
        ]);
    }






    /**
     * @Route("/ajoutCv", name="ajoutCv", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cv = new Cv();

        $form = $this->createForm(CvType::class, $cv)->add('Ajouter',SubmitType::class ,['label'=> 'Ajouter']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('photo')->getData();


            if ($imageFile) {


                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageFile->move(
                        'C:/wamp64/www/crudd/public/uploads',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $cv->setPhoto($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cv);
            $entityManager->flush();

            return $this->redirectToRoute('choix');
        }


        return $this->render('Cv/Ajoutercv.html.twig', [
            'cv' => $cv,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/suppCv", name="supprimerCv", methods={"GET"})
     */
    public function delete($id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $cv=$this->getDoctrine()->getRepository(Cv::class)
            ->find($id);
        if($cv!=null){
            $entityManager->remove($cv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ajoutCv');
    }


    /**
     * @Route("/{id}/AdminsuppCv", name="AdminsupprimerCv", methods={"GET"})
     */
    public function remove($id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $cv=$this->getDoctrine()->getRepository(Cv::class)
            ->find($id);
        if($cv!=null){
            $entityManager->remove($cv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cvadmin');
    }




    /**
     * @Route("/{id}/modifierCv", name="modifierCv", methods={"GET","POST"})
     */
    public function edit(Request $request, Cv $cv): Response
    {

        $form = $this->createForm(CvType::class, $cv)->add('Modifier',SubmitType::class ,['label'=> 'Modifier']);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('choix');
        }

        return $this->render('Cv/modifierCv.html.twig', [
            'cv' => $cv,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/cvpdf", name="Cvpdf", methods={"GET","POST"})
     */
    public function cvpdf(CvRepository $cvrepository): Response
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('cv/tam1.html.twig', [
            'title' => "mon CV",
            'cvs' => $cvrepository->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = 'C:/wamp64/www/crudd/public';
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/monCv.pdf';

        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);

        // Send some text response
        return $this->redirectToRoute('tam1');

    }




}
