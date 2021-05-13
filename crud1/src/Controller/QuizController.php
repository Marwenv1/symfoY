<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\Resultat;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index(QuizRepository $qzrepository): Response
    {
        return $this->render('quiz/index.html.twig', [
            'quizs' => $qzrepository->findAll(),
        ]);
    }

    /**
     * @Route("/quizadmin ", name="quizadmin")
     */
    public function viewadminn(QuizRepository $qzrepository ): Response
    {
        return $this->render('quiz/Adminquiz.html.twig', [
            'quizs' => $qzrepository->findAll(),

        ]);
    }






    /**
     * @Route("/ajoutQuiz", name="ajoutQuiz", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quiz = new Quiz();

        $form = $this->createForm(QuizType::class, $quiz)
        ->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('quiz');
        }


        return $this->render('Quiz/Ajoutquiz.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/modifierQuiz", name="modifierQuiz", methods={"GET","POST"})
     */
    public function edit(Request $request, Quiz $quiz): Response
    {
        $form = $this->createForm(QuizType::class, $quiz)
            ->add('Modifier',SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quiz');
        }

        return $this->render('Quiz/modifierQuiz.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/suppQuiz", name="supprimerQuiz", methods={"GET"})
     */
    public function delete($id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $quiz=$this->getDoctrine()->getRepository(Quiz::class)
            ->find($id);
        if($quiz!=null){
            $entityManager->remove($quiz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quiz');
    }



    /**
     * @Route("/{id}/AdminsuppQuiz", name="AdminsupprimerQuiz", methods={"GET"})
     */
    public function removea($id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $quiz=$this->getDoctrine()->getRepository(Quiz::class)
            ->find($id);
        if($quiz!=null){
            $entityManager->remove($quiz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quizadmin');
    }

    /**
     * @Route("/{id}/detailQuiz", name="detailQuiz", methods={"GET"})
     */
    public function detailQuiz(QuizRepository $qzrepository,$id): Response
    {

        $quiz=$qzrepository->find($id);
        return $this->render('quiz/detailQuiz.html.twig', [
            'quiz' => $quiz,
        ]);

    }


    /**
     * @Route("/{id}/ajoutQuestion", name="ajoutQuestion", methods={"GET","POST"})
     */
    public function newQuestion(Request $request,$id): Response
    {
        $question = new Question();
        $question->setQuestion($request->get('question'));
        $question->setChoix1($request->get('choix1'));
        $question->setChoix2($request->get('choix2'));
        $question->setChoix3($request->get('choix3'));
        $reponse=$request->get('reponse');
        if($reponse==1){
            $question->setReponse($request->get('choix1'));
        }
        elseif ($reponse==2){
            $question->setReponse($request->get('choix2'));
        }
        else{
            $question->setReponse($request->get('choix3'));
        }


        $quiz=$this->getDoctrine()->getRepository(Quiz::class)->find($id);
        $question->setQuizz($quiz);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($question);
        $entityManager->flush();

        return $this->redirectToRoute('detailQuiz',array('id' => $id));

    }

    /**
     * @Route("/{id}/modifierQuestion", name="modifierQuestion", methods={"GET","POST"})
     */
    public function editQuestion(Request $request, $id): Response
    {
        $question=$this->getDoctrine()->getRepository(Question::class)->find($id);
        $question->setQuestion($request->get('question'));
        $question->setChoix1($request->get('choix1'));
        $question->setChoix2($request->get('choix2'));
        $question->setChoix3($request->get('choix3'));

        $reponse=$request->get('reponse');

        if($reponse==1){
            $question->setReponse($request->get('choix1'));
        }
        elseif ($reponse==2){
            $question->setReponse($request->get('choix2'));
        }
        else{
            $question->setReponse($request->get('choix3'));
        }


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($question);
        $entityManager->flush();


        return $this->redirectToRoute('detailQuiz',array('id' => $question->getQuizz()->getId()));
    }

    /**
     * @Route("/{id}/suppQuestion", name="suppQuestion", methods={"GET"})
     */
    public function removeQuestion($id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $question=$this->getDoctrine()->getRepository(Question::class)
            ->find($id);
        if($question!=null){
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detailQuiz',array('id' => $question->getQuizz()->getId()));
    }

    /**
     * @Route("/{id}/testQuiz", name="testQuiz", methods={"GET"})
     */
    public function testQuiz(QuizRepository $qzrepository,$id): Response
    {

        return $this->render('quiz/test.html.twig', [
            'quiz' => $qzrepository->find($id),
        ]);

    }



    /**
     * @Route("/endQuiz/{id}/{result}", name="endQuiz", methods={"GET","POST"})
     */
    public function newResultat(Request $request,$id,$result): Response
    {
        $resultat = new Resultat();
        $resultat->setNote($result);
        $quiz=$this->getDoctrine()->getRepository(Quiz::class)->find($id);
        $resultat->setQuiz($quiz);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($resultat);
        $entityManager->flush();


        return $this->redirectToRoute('resultatQuiz',array('result' => $result));

    }

    /**
     * @Route("/{result}/resultatQuiz", name="resultatQuiz", methods={"GET"})
     */
    public function resultat($result): Response
    {

        return $this->render('quiz/result.html.twig', [
            'resultat' => $result,
        ]);

    }

    /**
     * @Route("/rechercheQuiz", name="search")
     */
    public function search()
    {
        return $this->render('quiz/search.html.twig', [
        ]);
    }

    /**
     * @Route("/searchfunc", name="searchfunc",methods={"POST"})
     */
    public function searchfunc(Request $request,QuizRepository $qzrepository)
    {


        $requestString = $request->get('q');

        $entities =  $qzrepository->search($requestString);

        if(!$entities) {
            $result['entities']['error'] = "Aucune quiz trouvée";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($quizs){

        foreach ($quizs as $q){
            $realEntities[$q->getId()] = [$q->getTitle()];
        }
        return $realEntities;
    }




}


