<?php

namespace testMovemberBundle\Controller;

use testMovemberBundle\Entity\testMovember;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Testmovember controller.
 *
 */
class testMovemberController extends Controller
{
    /**
     * Lists all testMovember entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $testMovembers = $em->getRepository('testMovemberBundle:testMovember')->findAll();

        return $this->render('testMovemberBundle:testmovember:index.html.twig', array(
            'testMovembers' => $testMovembers,
        ));
    }

    /**
     * Creates a new testMovember entity.
     *
     */
    public function newAction(Request $request)
    {
        $testMovember = new testMovember();
        $form = $this->createForm('testMovemberBundle\Form\testMovemberType', $testMovember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $url = "https://maps.google.com/maps/api/geocode/json?address=".$testMovember->getAdresse()."&key=AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";

// get the json response
            $resp_json = file_get_contents($url);

// decode the json
            $resp = json_decode($resp_json, true);

// response status will be 'OK', if able to geocode given address
            if ($resp['status'] == 'OK') {

                // get the important data
                $lati = $resp['results'][0]['geometry']['location']['lat'];
                $longi = $resp['results'][0]['geometry']['location']['lng'];


                // verify if data is complete
                if ($lati && $longi) {
                    $testMovember->setLat($lati);
                    $testMovember->setLgt($longi);


                    $em = $this->getDoctrine()->getManager();
                    $em->persist($testMovember);
                    $em->flush($testMovember);

                }
            }


            return $this->redirectToRoute('testmovember_show', array('id' => $testMovember->getId()));
        }

        return $this->render('testMovemberBundle:testmovember:new.html.twig', array(
            'testMovember' => $testMovember,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a testMovember entity.
     *
     */
    public function showAction(testMovember $testMovember)
    {
        $deleteForm = $this->createDeleteForm($testMovember);

        return $this->render('testMovemberBundle:testmovember:show.html.twig', array(
            'testMovember' => $testMovember,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing testMovember entity.
     *
     */
    public function editAction(Request $request, testMovember $testMovember)
    {
        $deleteForm = $this->createDeleteForm($testMovember);
        $editForm = $this->createForm('testMovemberBundle\Form\testMovemberType', $testMovember);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('testmovember_edit', array('id' => $testMovember->getId()));
        }

        return $this->render('testMovemberBundle:testmovember:edit.html.twig', array(
            'testMovember' => $testMovember,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a testMovember entity.
     *
     */
    public function deleteAction(Request $request, testMovember $testMovember)
    {
        $form = $this->createDeleteForm($testMovember);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($testMovember);
            $em->flush($testMovember);
        }

        return $this->redirectToRoute('testmovember_index');
    }

    /**
     * Creates a form to delete a testMovember entity.
     *
     * @param testMovember $testMovember The testMovember entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(testMovember $testMovember)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('testmovember_delete', array('id' => $testMovember->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


/*   //debut translate address ***************************
    public $adresse;
    public function getAdresseAction(Request $request)
        {
            $Request=$this->getRequest();
            if ($Request->getMethod()=="POST") {
    
                $adresse = $Request->get("adresse");
                $apiKey = "AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";//Indiquez ici votre clé Google maps !
                $url = "http://maps.google.com/maps/geo?q=".urlencode('28100').
                    "&output=csv&key=".$apiKey;
                $csv = file($url);
                $donnees = explode(",",$csv[0]);
                $testMovember->setLat = '1';
                $testMovember->setLgt = '2';

                $em = $this->getDoctrine()->getManager();
                $em->persist($testMovember);
                $em->flush();

                return $this->render('testMovemberBundle:testmovember:show.html.twig');


            }


    
    
    
            //return $this->render('testMovemberBundle:Default:index.html.twig');
        }
    
        // fin translate de merde qui marche pas pour le moment ***************************
*/

    //   ***************************************** code Ludo ******************

    /***************************************** code Ludo *********************************/

    public function getAdresseAction(Request $request)
    {
        // google map geocode api url
        $url = "https://maps.google.com/maps/api/geocode/json?address=chartres&key=AIzaSyBSFjZGurwwEtOnMOg1mKgJgS3WcP8ucrk";

// get the json response
        $resp_json = file_get_contents($url);

// decode the json
        $resp = json_decode($resp_json, true);

// response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {

            // get the important data
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];


            // verify if data is complete
            if ($lati && $longi) {
                $testMovember = new Testmovember();
                $testMovember->setLat = $lati;
                $testMovember->setLgt = $longi;


                $em = $this->getDoctrine()->getManager();
                $em->persist($testMovember);
                $em->flush($testMovember);

            } else {
                return false;
            }

        } else {
            return false;

        }

    }


    /*   ********************************* fin code Ludo ************************/


}
