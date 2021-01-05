<?php

namespace App\Controller\Api;

use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1", name="api_v1_usuario_")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/lista", methods={"GET"}, name="lista")
     */
    public function lista(): JsonResponse
    {
        $doctrine = $this->getDoctrine()->getRepository(Usuario::class);

        return new JsonResponse($doctrine->pegarTodos());
    }

    /**
     * @Route("/cadastra", methods={"POST"}, name="cadastra")
     */
    public function cadastra(Request $request): Response
    {
        $data = $request->request->all();

        $usuario = new Usuario;

        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);

        $doctrine = $this->getDoctrine()->getManager(); // pegar o gerenciador de entidades
        $doctrine->persist($usuario); // prepara tudo para enviar ao banco
        $doctrine->flush(); // faz com que a query (insert, update, delete, select) seja realizada no banco
        
        if ($doctrine->contains($usuario))
        {
            return new Response("OK", 200);
        } else {
            return new Response("ERROR", 404);
        }
    }
}