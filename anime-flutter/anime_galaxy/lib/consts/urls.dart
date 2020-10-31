class Urls {
 
  static const String BASE_API = 'http://35.226.243.159/html/public/index.php';
  //hassan use this
  static const API_ALL_ANIME=BASE_API+"/anime";
  static const API_PROFILE = BASE_API + '/userprofile';
  static const API_ANIME = BASE_API + '/anime';
  static const API_CATEGORY = BASE_API + '/category';
  static const API_EPISODE = BASE_API + '/episode';
  static const API_ANIME_EPISODES = BASE_API + '/animeEpisodes/';
  static const API_ALL_COMMENTS = BASE_API +'/comments/';
  static const API_COMMENT = BASE_API+ '/comment';
  static const API_ADD_FAVOURITE = BASE_API + '/favourite';
  static const API_ANIME_BY_CATEGORY = BASE_API +'/animeByCategory/';
  static const API_FAVOURITE_ANIMES = BASE_API + '/favouriteUser/';
  static const API_HIGHEST_RATED_ANIMES = BASE_API +'/getHighestRatedAnime';
  static const API_HIGHEST_RATED_ANIMES_BY_USER = BASE_API +'/getHighestRatedAnime/';
  static const API_COMING_SOON_ANIMES = BASE_API + '/animeCommingSoon';
  static const API_ANIME_YOU_MAY_LIKE = BASE_API + '/getMaybeYouLike';
  static const API_USER_POINTS = BASE_API + '/grade/';
  static const API_EPISODES_COMING_SOON = BASE_API + '/episodesComingSoon';
  static const API_ACTIVE_USERS = BASE_API + '/top50';

}
