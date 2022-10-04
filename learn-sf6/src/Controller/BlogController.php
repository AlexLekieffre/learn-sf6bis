<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Image;
use App\Form\ArticleType;
use PhpParser\Node\Name;
use App\Service\Proverbe;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class BlogController extends AbstractController
{
    

    #[Route('/fixadd', name : 'fixadd')]
    public function fixadd(ManagerRegistry $doctrine )
    {
        $manager= $doctrine->getManager();

        $imgRP = $manager->getRepository(Image::class);
        $catRP = $manager->getRepository(Category::class);
        $img = $imgRP->findById(1);
        $category = $catRP->findAll();
        dump($category,$img);

        $article = new Article();
        $article->setTitle("first article")
            ->setImage($img[0])
            ->addCategory($category[0])
            ->addCategory($category[1])
            ->setContent("voila mon first test")
            ->setLastUpdateDate(new \DateTime())
            ->setIsPublished(false);
            
        $manager->persist($article);
        $manager->flush();
        dump($article);

        return new Response('<body>YA bon</body>');
        
        
    }
    
    #[Route('/', name: 'homepage')]
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
            $form = $this->createForm(ArticleType::class);
            return $this->render("blog/ajout.html.twig",["form"=>$form->createView()]);
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

    public function proverbe(Proverbe $proverbe) {
        return $this->render("parts/proverbe.html.twig", ['proverbe'=> $proverbe->getProverbe()]);
    }
   
   

}

    