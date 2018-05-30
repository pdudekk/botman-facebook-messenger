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

      $question = "";

      if($this->age == NULL) $question = "Ile masz lat?";
      else $question = "podaj poprawną wartość!";

      $this->ask($question , function(Answer $answer){

        $this->age = $answer->getText();
        if(is_numeric($this->age)){
          if(intval($this->age) >= 13 && intval($this->age) <= 100){
            $year = date("Y");
            $this->say('Urodziłeś się w '.$year-$this->age.' lat!');
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
