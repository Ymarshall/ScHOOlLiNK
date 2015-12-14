<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Swift_Transport;
class AccueilController extends Controller
{
    public function indexAction()
    {
        return $this->render('SLPlateformBundle:Accueil:index.html.twig');
    }
    
    public function aboutAction()
    {
        return $this->render('SLPlateformBundle:Accueil:about.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('SLPlateformBundle:Accueil:contact.html.twig');
    }
    
    public function mailAction(Request $request)
    {
           
        /*    $transport = \Swift_SmtpTransport::newInstance('smtp.example.ci', 25)
  ->setUsername('brossoukevin@gamil.com')
  ->setPassword('cristiano07')
  ; 
            $mailer = \Swift_Mailer::newInstance($transport);
            $message = \Swift_Message::newInstance('Wonderful Subject')
            ->setSubject('Mail de contact')
            ->setTo('brossoukevin@yahoo.fr')
            ->setBody($request->get('message','text/plain'))
            ->addPart("<p>La version HTML.</p>", 'text/html')
             ;
          ;
            
           $result=$mailer->send($message);
           if($result){
        $request->getSession()->getFlashBag()->add('notice', 'Message envoyé.');
            return $this->redirect($this->get('router')->generate('sl_plateform_contact'));
           }else{
        
        $request->getSession()->getFlashBag()->add('notice', 'Message non envoyé.');
            return $this->redirect($this->get('router')->generate('sl_plateform_contact'));
           }*/
    }
}
