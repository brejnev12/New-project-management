<?php
//BrejnevNgondi
namespace App\Controller;

use App\Entity\CustomerOrder;
use App\Form\CustomerOrderType;
use App\Repository\CustomerOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/customer/order')]
final class CustomerOrderController extends AbstractController
{
    #[Route(name: 'app_customer_order_index', methods: ['GET'])]
    public function index(CustomerOrderRepository $customerOrderRepository): Response
    {
        return $this->render('customer_order/index.html.twig', [
            'customer_orders' => $customerOrderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_customer_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customerOrder = new CustomerOrder();
        $form = $this->createForm(CustomerOrderType::class, $customerOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customerOrder);
            $entityManager->flush();

            return $this->redirectToRoute('app_customer_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer_order/new.html.twig', [
            'customer_order' => $customerOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_customer_order_show', methods: ['GET'])]
    public function show(CustomerOrder $customerOrder): Response
    {
        return $this->render('customer_order/show.html.twig', [
            'customer_order' => $customerOrder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_customer_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CustomerOrder $customerOrder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerOrderType::class, $customerOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_customer_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('customer_order/edit.html.twig', [
            'customer_order' => $customerOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_customer_order_delete', methods: ['POST'])]
    public function delete(Request $request, CustomerOrder $customerOrder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customerOrder->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($customerOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_customer_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
