<?php


namespace App\Dto;


use App\Entity\Author;
use Symfony\Component\Serializer\Annotation\Groups;

class BookInput
{
    #[Groups(["Book:read","Book:write"])]
    public $title;


    #[Groups(["Book:read","Book:write"])]
    public $isbn;




    #[Groups(["Book:read"])]
    public $price;


    #[Groups(["Book:read","Book:write"])]
    public $reviews = [];


    /**
     * @var Author
     */
    #[Groups(["Book:read","Book:write"])]

    public $author;
}