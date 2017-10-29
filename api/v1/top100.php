<?php
	function top100($sort) {
		include_once 'includes/config.php'; // ��������� HOST, USER, PASSWORD
		include_once 'additional_functions.php'; // ��������� �������������� �������
		
		// ���������� ��������� ������
		$db_name = 'sc_history_db';
		
		// ����������� � �������� ���� ������
		$connect_to_db = mysql_connect(HOST, USER, PASSWORD)
		or die("Could not connect: " . mysql_error());
		
		// ������������ � ���� ������
		mysql_select_db($db_name, $connect_to_db)
		or die("Could not select DB: " . mysql_error());
		
		// �������� ��� �������� �� �������
		$qr_result = mysql_query("SELECT * FROM top100 WHERE gamePlayed!=gamePlayed2 ORDER BY " . $sort .  " DESC LIMIT 100")
		or die("Could not found: " . mysql_error());
		
		// ��������� ���������� � �������� ���� ������
		mysql_close($connect_to_db);
		
		$outputArray = [];
		while($data = mysql_fetch_array($qr_result)){ 
			$outputArray = array_merge_recursive($outputArray, [$data]);
		}
		return $outputArray;
	}
	function top100_kd2_go() {
		
		$inputArray = top100('kd2');
		
		// ������� �� �������� ����� ��������� HTML-�������
		DisplayText('<table border="1">');
		DisplayText('<thead>');
		DisplayText('<tr>');
		
		DisplayText('<th>uid</th>');
		DisplayText('<th>nickname</th>');
		DisplayText('<th>clanTag</th>');
		
		DisplayText('<th>K/D+</th>');
		//DisplayText('<th>KDA+</th>');

		DisplayText('</tr>');
		DisplayText('</thead>');
		DisplayText('<tbody>');
		
		// ������� � HTML-������� ��� ������ �������� �� ������� MySQL 
		foreach ($inputArray as &$data) { 
			echo('<tr>');
			
			echo('<td>' . '<a href="http://ts2.scorpclub.ru/api/v1/userinfo.php?uid=' . $data['uid'] . '" target="_blank">' . $data['uid'] . '</a></td>');
			echo('<td>' . $data['nickname'] . '</td>');
			echo('<td>' . $data['clanTag'] . '</td>');
			
			echo('<td>' . $data['kd2'] . '</td>');
			//echo('<td>' . $data['kda2'] . '</td>');
			
			echo('</tr>');
		}
		
		DisplayText('</tbody>');
		DisplayText('</table>');
	}
	function top100_gamePlayed2_go() {
		
		$inputArray = top100('gamePlayed2');
		
		// ������� �� �������� ����� ��������� HTML-�������
		DisplayText('<table border="1">');
		DisplayText('<thead>');
		DisplayText('<tr>');
		
		DisplayText('<th>uid</th>');
		DisplayText('<th>nickname</th>');
		DisplayText('<th>clanTag</th>');
		
		DisplayText('<th>gamePlayed+</th>');
		DisplayText('<th>gameWin+</th>');

		DisplayText('</tr>');
		DisplayText('</thead>');
		DisplayText('<tbody>');
		
		// ������� � HTML-������� ��� ������ �������� �� ������� MySQL 
		foreach ($inputArray as &$data) { 
			echo('<tr>');
			
			echo('<td>' . '<a href="http://ts2.scorpclub.ru/api/v1/userinfo.php?uid=' . $data['uid'] . '" target="_blank">' . $data['uid'] . '</a></td>');
			echo('<td>' . $data['nickname'] . '</td>');
			echo('<td>' . $data['clanTag'] . '</td>');
			
			echo('<td>' . $data['gamePlayed2'] . '</td>');
			echo('<td>' . $data['gameWin2'] . '</td>');
			
			echo('</tr>');
		}
		
		DisplayText('</tbody>');
		DisplayText('</table>');
	}
?>