<?php
class Log {
    function __construct() {
		global $DB;
		$this->DB = $DB;
    }
	
    function listAll(){
        $result = array();
        $query = "SELECT l.system_log_uid, l.table, l.action, l.timestamp, l.table_uid, u.login FROM system_log l, user u                      
                  INNER JOIN user u ON l.user_uid = u.user_uid";
		$req = $this->DB->prepare($query);
		$req->execute();
		$logs = $req->fetchAll(PDO::FETCH_ASSOC);
       
       return $logs;
    }
	
	function log($action, $user_uid, $table, $table_uid) {
	
        $query = "INSERT INTO system_log (table, table_uid, action, user_uid, timestamp) VALUES (?, ?, ?, ?, NOW())";
		$req = $this->DB->prepare($query);
		
		$req->execute(array($table, $table_uid, $action, $user_uid));
	}	
}
$log = new Log();
?>
