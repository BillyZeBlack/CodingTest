<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use App\DoctrineType\StatusType;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
// use Doctrine\Common\Collections\Collection;
use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\String_;
use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ApiResource]
class Question 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column]
    private bool $promoted;

    #[ORM\Column(type: StatusType::NAME, length: 255)]
    #[Enum()]
    private $status;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, cascade:["persist"])]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of promoted
     */ 
    public function getPromoted()
    {
        return $this->promoted;
    }

    /**
     * Set the value of promoted
     *
     * @return  self
     */ 
    public function setPromoted($promoted)
    {
        $this->promoted = $promoted;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    /**
     * @return ArrayCollection<int, Answer>
     */
    public function getAnswers(): ArrayCollection
    {
        return $this->answers;
    }

    /**
     * @param Answer $answer
     * 
     * @return self
     */
    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    /**
     * @param Answer $answer
     * 
     * @return self
     */
    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }
}