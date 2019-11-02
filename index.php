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
            array("IBLOCK_ID"=>$iblockId), false, array("nPageSize" => "2"), ['ID']);

        $result = [];
        while($arRes = $db_iblock->Fetch()) {

            $result[] = $arRes["ID"];
        }
        return $result;
    }
}

$code = 'services';
$code = 'price-list';
$id = IBlockService::getIBlockId($code);
$list = IBlockService::getList($id);

print_r($id);
print_r($list);
