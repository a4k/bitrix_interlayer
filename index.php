<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
echo 'test';

class IBlockService {
    public static function getIBlockId($code) {

        if (! $code) {
            throw new \InvalidArgumentException('Iblock Code must be specified');
        }

        $db_iblock = \CIBlock::GetList(array("SORT"=>"ASC"), array("CODE"=>$code), false, false, ['ID']);

        while($arRes = $db_iblock->Fetch()) {

            return $arRes["ID"];
        }
        return 0;
    }

    public static function getList($iblockId) {
        $db_iblock = \CIBlockElement::GetList(array("SORT"=>"ASC"),
            array("IBLOCK_ID"=>$iblockId), false, array("nPageSize" => "5"), ['NAME', 'PROPERTY_CITY']);

        $result = [];
        while($arRes = $db_iblock->Fetch()) {

            $result[] = $arRes;
        }
        return $result;
    }

    public static function getSectionList($iblockId) {
        $db_iblock = \CIBlockSection::GetList(array("SORT"=>"ASC"),
            array("IBLOCK_ID"=>$iblockId), false, ['NAME', 'PROPERTY_CITY'], array("nPageSize" => "5"));

        $result = [];
        while($arRes = $db_iblock->Fetch()) {

            $result[] = $arRes;
        }
        return $result;
    }
}

$code = 'services';
$code = 'price-list';
$id = IBlockService::getIBlockId($code);
$list = IBlockService::getSectionList($id);

print_r($id);
print_r($list);
