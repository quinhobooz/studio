<?php
header('Content-type: text/xml; charset=utf-8');
/*
// CONEXAO
*/
include "config.php";
/*
//
*/

$xml_output = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$xml_output .= "<atualiza_paises>\n";

$result = $conexao->sql("SELECT * FROM sys_paises ORDER BY sg_pais");
while ($dados = mysql_fetch_array($result)) {
	$codigo = $dados['cd_pais'];
	$codPais = $dados['sg_pais'];
	
	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://world-geo-data.p.rapidapi.com/countries/".$codPais."?language=en",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_MAXREDIRS => 1000,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"X-RapidAPI-Host: world-geo-data.p.rapidapi.com",
			"X-RapidAPI-Key: 508e852e11mshc6515ba1f4a9b82p1e4db6jsne0b7de61e16b"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		//print_r( json_decode($response) );
		$arrayPaises = json_decode($response, true);

		$codTelefone = $arrayPaises['phone_code'];
		$tl_pais = $arrayPaises['name'];
		$populacao = $arrayPaises['population'];
		$flagURL = $arrayPaises['flag']['file'];
		$timezone = $arrayPaises['timezone']['timezone'];
		$nomeMoeda = $arrayPaises['currency']['name'];
		$codigoMoeda = $arrayPaises['currency']['code'];

		$result2 = $conexao->sql("UPDATE sys_paises SET ds_codTelefone = '$codTelefone',
														tl_pais = '$tl_pais',
														ds_moeda = '$nomeMoeda',
														ds_moeda_code = '$codigoMoeda',
														ds_timezone = '$timezone',
														ds_flag_url = '$flagURL',
														ds_populacao = '$populacao'
												WHERE sg_pais = '$codPais'");
		
		
		//print_r($arrayPaises);
		$xml_output .= "	<pais>\n";
		$xml_output .= "		<codigo>".$arrayPaises['code']."</codigo>\n";
		$xml_output .= "		<nome>".$arrayPaises['name']."</nome>\n";
		$xml_output .= "		<ddi>".$arrayPaises['phone_code']."</ddi>\n";
		$xml_output .= "		<populacao>".$arrayPaises['population']."</populacao>\n";
		$xml_output .= "		<bandeira>".$arrayPaises['flag']['file']."</bandeira>\n";
		$xml_output .= "		<timezone>".$arrayPaises['timezone']['timezone']."</timezone>\n";
		$xml_output .= "		<moeda>".$arrayPaises['currency']['name']."</moeda>\n";
		$xml_output .= "		<cod_moeda>".$arrayPaises['currency']['code']."</cod_moeda>\n";
		$xml_output .= "	</pais>\n";
		
		
	}

};


	
//
$xml_output .= "</atualiza_paises>\n";

echo $xml_output;


?>