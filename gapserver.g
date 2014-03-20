#############################################################################
#
# This is the SCSCP server configuration file.
# The service provider can start the server just by the command 
# $ gap myserver.g
#
#############################################################################

#############################################################################
#
# Load necessary packages and read external files. 
# Put here and other commands if needed.
#
#############################################################################

LogTo(); # to close the GAP log file just in case it may have been opened

LoadPackage("scscp");

# Installing some standard GAP functions as SCSCP procedures for tests and demos

InstallSCSCPprocedure( "Identity", x -> x, "Identity procedure for tests", 1, 1 );
InstallSCSCPprocedure( "Factorial", Factorial, "See ?Factorial in GAP", 1, 1 );
InstallSCSCPprocedure( "Phi", Phi, "Euler's totient function, see ?Phi in GAP", 1, 1 );
InstallSCSCPprocedure( "Size", Size, 1, 1 );
InstallSCSCPprocedure( "Determinant", Determinant );

#############################################################################
#
# Procedures and functions for the SCSCP server
#
#############################################################################


#############################################################################
#
# Auxiliary function to check that the input string has the required format,
# then wraps it into a list and evaluate in GAP
#
SafeWrapAndEvalString:=function( str )
if ForAll( str, s -> IsDigitChar(s) or s in " -(,)" ) then
  return EvalString( Concatenation( "[", str, "]") );
else
  return fail;
fi;    
end;


#############################################################################
#
# A collection of validators 
#
GAPTutorValidators:=rec();

# 
GAPTutorValidators.GeneratingSameGroup:=function( gens1, gens2 )
local res, g1, g2, hints;
g1:=Group(gens1);
g2:=Group(gens2);
res := (g1=g2);
hints := "";
if Size(g1) <> Size(g2) then
  Append(hints, "The groups have different orders. "); 
fi;
if Length(gens1) > Length(MinimalGeneratingSet(g2)) then
  Append(hints, "The list of generators contains redundant elements. ");
  if IsCyclic(g2) then
    Append(hints, "The group in question is cyclic. ");
  fi;
fi;
if Length(gens1)=1 and not IsCyclic(g2) then
  Append(hints, "The group in question is not cyclic. ");
fi;
return [res, hints];
end;


#############################################################################


ValidateAnswer := function( student_answer, model_answer, mode )

local reply, model;

reply := SafeWrapAndEvalString( student_answer );
if reply = fail then
  return [false, "Illegal input in student's answer"];
fi;

model := SafeWrapAndEvalString( model_answer );
if model = fail then
  return [false, "Illegal input in model answer"];
fi;

return GAPTutorValidators.(mode)(reply,model);

end;


InstallSCSCPprocedure( "ValidateAnswer", ValidateAnswer, 3, 3 );
 


#############################################################################
#
# Finally, we start the SCSCP server. The two arguments of RunSCSCPserver
# (SCSCPserverAddress, SCSCPserverPort) are taken from the SCSCP package 
# configuration file (localhost:26133 by default). You may specify what 
# you need using RunSCSCPserver( <string>, <integer> ) format.
#
#############################################################################

SetInfoLevel(InfoSCSCP,4); # temporary here for debugging

RunSCSCPserver( SCSCPserverAddress, SCSCPserverPort );