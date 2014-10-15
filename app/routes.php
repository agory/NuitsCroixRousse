<?php

use Symfony\Component\HttpFoundation\Request;use MicroCMS\Domain\Comment;
use MicroCMS\Domain\Article;
use MicroCMS\Domain\User;
use MicroCMS\Form\Type\CommentType;


// Returns index
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
});

// Detailed all concerts
$app->get('/concerts', function() use ($app) {
    $concerts = $app['dao.concert']->findAll();
    return $app['twig']->render('concerts.html.twig', array('concerts' => $concerts));
});

$app->get('/concerts/search/', function() use ($app) {
    $genres = $app['dao.genre']->findAll();
    return $app['twig']->render('concerts_search.html.twig', array('genres' => $genres));
});

$app->get('/concerts/{id}', function($id) use ($app) {
    $concert = $app['dao.concert']->find($id);
    return $app['twig']->render('concert.html.twig', array('concert' => $concert));
});

$app->post('/concerts/results/', function(Request $request) use ($app) {
    $genre = $request->request->get('genreId');
    $concerts = $app['dao.concert']->findAllByGenre($genre);
    return $app['twig']->render('concerts_result.html.twig', array('concerts' => $concerts));
});

/*
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');  // named route so that path('login') works in Twig templates*/