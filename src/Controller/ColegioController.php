<?php

namespace App\Controller;

use App\Entity\Colegio;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ColegioController extends AbstractController
{
    /**
     * @Route("/eliminarcolegio/{slug}", name="eliminacolegio")
     */
    public function  deleteColex($slug, EntityManagerInterface $em){
        try
        {
            $user_delete = $em->getRepository(Colegio::class)->find($slug);
            $em->remove($user_delete);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        catch(\Exception $ex)
        {
           return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/nuevocole",name="nuevocolegio")
    */

    public function  addColex(EntityManagerInterface $em)
    {

      $nuevoCole=new Colegio();
      if(!empty($_POST['nombre']) and !empty($_POST['comunidad']))
      {
          $nuevoCole->setNombre($_POST['nombre']);
          $nuevoCole->setComunidadAtonoma($_POST['comunidad']);
          $em->persist($nuevoCole);
          $em->flush();
          return $this->redirect("home");
      }else
        {
            unset($nuevoCole);


          return $this->redirect("home");
      }
    }

    /**
     * @Route("/editarcolegio/{slug}", name="editarcolegio")
     */
    public function  updateColex($slug,EntityManagerInterface $em){


        $colegio=$em->getRepository(Colegio::class)->find($slug);

        if (!$colegio) {
            throw $this->createNotFoundException(
                'No product found for id '.$slug
            );
        }
        if(!empty($_POST['nombreNuevo']) and !empty($_POST['comunidadNueva']))
        {
            $colegio->setNombre($_POST['nombreNuevo']);
            $colegio->setComunidadAtonoma($_POST['comunidadNueva']);
            $em->flush();

            return $this->redirectToRoute("home");
        }
        else
        {
             return $this->redirectToRoute("home");
        }


    }
}
