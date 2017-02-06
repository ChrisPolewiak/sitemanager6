<?

sm_core_content_user_accesscheck($access_type_id."_READ",1);

$dane = $_REQUEST["dane"];
$tinyerp_company__id = $_REQUEST["tinyerp_company__id"];

if( isset($action["add"]) || isset($action["edit"]) ){
	$dane=trimall($dane);
	tinyerp_company_validate( $dane );
}

if(!is_array($ERROR)) {
	if ( isset($action["add"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_company__id = tinyerp_company_add($dane);
		header("Location: ?tinyerp_company__id=".$tinyerp_company__id);
		exit;
	}
	elseif ( isset($action["edit"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_company__id = tinyerp_company_edit($dane);
		header("Location: ?tinyerp_company__id=".$tinyerp_company__id);
		exit;
	}
	elseif ( isset($action["delete"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		tinyerp_company_delete($dane["tinyerp_company__id"]);
		tinyerp_company_delete($tinyerp_company__id);
		header("Location: ?");
		exit;
	}
}
else {
	$tinyerp_company__id = $tinyerp_company__id ? $tinyerp_company__id : "0";
}

if( $tinyerp_company__id ) {
	$dane = tinyerp_company_dane( $tinyerp_company__id );
}

include "_page_header5.php";

$dane = htmlentitiesall($dane);

if (!$tinyerp_company__id && $tinyerp_company__id!="0") {
	$params = array(
		"button_back" => 1,
		"button_addnew" => 1,
		"dbname" => "tinyerp_company",
		"function_fetch" => "tinyerp_company_fetch_all()",
		"mainkey" => "tinyerp_company__id",
		"columns" => array(
			array( "title"=>"Nazwa firmy", "width"=>"", "value"=>"%%{tinyerp_company__name}%%", "order"=>1, ),
			array( "title"=>"NIP", "width"=>"", "value"=>"%%{tinyerp_company__vatcode}%%", "order"=>1, ),
			array( "title"=>"Miasto", "width"=>"", "value"=>"%%{tinyerp_company__city}%%", "order"=>1, ),
			array( "title"=>"E-mail", "width"=>"", "value"=>"%%{tinyerp_company__email}%%", "order"=>1, ),
		),
		"row_per_page_default" => 100,
	);
	include "_datatable_list5.php";
}
else {
?>
					<div class="btn-toolbar">
						<div class="btn-group">
							<a class="btn btn-small btn-info" href="?"><i class="icon-list icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__BACK_TO_LIST")?></a>
							<a class="btn btn-small btn-info" href="?tinyerp_company__id=0"><i class="icon-plus-sign icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__ADD_NEW")?></a>
						</div>
					</div>

					<form action="<?=$page?>" method=post enctype="multipart/form-data" id="sm-form">

						<div class="fieldset-title">
							<div>institution</div>
						</div>
						<fieldset class="no-legend">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Nazwa",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__name",
								"name"	=> "dane[tinyerp_company__name]",
								"value"	=> $dane["tinyerp_company__name"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
							<div class="float-row">
								<div class="span3">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Miasto",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__city",
								"name"	=> "dane[tinyerp_company__city]",
								"value"	=> $dane["tinyerp_company__city"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span3">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Ulica",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__street",
								"name"	=> "dane[tinyerp_company__street]",
								"value"	=> $dane["tinyerp_company__street"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Kod pocztowy",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__postcode",
								"name"	=> "dane[tinyerp_company__postcode]",
								"value"	=> $dane["tinyerp_company__postcode"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Poczta",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__postcity",
								"name"	=> "dane[tinyerp_company__postcity]",
								"value"	=> $dane["tinyerp_company__postcity"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if(isset($TINYERP_COUNTRY_ARRAY)){
			foreach($TINYERP_COUNTRY_ARRAY AS $k=>$v) {
				$inputfield_options[ $k ] = $v["01"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Country",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__country_id",
								"name"	=> "dane[tinyerp_company__country_id]",
								"value"	=> $dane["tinyerp_company__country_id"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => $inputfield_options,
								"xss_secured" => true
							));?>
								</div>
							</div>
							<div class="float-row">
								<div class="span3">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "NIP",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__vatcode",
								"name"	=> "dane[tinyerp_company__vatcode]",
								"value"	=> $dane["tinyerp_company__vatcode"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span2">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Regon",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__regon",
								"name"	=> "dane[tinyerp_company__regon]",
								"value"	=> $dane["tinyerp_company__regon"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
								<div class="span4">
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "E-mail",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__email",
								"name"	=> "dane[tinyerp_company__email]",
								"value"	=> $dane["tinyerp_company__email"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
								</div>
							</div>
						</fieldset>

<?	if (sm_core_content_user_accesscheck($access_type_id."_WRITE")) { ?>
						<input type=hidden name="dane[tinyerp_company__crmid]" value="<?=$dane["tinyerp_company__crmid"]?>">
						<input type=hidden name="dane[tinyerp_company__id]" value="<?=$tinyerp_company__id?>">
						<input type=hidden name="tinyerp_company__id" value="<?=$tinyerp_company__id?>">
						<div class="btn-toolbar">
<?		if ($dane["tinyerp_company__id"]) {?>
							<a class="btn btn-normal btn-info" id="action-edit"><i class="icon-ok icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__SAVE")?></a>
							<a class="btn btn-normal btn-danger" id="action-delete"><i class="icon-remove icon-white" onclick="return confDelete()"></i>&nbsp;<?=__("CORE", "BUTTON__DELETE")?></a>
<?		} else {?>
							<a class="btn btn-normal btn-info" id="action-add"><i class="icon-ok icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__SAVE")?></a>
<?		}?>
						</div>
<script>
$('#action-edit').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[edit]" value=1>');
	$('#sm-form').submit();
});
$('#action-delete').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[delete]" value=1>');
	$('#sm-form').submit();
});
$('#action-add').click(function() {
	$('#sm-form').append('<input type="hidden" name="action[add]" value=1>');
	$('#sm-form').submit();
});
</script>
<?	} ?>

					</form>
<?
}
?>

<? include "_page_footer5.php"; ?>
