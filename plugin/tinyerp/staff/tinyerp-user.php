<?

sm_core_content_user_accesscheck($access_type_id."_READ",1);

if($_REQUEST["ajax"]){
	switch($_REQUEST["action"]){
		case "get":
			$tinyerp_user = tinyerp_user_get( $_REQUEST["tinyerp_user__id"] );
			echo json_encode($tinyerp_user);
			break;
	}
	exit;
}

$dane = $_REQUEST["dane"];
$tinyerp_user__id = $_REQUEST["tinyerp_user__id"];

if( isset($action["add"]) || isset($action["edit"]) ){
	$dane=trimall($dane);
	tinyerp_user_validate( $dane );
}

if(!is_array($ERROR)) {
	if ( isset($action["add"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_user__id = tinyerp_user_add($dane);
		header("Location: ?tinyerp_user__id=".$tinyerp_user__id);
		exit;
	}
	elseif ( isset($action["edit"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		$tinyerp_user__id = tinyerp_user_edit($dane);
		header("Location: ?tinyerp_user__id=".$tinyerp_user__id);
		exit;
	}
	elseif ( isset($action["delete"]) ) {
		sm_core_content_user_accesscheck($access_type_id."_WRITE",1);
		tinyerp_user_delete($dane["tinyerp_user__id"]);
		tinyerp_user_delete($tinyerp_user__id);
		header("Location: ?");
		exit;
	}
}
else {
	$tinyerp_user__id = $tinyerp_user__id ? $tinyerp_user__id : "0";
}

if( $tinyerp_user__id ) {
	$dane = tinyerp_user_dane( $tinyerp_user__id );
}

include "_page_header5.php";

$dane = htmlentitiesall($dane);

if (!$tinyerp_user__id && $tinyerp_user__id!="0") {

	foreach($TINYERP_ACL_ARRAY AS $k=>$v) {
		$tinyerp_acl_valuesmatch[$k] = $v["01"];
	}

	$params = array(
		"button_back" => 1,
		"button_addnew" => 1,
		"dbname" => "tinyerp_user",
		"function_fetch" => "tinyerp_user_fetch_all()",
		"mainkey" => "tinyerp_user__id",
		"columns" => array(
			array( "title"=>"Użytkownik", "width"=>"", "value"=>"%%{content_user__username}%%", "order"=>1, ),
			array( "title"=>"Państwo", "width"=>"", "value"=>"%%{tinyerp_company__name}%%", "order"=>1, ),
			array( "title"=>"Uprawnienia", "width"=>"", "value"=>"%%{tinyerp_user__acl}%%", "order"=>1, "valuesmatch"=>$tinyerp_acl_valuesmatch),
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
							<a class="btn btn-small btn-info" href="?tinyerp_user__id=0"><i class="icon-plus-sign icon-white"></i>&nbsp;<?=__("CORE", "BUTTON__ADD_NEW")?></a>
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
								"title"	=> "Firma",
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
<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if($result = content_user_fetch_all()){
			while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
				$inputfield_options[ $row["content_user__id"] ] = $row["content_user__username"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Użytkownik systemowy",
								"help"	=> "",
								"id"	=> "dane_content_user__id",
								"name"	=> "dane[content_user__id]",
								"value"	=> $dane["content_user__id"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => $inputfield_options,
								"xss_secured" => true
							));?>

<?
		$inputfield_options = array();
		$inputfield_options[0] = "--- select ---";
		if(isset($TINYERP_ACL_ARRAY)){
			foreach($TINYERP_ACL_ARRAY AS $k=>$v) {
				$inputfield_options[ $k ] = $v["01"];
			}
		}
?>
							<?=sm_inputfield(array(
								"type"	=> "select",
								"title"	=> "Uprawnienia",
								"help"	=> "",
								"id"	=> "dane_tinyerp_user__acl",
								"name"	=> "dane[tinyerp_user__acl]",
								"value"	=> $dane["tinyerp_user__acl"],
								"size"	=> "block-level",
								"disabled" => 0,
								"validation" => 0,
								"prepend" => 0,
								"append" => 0,
								"rows" => 1,
								"options" => $inputfield_options,
								"xss_secured" => true
							));?>
						</fieldset>

<?	if (sm_core_content_user_accesscheck($access_type_id."_WRITE")) { ?>
						<input type=hidden name="dane[tinyerp_user__id]" value="<?=$tinyerp_user__id?>">
						<input type=hidden name="tinyerp_user__id" value="<?=$tinyerp_user__id?>">
						<div class="btn-toolbar">
<?		if ($dane["tinyerp_user__id"]) {?>
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
