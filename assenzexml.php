<?php

$myXMLData = "<?xml version='1.0' encoding='UTF-8'?><assenze><assenza><assenza_tipo>ferie</assenza_tipo><data_inizio>2022-03-18</data_inizio><gg_ferie>1</gg_ferie><ore_assenza>8.5</ore_assenza></assenza></assenze>";

// $xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
// echo $xml;



$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?> <assenze></assenze>');
$assenza = $xml->addChild('assenza');
$assenza->addChild('assenza_tipo','ferie');
$assenza->addChild('data_inizio','2022-03-18');
$assenza->addChild('gg_ferie','5');
$assenza->addChild('ore_assenza','38');

// $myXMLData = $xml->asXML();
Header('Content-type: text/xml');
echo $xml->asXML();

?>