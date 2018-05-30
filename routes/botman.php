<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $bot->reply('Hello!'.' '.$firstname);
});

$botman->on('messaging_optins', function($payload, $bot) {
  $bot->reply('Hi');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
