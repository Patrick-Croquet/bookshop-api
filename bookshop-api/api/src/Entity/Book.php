<?php
// api/src/Entity/Book.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** A book. */
#[ORM\Entity]
#[ApiResource]
class Book
{
    /** The id of this book. */
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    /** The ISBN of this book (or null if doesn't have one). */
    #[ORM\Column(nullable: true)]
    public ?string $isbn = null;

    /** The title of this book. */
    #[ORM\Column]
    public string $title = '';

    /** The description of this book. */
    #[ORM\Column(type: "text")]
    public string $description = '';

    /** The author of this book. */
    #[ORM\Column]
    public string $author = '';

    /** The publication date of this book. */
    #[ORM\Column(type: "datetime")]
    public ?\DateTimeInterface $publicationDate = null;

    /** @var Review[] Available reviews for this book. */
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: 'Review', cascade: ['persist', 'remove'])]
    public iterable $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}