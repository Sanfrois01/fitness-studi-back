<?php

namespace App\Controller\Admin;


use App\Entity\StructurePermission;
use App\Form\StructurePermissionType;
use App\Repository\StructurePermissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class StructurePermissionController extends AbstractController

{
    #[Route('/admin/structure_permission', name: 'structure_permission_list')]

    public function structurePermissionList(StructurePermissionRepository $structurePermissionRepository)
    {
        $structure_permissions = $structurePermissionRepository->findAll();

        return $this->render('admin/structure_permission.html.twig', [
            'structure_permissions' => $structure_permissions
            ]);
    }

    #[Route('/admin/structure_permission/{id}/delete', name: 'structure_permission_delete')]

    public  function  structurePermissionDelete($id , StructurePermissionRepository $structurePermissionRepository, EntityManagerInterface $entityManager)
    {
        $structure_permission = $structurePermissionRepository->find($id);

        $entityManager->remove($structure_permission);
        $entityManager->flush();

        return $this->redirectToRoute('structure_permission_list');

    }

    #[Route('/admin/structure_permission/create', name: 'structure_permission_create')]

    public  function  structurePermissionCreate(Request $request, EntityManagerInterface $entityManager)
    {
        $structure_permission = new StructurePermission();

        $structurePermissionForm = $this->createForm(StructurePermissionType::class,$structure_permission);

        $structurePermissionForm->handleRequest($request);

        if  ($structurePermissionForm->isSubmitted() && $structurePermissionForm->isValid()){
            $entityManager->persist($structure_permission);
            $entityManager->flush();
            $this->addFlash('success', 'Permission créé avec succes');
            return $this->redirectToRoute('structure_permission_list');

        }


        return $this->render('/admin/structure_permission_create.html.twig',[
            'structurePermissionForm' => $structurePermissionForm->createView()
            ]);
    }

    #[Route('/admin/structure_permission/{id}/update', name: 'structure_permission_update')]

    public function structurePermissionUpdate($id, Request $request, EntityManagerInterface $entityManager, StructurePermissionRepository $structurePermissionRepository)
    {
        $structure_permission = $structurePermissionRepository->find($id);

        $structurePermissionForm = $this->createForm(StructurePermissionType::class,$structure_permission);

        $structurePermissionForm->handleRequest($request);

        if  ($structurePermissionForm->isSubmitted() && $structurePermissionForm->isValid()){
            $entityManager->persist($structure_permission);
            $entityManager->flush();
            $this->addFlash('success', 'Permission modifié avec succes');
            return $this->redirectToRoute('structure_permission_list');

        }


        return $this->render('/admin/structure_permission_create.html.twig',[
            'structurePermissionForm' => $structurePermissionForm->createView()
        ]);


    }




}
