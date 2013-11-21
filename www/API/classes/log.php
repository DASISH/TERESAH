<?php
class Log {
	/**
	 * Helper class which can be used by any other class.
	 *
	 *
	 */
	 
	/**
	 *	Get the DB in a PDO way, can be called through self::DB()->PdoFunctions
	 * @return PDO php object
	 */
	private static function DB() {
		global $DB;
		return $DB;
	}
	
	/**
	 *	List logs
	 *
	 * @return array of logs
	 */
    public static function listAll(){
        $result = array();
        $query = "SELECT l.system_log_uid, l.table, l.action, l.timestamp, l.table_uid, u.login FROM system_log l, user u                      
                  INNER JOIN user u ON l.user_uid = u.user_uid";
		$req = self::DB()->prepare($query);
		$req->execute();
		$logs = $req->fetchAll(PDO::FETCH_ASSOC);
       
       return $logs;
    }
	
	/**
	 *	Insert logs
	 *
	 * @params $action		CRUD action like (INSERT, UPDATE, DELETE, ETC.)
	 * @params $user_uid	Numeric identifier of a USER
	 * @params $table		MySQL table name affected
	 * @params $table_uid	ID of the element affected
	 * @return void
	 */
	public static function insert($action, $user_uid, $table, $table_uid) {
	
        $query = "INSERT INTO system_log (`table`,`table_uid`,`action`,`user_uid`,`timestamp`) VALUES (?, ?, ?, ?, NOW())";
		$req = self::DB()->prepare($query);
		$req->execute(array($table, $table_uid, $action, $user_uid));
	}	
}
?>
