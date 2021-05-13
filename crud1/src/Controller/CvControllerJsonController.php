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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\Json;




class CvControllerJsonController extends AbstractController
{



    /**
     * @Route("/deleteCvv", name="delete_cv")
     * @Method("DELETE")
     */

    public function deleteReclamationAction(Request $request) {
        $id = $request->get("id");

        $em = $this->getDoctrine()->getManager();
        $cv = $em->getRepository(Cv::class)->find($id);
        if($cv!=null ) {
            $em->remove($cv);
            $em->flush();

            $serialize = new Serializer([new ObjectNormalizer()]);
            $formatted = $serialize->normalize("Cv a ete supprimee avec success.");
            return new JsonResponse($formatted);

        }
        return new JsonResponse("id cv invalide.");


    }




    /******************Ajouter Reclamation*****************************************/
    /**
     * @Route("/addReclamation", name="add_reclamation")
     * @Method("POST")
     */

    public function ajouterReclamationAction(Request $request)
    {
        $cv = new Cv();
        $nom = $request->query->get("nom");
        $prenom = $request->query->get("prenom");



        $photo = $request->query->get("photo");
        $email = $request->query->get("email");
        $telephone = $request->query->get("telephone");
        $adresse = $request->query->get("adresse");
        $codepostale = $request->query->get("codepostale");
        $ville = $request->query->get("ville");
        $datedenaissance = new \DateTime('now');
        $lieu = $request->query->get("lieu");
        $sexe = $request->query->get("sexe");
        $etatcivil = $request->query->get("etatcivil");
        $formation = $request->query->get("formation");
        $etablif = $request->query->get("etablif");
        $stage = $request->query->get("stage");
        $etablis = $request->query->get("etablis");

        $experience = $request->query->get("experience");
        $tablie= $request->query->get("tablie");
        $centredinteret = $request->query->get("centredinteret");

        $longtitude = $request->query->get("longtitude");
        $altitude = $request->query->get("altitude");



        $em = $this->getDoctrine()->getManager();




        $cv->setPhoto("aa");


        $cv->setNom($nom);


        $cv->setPrenom($prenom);




        $cv->setEmail("aa");


        $cv->setTelephone(0000);


        $cv->setAdresse("aa");


        $cv->setCodepostale( 000);


        $cv->setVille("aa");


        $cv->setDatedenaissance($datedenaissance);


        $cv->setLieu("aa");

        $cv->setSexe("aa");


        $cv->setEtatcivil( "aa");


        $cv->setFormation( "aa");


        $cv->setEtablif( "aa");


        $cv->setStage("aa");


        $cv->setEtablis( "aa");


        $cv->setExperience( "aa");


        $cv->setTablie( "aa");


        $cv->setCentredinteret( "aa");


        $cv->setLongtitude( 0);


        $cv->setAltitude(0);


        $em->persist($cv);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cv);
        return new JsonResponse($formatted);

    }











    /**
     * @Route("/detailCv", name="detail_Cv")
     * @Method("GET")
     */

    //Detail Reclamation
    public function detailCv(Request $request)
    {
        $id = $request->get("id");

        $em = $this->getDoctrine()->getManager();
        $cv = $this->getDoctrine()->getManager()->getRepository(Cv::class)->find($id);
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getDescription();
        });
        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($cv);
        return new JsonResponse($formatted);
    }




    /**
     * @Route("/updateReclamation", name="update_reclamation")
     * @Method("PUT")
     */
    public function modifierReclamationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $cv = $this->getDoctrine()->getManager()
            ->getRepository(Cv::class)
            ->find($request->get("id"));





        $cv->setNom($request->get("nom"));
        $cv->setPrenom($request->get("prenom"));

        $em->persist($cv);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cv);
        return new JsonResponse("Cv a ete modifiee avec success.");

    }













}






