<?php
	function user_brief_info_go()
	{
		// ���� �������������� �������
		include_once('new_user.php');
		
		// ��������� �������� ���������
		$nickname = $_GET['nickname'];
		$uid = $_GET['uid'];
		$isFullTable = $_COOKIE["isFullTable"];

		// ���������� ��������� ������
		$db_name = 'sc_history_db';
		//$db_table_to_show_from_nickname = 'nickname_uid';
		//$db_table_translate_ru = 'translate_ru';

		// ����������� � �������� ���� ������
		$connect_to_db = mysql_connect(HOST, USER, PASSWORD)
		or die("Could not connect: " . mysql_error());

		// ������������ � ���� ������
		mysql_select_db($db_name, $connect_to_db)
		or die("Could not select DB: " . mysql_error());
		
		// ���� uid �� ������, ������ ���
		if (!isset($uid)) {
			$uid = FindUidFromnickname($nickname);
		}

		// �������� ��� �������� �� ������� uid
		$db_table_to_show = 'uid_' . $uid;
		$qr_result = mysql_query("SELECT * FROM " . $db_table_to_show . " ORDER BY date DESC LIMIT 1")
		or UserNotFound($nickname);
		
		$data = mysql_fetch_array($qr_result)
		
		// ������� �� �������� ����� ��������� HTML-�������
		DisplayText('<table border="1" style="margin-bottom: 50px;">');
		DisplayText('<thead>');
		DisplayText('<tr>');
		DisplayText('<th>user_icon</th>');
		DisplayText('<th>uid</th>');
		DisplayText('<th>nickname</th>');
		DisplayText('<th>clan_icon</th>');
		DisplayText('<th>clanName</th>');
		DisplayText('<th>clanTag</th>');
		DisplayText('<th>K/D</th>');
		DisplayText('<th>KDA</th>');
		DisplayText('<th>WinRate</th>');
		DisplayText('<th>W/L</th>');
		DisplayText('</tr>');
		DisplayText('</thead>');
		DisplayText('<tbody>');
		
		
		echo('<tr>');
		echo('<td>' . $date . '</td>');
		echo('<td>' . $data['uid'] . '</td>');
		echo('<td>' . $data['nickname'] . '</td>');
		echo('<td>' . $data['clanName'] . '</td>');
		echo('<td>' . $data['clanTag'] . '</td>');
		echo('<td>' . $kd . '</td>');
		echo('<td>' . $kda . '</td>');
		echo('<td>' . $wr*100 . '%</td>');
		echo('<td>' . $wl . '</td>');
		echo('<td>' . $kd2 . '</td>');
		echo('<td>' . $kda2 . '</td>');
		echo('<td>' . $wr2*100 . '%</td>');
		echo('<td>' . $wl2 . '</td>');
		echo('<td>' . $gamePlayed2 . '</td>');
		echo('</tr>');
		echo('</tbody>');
		echo('</table>');
		
		echo('<p><p>');
		
		// ��������� ���������� � �������� ���� ������
		mysql_close($connect_to_db);
		
		
	}
?>