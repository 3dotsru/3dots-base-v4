<?php

require $_SERVER['DOCUMENT_ROOT']."/inc/vendor/autoload.php";

/***********************Ловля ошибок********************/
use RuntimeException;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
$run = new Run();
$run->pushHandler(new PrettyPageHandler());
$jsonHandler = new JsonResponseHandler();
$jsonHandler->onlyForAjaxRequests(true);
$run->pushHandler($jsonHandler);
$run->register();
/***********************Ловля ошибок********************/

/********************** Константы **********************/

/*define('GEO_IBLOCK_ID', 3);
define('FILES_IBLOCK_ID', 18);*/

/********************** Константы **********************/

CModule::IncludeModule("iblock");

require $_SERVER['DOCUMENT_ROOT']."/inc/StorageHelper.php";
require $_SERVER['DOCUMENT_ROOT']."/inc/LangManager.php";


/*
function custom_mail($to, $subject, $message, $additionalHeaders = ''){

    require_once $_SERVER['DOCUMENT_ROOT'].'/inc/vendor/autoload.php';

    if(!Nette\Utils\Validators::isEmail($to))
        return true;

    try {
        $mail = new Nette\Mail\Message;
        $mail->setFrom(COption::GetOptionString("main", "site_name").' <abyss@3dots.ru>')
            ->addTo($to)
            ->setSubject($subject)
            ->setBody($message);
        if($additionalHeaders){
            $mail->clearHeader('Content-Type');
            $arAdditionalHeaders = explode("\n", $additionalHeaders);
            foreach($arAdditionalHeaders as $sAdditionalHeader){
                $arHeader = explode(": ", $sAdditionalHeader);
                if($arHeader[0] == "From") continue;
                if($arHeader[0] == "X-EVENT_NAME") continue;
                if($arHeader[1] == '') continue;
                $mail->setHeader($arHeader[0], $arHeader[1]);
            }
            //$mail->addAttachment()
        }
        $mailer = new Nette\Mail\SmtpMailer(array(
            'host' => 'smtp.gmail.com',
            'username' => 'abyss@3dots.ru',
            'password' => 'qopqopqop',
            'secure' => 'ssl'
        ));
        $mailer->send($mail);
        return true;
    }catch (Exception $e){
        AddMessage2Log($e->getMessage(), 'mailer_error');
    }
}
*/

AddEventHandler("main", "OnProlog", ["PageLive", "OnProlog"]);
AddEventHandler("main", "OnEndBufferContent", ["PageLive", "OnEndBufferContent"]);
Class PageLive{

    public function OnProlog()
    {
        global $USER;
    }

    public function OnEndBufferContent( &$content )
    {

    }
}


function showMetaProperty($id)
{
    global $APPLICATION;

    $arOgKeys = [
        'og:title' => 'TITLE',
        'og:description' => 'DESCRIPTION'
    ];
    $arPropValues = $APPLICATION->GetPagePropertyList();

    if( $arOgKeys[$id]  and $arPropValues[$arOgKeys[$id]])
        return '<meta property="'.htmlspecialcharsbx($id).'" content="'.htmlspecialcharsEx($arPropValues[$arOgKeys[$id]]).'">'."\n";

    $val = $APPLICATION->GetProperty($id);
    if(!empty($val))
        return '<meta property="'.htmlspecialcharsbx($id).'" content="'.htmlspecialcharsEx($val).'">'."\n";

    return '';
}

function ShowStripTagTitle()
{
    global  $APPLICATION;
    return strip_tags(htmlspecialcharsBack($APPLICATION->GetTitle('title', false)));
}