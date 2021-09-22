<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    #[Route('/test', name: 'test')]
    public function index(): Response
    {
        $testContainerParameter = $this->getParameter('service_directory_name');

        return $this->render('test/index.html.twig', [
            'controller_name' => $testContainerParameter,
        ]);
    }

    #[Route('/upload', name: 'upload')]
    public function upload(Request $request): Response
    {
        $file = $request->files->get('file');
        if ($file) {
            $filename = $this->generateUniqueName().'.'.$file->guessExtension();

            $file->move($this->getTargetDirectory(), $filename);
        }
        $fileOriginalName = $file->getClientOriginalName();
        return $this->render('upload.html.twig', [
            'data' => $fileOriginalName,
        ]);
    }

    public function getTargetDirectory(): string
    {
        return $this->getParameter('service_directory_name');
    }

    public function generateUniqueName(): string
    {
        return md5(uniqid('', true));
    }
}
