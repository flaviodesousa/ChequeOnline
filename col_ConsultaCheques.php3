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
	<h3>Consulta Cheques</h3>
	<?
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
		if ($result = mysql_query("select * from Cheques where cliente=$Cliente"))
		if (mysql_num_rows($result))
		{
			$total = 0;
			?><table>
			<tr><th>N&uacute;mero</th><th>Vencimento</th><th>Valor</th></tr><?
			while ($rowCheque = mysql_fetch_array($result))
			{
				?>
				<tr>
					<td><? echo $rowCheque[numero] ?></td>
					<td><? echo $rowCheque[vencimento] ?></td>
					<td><? echo $rowCheque[valor] ?></td>
				</tr>
				<?
				$total += $rowCheque[valor];
			}
			?></table><?

			echo "Total: R\$ $total<br>";
		}
	}

	$emissao = $vencimento = date("d/m/Y", time());
	?>
	<hr>
	<form action="col_CadastraCheque.php3" method=POST>
		<input type=hidden name=Associado value="<? echo $Associado ?>">
		<input type=hidden name=AssociadoEfetivo value="<? echo $AssociadoEfetivo ?>">
		<input type=hidden name=Operador value="<? echo $Operador ?>">
		<input type=hidden name=Cliente value="<? echo $Cliente ?>">
		<table>
			<tr><th colspan=2>Dados do cheque:</th></tr>
			<tr><td>CPF ou CGC</td><td><? echo $Cliente ?>
			<a href="javascript:openWindow('col_CadastraCliente.php3?Cliente=<? echo $Cliente ?>','Win')">atualizar dados</a></td></tr>
			<tr><td>Banco</td><td><input type=text name=Cheque[banco] size=4></td></tr>
			<tr><td>Ag&ecirc;ncia</td><td><input type=text name=Cheque[agencia] size=4></td></tr>
			<tr><td>Conta</td><td><input type=text name=Cheque[conta] size=10></td></tr>
			<tr><td>N&uacute;mero do cheque</td><td><input type=text name=Cheque[numero] size=10></td></tr>
			<tr><td>Valor</td><td>R$<input type=text name=Cheque[valor] size=16></td></tr>
			<tr><td>Data de emiss&atilde;o</td><td><input type=text name=Cheque[emissao] size=10 value="<? echo $emissao ?>"></td></tr>
			<tr><td>Data de vencimento</td><td><input type=text name=Cheque[vencimento] size=10 value="<? echo $vencimento ?>"></td></tr>
			<tr><td colspan=2><input type=submit value="Registrar cheque"></td></tr>
		</table>
	</form>
</body>
</html>
