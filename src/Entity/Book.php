<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\BookInput;
use App\Dto\BookOutput;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource( input: BookInput::class,  output: BookOutput::class, collectionOperations: ['get', 'post'], itemOperations: ['get', 'put', 'patch'], normalizationContext: ['groups'=>['Book:read']],denormalizationContext: ['groups'=>['Book:write']])]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(["Book:read","Book:write"])]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]

    private $isbn;


    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(["Book:read"])]
    private $price;

    #[ORM\Column(type: 'array')]
    #[Groups(["Book:read","Book:write"])]
    private $reviews = [];

    #[ORM\OneToOne(inversedBy: 'book', targetEntity: Author::class, cascade: ['persist', 'remove'])]
    private $author;


    public  function  __construct()
    {
        $this->title= 'test';
        $this->price = 2500;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }



    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getReviews(): ?array
    {
        return $this->reviews;
    }

    public function setReviews(array $reviews): self
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }


}
