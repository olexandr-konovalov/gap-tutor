<?php	

include 'scscp.php';

$server = 'localhost';

$port = 26133;

echo PingSCSCPservice( $server, 26134 );

echo PingSCSCPservice( $server, $port );

echo "\n=========================\n";

echo EvaluateBySCSCP( 'WS_Factorial', '<OMI>10</OMI>', $server, $port );

echo EvaluateBySCSCP( 'WS_Phi', "<OMI>10</OMI>", $server, $port );

echo EvaluateBySCSCP( 'Determinant', "<OMA> <OMS cd=\"linalg2\" name=\"matrix\"/> <OMA> <OMS cd=\"linalg2\" name=\"matrixrow\"/> <OMI>1</OMI> <OMI>2</OMI> </OMA> <OMA> <OMS cd=\"linalg2\" name=\"matrixrow\"/> <OMI>3</OMI> <OMI>4</OMI> </OMA> </OMA>", $server, $port );

echo EvaluateBySCSCP( 'Size', "<OMA> <OMS cd=\"permgp1\" name=\"group\"/> <OMS cd=\"permutation1\" name=\"right_compose\"/> <OMA> <OMS cd=\"permut1\" name=\"permutation\"/> <OMI>2</OMI> <OMI>3</OMI> <OMI>1</OMI> </OMA> <OMA> <OMS cd=\"permut1\" name=\"permutation\"/> <OMI>2</OMI> <OMI>1</OMI> </OMA> </OMA>", $server, $port );

?> 