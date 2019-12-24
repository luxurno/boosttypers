<?php
//
//declare(strict_types = 1);
//
//namespace App\Tests\unit\Bundle\DownloadBundle\Generator;
//
//use App\Bundle\DownloadBundle\Collection\ElementPhotoDTOCollection;
//use App\Bundle\DownloadBundle\DTO\ElementDTO;
//use App\Bundle\DownloadBundle\DTO\ElementPhotoDTO;
//use App\Bundle\DownloadBundle\Entity\Element;
//use App\Bundle\DownloadBundle\Generator\ElementPhotoGenerator;
//use App\Bundle\DownloadBundle\Repository\ElementRepository;
//use ArrayIterator;
//use Doctrine\ORM\EntityManagerInterface;
//use PHPUnit\Framework\MockObject\MockObject;
//use Prophecy\Argument;
//use SimpleBus\SymfonyBridge\Bus\CommandBus;
//
//class ElementPhotoGeneratorTest extends \Codeception\Test\Unit
//{
//    private const ID = 1;
//    private const IS_VIDEO = true;
//    private const PHOTO_NUMBER = 1;
//
//    public function testGeneratePhotos(): void
//    {
//        $elementRepository = $this->createElementRepository();
//        $elementEntity = $this->createElementEntity();
//        $elementDTO = $this->createElementDTO();
//        $elementPhotoDTOCollection = $this->createElementPhotoDTOCollection();
//        $entityManager = $this->createEntityManager();
//        $elementPhotoDTO = $this->createElementPhotoDTO();
//        $commandBus = $this->createCommandBus();
//
//        $elementRepository->expects($this->at(0))->method('__call')->with('findOneBy')
//            ->willReturn($elementEntity);
//        $elementRepository->expects(self::once())->method('findOneBy')->with(Argument::any(), Argument::any())
//            ->willReturn($elementEntity);
//
//        $elementDTO->expects(self::once())->method('getId')->willReturn(self::ID);
//        $elementDTO->method('getIsVideo')->willReturn(self::IS_VIDEO);
//        $elementDTO->method('getPhotoNumber')->willReturn(self::PHOTO_NUMBER);
//        $elementEntity->expects(self::once())->method('setIsVideo')->with($elementDTO->getIsVideo());
//        $elementEntity->expects(self::once())->method('setPhotoNumber')->with($elementDTO->getPhotoNumber());
//        $entityManager->expects(self::once())->method('persist')->with($elementEntity);
//        $entityManager->expects(self::once())->method('flush');
//        $elementPhotoDTOCollection->method('getIterator')->willReturn(new ArrayIterator($elementPhotoDTO));
//        $commandBus->expects(self::any())->method('handle');
//
//        $elementPhotoGenerator = new ElementPhotoGenerator(
//            $entityManager,
//            $elementRepository,
//            $commandBus
//        );
//        $elementPhotoGenerator->generatePhotos($elementDTO, $elementPhotoDTOCollection);
//    }
//
//    private function createElementEntity(): MockObject
//    {
//        return $this->createMock(Element::class);
//    }
//
//    private function createElementDTO(): MockObject
//    {
//        return $this->createMock(ElementDTO::class);
//    }
//
//    private function createElementPhotoDTO(): MockObject
//    {
//        return $this->createMock(ElementPhotoDTO::class);
//    }
//
//    private function createElementPhotoDTOCollection(): MockObject
//    {
//        return $this->createMock(ElementPhotoDTOCollection::class);
//    }
//
//    private function createEntityManager(): MockObject
//    {
//        return $this->createMock(EntityManagerInterface::class);
//    }
//
//    private function createElementRepository(): MockObject
//    {
//        return $this->createMock(ElementRepository::class);
//    }
//
//    private function createCommandBus(): MockObject
//    {
//        return $this->createMock(CommandBus::class);
//    }
//}