<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $user = $bot->getUser();
    $firstname = $user->getFirstName();
    $bot->reply('Hello!'.' '.$firstname);
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
