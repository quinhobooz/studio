<?php 
include("config.php");
# Select Database
$sql = $conexao->sql("SELECT * FROM sys_processo_pedido_tarefa WHERE dt_limite > '2023-02-01'");

$ics_data = "BEGIN:VCALENDAR\n";
$ics_data .= "VERSION:2.0\n";
$ics_data .= "PRODID:PHP\n";
$ics_data .= "CALSCALE:GREGORIAN\n";
$ics_data .= "METHOD:PUBLISH\n";

# Change the timezone if needed

while ($event_details = mysql_fetch_assoc($sql)) {
    $id = $event_details['cd_tarefa'];
    $cd_processo = retornaProcessoDaTarefa($id);
    $dadosProcesso = retornaDadosProcessoPedido($cd_processo);
    $ds_proforma = $dadosProcesso['ds_proforma_processo'];
    $start_date = str_replace("-", "", $event_details['dt_limite']);
    //$start_time = $event_details['StartTime'];
    $end_date = str_replace("-", "", $event_details['dt_limite']);
    //$end_time = $event_details['EndTime'];
    $name = $ds_proforma." - ".$event_details['tl_tarefa'];
    //$location = $event_details['Location'];
    $description = URL_PATH."/apps/processos/processoPedidoTarefa.php?codProcessoPedido=".$cd_processo;

    # Replace HTML tags
    $search = array("/<br>/","/&amp;/","/&rarr;/","/&larr;/","/,/","/;/");
    $replace = array("\\n","&","-->","<--","\\,","\\;"); 

    $name = preg_replace($search, $replace, $name);
    //$location = preg_replace($search, $replace, $location);
    $description = preg_replace($search, $replace, $description);

    # Change TimeZone if needed
    $ics_data .= "BEGIN:VEVENT\n";
    $ics_data .= "SUMMARY:" . $name . "\n";
    $ics_data .= "UID:" . $id . "\n";
    $ics_data .= "SEQUENCE:0\n";
    $ics_data .= "DTSTART:".$start_date."\n";
    $ics_data .= "DTEND:" . $end_date . "\n";
    //$ics_data .= "LOCATION:" . $location . "\n";
    //$ics_data .= "DESCRIPTION:" . $description . "\n";
    
    
    $ics_data .= "END:VEVENT\n";
}
$ics_data .= "END:VCALENDAR\n";

# Download the File
$filename = "calendar.ics";
//header("Content-type:text/calendar");
//header("Content-Disposition: attachment; filename=$filename");
//header('Content-type: text/calendar; charset=utf-8');
//header('Content-Disposition: inline; filename=calendar.ics');
//echo $ics_data;
$file = "calendar.ics";

file_put_contents($file,$ics_data);


exit;

?>
