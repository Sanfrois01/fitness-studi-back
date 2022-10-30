<?php

namespace App\Controller\Admin;


use App\Entity\Structure;
use App\Form\StructureType;
use App\Repository\StructureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class StructureController extends AbstractController

{
    #[Route('/admin/structure', name: 'structure_list')]

    public function structureList(StructureRepository $structureRepository)
    {
        $structures = $structureRepository->findAll();

        return $this->render('admin/structure.html.twig', [
            'structures' => $structures
            ]);
    }

    #[Route('/admin/structure/{id}/delete', name: 'structure_delete')]

    public  function  structureDelete($id , StructureRepository $structureRepository, EntityManagerInterface $entityManager)
    {
        $structure = $structureRepository->find($id);

        $entityManager->remove($structure);
        $entityManager->flush();

        return $this->redirectToRoute('structure_list');

    }

    #[Route('/admin/structure/create', name: 'structure_create')]

    public  function  structureCreate(Request $request, EntityManagerInterface $entityManager)
    {
        $structure = new Structure();

        $structureForm = $this->createForm(StructureType::class,$structure);

        $structureForm->handleRequest($request);

        if  ($structureForm->isSubmitted() && $structureForm->isValid()){
            $entityManager->persist($structure);
            $entityManager->flush();
            return $this->redirectToRoute('structure_list');

        }
        $this->addFlash('success', 'Structure créé avec succes');


        return $this->render('/admin/structure_create.html.twig',[
            'structureForm' => $structureForm->createView()
            ]);
    }


    #[Route('/admin/structure/{id}/update', name: 'structure_update')]


    public function structureUpdate($id, Request $request, EntityManagerInterface $entityManager, StructureRepository $structureRepository)
    {
        $structure = $structureRepository->find($id);

        $structureForm = $this->createForm(StructureType::class,$structure);

        $structureForm->handleRequest($request);


        if  ($structureForm->isSubmitted() && $structureForm->isValid()){
            $entityManager->persist($structure);
            $entityManager->flush();
            return  $this->redirectToRoute('structure_list');
        }

        $this->addFlash('success', 'Structure modifié avec succes');


        return $this->render('/admin/structure_create.html.twig',[
            'structureForm' => $structureForm->createView()
        ]);


    }




}
