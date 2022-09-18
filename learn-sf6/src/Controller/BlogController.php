<?php

namespace App\Controller;

use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlogController extends AbstractController
{
    public function menu()
    {
        $listMenu = array(
            array('title'=>'Mon Blog','texte'=>'Accueil','url'=>$this->generateUrl('homepage',[],UrlGeneratorInterface::ABSOLUTE_URL)),
            array('title'=>'Login','texte'=>'connexion','url'=>"/login")
        );
        
        return $this->render("parts/menu.html.twig",array(
            'listmenu'=>$listMenu
        ));
    }
    

    
    #[Route('/index', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }  
   
    
    #[Route('/edit', name: 'app_edit')]
    public function edit($id)
        {
            return $this->render("blog/edition.html.twig",["id"=>$id]);
        }
        
    #[Route('/add', name: 'app_add')]
    public function add()
        {
            return $this->render("blog/ajout.html.twig");
        }
        
    #[Route('/show', name: 'app_show')]
    public function show($url,$id)
        {
            return $this->render("blog/lecture.html.twig",["url"=>$url,"id"=>$id]);
        }
        
    #[Route('/remove', name: 'app_remove')]
    public function remove($id)
        {
            return new Response('<h1>Supprimer l\'article ' .$id. '</h1>');
        }

    #[Route('/article/{id}/{url}', name: 'article')]
    public function article($id,$url):Response
    {
        return $this->render('blog/lecture.html.twig', [
            'url' => $url,'id'=>$id ]);
    }
   
   

}

    