<?php

namespace App\Controller;


use App\Entity\Colegio;
use App\Entity\User;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function indexHome()
    {
        return $this->render('home/index.html.twig');

    }
    /**
     * @Route("/cambiocontra", name="cambiocontra")
     */
    public function base()
    {
        return $this->render('home/cambiopassword.html.twig');

    }

    /**
     * @Route("/home", name="home")
     */
    public function homeIndex()
    {
        $conexion= $this->getDoctrine()->getRepository(Colegio::class);
        $colegios=$conexion->findAll();
        return $this->render('colegio/colegiosUtad.html.twig',['colegios'=>$colegios]);

    }


    /**
     * @Route("/homeadmin", name="homeadmin")
     */
    public function homeAdmin()
    {
        $conexion= $this->getDoctrine()->getRepository(User::class);

        $allusers=$conexion->findAll();

        return $this->render('user/administracionUsers.html.twig',['allusers'=>$allusers]);

    }


}
