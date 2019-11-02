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
}

$code = 'services';
$code = 'price-list';
$id = IBlockService::getIBlockId($code);

print_r($id);
