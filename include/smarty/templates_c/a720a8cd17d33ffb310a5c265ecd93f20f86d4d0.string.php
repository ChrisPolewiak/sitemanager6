<?php /* Smarty version Smarty-3.0.8, created on 2013-01-20 23:48:19
         compiled from "string:" */ ?>
<?php /*%%SmartyHeaderCode:1128550fc7433a30f53-37859148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a720a8cd17d33ffb310a5c265ecd93f20f86d4d0' => 
    array (
      0 => 'string:',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1128550fc7433a30f53-37859148',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<p>Na stronie <?php echo $_smarty_tpl->getVariable('template')->value['http_host'];?>
 zostało założone konto z adresu IP <font face="trebuchet ms, verdana"><font face="trebuchet ms, verdana"><?php echo $_smarty_tpl->getVariable('template')->value['remote_addr'];?>
.</font></font></p>

<p><strong>Wprowadzone dane</strong></p>

<table border="1" cellpadding="1" cellspacing="1" style="width: 500px;">
	<tbody>
		<tr>
			<th scope="row">Imię</th>
			<td><?php echo $_smarty_tpl->getVariable('template')->value['firstname'];?>
</td>
		</tr>
		<tr>
			<th scope="row">Nazwisko</th>
			<td><?php echo $_smarty_tpl->getVariable('template')->value['lastname'];?>
</td>
		</tr>
		<tr>
			<th scope="row">Adres e-mail</th>
			<td><?php echo $_smarty_tpl->getVariable('template')->value['email'];?>
</td>
		</tr>
	</tbody>
</table>

<p>W celu potwierdzenia swojej rejestracji prosimy o <font face="trebuchet ms, verdana"><font face="trebuchet ms, verdana"><font face="trebuchet ms, verdana">kliknięcie na link poniżej <span style="font-family: 'trebuchet ms', verdana">lub skopiowanie go do pola adresu w przeglądarce.<br />
<br />
<strong><font face="trebuchet ms, verdana"><a href="<?php echo $_smarty_tpl->getVariable('template')->value['url'];?>
."><?php echo $_smarty_tpl->getVariable('template')->value['url'];?>
</a></font></strong></span></font></font></font></p>