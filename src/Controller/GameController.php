<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'game_index')]
    public function gameIndex(){
        $game = $this->getDoctrine()->getRepository(Game::class)->findAll();
        return $this->render("game/index.html.twig",
    [
        'game' => $game
    ]);

    }

    #[Route('/game/detail/{id}', name: 'game_detail')]
    public function gameDetail ($id) {
        $game = $this->getDoctrine()->getRepository(Game::class)->find($id);
        if ($game != null) {
            return $this->render("game/detail.html.twig",
            [
                'game' =>$game
            ]);
        } else {
            return $this->redirectToRoute("game_index");
        }
    }

    #[Route('/game/delete/{id}', name:'game_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function gameDelete ($id) {
        $game = $this->getDoctrine()->getRepository(Game::class)->find($id);
        if ($game != null) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($game);
            $manager->flush();
        } 
        return $this->redirectToRoute("game_index");
    }

    #[Route('/game/add', name: "game_add")]
    #[IsGranted('ROLE_ADMIN')]
    public function gameAdd (Request $request) {
        $game = new Game;
        $gameForm = $this->createForm(GameType::class, $game);
        $gameForm->handleRequest($request);
        if ($gameForm->isSubmitted() && $gameForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($game);
            $manager->flush();
            return $this->redirectToRoute("game_index");
        }
        return $this->renderForm("game\add.html.twig",
        [
            'gameForm' => $gameForm
        ]);
    }

    #[Route('/game/edit/{id}', name:'game_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function gameEdit (Request $request, $id) {
        $game = $this->getDoctrine()->getRepository(Game::class)->find($id);
        $gameForm = $this->createForm(GameType::class, $game);
        $gameForm->handleRequest($request);
        if ($gameForm->isSubmitted() && $gameForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($game);
            $manager->flush();
            return $this->redirectToRoute("game_index");
        }
        return $this->renderForm("game/edit.html.twig",
        [
            'gameForm' => $gameForm
        ]);        
    }
}
