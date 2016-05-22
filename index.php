<?php
require_once 'vendor/autoload.php';
$battleatnarshechars = array('celes', 'locke', 'sabin', 'edgar', 'cyan', 'gau', 'terra');
$postbattleatnarshechars = array('celes', 'locke', 'sabin', 'edgar', 'cyan', 'gau', 'shadow');
$vectorchars = array('shadow', 'sabin', 'edgar', 'cyan', 'gau'); $vectorreqs = array('celes', 'locke');
$floatchars = array('terra', 'locke', 'celes', 'relm', 'strago', 'cyan', 'sabin', 'edgar', 'shadow', 'setzer', 'gau'); $floatreqs = array('shadow');
$finalchars = array('terra', 'locke', 'celes', 'relm', 'strago', 'cyan', 'sabin', 'mog', 'edgar', 'gogo', 'shadow', 'umaro', 'setzer', 'gau');
$phoenixchars = array('terra', 'celes', 'relm', 'strago', 'cyan', 'sabin', 'mog', 'edgar', 'gogo', 'shadow', 'umaro', 'setzer', 'gau');

if (!isset($_GET['trand']))
	srand(ip2long($_SERVER['REMOTE_ADDR']));

$parties = array();
$parties['Battle at Narshe'] = generate_parties(3, $battleatnarshechars);
$parties['Journey To Zozo'] = generate_parties(1, $postbattleatnarshechars);
if (in_array('Shadow', $parties['Journey To Zozo'][0]))
	unset($vectorchars[0]); //Shadow is unavailable if recruited to zozo
$parties['Vector'] = generate_parties(1, $vectorchars, $vectorreqs);
//$parties['Floating Continent'] = generate_parties(1, $floatchars, $floatreqs);
$parties['World of Ruin'] = generate_parties(1, $finalchars);
$parties['Phoenix Cave'] = generate_parties(2, $phoenixchars);
$parties['Final Dungeon'] = generate_parties(3, $finalchars);

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('.');
$twig = new Twig_Environment($loader);
$template = $twig->loadTemplate('ffvichars.tpl');
$template->display(['parties' => $parties]);

function generate_parties($numparties, $characters, $requiredchars = array()) {
	$output = array();
	
	for ($i = 0; $i < $numparties; $i++) //for each party,
		$output[$i][] = get_and_remove_element($requiredchars, $characters); //ensure that all the required characters for the scenario are in at least one of the parties

	$dist = random_distribution(min($numparties*3, count($characters)), 3, $numparties); //determine how many characters should be available in each party

	for ($i = 0; $i < $numparties; $i++) //for every party,
		for ($j = 0; $j < $dist[$i]; $j++) //and every character meant to be in the party,
			$output[$i][] = get_and_remove_element($requiredchars, $characters); //select an available character and add it to the party
	
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
