<?
function FormularioConsulta($Associado)
{
	?>
	<hr>
	<h3>Consulta</h3>
	<form action="col_ConsultaCheques.php3" method=POST>
	<input type=hidden name="Associado" value="<? echo $Associado ?>">
	Operador: <input type=password name="Operador" size=5><br>
	<?
	if ($Associado)
	{
		?><input type=hidden name="AssociadoEfetivo" value="<? echo $Associado ?>"><?
	}
	else
	{
		?>Associado: <input type=text name="AssociadoEfetivo" size=5><br><?
	}
	?>
	CGC ou CPF: <input type=text name="Cliente" size=14>
	<input name=action type=submit value="Pesquisar">
	</form>
	<hr>
	<h3>Baixa</h3>
	<form action="col_BaixarCheques.php3" method=POST>
	<input type=hidden name="Associado" value="<? echo $Associado ?>">
	Operador: <input type=password name="Operador" size=5><br>
	<?
	if ($Associado)
	{
		?><input type=hidden name="AssociadoEfetivo" value="<? echo $Associado ?>"><?
	}
	else
	{
		?>Associado: <input type=text name="AssociadoEfetivo" size=5><br><?
	}
	?>
	N&uacute;mero do cheque: <input type=text name=Cheque size=10>
	<input name=action type=submit value="Baixar">
	</form>
	<?
}
?>
