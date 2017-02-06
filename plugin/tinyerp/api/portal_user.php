<?php

$API["msz/portal_user/get"] = array(
	"name" => "MSZ Get portal_user",
	"function" => "sm_api_plugin_msz_portal_user_get",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"params" => "/portal_user__id",
	"plugin" => "msz",
	"group" => "portal_user",
	"description" => "",
	"arguments" => array(
		array( "argument" => "id", "type" => "uid", "valid" => "existing portal_user__id", "default" => "required", "detail" => "unique portal_user__id ID", ),
		),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user_get()
{
	$portal_user__id = $_REQUEST["id"];

	if ( $row = portal_user_get( $portal_user__id ) ) {
		$response[] = array(
			"portal_user__id" => $row["portal_user__id"],
			"portal_user__crmid" => $row["portal_user__crmid"],
			"portal_user__username" => $row["portal_user__username"],
			"portal_user__status" => $row["portal_user__status"],
			"portal_user__firstname" => $row["portal_user__firstname"],
			"portal_user__middlename" => $row["portal_user__middlename"],
			"portal_user__lastname" => $row["portal_user__lastname"],
			"portal_user__birth_date" => $row["portal_user__birth_date"],
			"portal_user__birth_place" => $row["portal_user__birth_place"],
			"portal_user__penality" => $row["portal_user__penality"],
			"portal_user__telephone" => $row["portal_user__telephone"],
			"portal_user__fax" => $row["portal_user__fax"],
			"portal_user__mobile_phone" => $row["portal_user__mobile_phone"],
			"portal_user__nationality" => $row["portal_user__nationality"],
			"portal_user__sex" => $row["portal_user__sex"],
			"portal_user__street" => $row["portal_user__street"],
			"portal_user__street_number" => $row["portal_user__street_number"],
			"portal_user__postcode" => $row["portal_user__postcode"],
			"portal_user__city" => $row["portal_user__city"],
			"portal_user__motivation" => $row["portal_user__motivation"],
			"portal_user__other_information" => $row["portal_user__other_information"],
			"portal_user__language" => $row["portal_user__language"],
			"portal_country__name_birth_pl" => $row["portal_country__name_birth_pl"],
			"portal_country__name_birth_en" => $row["portal_country__name_birth_en"],
			"portal_country__name_birth_fr" => $row["portal_country__name_birth_fr"],
			"portal_country__id_birth" => $row["portal_country__id_birth"],
			"portal_country__crmid_birth" => $row["portal_country__crmid_birth"],
			"portal_country__name_address_pl" => $row["portal_country__name_address_pl"],
			"portal_country__name_address_en" => $row["portal_country__name_address_en"],
			"portal_country__name_address_fr" => $row["portal_country__name_address_fr"],
			"portal_country__id_address" => $row["portal_country__id_address"],
			"portal_country__crmid_address" => $row["portal_country__crmid_address"],
			"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
			"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
			);
	}

	return $response;
}

// #

$API["msz/portal_user/fetch"] = array(
	"name" => "MSZ Fetch portal_user",
	"function" => "sm_api_plugin_msz_portal_user_fetch",
	"acl" => "MSZ_API_READ",
	"RequestMethodAllowed" => "GET|POST",
	"plugin" => "msz",
	"group" => "portal_user",
	"description" => "",
	"arguments" => array(
	),
	"return" => array(
		),
	"example_query" => "?id=5abf08cc-f39d-4e39-8401-2b3c6f067fb6",
	"example_response" => array(
		),
	);

function sm_api_plugin_msz_portal_user_fetch()
{
	if ( $result = portal_user_fetch_all() ) {
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$response[] = array(
				"portal_user__id" => $row["portal_user__id"],
				"portal_user__crmid" => $row["portal_user__crmid"],
				"portal_user__username" => $row["portal_user__username"],
				"portal_user__status" => $row["portal_user__status"],
				"portal_user__firstname" => $row["portal_user__firstname"],
				"portal_user__middlename" => $row["portal_user__middlename"],
				"portal_user__lastname" => $row["portal_user__lastname"],
				"portal_user__birth_date" => $row["portal_user__birth_date"],
				"portal_user__birth_place" => $row["portal_user__birth_place"],
				"portal_user__penality" => $row["portal_user__penality"],
				"portal_user__telephone" => $row["portal_user__telephone"],
				"portal_user__fax" => $row["portal_user__fax"],
				"portal_user__mobile_phone" => $row["portal_user__mobile_phone"],
				"portal_user__nationality" => $row["portal_user__nationality"],
				"portal_user__sex" => $row["portal_user__sex"],
				"portal_user__street" => $row["portal_user__street"],
				"portal_user__street_number" => $row["portal_user__street_number"],
				"portal_user__postcode" => $row["portal_user__postcode"],
				"portal_user__city" => $row["portal_user__city"],
				"portal_user__motivation" => $row["portal_user__motivation"],
				"portal_user__other_information" => $row["portal_user__other_information"],
				"portal_user__language" => $row["portal_user__language"],
				"portal_country__name_birth_pl" => $row["portal_country__name_birth_pl"],
				"portal_country__name_birth_en" => $row["portal_country__name_birth_en"],
				"portal_country__name_birth_fr" => $row["portal_country__name_birth_fr"],
				"portal_country__id_birth" => $row["portal_country__id_birth"],
				"portal_country__crmid_birth" => $row["portal_country__crmid_birth"],
				"portal_country__name_address_pl" => $row["portal_country__name_address_pl"],
				"portal_country__name_address_en" => $row["portal_country__name_address_en"],
				"portal_country__name_address_fr" => $row["portal_country__name_address_fr"],
				"portal_country__id_address" => $row["portal_country__id_address"],
				"portal_country__crmid_address" => $row["portal_country__crmid_address"],
				"record_create_date" => gmdate( "Y-m-d H:i:s e", $row["record_create_date"] ),
				"record_modify_date" => gmdate( "Y-m-d H:i:s e", $row["record_modify_date"] ),
				);
		}
	}

	return $response;
}

?>