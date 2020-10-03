<?php


namespace App\Controller;


use App\AutoMapping;
use App\Request\CreateEpisodeRequest;
use App\Request\DeleteRequest;
use App\Request\GetByIdRequest;
use App\Request\UpdateEpisodeRequest;
use App\Service\EpisodeService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EpisodeController extends BaseController
{
    private $episodeService;
    private $autoMapping;

    public function __construct(SerializerInterface $serializer, EpisodeService $episodeService, AutoMapping $autoMapping)
    {
        parent::__construct($serializer);
        $this->episodeService = $episodeService;
        $this->autoMapping = $autoMapping;
    }

    /**
     * @Route("/episode", name="createEpisode", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $request = $this->autoMapping->map(\stdClass::class, CreateEpisodeRequest::class, (object)$data);

        $result = $this->episodeService->create($request);

        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/episode/{id}", name="updateArticle", methods={"PUT"})
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request = $this->autoMapping->map(\stdClass::class, UpdateEpisodeRequest::class, (object)$data);

        $result = $this->episodeService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/episode/{id}", name="getEpisodeById", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getEpisodeById(Request $request)
    {
        $request = new GetByIdRequest($request->get('id'));
        $result = $this->episodeService->getEpisodeById($request);
        return $this->response($result, self::FETCH);
    }

    /**
     * @Route("/animeEpisodes/{animeID}", name="getEpisodeByAnimeID", methods={"GET"})
     * @param $animeID
     * @return JsonResponse
     */
    public function getEpisodeByAnimeId($animeID)
    {
        $result = $this->episodeService->getEpisodesByAnimeId($animeID);

        return $this->response($result, self::FETCH);
    }

    /**
     * @Route("/animeEpisodes/{animeID}/{seasonNumber}", name="getEpisodesByAnimeAndSeason", methods={"GET"})
     * @param $animeID
     * @param $seasonNumber
     * @return JsonResponse
     */
    public function getEpisodesByAnimeAndSeason($animeID, $seasonNumber)
    {
        $result = $this->episodeService->getEpisodesByAnimeIdAndSeasonNumber($animeID, $seasonNumber);

        return $this->response($result, self::FETCH);
    }

    /**
     * @Route("/episode/{id}", name="deleteEpisode", methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $request = new DeleteRequest($request->get('id'));
        $result = $this->episodeService->delete($request);

        return $this->response("",self::DELETE);
    }

     /**
     * @Route("episodesCommingSoon", name="getAllEpisodesCommingSoon", methods={"GET"})
     * @return JsonResponse
     */
    public function getAllCommingSoon()
    {
        $result = $this->episodeService->getAllCommingSoon();

        return $this->response($result, self::FETCH);
    }
}