<?php
set_time_limit(6000);
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
	$codigo_pais = $dados['cd_pais'];
	$codPais = $dados['sg_pais'];
	$xml_output .= "	<pais>\n";
	$xml_output .= "		<nome>".$dados['tl_pais']."</nome>\n";
	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://world-geo-data.p.rapidapi.com/countries/".$codPais."/adm-divisions?language=pt",
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
		
		$arrayEstados = json_decode($response, true);
		//print_r(count($arrayEstados['divisions']));
		foreach($arrayEstados['divisions'] as $estado){
			$xml_output .= "		<estado>\n";
			$xml_output .= "			<codigo>".$estado['code']."</codigo>\n";
			$xml_output .= "			<nome>".$estado['name']."</nome>\n";
			$xml_output .= "			<sigla>".substr($estado['code'], 3)."</sigla>\n";

			$sigla = substr($estado['code'], 3);
			$iso = $estado['code'];
			$tl_estado = $estado['name'];
			//
			$result2 = $conexao->sql("SELECT * FROM sys_estado_bkp WHERE ds_iso LIKE '$iso'");
			$num_rows = mysql_num_rows($result2);
			if($num_rows != 0){
				$dados2 = mysql_fetch_array($result2);
				$codEstado = $dados['cd_estado'];

				$result2 = $conexao->sql("UPDATE sys_estado_bkp SET tl_estado = '$tl_estado',
																	sg_estado = '$sigla',
																	ds_iso = '$iso',
																	fl_atualizado = '1'
															WHERE cd_estado = '$codEstado'");
				$xml_output .= "			<status>Atualizado</status>\n";

			} else {
				$result2 = $conexao->sql("INSERT INTO sys_estado_bkp (cd_pais, tl_estado, sg_estado, ds_iso, fl_atualizado) VALUES ('$codigo_pais','$tl_estado','$sigla','$iso','1')");
				$xml_output .= "			<status>Incluido</status>\n";
			}

			//
			$xml_output .= "		</estado>\n";
		}
	}

	$xml_output .= "	</pais>\n";	
}



//

$xml_output .= "</atualiza_paises>\n";
echo $xml_output;

?>