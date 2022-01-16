<?php

namespace App\Controller\Admin;

use App\Entity\Licence;
use App\Form\LicenceType;
use App\Repository\LicenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminLicenceController extends AbstractController
{
    /**
     * @Route("admin/licences", name="admin_licence_list")
     */
    public function AdminLicenceList(LicenceRepository $licenceRepository)
    {
        $licences = $licenceRepository->findAll();

        return $this->render("admin/licences.html.twig", ['licences' => $licences]);
    }

    /**
     * @Route("admin/licence/{id}", name="admin_show_licence")
     */
    public function AdminShowLicence($id, LicenceRepository $licenceRepository)
    {
        $licence = $licenceRepository->find($id);

        return $this->render("admin/licence.html.twig", ['licence' => $licence]);
    }

    /**
     * @Route("admin/create/licence", name="admin_create_licence")
     */
    public function adminCreateLicence(
        Request $request, 
        EntityManagerInterface $entityManagerInterface,
        SluggerInterface $sluggerInterface
    ){
        $licence = new Licence();

        $licenceForm = $this->createForm(LicenceType::class, $licence);

        $licenceForm->handleRequest($request);

        if($licenceForm->isSubmitted() && $licenceForm->isValid()){

            $licenceFile = $licenceForm->get('media')->getData();

            if($licenceFile){

                $originalFilename = pathinfo($licenceFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $sluggerInterface->slug($originalFilename);

                $newFilename = $safeFilename . '-' . uniqid() . '.' . $licenceFile->guessExtension();

                $licenceFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $licence->setMedia($newFilename);
            }

            $entityManagerInterface->persist($licence);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_licence_list");
        }

        return $this->render("admin/licenceform.html.twig", ['licenceForm' => $licenceForm->createView()]);
    }

    /**
     * @Route("admin/update/licence/{id}", name="admin_update_licence")
     */
    public function adminUpdateLicence(
        $id,
        LicenceRepository $licenceRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        SluggerInterface $sluggerInterface
    ){
        $licence = $licenceRepository->find($id);

        $licenceForm = $this->createForm(LicenceType::class, $licence);

        $licenceForm->handleRequest($request);

        if($licenceForm->isSubmitted() && $licenceForm->isValid()){

            $licenceFile = $licenceForm->get('media')->getData();

            if($licenceFile){

                $originalFilename = pathinfo($licenceFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $sluggerInterface->slug($originalFilename);

                $newFilename = $safeFilename . '-' . uniqid() . '.' . $licenceFile->guessExtension();

                $licenceFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $licence->setMedia($newFilename);
            }

            $entityManagerInterface->persist($licence);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_licence_list");
        }

        return $this->render("admin/licenceform.html.twig", ['licenceForm' => $licenceForm->createView()]);
    }

    /**
     * @Route("admin/delete/licence/{id}", name="admin_delete_licence")
     */
    public function adminDeleteLicence(
        $id,
        LicenceRepository $licenceRepository,
        EntityManagerInterface $entityManagerInterface
    ){
        $licence = $licenceRepository->find($id);

        $entityManagerInterface->remove($licence);

        $entityManagerInterface->flush();

        return $this->redirectToRoute("admin_licence_list");
    }
}