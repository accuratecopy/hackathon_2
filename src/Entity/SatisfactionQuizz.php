<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SatisfactionQuizzRepository")
 * @ORM\Table(name="satisfaction_quizz")
 */
class SatisfactionQuizz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $businessContact;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $satisfactionNote;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $contactNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="satisfactionQuizz")
     */
    private $contacts;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="satisfactionQuizzs")
     */
    private $event;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBusinessContact(): ?bool
    {
        return $this->businessContact;
    }

    public function setBusinessContact(bool $businessContact): self
    {
        $this->businessContact = $businessContact;

        return $this;
    }

    public function getSatisfactionNote(): ?int
    {
        return $this->satisfactionNote;
    }

    public function setSatisfactionNote(?int $satisfactionNote): self
    {
        $this->satisfactionNote = $satisfactionNote;

        return $this;
    }

    public function getContactNumber(): ?int
    {
        return $this->contactNumber;
    }

    public function setContactNumber(?int $contactNumber): self
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setSatisfactionQuizz($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getSatisfactionQuizz() === $this) {
                $contact->setSatisfactionQuizz(null);
            }
        }

        return $this;
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

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}
