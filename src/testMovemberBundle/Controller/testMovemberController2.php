<?php


namespace testMovemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class testMovemberController extends Controller
                                  //debut translate address
{
    public function getCoordonneeAction($adresse)
    {
            $apiKey = "AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";//Indiquez ici votre clé Google maps !
            $url = "http://maps.google.com/maps/geo?q=".urlencode($adresse).
                "&output=csv&key=".$apiKey;
            $csv = file($url);
            $donnees = explode(",",$csv[0]);
            return $donnees[1].",".$donnees[2];

        $em = $this->getDoctrine()->getManager();
        $em->persist($adresse);
        $em->flush();


        return $this->render('testMovemberBundle:Default:index.html.twig');
    }
                                    // fin translate
}



// vérif appels BDD et doctrine;
// persist   flush      crud: controller index    cf new action crud comp agri;