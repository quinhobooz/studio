<?php
//diretorio dos arquivos
define("DIR_INCLUDE", "assets/");
define("DIR_PHP", "assets/php/");
define("DIR_CLASS"  , "assets/php/class/");
define("DIR_JS"  , "assets/js/");
define("LOCAL", '0');
define("SESSION", '1');
ini_set('display_errors', 'On');
error_reporting(E_ERROR | E_PARSE);

//email stuff
define("SITE_NAME", "Studio Export - BS");
define("SITE_ADDRESS", "http://www.bsimportexport.com.br/");

if(LOCAL == 1) {
	define("SERVIDOR", "186.202.152.213");
	define("USUARIO" , "bsimportexport");
	define("SENHA"   , "rph65002012");
	define("BANCO"   , "bsimportexport"); 
	define("URL_PATH", "http://localhost:8888/bsimportexport/studio");
	define("PROCESSOS_PATH", "http://localhost:8888/bsimportexport/studio/apps/processos");
	define("LOGIN_PATH", "http://localhost:8888/bsimportexport/studio");
	define("URL_PATH_USER", "http://localhost:8888/bsimportexport/vendor");
	define("SITE_PATH", "http://localhost:8888/bsimportexport");
	define("SQL_DEBUG", "1");
	define("EMAIL_CONTATO", "quinhobooz@gmail.com");
	define("EMAIL_SUPORTE", "quinhobooz@gmail.com");
	define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'].'/bsimportexport/studio');
} else {
	define("SERVIDOR", "186.202.152.213");
	define("USUARIO" , "bsimportexport");
	define("SENHA"   , "rph65002012");
	define("BANCO"   , "bsimportexport"); 
	define("URL_PATH", "http://www.bsimportexport.com.br/studio");
	define("LOGIN_PATH", "http://www.bsimportexport.com.br/studio");
	define("URL_PATH_USER", "http://www.bsimportexport.com.br/vendor");
	define("SITE_PATH", "http://www.bsimportexport.com.br");
	define("SQL_DEBUG", "1");
	define("EMAIL_CONTATO", "quinhobooz@gmail.com");
	define("EMAIL_SUPORTE", "quinhobooz@gmail.com");
	define("PROCESSOS_PATH", "http://www.bsimportexport.com.br/studio/apps/processos");
	define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'].'/studio');
}
include_once(DIR_CLASS."conexao.class.php");
$conexao = new ConexaoMysql();
$conexao->sql("SET NAMES 'utf8';");

include(DIR_CLASS."session.class.php");
include(DIR_CLASS."class.upload.php");
include(DIR_PHP."funcoes.php");
$timezone = date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>