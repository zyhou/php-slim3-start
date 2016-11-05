<?php

namespace  App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PagesController extends Controller {

    public function home(RequestInterface $request, ResponseInterface $response){
        $this->render($response, 'pages/home.twig', ['name' => 'Max']);
    }

    public function getContact(RequestInterface $request, ResponseInterface $response){
        $flash = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
        $_SESSION['flahs'] = [];
        return $this->render($response, 'pages/contact.twig', ['flash' => $flash]);
    }

    public function postContact(RequestInterface $request, ResponseInterface $response){

        $_SESSION['flash'] = [
            'success' => 'Votre message a bien été envoyé'
        ];

      /*  $message = \Swift_Message::newInstance('Message de contact')
                    ->setFrom([$request->getParam('email') => $request->getParam('name')])
                    ->setTo('contact@monsite.fr')
                    ->setBody("Un email vous a été envoyé :
                    {$request->getParam('content')}");

        $this->mailer->send($message);*/
        return $this->redirect($response, 'contact');
    }
}
