<?php
$search1 = "title";
$search2 = "link";
$chars = array();
$chars2 = array();
$titles = array();
$dates = array();
$links = array();
$len = 0;
$llen = 0;
$count = 0;


$handle = @fopen("feed.txt", "r");
if ($handle)
{
    	header('Content-Type: text/plain');
    	while (!feof($handle))
	{
        	$buffer = fgets($handle);
		//print_r($buffer);
        	if(strpos($buffer, $search1) !== FALSE)
		{
            		$chars[] = $buffer;
			//$matches[] = $buffer;
		}
		if(strpos($buffer, $search2) !== FALSE)
		{
            		$chars2[] = $buffer;
			$matches[] = $buffer;
		}
	}
	fclose($handle);
	$m_len = count($chars);
	$l_len = count($chars2);
	for($i=0; $i<$m_len; $i++)
	{
    		$chars[$i] = str_split($chars[$i]);
		$len = count($chars[$i]);
		//printf("%d\n",$len);
		if($i != 0)
		{
			for($j=0; $j<$len; $j++)
			{
				if($j+9 < $len)
				{
					//printf("hey\n");
					if($chars[$i][$j] == '<' && $chars[$i][$j+1] == 't'&& $chars[$i][$j+2] == 'i')
					{
						$j = $j + 7;
						$count = $j;

						while($chars[$i][$count] != '<' || $chars[$i][$count+1] != '/' || $chars[$i][$count+2] != 't')
						{
							$titles[$i-1][$count - ($j + 7)] = $chars[$i][$count];
							$count++;
						}
						$titles[$i-1] = implode($titles[$i-1]);
						//print_r($titles);
					} elseif($chars[$i][$j] == '<' && $chars[$i][$j+1] == 'p' && $chars[$i][$j+2] == 'u' && $chars[$i][$j+3] == 'b')
					{
						$j = $j + 9;
						$count = $j;

						while($chars[$i][$count] != '<' || $chars[$i][$count+1] != '/' || $chars[$i][$count+2] != 'p')
						{
							$dates[$i-1][$count - ($j + 9)] = $chars[$i][$count];
							$count++;
						}
						$dates[$i-1] = implode($dates[$i-1]);
						//print_r($dates);
					}
				}else{
					break;
				}
			}

		}
	}
	$i=0;
	$j=0;
	for($i=0; $i<$l_len; $i++)
	{
		$chars2[$i] = str_split($chars2[$i]);
		$llen = count($chars2[$i]);
		//printf("%d\n",$llen);
		if($i != 0)
		{
			//printf("in\n");
			for($j=0; $j<$llen; $j++)
			{
				if($j+6 < $llen)
				{
					//printf("j=%d\n",$j);
					if($chars2[$i][$j] == '<' && $chars2[$i][$j+1] == 'l' && $chars2[$i][$j+2] == 'i' && $chars2[$i][$j+3] == 'n')
					{
						$j = $j + 6;
						$count = $j;
						while($chars2[$i][$count] != '<' || $chars2[$i][$count+1] != '/' || $chars2[$i][$count+2] != 'l')
						{
							$links[$i-1][$count - ($j + 7)] = $chars2[$i][$count];
							$count++;
						}
						$links[$i-1] = implode($links[$i-1]);
						//print_r($links);
					}
				}
			}
		}
	}

}

//show results:
//print_r($matches);
//print_r($chars);
//print_r($chars2);
//print_r($titles);
//print_r($dates);
//print_r($links);

printf("File 'findInRss.php' loaded\n\n");

?>