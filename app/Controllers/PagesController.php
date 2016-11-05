<?php

namespace  App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PagesController extends Controller {

    public function home(RequestInterface $request, ResponseInterface $response){
        $this->render($response, 'pages/home.twig', ['name' => 'Max']);
    }

    public function getContact(RequestInterface $request, ResponseInterface $response){
        return $this->render($response, 'pages/contact.twig');
    }

    public function postContact(RequestInterface $request, ResponseInterface $response){

        if(false) {
            $this->flash('Votre message a bien été envoyé');

        } else {
            $this->flash('Certains champs n\'ont pas été rempli correctement', 'error');

        }


      /*  $message = \Swift_Message::newInstance('Message de contact')
                    ->setFrom([$request->getParam('email') => $request->getParam('name')])
                    ->setTo('contact@monsite.fr')
                    ->setBody("Un email vous a été envoyé :
                    {$request->getParam('content')}");

        $this->mailer->send($message);*/
       return $this->redirect($response, 'contact');
    }
}
