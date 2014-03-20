<?php	

###########################################################################
#
# PingSCSCPservice( server, port )
#
function PingSCSCPservice ( $server, $port ){
$socket=fsockopen( $server, $port );
if ($socket == false ) {
    echo 'Can not establish connection to '.$server.':'.$port."\n";
    return false;
} else {
    fclose($socket);
    echo 'Can establish connection to '.$server.':'.$port."\n";
    return true;
}
}

    
###########################################################################
#
# EvaluateBySCSCP( command, arg, server, port, cd=scscp_transient_1 );
# 
function EvaluateBySCSCP ( $command, $arg, $server, $port, $cd='scscp_transient_1' ){

# open socket connection

$socket=fsockopen( $server, $port);

# read SCSCP connection initiation message

$data = fread($socket, 4096);
if($data !== "") 
  echo '### Received connection initiation message '.$data."\n";

# respond with the protocol version 

fwrite($socket, "<?scscp version=\"1.3\" ?>\n");  

# get back agreed protocol version

$data = fread($socket, 4096);
if($data !== "") 
  echo '### Agreed protocol version '.$data."\n";

# assemble and send SCSCP procedure call
  
$str = "<?scscp start ?>\n<OMOBJ><OMATTR><OMATP><OMS cd=\"scscp1\" name=\"call_id\"/><OMSTR>test</OMSTR><OMS cd=\"scscp1\" name=\"option_return_object\"/><OMSTR></OMSTR></OMATP><OMA><OMS cd=\"scscp1\" name=\"procedure_call\"/><OMA><OMS cd=\"".$cd."\" name=\"".$command."\"/>".$arg."</OMA></OMA></OMATTR></OMOBJ>\n<?scscp end ?>\n";

echo "### Sending procedure call \n\n";

echo $str;
	
fwrite($socket, $str);

# get the reply 

echo "\n### Receiving result \n\n";

$data = '';

do {
    $line = fgets($socket, 4096);
    echo $line;
    $data .= $line;
} while ( $line != "<?scscp end ?>\n");
    
fclose($socket);

echo "-------------------------\n";

$xml = simplexml_load_string($data); 
print_r($xml->OMATTR->OMA); 

echo "=========================\n";

$res = (string) $xml->OMATTR->OMA->OMA->OMS[1]['name']; 
print_r($res);
echo "\n";
$hint = (string) $xml->OMATTR->OMA->OMA->OMSTR; 
print_r($hint);

echo "\n";

echo "#########################\n";

}

###########################################################################
#
# ValidateBySCSCP( server, port )
#
function ValidateBySCSCP ( $student_answer, $model_answer, $mode, $server, $port ){
return EvaluateBySCSCP( 'ValidateAnswer', '<OMSTR>'.$student_answer.'</OMSTR><OMSTR>'.$model_answer.'</OMSTR><OMSTR>'.$mode.'</OMSTR>', $server, $port );
}

?>