<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Dto\BookInput;
use App\Entity\Book;

class BookInputDataTransformer  implements  DataTransformerInterface
{
    /**
     * @param Book $input
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($input, string $to, array $context = [])
    {
         //dump($input);
         if (isset($context[AbstractItemNormalizer::OBJECT_TO_POPULATE])){
             $book = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
         }
         else {
               $book = new Book();
         }


        $book->setTitle($input->title);
        $book->setPrice($input->price);
        $book->setIsbn($input->isbn);
        $book->setAuthor($input->author);
        $book->setReviews($input->reviews);

        return $book;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
       // dump($data, $to, $context);
        if ($data instanceof Book)
        {
            return false ;
        }

        return $to === Book::class && ($context['input']['class'] ?? null) === BookInput::class;
    }

}