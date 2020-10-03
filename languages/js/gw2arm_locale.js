// queries the browser locale and sets it to the shortcode
function set_gw2arm_embedding_locale()
{
  let navLang = navigator.language;
  let targetLang = navLang.slice(0, 2).toLowerCase();

  switch (targetLang) {
    case 'de':
      document.GW2A_EMBED_OPTIONS = {
        lang: "de"
      };
      break;
    case 'fr':
      document.GW2A_EMBED_OPTIONS = {
        lang: "fr"
      };
      break;
    case 'es':
      document.GW2A_EMBED_OPTIONS = {
        lang: "es"
      };
      break;
    case 'zh':
      document.GW2A_EMBED_OPTIONS = {
        lang: "zh"
      };
      break;
    case 'ru':
      document.GW2A_EMBED_OPTIONS = {
        lang: "ru"
      };
      break;
    default:
      document.GW2A_EMBED_OPTIONS = {
        lang: "en"
      };
  }

}

set_gw2arm_embedding_locale();
