<?php
	include_once 'includes/config.php'; // ��������� HOST, USER, PASSWORD
	include_once 'counter.php'; // ��������� Counter
	counter_go('1');
	
	// ���������� ��������� ������
	$db_name = 'other_db';
	$db_table_to_show = 'timestamps';
	
	// ����������� � �������� ���� ������
	$connect_to_db = mysql_connect(HOST, USER, PASSWORD)
	or exit("Could not connect: " . mysql_error());
	
	// ����������� � ���� ������
	mysql_select_db($db_name, $connect_to_db)
	or exit("Could not select DB: " . mysql_error());
	
	// �������� ��� �������� �� �������
	$qr_result = mysql_query("SELECT * FROM " . $db_table_to_show)
	or exit('Could not find: ' . mysql_error());
	
	// ��������� ���������� � �������� ���� ������
	mysql_close($connect_to_db);
	
	$data = [];
	$result = mysql_num_rows($qr_result);
	while($row = mysql_fetch_array($qr_result)) {
		$nomination = $row['nomination'];
		$value = $row['value'];
		$data = array_merge_recursive($data, [$nomination => $value]);
	}
	
	// ��������� �����
	$output = ['result' => $result, 'text' => 'ok', 'data' => $data];
	echo json_encode($output, JSON_FORCE_OBJECT); // � ������ ��� json
	
?>