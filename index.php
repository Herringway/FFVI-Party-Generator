<?php
require_once 'Dwoo/dwooAutoload.php';
$dwoo = new Dwoo();
$chars = array('Terra', 'Locke', 'Celes', 'Relm', 'Strago', 'Cyan', 'Sabin', 'Mog', 'Edgar', 'Gogo', 'Shadow', 'Umaro', 'Setzer', 'Gau');

$finalchars = array();
for ($i = 0; $i < 3; $i++) {
	for ($j = 0; $j < 4; $j++) {
		$x = array_rand($chars);
		$finalchars[$i][] = $chars[$x];
		unset($chars[$x]);
	}
}

$dwoo->output('ffvichars.tpl', array('chars' => $finalchars));
?>
