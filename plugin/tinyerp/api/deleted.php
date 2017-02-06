<?

$API["msz/deleted/fetch"] = array(
	"name"=>"MSZ Get portal_deleted",
	"function"=>"sm_api_plugin_msz_deleted_fetch",
	"acl"=> "MSZ_API_READ",
	"RequestMethodAllowed"=> "GET|POST",
	"params"=> "/date_from/date_to",
	"plugin" => "msz",
	"group" => "deleted",
);

function sm_api_plugin_msz_deleted_fetch( $params ) {
	global $SM_PLUGIN_MSZ_OBJECTS;

	list( $date_from, $date_to ) = split("\/", $params);

	foreach($SM_PLUGIN_MSZ_OBJECTS AS $object_name=>$null) {
		if ( $result = core_changed_fetch_by_table( $object_name, "del", $date_from, $date_to ) ){
			while($row=$result->fetch(PDO::FETCH_ASSOC)) {
				$response[] = array(
					"object" => $row["core_changed__table"],
					"id" => $row["core_changed__tableid"],
					"record_delete_date" => gmdate("Y-m-d H:i:s e", $row["record_create_date"]),
				);
			}
		}
	}
	
	return $response;
}

#
##
#

$API["msz/deleted/delete"] = array(
	"name"=>"MSZ Delete portal_deleted",
	"function"=>"sm_api_plugin_msz_deleted_delete",
	"acl"=> "MSZ_API_DELETE",
	"RequestMethodAllowed"=> "GET|DELETE",
	"params"=> "/object/id",
	"plugin" => "msz",
	"group" => "deleted",
);

function sm_api_plugin_msz_deleted_delete( $params ) {
	global $SM_PLUGIN_MSZ_OBJECTS;

	list( $object, $id ) = split("\/", $params);

	if( $SM_PLUGIN_MSZ_OBJECTS[$object] && $id ) {
		if(core_deleted_delete_by_id( $id, $object )) 
			$response = array("result" => "true");
		else
			$response = array("result" => "false");
	}
	else {
		$response = array("error" => "Unknown params");
	}

	return $response;
}

?>