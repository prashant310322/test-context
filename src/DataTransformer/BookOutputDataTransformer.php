<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\BookOutput;
use App\Entity\Book;

class BookOutputDataTransformer implements  DataTransformerInterface
{
    /**
     * @param BookOutput $bookoutput
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($bookoutput, string $to, array $context = [])
    {
            $output = new BookOutput();
            $output->title=$bookoutput->getTitle();
            $output->isbn=$bookoutput->getIsbn();
            $output->price=$bookoutput->getPrice();
            $output->reviews= $bookoutput->getReviews();
            $output->author=$bookoutput->getAuthor();

            return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $data instanceof  Book && $to === BookOutput::class ;
    }

}