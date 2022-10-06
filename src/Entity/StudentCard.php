<?php

namespace App\Entity;

use App\Repository\StudentCardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentCardRepository::class)]
class StudentCard
{
    #[ORM\OneToOne(mappedBy: 'card', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): self
    {
        // set the owning side of the relation if necessary
        if ($student->getCard() !== $this) {
            $student->setCard($this);
        }

        $this->student = $student;

        return $this;
    }
}
