<?php

namespace Blackshawk\SymfonyReactorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    protected static $runCount = 0;
    
    public function indexAction($name)
    {
        self::$runCount++;
        
        return $this->render('BlackshawkSymfonyReactorBundle:Default:index.html.twig', array('name' => $name, 'runcount' => self::$runCount));
    }
}
