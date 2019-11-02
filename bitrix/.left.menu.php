<?
// добавим пункт меню "Импорт техники" в раздел "Информ. блоки"
$aMenuLinks = Array(
    Array(
        "Импорт техники",
        "/bitrix/admin/equipment_import.php?lang=ru",
        Array(),
        Array(
            "ALT" => "Импорт техники из dbf файлов",
            "SECTION_ID" => "iblock",
            "SORT" => "100"
        )
    )
);
?>