<?
function DateAsYYYYMMDD($Date)
{
	if (preg_match("/(\d{1,2})\/(\d{1,2})\/(\d{2,4})/", $Date, $DateComponents))
	{
		if ($DateComponents[3] < 70)
		{
			$DateComponents[3] += 2000;
		}
		elseif ($DateComponents[3] < 100)
		{
			$DateComponents[3] += 1900;
		}
		elseif ($DateComponents[3] < 1970)
		{
			return "";
		}
		return $DateComponents[3] * 10000 + $DateComponents[2] * 100 + $DateComponents[1];
	}
	else
	{
		return "";
	}
}
?>
