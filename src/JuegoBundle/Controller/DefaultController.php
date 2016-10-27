<?php

namespace JuegoBundle\Controller;

use JuegoBundle\Entity\Modificaciones;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('JuegoBundle:Default:index.html.twig');
    }

    public function perfilAction(Request $request)
    {
        $username = $this->getUser()->getCaracteristicas();
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('JuegoBundle:Caracteristicas')
            ->getCaracteristicas($username);

        $user = $this->getUser();
        return $this->render('JuegoBundle:Default:profile.html.twig', array('user' => $user, 'caracteristicas' => $repository));
    }

    public function aumentarAction(Request $request)
    {
        $response = "";
        $llave = "";
        $valor = "";

        if ($request->isXmlHttpRequest()) {
            $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);


            $username = $this->getUser()->getCaracteristicas();
            $all = $request->request->all();

            foreach ($all as $key => $value) {
                $llave = $key;
                $valor = $value;
            }

            $caract = $valor + 1;
            $helper = strpos($llave, '_');
            $caractToModify = substr($llave, $helper + 1);

            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('JuegoBundle:Caracteristicas')
                ->updateCaracteristica($username, $caractToModify, $caract);

            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',
                'repository' => $serializer->serialize($repository, 'json'),
                'caract' => $caract,
                'llave' => $caractToModify
            ));
        }

        return $response;
    }

    public function modificacionesAction(Request $request)
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        if ($request->isXmlHttpRequest()) {
            $llave = "";
            $all = $request->request->all();

            foreach ($all as $key => $value) {
                $llave = $key;
            }

            $helper = strpos($llave, '_');
            $caractToModify = substr($llave, $helper + 1);
            $fecha = new DateTime();

            $modificacion = new Modificaciones();
            $modificacion->setValor($caractToModify);
            $modificacion->setUser($this->getUser());
            $modificacion->setFecha($fecha);
            $em = $this->getDoctrine()->getManager();
            $em->persist($modificacion);
            $em->flush();

            $jetzt = $modificacion->getFecha();

            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',
                'jetzt' => $serializer->serialize($jetzt, 'json'),
            ));

            return $response;
        }

        return new Response("");
    }

    public function tutorial_cambioAction(Request $request)
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        if ($request->isXmlHttpRequest()) {
            $a = $this->getUser()->getTutorial();
            $a++;
            $this->getUser()->setTutorial($a);
            $em = $this->getDoctrine()->getManager();
            $em->persist($this->getUser());
            $em->flush();

            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',
                'user' => $serializer->serialize($this->getUser(), 'json'),
                'html' => $this->renderView('JuegoBundle:Default:tutorial.html.twig', array('user' => $this->getUser()))
            ));

            return $response;
        }

        return new Response("");
    }
}
