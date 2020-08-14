<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\RealVoucher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class VoucherController extends AbstractController
{
    /**
     * @Route("/voucher", name="create_voucher")
     */
    public function createVoucher(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $voucher = new RealVoucher();
        $voucher->setCustomer('John Doe');
        $voucher->setReceipt('The purchase of 110 euros for a aluminium childrens bike');
        $voucher->setProduct('aluminium childrens bike');
        $voucher->setDiscount('5 Euro voucher for a repeat visit or store credit at Real Digital');
        $voucher->setMessage('Thank you for shopping with Real Digital');
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($voucher);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Create new voucher with id '.$voucher->getId());
    }
}
