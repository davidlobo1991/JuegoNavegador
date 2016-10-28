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
        $em = $this->getDoctrine()->getManager();

        $username = $this->getUser()->getCaracteristicas();
        $repository = $em
            ->getRepository('JuegoBundle:Caracteristicas')
            ->getCaracteristicas($username);

        $modificaciones = $em
            ->getRepository('JuegoBundle:Modificaciones')
            ->findAll();

        $user = $this->getUser();
        return $this->render('JuegoBundle:Default:profile.html.twig', array('user' => $user, 'caracteristicas' => $repository, 'modificaciones' => $modificaciones));
    }

    public function aumentarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
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

            $repository = $em
                ->getRepository('JuegoBundle:Caracteristicas')
                ->updateCaracteristica($username, $caractToModify, $caract);

            $borrar = $em
                ->getRepository('JuegoBundle:Modificaciones')
                ->getModificacion($this->getUser()->getId(), $caractToModify);

            $em->remove($borrar);
            $em->flush();

            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',
                'repository' => $serializer->serialize($repository, 'json'),
                'borrar' => $borrar,
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
        $valor = "";

        if ($request->isXmlHttpRequest()) {
            $llave = "";
            $all = $request->request->all();

            foreach ($all as $key => $value) {
                $llave = $key;
                $valor = $value;
            }

            $helper = strpos($llave, '_');
            $caractToModify = substr($llave, $helper + 1);
            $fecha = new DateTime();

            $tiempo = $this->getDoctrine()
                ->getManager()
                ->getRepository('JuegoBundle:'.$caractToModify)
                ->find($valor);

            $modificacion = new Modificaciones();
            $modificacion->setValor($caractToModify);
            $modificacion->setUser($this->getUser());
            $modificacion->setFecha($fecha);
            $em = $this->getDoctrine()->getManager();
            $em->persist($modificacion);
            $em->flush();

            $duracion = $tiempo->getTiempo();
            $jetzt = $modificacion->getFecha();



            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',
                'jetzt' => $serializer->serialize($jetzt, 'json'),
                'end' => $serializer->serialize($duracion, 'json'),
            ));
            return $response;
        }
        return new Response("");
    }



    public function modificacionesSeguidoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $valor = "";

        if ($request->isXmlHttpRequest()) {
            $llave = "";
            $all = $request->request->all();

            foreach ($all as $key => $value) {
                $llave = $key;
                $valor = $value;
            }

            $helper = strpos($llave, '_');
            $caractToModify = substr($llave, $helper + 1);

            $tiempo = $this->getDoctrine()
                ->getManager()
                ->getRepository('JuegoBundle:'.$caractToModify)
                ->find($valor);

            $tiempo_comienzo = $this->getDoctrine()
                ->getManager()
                ->getRepository('JuegoBundle:Modificaciones')
                ->getModificacion($this->getUser()->getId(), $caractToModify);


            $duracion = $tiempo->getTiempo();
            $tiempo_comi = $tiempo_comienzo->getFecha();

            $response = new JsonResponse();
            $response->setStatusCode(200);
            $response->setData(array(
                'response' => 'success',
                'fecha' => $serializer->serialize($tiempo_comi, 'json'),
                'end' => $serializer->serialize($tiempo, 'json'),
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
