<?php

namespace App\Controller\Admin;

use App\Entity\Designer;
use App\Form\DesignerType;
use App\Repository\DesignerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDesignerController extends AbstractController
{
    /**
     * @Route("admin/designers", name="admin_designer_list")
     */
    public function adminDesignerList(DesignerRepository $designerRepository)
    {
        $designers = $designerRepository->findAll();

        return $this->render("admin/comics.html.twig", ['designers' => $designers]);
    }

    /**
     * @Route("admin/designer/{id}", name="admin_show_designer")
     */
    public function adminShowDesigner($id, DesignerRepository $designerRepository)
    {
        $designer = $designerRepository->find($id);

        return $this->render("admin/designer.html.twig", ['designer' => $designer]);
    }

    /**
     * @Route("admin/create/designer", name="admin_create_designer")
     */
    public function adminCreateDesigner(
        Request $request, 
        EntityManagerInterface $entityManagerInterface
    ){
        $designer = new Designer();

        $designerForm = $this->createForm(DesignerType::class, $designer);

        $designerForm->handleRequest($request);

        if($designerForm->isSubmitted() && $designerForm->isValid()){
            $entityManagerInterface->persist($designer);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_designer_list");
        }

        return $this->render("admin/designerform.html.twig", ['designerForm' => $designerForm->createView()]);
    }

    /**
     * @Route("admin/update/designer/{id}", name="admin_update_designer")
     */
    public function adminUpdateDesigner(
        $id,
        DesignerRepository $designerRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ){
        $designer = $designerRepository->find($id);

        $designerForm = $this->createForm(DesignerType::class, $designer);

        $designerForm->handleRequest($request);

        if($designerForm->isSubmitted() && $designerForm->isValid()){
            $entityManagerInterface->persist($designer);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_designer_list");
        }

        return $this->render("admin/designerform.html.twig", ['designerForm' => $designerForm->createView()]);
    }

    /**
     * @Route("admin/delete/designer/{id}", name="admin_delete_designer")
     */
    public function adminDeleteDesigner(
        $id,
        DesignerRepository $designerRepository,
        EntityManagerInterface $entityManagerInterface
    ){
        $designer = $designerRepository->find($id);

        $entityManagerInterface->remove($designer);

        $entityManagerInterface->flush();

        return $this->redirectToRoute("admin_designer_list");
    }
}