<?php


namespace App\Serialzer\Normalizer;


use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Dto\BookInput;
use App\Entity\Book;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class BookInputDenormalizer implements  DenormalizerInterface, CacheableSupportsMethodInterface
{
    private ObjectNormalizer $objectNormalizer;
    public  function  __construct(ObjectNormalizer $objectNormalizer)
    {
        $this->objectNormalizer = $objectNormalizer;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
      //dump($context);

        //$dto = new BookInput();
       // $dto->title = 'I am set in denormalizer';

        $context[AbstractItemNormalizer::OBJECT_TO_POPULATE] = $this->createDto($context);

        return $this->objectNormalizer->denormalize($data, $type, $format, $context);

    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return $type === BookInput::class;
    }


    public function hasCacheableSupportsMethod(): bool
    {
       return true;
    }


    private function createDto(array $context): BookInput
    {
        $entity = $context['object_to_populate'] ?? null;
        $dto = new BookInput();
        // not an edit, so just return an empty DTO
        if (!$entity) {
            return $dto;
        }
        if (!$entity instanceof Book) {
            throw new \Exception(sprintf('Unexpected resource class "%s"', get_class($entity)));
        }
        $dto->title = $entity->getTitle();
        $dto->price = $entity->getPrice();
        $dto->isbn  = $entity->getIsbn();
        $dto->reviews = $entity->getReviews();
        $dto->author = $entity->getAuthor();


        return $dto;
    }

}