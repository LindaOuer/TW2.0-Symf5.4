<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: Classroom::class, inversedBy: 'teachers')]
    #[ORM\JoinTable(name: 'teacher_classroom')]
    #[ORM\JoinColumn(name:"teacher_id", referencedColumnName:"cin")]
    #[ORM\InverseJoinColumn(name:"classroom_id", referencedColumnName:"id")]
    private Collection $classrooms;

    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setCin(string $cin): self
    {
        $this->email = $cin;

        return $this;
    }

    /**
     * @return Collection<int, Classroom>
     */
    public function getClassrooms(): Collection
    {
        return $this->classrooms;
    }

    public function addClassroom(Classroom $classroom): self
    {
        if (!$this->classrooms->contains($classroom)) {
            $this->classrooms->add($classroom);
        }

        return $this;
    }

    public function removeClassroom(Classroom $classroom): self
    {
        $this->classrooms->removeElement($classroom);

        return $this;
    }
}
