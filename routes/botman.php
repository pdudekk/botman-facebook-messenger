<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Cześć', BotManController::class.'@startConversation');
