<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminImageController extends AbstractController
{
    /**
     * @Route("admin/create/image"), name="admin_create_media")
     */
    public function adminCreateImage(
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        SluggerInterface $sluggerInterface
    ){
        $image = new Image();

        $imageForm = $this->createForm(ImageType::class, $image);

        $imageForm->handleRequest($request);

        if($imageForm->isSubmitted() && $imageForm->isValid()){
            
            $imageFile = $imageForm->get('src')->getData();

            if($imageFile){

                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $sluggerInterface->slug($originalFilename);

                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $newFilename
                );

                $image->setSrc($newFilename);
            }

            $entityManagerInterface->persist($image);

            $entityManagerInterface->flush();

            return $this->redirectToRoute("admin_image_list");
        }

        return $this->render("admin/imageform.html.twig", ['imageForm' => $imageForm->createView()]);
    }
}