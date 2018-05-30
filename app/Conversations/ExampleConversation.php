<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ExampleConversation extends Conversation
{
    protected $firstname;
    protected $age;

    public function sayHello()
    {

        $user = $this->bot->getUser();
        $this->firstname = $user->getFirstName();

        $this->say("Cześć ".$this->firstname."!");
        $this->rightValue();
        /*
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Tell a joke')->value('joke'),
                Button::create('Give me a fancy quote')->value('quote'),
            ]);
*/

        /*, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'joke') {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);
                } else {
                    $this->say(Inspiring::quote());
                }
            }
        });
        */
    }

    public function rightValue(){

      $question = Question::create('Urodziłeś się w '.$year.' roku?')
       ->addButtons([
           Button::create('tak')->value('yes'),
           Button::create('nie')->value('no'),
       ]);

      $ifsetAge = "";

      if($this->age == NULL) $ifsetAge = "Ile masz lat?";
      else $ifsetAge = "podaj poprawną wartość!";

      $this->ask($ifsetAge , function(Answer $answer){

        $this->age = $answer->getText();
        if(is_numeric($this->age)){
          if(intval($this->age) >= 13 && intval($this->age) <= 100){
            $year = date("Y") - intval($this->age);
          //  $this->say('Urodziłeś się w '.$year.' roku?');
          $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
          if ($answer->isInteractiveMessageReply()) {
              //$selectedValue = $answer->getValue();
              if($answer->getValue() == 'yes'){
                $this->say("Świetnie. Dziękuje za odpowiedź.");
              }
              else if($answer->getValue() == 'no'){
                $ifsetAge = NULL;
                $this->rightValue();
              }
          }
        });


          }else{
            $this->rightValue();
          }
        }else{
          $this->rightValue();
        }
    });
  }


    /**
     * Start the conversation
     */
    public function run()
    {
        $this->sayHello();
    }
}
