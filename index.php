<?php
require_once 'Dwoo/dwooAutoload.php';
$dwoo = new Dwoo();
$battleatnarshechars = array('Celes', 'Locke', 'Sabin', 'Edgar', 'Cyan', 'Gau', 'Terra');
$postbattleatnarshechars = array('Celes', 'Locke', 'Sabin', 'Edgar', 'Cyan', 'Gau');
$vectorchars = array('Shadow', 'Sabin', 'Edgar', 'Cyan', 'Gau'); $vectorreqs = array('Celes', 'Locke');
$finalchars = array('Terra', 'Locke', 'Celes', 'Relm', 'Strago', 'Cyan', 'Sabin', 'Mog', 'Edgar', 'Gogo', 'Shadow', 'Umaro', 'Setzer', 'Gau');

if (!isset($_GET['trand']))
        srand(ip2long($_SERVER['REMOTE_ADDR']));

$parties = array();
$parties['Battle at Narshe'] = generate_parties(3, $battleatnarshechars);
$parties['To Zozo'] = generate_parties(1, $postbattleatnarshechars);
$parties['Vector'] = generate_parties(1, $vectorchars, $vectorreqs);
//$parties['Floating Continent'] = generate_parties(1, $vectorchars, $vectorreqs);
$parties['World of Ruin'] = generate_parties(1, $finalchars);
$parties['Final Dungeon'] = generate_parties(3, $finalchars);

$dwoo->output('ffvichars.tpl', array('parties' => $parties));

function generate_parties($numparties, $characters, $requiredchars = array()) {
	$output = array();
	
	for ($i = 0; $i < $numparties; $i++)
		$output[$i][] = get_and_remove_element($requiredchars, $characters);

	$dist = random_distribution(min($numparties*3, count($characters)), 3, $numparties);

	for ($i = 0; $i < $numparties; $i++)
		for ($j = 0; $j < $dist[$i]; $j++)
			$output[$i][] = get_and_remove_element($requiredchars, $characters);
	
	return $output;
}
function get_and_remove_element(&$arr1, &$arr2) {
	$output = null;
	if (count($arr1) > 0) {
		$x = array_rand($arr1);
		$output = $arr1[$x];
		unset($arr1[$x]);
	} else {
		$x = array_rand($arr2);
		$output = $arr2[$x];
		unset($arr2[$x]);
	}
	return $output;
}
function random_distribution($range, $individuallimit, $divisions) {
	if ($individuallimit * $divisions < $range)
		throw new Exception("Cannot divide this range under these constraints");
	$output = array();
	for ($i = 0; $i < $divisions; $i++)
		$output[$i] = 0;
	for ($i = 0; $i < $range; $i++) {
		for ($x = rand(0, $divisions-1); $output[$x] >= $individuallimit; $x = rand(0, $divisions-1));
		$output[$x]++;
	}
	return $output;
}
?>
