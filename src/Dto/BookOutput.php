<?php


namespace App\Dto;


use App\Entity\Author;
use Symfony\Component\Serializer\Annotation\Groups;

class BookOutput
{

    #[Groups(["Book:read","Book:write"])]
    public $title;


    #[Groups(["Book:read","Book:write"])]
    public $isbn;



    #[Groups(["Book:read"])]
    public $price;


    #[Groups(["Book:read","Book:write"])]
    public $reviews = [];



    #[Groups(["Book:read","Book:write"])]

    public $author;
}