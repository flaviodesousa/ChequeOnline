<html>
<head>
	<title>Cheque On-Line - Consulta Cheques</title>
</head>
<script language="JavaScript">
function openWindow(url, name)
{
	wndCadastrarCliente = window.open(url, name, 'scrollbars,menubar,resizable,width=400,height=400');
	window.name = 'opener';
}
</script>
<body bgcolor=#FFFFFF>
	<h1>Cheque On-Line</h1>
	<h3>Baixa de Cheques</h3>
	<?
	require "col_FormularioConsulta.php3";

	if (! mysql_pconnect("localhost", "httpd", "teste"))
	{
		echo "N&atilde;o conectado!<br>";
	}
	elseif (! mysql_select_db("ChequeOnLine"))
	{
		echo "N&atilde;o selecionado!<br>";
	}
	else
	{
		if (! ($result = mysql_query($y="select * from Cheques where numero=$Cheque and associado=$AssociadoEfetivo")))
		{
			echo "Falha na consulta<br>$y<br>";
		}
		else if (! mysql_num_rows($result))
		{
			echo "N&atilde;o h&aacute; cheque n&uacute;mero $Cheque para este associado!<br>";
		}
		else
		{
			$rowCheque = mysql_fetch_array($result);

			?>
			<form action="col_EfetuarBaixa.php3" method=POST>
			<input type=hidden name=Associado value="<? echo $Associado ?>">
			<input type=hidden name=AssociadoEfetivo value="<? echo $AssociadoEfetivo ?>">
			<input type=hidden name=Operador value="<? echo $Operador ?>">
			<input type=hidden name=Cheque value="<? echo $rowCheque[numero] ?>">
			<table border>
				<tr><th colspan=2>Dados do cheque:</th></tr>
				<tr><td>CPF ou CGC</td><td><? echo $rowCheque[cliente] ?>
				<a href="javascript:openWindow('col_CadastraCliente.php3?Cliente=<? echo $rowCheque[cliente] ?>','Win')">atualizar dados</a></td></tr>
				<tr><td>Banco</td><td><? echo $rowCheque[banco] ?></td></tr>
				<tr><td>Ag&ecirc;ncia</td><td><? echo $rowCheque[agencia] ?></td></tr>
				<tr><td>Conta</td><td><? echo $rowCheque[conta] ?></td></tr>
				<tr><td>N&uacute;mero do cheque</td><td><? echo $rowCheque[numero] ?></td></tr>
				<tr><td>Valor</td><td>R$<? echo $rowCheque[valor] ?></td></tr>
				<tr><td>Data de emiss&atilde;o</td><td><? echo $rowCheque[emissao] ?></td></tr>
				<tr><td>Data de vencimento</td><td><? echo $rowCheque[vencimento] ?></td></tr>
				<tr><td><input type=radio name=tipo value=Devolvido checked> Devolu&ccedil;&atilde;o</td>
					<td>
					Motivo: <select name=devolucao_motivo>
					<option value=11>11 - Cheque sem fundos - 1a apresenta&ccedil;&atilde;o
					<option value=12>12 - Cheque sem fundos - 2a apresenta&ccedil;&atilde;o
					<option value=13>13 - Conta encerrada
					<option value=14>14 - Pr&aacute;tica esp&uacute;ria
					<option value=21>21 - Contra ordem ou oposi&ccedil;&atilde;o ao pagamento
					</select><br>
					Data: <input name=devolucao_data size=10 value="<? echo date("d/m/Y", time()) ?>">
					</td></tr>
				<tr><td><input type=radio name=tipo value=Pago> Pagamento</td><td> </td></tr>
				<tr><td colspan=2><input type=submit value="Registrar"></td></tr>
			</table>
			</form>
			<?
		}
		mysql_free_result($result);
		FormularioConsulta($Associado);
	}
	?>
</body>
</html>
