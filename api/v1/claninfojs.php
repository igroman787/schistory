<?php
	
	// ���� �������������� ���������
	include_once 'includes/config.php'; // ��������� HOST, USER, PASSWORD
	include_once 'counter.php'; // ��������� Counter
	//counter_go('1');
	
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
	
	// ��������� ���������� � �������� ���� ������
	mysql_close($connect_to_db);
	
	$bigdata = [];
	$result = mysql_num_rows($qr_result);
	while($data = mysql_fetch_array($qr_result)) {
		$date = new DateTime($data['date']);
		$date->modify('-1 day');
		$date = $date->format('Y-m-d');
		$data = array_replace_recursive($data, ['date' => $date, 0 => $date]);
		$bigdata = array_merge_recursive($bigdata, [$data]);
	}
	
	// ��������� �����
	$output = ['result' => $result, 'text' => 'ok', 'bigdata' => $bigdata];
	echo json_encode($output, JSON_FORCE_OBJECT); // � ������ ��� json
	
?>