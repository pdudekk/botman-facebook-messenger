<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class MyConversation extends Conversation
{
    protected $firstname;
    protected $age;
    protected $year;
    public function sayHello()
    {

        $user = $this->bot->getUser();
        $this->firstname = $user->getFirstName();

        $this->say("Cześć ".$this->firstname."!");
        $this->rightValue();

    }

    public function rightValue(){


      $ifsetAge = "";

      if($this->age == NULL) $ifsetAge = "Ile masz lat?";
      else $ifsetAge = "podaj poprawną wartość!";

      $this->ask($ifsetAge , function(Answer $answer){

        $this->age = $answer->getText();
        if(is_numeric($this->age)){
          if(intval($this->age) >= 13 && intval($this->age) <= 100){
            $this->year = date("Y") - intval($this->age);
          //  $this->say('Urodziłeś się w '.$year.' roku?');
            $this->askIfTrue();

          }else{
            $this->rightValue();
          }
        }else{
          $this->rightValue();
        }
    });
  }

  public function askIfTrue(){

          $question = Question::create('Urodziłeś się w '.$this->year.' roku?')
          ->fallback('Unable to ask question')
          ->callbackId('ask_reason')
          ->addButtons([
               Button::create('tak')->value('yes'),
               Button::create('nie')->value('no'),
           ]);

         $this->ask($question, function (Answer $answer) {

         if ($answer->isInteractiveMessageReply()) {

             if($answer->getValue() === 'yes'){
               $this->say("Świetnie. Dziękuje za odpowiedź.");
             }
             else if($answer->getValue() === 'no'){
               $this->age = NULL;
               $this->rightValue();
             }
         }
       });

  }

    public function run()
    {
        $this->sayHello();
    }
}
