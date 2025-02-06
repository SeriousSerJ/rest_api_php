<?php
	
	//Подключение БД
	require 'db.php';

	//Получаем введенные данные
	$id = $_GET['id'] ?? null;

	//Проверяем данные на заполненность
	if (!$id)
	{
		//Отправляем код ошибки
		http_response_code(400);

		//Отправляем сообщение с текстом ошибки
		echo json_encode(["message" => "ID обязателен"]);

		//Завершаем код
		exit;
	}

	//Получение записи в БД по ID
	$get_r = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '".$id."'");
	$get_f = mysqli_fetch_assoc($get_r);

	//Проверяем на пустоту полученную запись
	if ($get_f)
	{
		//Отправляем результат
		echo json_encode(["id" => $get_f['id'], "name" => $get_f['name'], "email" => $get_f['email']]);
	}
	else
	{
		//Отправляем код ошибки
		http_response_code(404);

		//Отправляем текст с ошибкой
		echo json_encode(["message" => "Пользователь не найден"]);
	}

?>