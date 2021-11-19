<?php ini_set('display_errors', 1);ini_set('display_startup_errors', 1);error_reporting(E_ALL);
/*define("DB_HOST","localhost");define("DB_PORT","3306");define("DB_USER","root");define("DB_PASSWORD","1234");define("DB_NAME","com_general"); //Web
define("DB_HOSTAudit","localhost");define("DB_PORTAudit","3306");define("DB_USERAudit","root");define("DB_PASSWORDAudit","1234");define("DB_NAMEAudit","com_audit"); //Web*/

define("DB_HOST","localhost");define("DB_PORT","3306");define("DB_USER","businessIns_root");define("DB_PASSWORD","9_z9fTbTQB5A");define("DB_NAME","businessins_general"); //Web
define("DB_HOSTAudit","localhost");define("DB_PORTAudit","3306");define("DB_USERAudit","businessIns_root");define("DB_PASSWORDAudit","9_z9fTbTQB5A");define("DB_NAMEAudit","businessins_audit"); //Web

global $connEMM, $connEMMAudit, $dtDateTime;

if(@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT) or die("Please try after a while...")){
	$connEMM=@mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,DB_PORT) or die("Please try after a while...");
	if($connEMM){
		@mysqli_query($connEMM, "SET CHARACTER SET utf8mb4");
		@mysqli_query($connEMM, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}

if(@mysqli_connect(DB_HOSTAudit, DB_USERAudit, DB_PASSWORDAudit, DB_NAMEAudit,DB_PORTAudit) or die("Please try after a while...")){
	$connEMMAudit=@mysqli_connect(DB_HOSTAudit, DB_USERAudit, DB_PASSWORDAudit, DB_NAMEAudit,DB_PORTAudit) or die("Please try after a while...");
	if($connEMMAudit){
		@mysqli_query($connEMMAudit, "SET CHARACTER SET utf8");
		@mysqli_query($connEMMAudit, "SET SESSION collation_connection='utf8_general_ci'");
	}else{
		trigger_error("Please try after a while...");
		exit();
	}
}else{
	trigger_error("Please try after a while...");
	exit();
}


?>