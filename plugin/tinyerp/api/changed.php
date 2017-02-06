<?php

$API["msz/changed/fetch"] = array(
	"name" => "MSZ Get portal_changed",
	"function" => "sm_api_plugin_msz_changed_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "changed",
	"description" => "This method return information about changes in objects.",
	"arguments" => array(
		array( "argument" => "state", "type" => "string", "valid" => "del - deleted<br>add - added<br>edit - edited", "default" => "all states", "detail" => "state of changes", ),
		array( "argument" => "date_from", "type" => "date", "valid" => "yyyy-mm-dd", "default" => "all dates", "detail" => "date first changes", ),
		array( "argument" => "date_to", "type" => "date", "valid" => "yyyy-mm-dd", "default" => "all dates", "detail" => "date last changes", ),
		),
	"return" => array(
		array( "path" => "/", "name" => "core_changed__id", "type" => "string", "description" => "portal_changed__id" ),
		array( "path" => "/", "name" => "object", "type" => "string", "description" => "name of object" ),
		array( "path" => "/", "name" => "id", "type" => "uid", "description" => "object ID" ),
		array( "path" => "/", "name" => "portal_user__id", "type" => "uid", "description" => "ID of portal user matched for selected record" ),
		array( "path" => "/", "name" => "state", "type" => "string", "description" => "type of state (del, add, edit)" ),
		array( "path" => "/", "name" => "record_changed_date", "type" => "datetime", "description" => "date and time of change" ),
		),
	"example_query" => "?state=edit&date_from=2012-01-01&date_to=2013-01-01",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_changed_fetch()
{
	global $SM_PLUGIN_MSZ_OBJECTS;

	$state = $_REQUEST["state"];
	$date_from = $_REQUEST["date_from"];
	$date_to = $_REQUEST["date_to"];

	foreach( $SM_PLUGIN_MSZ_OBJECTS AS $object_name => $null ) {
		if ( $result = portal_changed_fetch_by_table( $object_name, $state, $date_from, $date_to ) ) {
			while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
				$response[] = array(
					"core_changed__id" => $row["portal_changed__id"],
					"object" => $row["portal_changed__table"],
					"id" => $row["portal_changed__tableid"],
					"state" => $row["portal_changed__state"],
					"portal_user__id" => $row["portal_user__id"],
					"record_changed_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
					);
			}
		}
	}
	return $response;
}

$API["msz/changed/delete"] = array(
	"name" => "MSZ Delete portal_changed",
	"function" => "sm_api_plugin_msz_changed_delete",
	"acl" => "MSZ_API_DELETE",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/object/id",
	"plugin" => "msz",
	"group" => "changed",
	"description" => "This method return information about changes in objects.",
	"arguments" => array(
		array( "argument" => "id", "type" => "string", "valid" => "portal_changed__id", "default" => "", "detail" => "portal_changed__id", ),
		),
	"return" => array(
		array( "path" => "result", "name" => "string", "type" => "true/false", "description" => "" ),
		array( "path" => "error", "name" => "string", "type" => "", "description" => "" ),
		),
	"example_query" => "",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_changed_delete()
{
	global $SM_PLUGIN_MSZ_OBJECTS;

	$id = $_REQUEST["id"];

	if ( $id ) {
		if ( portal_changed_delete( $id ) )
			$response = array( "result" => "true" );
		else
			$response = array( "result" => "false" );
	} else {
		$response = array( "error" => "Unknown params" );
	}

	return $response;
}

?>