<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\Anime;
use App\Repository\AnimeRepository;
use App\Request\CreateAnimeRequest;
use App\Request\DeleteRequest;
use App\Request\GetByIdRequest;
use App\Request\UpdateAnimeRequest;
use Doctrine\ORM\EntityManagerInterface;

class AnimeManager
{
    private $entityManager;
    private $animeRepository;
    private $autoMapping;

    public function __construct(EntityManagerInterface $entityManager, AnimeRepository $animeRepository,
 AutoMapping $autoMapping)
    {
        $this->entityManager = $entityManager;
        $this->animeRepository = $animeRepository;
        $this->autoMapping = $autoMapping;
    }

    public function create(CreateAnimeRequest $request)
    {
        $animeEntity = $this->autoMapping->map(CreateAnimeRequest::class, Anime::class, $request);
        $this->entityManager->persist($animeEntity);
        $this->entityManager->flush();
        $this->entityManager->clear();
        return $animeEntity;
    }

    public function getAnimeById(GetByIdRequest $request)
    {
        $result = $this->animeRepository->getAnimeById($request->getId());

        return $result;
    }

    public function getByCategoryId(GetByIdRequest $request)
    {
        $result = $this->animeRepository->getAnimeByCategoryId($request->getId());

        return $result;
    }

    public function getAllAnime()
    {
        $data = $this->animeRepository->getAll();

        return $data;
    }

    public function update(UpdateAnimeRequest $request)
    {
        $animeEntity = $this->animeRepository->getAnimeById($request->getId());
        if(!$animeEntity)
        {
            //return null;
        }
        else
        {
            $animeEntity = $this->autoMapping->mapToObject(UpdateAnimeRequest::class,
                Anime::class, $request, $animeEntity);
            $this->entityManager->flush();
            return $animeEntity;
        }
    }

    public function delete(DeleteRequest $request)
    {
        $anime = $this->animeRepository->getAnimeById($request->getId());
        if(!$anime)
        {
            return null;
            // return new Response(['data'=>'The project was not found!']);
        }
        else
        {
            $this->entityManager->remove($anime);
            $this->entityManager->flush();
        }
        return $anime;
    }
}