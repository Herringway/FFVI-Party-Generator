<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>FF6 Random Parties</title>
		<link rel="shortcut icon" href="sprites/terra.gif" />
	</head>
	<style>
		body            {background: lightgray; }
		table           {text-align: center;}
		th, td          {background: white;}
		td              {width: 75px;}
		td:first-child  {width: 100px;}
	</style>
	<body>
		{%for party,chars in parties%}

		<table>
			<tr>
				<th colspan="5">{{party}} {{(chars|length > 1) ? "Parties" : "Party"}}</th>
			</tr>{%for id,characters in chars %}

			<tr>
				<td>Team {{id+1}}</td>{%for character in characters %}

				<td><img alt="{{character|capitalize}}" src="sprites/{{character|replace({' ': '%20'})}}.gif"><br>{{character|capitalize}}</td>{%endfor%}

			</tr>{%endfor%}

		</table>{%endfor%}
	</body>
</html>
