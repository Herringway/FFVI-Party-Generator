<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>FF6 Random Parties</title>
		<link rel="shortcut icon" href="http://peng.elpenguino.net/ffvisprites/terra.gif" />
	</head>
	<body style="background: lightgray;">
		<table>{loop $chars}<tr><td style="text-align: center; width: 100px; background: white;">Team {$_key+1}</td>{loop $}<td style="text-align: center; width: 75px; background: white;"><img alt="{$}" src="ffvisprites/{replace($, ' ', '%20')|lower}.gif"><br>{$}</td>{/loop}</tr>{/loop}</table>
	</body>
</html>