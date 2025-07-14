<?php
/*
Array
(
    [hid] => Форма - Получить прайс
    [name] => test
    [phone] => 05050
    [mail] => test_50550@ya.ru
)
*/

$title = 'TITLE_' . rand();
$_POST["name"] = 'test_' . rand();
$_POST["msg"] = 'Примечание_' . rand();
$_POST["phone"] = '+7(918)' . rand();

$queryData = array(
	'fields' => array(
		'TITLE' => $title,
		'NAME' => $_POST["name"],
		'COMMENTS' => $_POST["msg"],
		"STATUS_ID" => "NEW",
		"OPENED" => "Y", // ДОСТУПЕН ВСЕМ
		//"ASSIGNED_BY_ID" => 83,		
		"PHONE" => array(
			array(
				"VALUE" => $_POST["phone"],
				"VALUE_TYPE" => "WORK"
			)
		),
		/*
		"EMAIL" => array(
			array(
				"VALUE" => '',
				"VALUE_TYPE" => "WORK"
			)
		)
		*/
	),
	'params' => array(
		"REGISTER_SONET_EVENT" => "Y"
	)
);


$appRequestUrl = 'https://xxxxxxx.bitrix24.ru/rest/83/br9locib9ynxz8vl/crm.lead.add.json?'.http_build_query($queryData);

$arrContextOptions=array(
	"ssl"=>array(
		"verify_peer"=>false,
		"verify_peer_name"=>false,
	),
);  

$response = file_get_contents(urldecode($appRequestUrl), false, stream_context_create($arrContextOptions));
$json_array = json_decode($response, true);

echo '<pre>';
print_r($json_array);
echo '</pre>';
            
$results = print_r($json_array, true);
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/print_r.txt', $results);
?>
