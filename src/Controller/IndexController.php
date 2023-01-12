<?php

namespace App\Controller;

use App\Repository\TareaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    const ELEMENTOS_POR_PAGINA = 10;
    /**
     * @Route(
     * "/{pagina}",
     * name="app_index",
     * defaults={"pagina":1},
     * requirements={"pagina"="\d+"},
     * methods={"GET"}
     * )
     */
    public function index(int $pagina,TareaRepository $tareaRepository): Response
    {
        dump($pagina);
        return $this->render('index/index.html.twig', [
            'tareas' => $tareaRepository->buscarPagina($pagina,self::ELEMENTOS_POR_PAGINA),
            'pagina_actual' => $pagina,
            'elementos_por_pagina' => self::ELEMENTOS_POR_PAGINA,
        ]);
    }
}
