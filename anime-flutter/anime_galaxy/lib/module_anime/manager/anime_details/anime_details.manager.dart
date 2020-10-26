
import 'package:anime_galaxy/module_anime/repository/anime_details/anime_details.repository.dart';
import 'package:anime_galaxy/module_anime/request/comment_request/comment_request.dart';
import 'package:anime_galaxy/module_anime/response/anime_response/anime_response.dart';
 import 'package:inject/inject.dart';

@provide
class AnimeDetailsManager{
  final AnimeDetailsRepository _animeDetailsRepository;
  AnimeDetailsManager(this._animeDetailsRepository);

  Future<AnimeResponse> getAnimeDetails(animeId)async{
    return await _animeDetailsRepository.getAnimeDetails(animeId);
  }

  Future<bool> addComment(CommentRequest commentRequest)async{
    return await _animeDetailsRepository.addComment(commentRequest);
  }
}