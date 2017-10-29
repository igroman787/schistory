<?php
	
	// ���� �������������� ���������
	mb_internal_encoding("UTF-8"); // ��������� ���������
	include_once 'includes/config.php'; // ��������� HOST, USER, PASSWORD
	include_once 'additional_functions.php'; // ��������� �������������� �������
	include_once 'caption.php'; // ��������� ���������
	//include_once 'header.php'; // ��������� �����
	//include_once "manual.php"; // ��������� ������
	//include_once 'comments.php'; // ��������� ����������� ������������
	//include_once 'footer.php'; // ��������� Footer
	
	// ���������� ���������
	caption_go();
	
	// ���������� �����
	//header_go();
	
	// ��������� �������� ���������
	$clanName = $_GET['clanName'];
	$clanTag = $_GET['clanTag'];
	
	// ���������� ��������� ������
	$db_name = 'sc_clan_db';
	$db_table_to_show = 'corporations_history';
	
	// ����������� � �������� ���� ������
	$connect_to_db = mysql_connect(HOST, USER, PASSWORD)
	or die("Could not connect: " . mysql_error());
	
	// ������������ � ���� ������
	mysql_select_db($db_name, $connect_to_db)
	or die("Could not select DB: " . mysql_error());
	
	// ���� clanName �� ������, ���� �� clanTag
	if (!isset($clanName)) {
		$sql = "SELECT * FROM " . $db_table_to_show . " WHERE BINARY clanTag='" . $clanTag . "'";
	} else {
		$sql = "SELECT * FROM " . $db_table_to_show . " WHERE BINARY clanName='" . $clanName . "'";
	}
	
	// �������� ��� �������� �� ������� uid
	$qr_result = mysql_query($sql)
	or die("Could not found: " . mysql_error());

	// ������� �� �������� ����� ��������� HTML-�������
	echo('<table border="1" style="margin-bottom: 50px;">');
	echo('<thead>');
	echo('<tr>');
	echo('<th>date</th>');
	echo('<th>clanName</th>');
	echo('<th>clanTag</th>');
	echo('<th>avgEffRating</th>');
	echo('<th>avgKarma</th>');
	echo('<th>avgPrestigeBonus</th>');
	echo('<th>avgGamePlayed</th>');
	echo('<th>avgGameWin</th>');
	echo('<th>avgTotalAssists</th>');
	echo('<th>avgTotalBattleTime</th>');
	echo('<th>avgTotalDeath</th>');
	echo('<th>avgTotalDmgDone</th>');
	echo('<th>avgTotalHealingDone</th>');
	echo('<th>avgTotalKill</th>');
	echo('<th>avgTotalVpDmgDone</th>');
	echo('</tr>');
	echo('</thead>');
	echo('<tbody>');
	echo('</tr>');

	// ������� � HTML-������� ��� ������ �������� �� ������� MySQL 
	while($data = mysql_fetch_array($qr_result)){ 
		
		$date = new DateTime($data['date']);
		$date->modify('-1 day');
		$date = $date->format('Y-m-d');
		echo('<tr>');
		echo('<td>' . $date . '</td>');
		echo('<td>' . $data['clanName'] . '</td>');
		echo('<td>' . $data['clanTag'] . '</td>');
		echo('<td>' . intval($data['effRating']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['karma']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['prestigeBonus']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['gamePlayed']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['gameWin']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['totalAssists']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['totalBattleTime']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['totalDeath']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['totalDmgDone']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['totalHealingDone']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['totalKill']) / intval($data['number']) . '</td>');
		echo('<td>' . intval($data['totalVpDmgDone']) / intval($data['number']) . '</td>');
		echo('</tr>');
	}

	echo('</tbody>');
	echo('</table>');
	echo('<p><p>');

	// ��������� ���������� � �������� ���� ������
	mysql_close($connect_to_db);
	
?>