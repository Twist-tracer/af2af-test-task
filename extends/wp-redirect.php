<?php

	if (isset($_GET['ident']) && ctype_digit($_GET['ident'])) {

		require($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');

		$wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

		// устанавливаем префикс таблиц
		$wpdb->set_prefix($table_prefix);

		 // получаем название таблицы брендов
		$cntrl = new ControlListCasinos();
		$table = $cntrl->table_casino;

		// Получаем данные из БД
		$res = $wpdb->get_row("SELECT * FROM `" . $table. "` WHERE `id`= " . (int)$_GET['ident'], ARRAY_A);

		if (isset($_GET['file'])) {
			$redirect = isset($res['exefile']) && !empty($res['exefile']) ? $res['exefile'] : false;

		} elseif (isset($_GET['mom'])) {
			$redirect = isset($res['moment']) && !empty($res['moment']) ? $res['moment'] : false;

		} else {
			$redirect = isset($res['redirect']) && !empty($res['redirect']) ? $res['redirect'] : false;
		}


		if ($redirect !== false) {
			header('location: ' . htmlspecialchars_decode($redirect, ENT_NOQUOTES), '', 301);
		} else {
			header('location: /', '', 301);
		}

	}



