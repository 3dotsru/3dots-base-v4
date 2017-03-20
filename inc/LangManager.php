<?
use Symfony\Component\Yaml\Parser;
use Dflydev\DotAccessData\Data;
class LangManager{
    private static $lang;
    private static $messages;

    public static function get($key)
    {
        if(self::$messages->get($key)){
            return self::$messages->get($key);
        }else{
            throw new Exception("Не найдена языковая строка ".$key);
        }
    }

    public static function loadMessages($arrMessages)
    {
        if(!self::$lang){
            throw new Exception("Не выбран язык");
        }
        self::$messages = new Data($arrMessages[self::$lang]);

    }

    public static function setLang($lang)
    {
        self::$lang = $lang;
    }
}
$yaml = new Parser();
LangManager::setLang($APPLICATION->GetDirProperty("lang"));
LangManager::loadMessages($yaml->parse(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/inc/messages.yml')));