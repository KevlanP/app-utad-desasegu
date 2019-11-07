<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{


    /**
     * @Route("/nuevosusuarios", name="nuevosusuarios")
     *  @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function usuarioNuevo( EntityManagerInterface $em,UserManagerInterface $userManager)
    {
        try{
                $usuario=$userManager->createUser();
                //  var_dump($_POST);
                //exit;
             if(!empty($_POST['nombre']) and !empty($_POST['email']) and !empty($_POST['password']))
                {
                    if($_POST['rolAdmin']='on')
                    {
                        $usuario->setUsername($_POST['nombre']);
                        $usuario->setEmail($_POST['email']);
                        $usuario->setPlainPassword($_POST['password']);
                        $usuario->addRole('ROLE_ADMIN');
                        $usuario->setEnabled(true);
                        $userManager->updateUser($usuario);

                        // $em->persist($usuario);
                        $em->flush();
                        return $this->redirect("homeadmin");
                    }else{
                        $usuario->setUsername($_POST['nombre']);
                        $usuario->setEmail($_POST['email']);
                        $usuario->setPlainPassword($_POST['password']);
                        $usuario->setEnabled(true);
                        $userManager->updateUser($usuario);
                        // $em->persist($usuario);
                        $em->flush();
                        return $this->redirect("homeadmin");
                    }

                }else
                {
                    unset($usuario);


                    return $this->redirect("homeadmin");
                }
        }
        catch (\Exception $ex)
        {
            return $this->redirectToRoute('homeadmin');}
    }


    /**
     * @Route("/eliminausuario/{slug}", name="eliminausuario")
     */
    public function  eliminarUsuario($slug, EntityManagerInterface $em){
        try
        {
            $user_delete = $em->getRepository(User::class)->find($slug);
            $em->remove($user_delete);
            $em->flush();
            return $this->redirectToRoute('homeadmin');
        }
        catch(\Exception $ex)
        {
             return $this->redirectToRoute('homeadmin');
        }
    }


    /**
     * @Route("/editarusuario/{slug}", name="editarusuario")
     */
    public function  updateColex($slug,UserManagerInterface $userManager,EntityManagerInterface $em){

        try{
            $usuario = $userManager->findUserByUsername($slug);

            if (!$usuario) {
                throw $this->createNotFoundException(
                    'No product found for id '.$slug
                );
            }
            if(!empty($_POST['nombreNuevo']) and !empty($_POST['emailNuevo']))
            {

                $usuario->setUsername($_POST['nombreNuevo']);
                $usuario->setEmail($_POST['emailNuevo']);
                $userManager->updateUser($usuario);
                $em->flush();
                return $this->redirectToRoute("homeadmin");
            }
            else
            {
                return $this->redirectToRoute("homeadmin");
            }
        }
        catch (\Exception $ex)
        {
            return $this->redirectToRoute('homeadmin');
        }


    }


    /**
     * @Route("/cambiocontra/verificacion", name="verificacion")
     */
    public function  actualizaPassword( EntityManagerInterface $em,UserManagerInterface $userManager){
        try
        {
            if(!empty($_POST['password1'] and !empty($_POST['password2'])))
            {

             if($_POST['password1'] === $_POST['password2'])
             {

                $usuario=$em->getRepository(User::class)->findOneBy([$this->getUser()->getUsername()]);
                 var_dump('dsbhdklsjk');die;
                $usuario->setPlainPassword($_POST['password2']);
                $userManager->updateUser($usuario);
                $em->flush();
                 return $this->redirectToRoute('home');
             }else
                 {
                     return $this->redirectToRoute('home');
                 }
            }else
                {
                    return $this->redirectToRoute('home');
                }

        }
        catch(\Exception $ex)
        {
            return $this->redirectToRoute('home');
        }
    }


}
