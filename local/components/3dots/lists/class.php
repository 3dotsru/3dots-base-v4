<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
class CUniversalList extends CBitrixComponent
{
    const CACHE_TIME = 3600;
	public function executeComponent()
    {
        if ($this->StartResultCache($this::CACHE_TIME, [CITY_ID]))
        {
            Bitrix\Main\Loader::includeModule('iblock');

            $arSelect = [ "ID", "IBLOCK_ID", "NAME", "CODE", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_*"];
            $arFilter = [
                "IBLOCK_ID"=> IntVal($this->arParams['IBLOCK_ID']),
                "ACTIVE_DATE"=>"Y",
                "ACTIVE"=>"Y"
            ];

            if($this->arParams['FILTER_NAME']){
                $arFilter = array_merge($arFilter, $GLOBALS[$this->arParams['FILTER_NAME']]);
            }

            $rsElements= CIBlockElement::GetList( [], $arFilter, false, false, $arSelect);
            while($rsElement = $rsElements->GetNextElement())
            {
                $arFields = $rsElement->GetFields();
                $arFields['PICTURE'] = $this->getImageSrc($arFields['PREVIEW_PICTURE']);
                $arFields['ALT_PICTURE'] = $this->getImageSrc($arFields['DETAIL_PICTURE']);
                $arFields['PROPERTYS'] = $rsElement->GetProperties();
                $this->arResult['ITEMS'][] = $arFields;
            }
            $this->IncludeComponentTemplate();
        }
    }

    public function getImageSrc($id)
    {
        return CFile::GetFileArray($id)['SRC'];
    }
}
;?>