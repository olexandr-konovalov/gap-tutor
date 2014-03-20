<?php	

include 'scscp.php';

$server = 'localhost';

$port = 26133;

# demonstrate how to initiate the connection

echo PingSCSCPservice( $server, 26134 );

echo PingSCSCPservice( $server, $port );

echo "\n=========================\n";

# some simple procedure calls

echo EvaluateBySCSCP( 'Factorial', '<OMI>10</OMI>', $server, $port );

echo EvaluateBySCSCP( 'Phi', "<OMI>10</OMI>", $server, $port );

echo EvaluateBySCSCP( 'Determinant', "<OMA> <OMS cd=\"linalg2\" name=\"matrix\"/> <OMA> <OMS cd=\"linalg2\" name=\"matrixrow\"/> <OMI>1</OMI> <OMI>2</OMI> </OMA> <OMA> <OMS cd=\"linalg2\" name=\"matrixrow\"/> <OMI>3</OMI> <OMI>4</OMI> </OMA> </OMA>", $server, $port );

echo EvaluateBySCSCP( 'Size', "<OMA> <OMS cd=\"permgp1\" name=\"group\"/> <OMS cd=\"permutation1\" name=\"right_compose\"/> <OMA> <OMS cd=\"permut1\" name=\"permutation\"/> <OMI>2</OMI> <OMI>3</OMI> <OMI>1</OMI> </OMA> <OMA> <OMS cd=\"permut1\" name=\"permutation\"/> <OMI>2</OMI> <OMI>1</OMI> </OMA> </OMA>", $server, $port );

# Validating the answer: check that two lists of permutations generate the same group
# Call the validator with student's and model replies and extra parameter specifying the method for validation

echo ValidateBySCSCP( '(1,2), (2,3)', '(1,2),(1,2,3)', 'GeneratingSameGroup', $server, $port );

echo ValidateBySCSCP( '(1,2),(3,4)', '(1,2),(1,2,3)', 'GeneratingSameGroup', $server, $port );

echo ValidateBySCSCP( '(1,2),(1,3),(2,3)', '(1,2),(1,2,3)', 'GeneratingSameGroup', $server, $port );

echo ValidateBySCSCP( '(1,2)*(3,4)', '(1,2),(1,2,3)', 'GeneratingSameGroup', $server, $port );

?>