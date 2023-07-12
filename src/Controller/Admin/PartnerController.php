<?php

namespace App\Controller\Admin;


use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PartnerController extends AbstractController

{
    #[Route('/admin/partner', name: 'partner_list')]

    public function partnerList(PartnerRepository $partnerRepository)
    {
        $partners = $partnerRepository->findAll();

        return $this->render('admin/partners.html.twig', [
            'partners' => $partners
            ]);
    }

    #[Route('/admin/partner/{id}/delete', name: 'partner_delete')]

    public  function  partnerDelete($id , PartnerRepository $partnerRepository, EntityManagerInterface $entityManager)
    {
        $partner = $partnerRepository->find($id);

        $entityManager->remove($partner);
        $entityManager->flush();

        return $this->redirectToRoute('partner_list');
        $this->addFlash('success', 'Partenaire supprimé avec succes');



    }



    #[Route('/admin/partner/create', name: 'partner_create')]

    public  function  partnerCreate(Request $request, EntityManagerInterface $entityManager)
    {
        $partner = new Partner();

        $partnerForm = $this->createForm(PartnerType::class,$partner);

        $partnerForm->handleRequest($request);

        if  ($partnerForm->isSubmitted() && $partnerForm->isValid()){
            $entityManager->persist($partner);
            $entityManager->flush();
            $this->addFlash('success', 'Partenaire créé avec succes');

            return $this->redirectToRoute('partner_list');
        }



        return $this->render('/admin/partner_create.html.twig',[
            'partnerForm' => $partnerForm->createView()
            ]);

    }

    #[Route('/admin/partner/{id}/update', name: 'partner_update')]

    public function partnerUpdate($id, Request $request, EntityManagerInterface $entityManager, PartnerRepository $partnerRepository)
    {
        $partner = $partnerRepository->find($id);

        $partnerForm = $this->createForm(PartnerType::class,$partner);

        $partnerForm->handleRequest($request);

        if  ($partnerForm->isSubmitted() && $partnerForm->isValid()){
            $entityManager->persist($partner);
            $entityManager->flush();
            $this->addFlash('success', 'Partenaire modifié avec succes');
            return $this->redirectToRoute('partner_list');

        }

        return $this->render('/admin/partner_create.html.twig',[
            'partnerForm' => $partnerForm->createView()
        ]);


    }



}
