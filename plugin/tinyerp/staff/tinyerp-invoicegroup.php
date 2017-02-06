<?

sm_core_content_user_accesscheck($access_type_id."_READ",1);

$dane = $_REQUEST["dane"];
$tinyerp_invoicegroup__id = $_REQUEST["tinyerp_invoicegroup__id"];

if( isset($action["add"]) || isset($action["edit"]) ){
	$dane=trimall($dane);
	tinyerp_invoicegroup_validate( $dane );
}

if(!is_array($ERROR)) {
	if ( isset($action["add"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_invoicegroup__id = tinyerp_invoicegroup_add($dane);
		header("Location: ?tinyerp_invoicegroup__id=".$tinyerp_invoicegroup__id);
		exit;
	}
	elseif ( isset($action["edit"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_invoicegroup__id = tinyerp_invoicegroup_edit($dane);
		header("Location: ?tinyerp_invoicegroup__id=".$tinyerp_invoicegroup__id);
		exit;
	}
	elseif ( isset($action["delete"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		tinyerp_invoicegroup_delete($dane["tinyerp_invoicegroup__id"]);
		tinyerp_invoicegroup_delete($tinyerp_invoicegroup__id);
		header("Location: ?");
		exit;
	}
}
else {
	$tinyerp_invoicegroup__id = $tinyerp_invoicegroup__id ? $tinyerp_invoicegroup__id : "0";
}

if( $tinyerp_invoicegroup__id ) {
	$dane = tinyerp_invoicegroup_dane( $tinyerp_invoicegroup__id );
}

include "_page_header5.php";

$dane = htmlentitiesall($dane);

if (!$tinyerp_invoicegroup__id && $tinyerp_invoicegroup__id!="0") {
	$params = array(
		"button_back" => 1,
		"button_addnew" => 1,
		"dbname" => "tinyerp_invoicegroup",
		"function_fetch" => "tinyerp_invoicegroup_fetch_all()",
		"mainkey" => "tinyerp_invoicegroup__id",
		"columns" => array(
			array( "title"=>"Właściciel", "width"=>"", "value"=>"%%{tinyerp_company__name}%%", "order"=>1, ),
			array( "title"=>"Nazwa groupy", "width"=>"", "value"=>"%%{tinyerp_invoicegroup__name}%%", "order"=>1, ),
			array( "title"=>"Prefix", "width"=>"", "value"=>"%%{tinyerp_invoicegroup__prefix}%%", "order"=>1, ),
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
							<a class="btn btn-small btn-info" href="?tinyerp_invoicegroup__id=0"><i class="icon-plus-sign icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__ADD_NEW")?></a>
						</div>
					</div>

					<form action="<?=$page?>" method=post enctype="multipart/form-data" id="sm-form">

						<div class="fieldset-title">
							<div>institution</div>
						</div>
						<fieldset class="no-legend">
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if($result = tinyerp_company_fetch_all()){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
				$inputfield_options[ $row["tinyerp_company__id"] ] = $row["tinyerp_company__name"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Właściciel",
								"help"	=> "",
								"id"	=> "dane_tinyerp_company__id",
								"name"	=> "dane[tinyerp_company__id]",
								"value"	=> $dane["tinyerp_company__id"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => $inputfield_options,
								"xss_secured" => true
							));?>

							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Nazwa grupy",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoicegroup__name",
								"name"	=> "dane[tinyerp_invoicegroup__name]",
								"value"	=> $dane["tinyerp_invoicegroup__name"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
							<?=sm_inputfield(array(
								"type"	=> "text",
								"title"	=> "Prefix",
								"help"	=> "",
								"id"	=> "dane_tinyerp_invoicegroup__prefix",
								"name"	=> "dane[tinyerp_invoicegroup__prefix]",
								"value"	=> $dane["tinyerp_invoicegroup__prefix"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => "",
								"xss_secured" => true
							));?>
						</fieldset>

<?	if (sm_core_content_user_accesscheck($access_type_id."_WRITE")) { ?>
						<input type=hidden name="dane[tinyerp_invoicegroup__crmid]" value="<?=$dane["tinyerp_invoicegroup__crmid"]?>">
						<input type=hidden name="dane[tinyerp_invoicegroup__id]" value="<?=$tinyerp_invoicegroup__id?>">
						<input type=hidden name="tinyerp_invoicegroup__id" value="<?=$tinyerp_invoicegroup__id?>">
						<div class="btn-toolbar">
<?		if ($dane["tinyerp_invoicegroup__id"]) {?>
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
