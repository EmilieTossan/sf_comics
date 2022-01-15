<?php

namespace App\Controller\Admin;

use App\Entity\Comic;
use App\Form\ComicType;
use App\Repository\ComicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminComicController extends AbstractController
{
    /**
     * @Route("admin/comics", name="admin_comic_list")
     */
    public function adminComicList(
        ComicRepository $comicRepository
    ){
        $comics = $comicRepository->findAll();

        return $this->render("admin/comics.html.twig", ['comics' => $comics]);
    }

    /**
     * @Route("admin/comic/{id}", name="admin_show_comic")
     */
    public function adminShowComic(
        $id, 
        ComicRepository $comicRepository
    ){
        $comic = $comicRepository->find($id);

        return $this->render("admin/comic.html.twig", ['comic' => $comic]);
    }

    /**
     * @Route("admin/create/comic", name="admin_create_comic")
     */
    public function adminCreateComic(
        Request $request, 
        EntityManagerInterface $entityManagerInterface
    ){
        $comic = new Comic();

        $comicForm = $this->createForm(ComicType::class, $comic);

        $comicForm->handleRequest($request);

        if($comicForm->isSubmitted() && $comicForm->isValid()){
            $entityManagerInterface->persist($comic);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_comic_list");
        }

        return $this->render("admin/comicform.html.twig", ['comicForm' => $comicForm->createView()]);
    }

    /**
     * @Route("admin/update/comic/{id}", name="admin_update_comic")
     */
    public function adminUpdateComic(
        $id,
        ComicRepository $comicRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ){
        $comic = $comicRepository->find($id);

        $comicForm = $this->createForm(ComicType::class, $comic);

        $comicForm->handleRequest($request);

        if($comicForm->isSubmitted() && $comicForm->isValid()){
            $entityManagerInterface->persist($comic);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_comic_list");
        }

        return $this->render("admin/comicform.html.twig", ['comicForm' => $comicForm->createView()]);
    }

    /**
     * @Route("admin/delete/comic/{id}", name="admin_delete_comic)
     */
    public function adminDeleteComic(
        $id,
        ComicRepository $comicRepository,
        EntityManagerInterface $entityManagerInterface
    ){
        $comic = $comicRepository->find($id);

        $entityManagerInterface->remove($comic);

        $entityManagerInterface->flush();

        return $this->redirectToRoute("admin_comic_list");
    }
}