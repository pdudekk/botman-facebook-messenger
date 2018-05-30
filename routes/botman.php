<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Hello', function (BotMan $bot) {
           $userName = $bot->getUser()->getFirstName() . ' ' . $bot->getUser()->getLastName();
           $bot->reply('Hi ' . $userName);
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
