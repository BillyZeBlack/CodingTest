<?php

use App\Enum\Channel;
use App\Entity\Answer;
use App\Entity\Question;
use App\Enum\Status;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase {

    /**
     * Nominal tests
     */
    public function testAllGettersAndSetters()
    {
        //Instanciation
        $question = new Question();
        $this->assertInstanceOf(Question::class, $question);

        //Title
        $this->assertInstanceOf(Question::class, $question->setTitle("Titre"));
        $this->assertSame("Titre", $question->getTitle());

        //Promoted
        $this->assertInstanceOf(Question::class, $question->setPromoted(false));
        $this->assertSame(false, $question->getPromoted());

        //Status
        $this->assertInstanceOf(Question::class, $question->setStatus(Status::draft));
        $this->assertSame(Status::draft, $question->getStatus());

        //Answer
        $answer = new Answer();
        $answer->setBody("test corps de réponse");
        $answer->setChannel(Channel::bot);
        $answer->setQuestion($question);
        $question->addAnswer($answer);
        $this->assertInstanceOf(ArrayCollection::class, $question->getAnswers());

    }

    /**
     * Alternative Test : Title
     */
    public function testSetTitleMissingArgumentMustThrowArgumentErrorException()
    {
        $this->expectException(ArgumentCountError::class);
        $question = new Question();
        $question->setTitle();
    }

    public function testSetTitleNullArgumentMustThrowTypeErrorException()
    {
        $this->expectException(TypeError::class);
        $question = new Question();
        $question->setTitle(null);
    }

    /**
     * Alternative tests : Promoted
     */
    public function testSetPromotedMissingArgumentMustThrowArgumentErrorException()
    {
        $this->expectException(ArgumentCountError::class);
        $question = new Question();
        $question->setPromoted();
    }

    public function testSetPromotedNullArgumentMustThrowTypeErrorException()
    {
        $this->expectException(TypeError::class);
        $question = new Question();
        $question->setPromoted(null);
    }

    /**
     * Alternative tests : status
     */
    public function testSetStatusMissingArgumentMustThrowArgumentErrorException()
    {
        $this->expectException(ArgumentCountError::class);
        $question = new Question();
        $question->setStatus();
    }

    /**
     * Alternative test : answers
     */
    public function testAddAnswwerMissingArgumentThrowArgumentErrorException()
    {
        $this->expectException(ArgumentCountError::class);
        $question = new Question();
        $question->addAnswer();
    }

    public function testAddAnswwerNullArgumentMustThrowTypeErrorException()
    {
        $this->expectException(TypeError::class);
        $question = new Question();
        $question->addAnswer(null);
    }

    public function testAddAnswerWrongArgumentThrowTypeErrorException()
    {
        $this->expectException(TypeError::class);
        $question = new Question();
        $question->addAnswer($question);
    }

}