<?php

use App\Enum\Channel;
use App\Entity\Answer;
use App\Entity\Question;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class AnswerTest extends TestCase {

    /**
     * Nominal tests
     */
    public function testAllGettersAndSetters()
    {
        //Instanciation
        $answer = new Answer();
        $this->assertInstanceOf(Answer::class, $answer);

        //Body
        $this->assertInstanceOf(Answer::class, $answer->setBody("Ceci est le corps de la question"));
        $this->assertSame("Ceci est le corps de la question", $answer->getBody());

        //Channel
        $this->assertInstanceOf(Answer::class, $answer->setChannel(Channel::faq));
        $this->assertSame(Channel::faq, $answer->getChannel());

        //Question
        $question = new Question();
        $answer->setQuestion($question);
        $this->assertInstanceOf(Question::class, $answer->getQuestion());

    }

    /**
     * Alternative Test : body
     */
    public function testSetBodyMissingArgumentMustThrowArgumentErrorException()
    {
        $this->expectException(ArgumentCountError::class);
        $answer = new Answer();
        $answer->setBody();
    }

    public function testSetBodyNullArgumentMustThrowTypeErrorException()
    {
        $this->expectException(TypeError::class);
        $answer = new Answer();
        $answer->setBody(null);
    }

    /**
     * Alternative tests : Channel
     */
    public function testSetChannelMissingArgumentMustThrowArgumentErrorException()
    {
        $this->expectException(ArgumentCountError::class);
        $answer = new Answer();
        $answer->setChannel();
    }

    /**
     * Alternative test : question
     */
    public function testSetQuestionMissingArgumentThrowArgumentErrorException()
    {
        $this->expectException(ArgumentCountError::class);
        $answer = new Answer();
        $answer->setQuestion();
    }

    public function testSetQuestionNullArgumentMustThrowTypeErrorException()
    {
        $this->expectException(TypeError::class);
        $answer = new Answer();
        $answer->setQuestion(null);
    }

    public function testSetQuestionWrongArgumentThrowTypeErrorException()
    {
        $this->expectException(TypeError::class);
        $answer = new Answer();
        $answer->setQuestion($answer);
    }

}