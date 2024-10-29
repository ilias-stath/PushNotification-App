<?php
$file = $deps[$index]->getFeed();
$searchfor[0] = '<title>';
$searchfor[1] = '<pubDate>';
$searchfor[2] = '<link>';
$tlen = 0;
$dlen= 0;
$llen = 0;
$count = 0;
$titles = array();
$dates = array();
$links = array();

// the following line prevents the browser from parsing this as HTML.
header('Content-Type: text/plain');

// get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($file);

for($search=0;$search<3;$search++){
	$j = 0;
	// escape special characters in the query
	$pattern = preg_quote($searchfor[$search], '/');

	// finalise the regular expression, matching the whole line
	$pattern = "/^.*$pattern.*\$/m";

	// search, and store all matching occurences in $matches
	if (preg_match_all($pattern, $contents, $matches))
	{
	   //echo "Found matches:\n";
	   implode("\n", $matches[0]);
	}
	else
	{
	   echo "No matches found";
	}

	//print_r($pattern);


	foreach($matches[0] as $match){
		$j++;
		//print_r($match);
		$tlen = strlen($match);
		//echo "\n\n\nsearch= ".$search."\n\n\n";
		//echo "\n\nlen= ".$tlen."\n\n";
		for($i=0;$i<$tlen;$i++){
			//echo "i=".$i."  ";
			if($search==0){
				if($match[$i] == '<' && $match[$i+1] == 't'&& $match[$i+2] == 'i'){
					$i = $i + 7;
					$count = $i;
					//print_r($match[$i]);

					if($match[$count] != '<'){
						while($match[$count] != '<' || $match[$count+1] != '/' || $match[$count+2] != 't')
						{
							$titles[$j-1][$count - ($i + 7)] = $match[$count];
							//echo "count=".$count."  ";
							$count++;
						}
						$titles[$j-1] = implode($titles[$j-1]);
						$titles[$j-1] = html_entity_decode($titles[$j-1], ENT_COMPAT, 'UTF-8');
						break;
					}else{
						$titles[$j-1] = '';
					}
					//print_r($titles[$j]);
					//echo "\n\n\n";
				}
			}elseif($search == 1){
				if($match[$i] == '<' && $match[$i+1] == 'p'&& $match[$i+2] == 'u'){
					$i = $i + 9;
					$count = $i;
					//print_r($match[$i]);

					if($match[$count] != '<'){
						while($match[$count] != '<' || $match[$count+1] != '/' || $match[$count+2] != 'p')
						{
							$dates[$j-1][$count - ($i + 9)] = $match[$count];
							$count++;
						}
						$dates[$j-1] = implode($dates[$j-1]);
						break;
					}else{
						$j--;
					}
				}
			}else{
				if($match[$i] == '<' && $match[$i+1] == 'l'&& $match[$i+2] == 'i'){
					$i = $i + 6;
					$count = $i;
					//print_r($match[$i]);

					if($match[$count] != '<'){
						while($match[$count] != '<' || $match[$count+1] != '/' || $match[$count+2] != 'l')
						{
							$links[$j-1][$count - ($i + 6)] = $match[$count];
							//echo "count=".$count."  ";
							$count++;
						}
						$links[$j-1] = implode($links[$j-1]);
						break;
					}else{
						$j--;
					}
					//print_r($titles[$j]);
					//echo "\n\n\n";
				}
			}
		}
	}
}


$tlen = count($titles);
$dlen = count($dates);
$llen = count($links);


while($tlen != 10){
	for($i=0;$i<$tlen-1;$i++){
		$titles[$i] = $titles[$i+1];
		unset($titles[$i+1]);
	}
	$tlen--;
}
while($dlen != 10){
	for($i=0;$i<$dlen-1;$i++){
		$dates[$i] = $dates[$i+1];
		unset($dates[$i+1]);
	}
	$dlen--;
}
while($llen != 10){
	for($i=0;$i<$llen-1;$i++){
		$links[$i] = $links[$i+1];
		unset($links[$i+1]);
	}
	$llen--;
}


$deps[$index]->addTitles($titles);
$deps[$index]->addDates($dates);
$deps[$index]->addLinks($links);

unset($titles);
unset($dates);
unset($links);

?>
