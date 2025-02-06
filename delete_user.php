<?php
	
	//Подключение БД
	require 'db.php';

	//Получаем введенные данные
	$data = json_decode(file_get_contents("php://input"), true);

	//Проверяем данные на заполненность
	if (!$data['id'])
	{
		//Отправляем код ошибки
		http_response_code(400);

		//Отправляем сообщение с текстом ошибки
		echo json_encode(["message" => "ID обязателен"]);

		//Завершаем код
		exit;
	}

	//Изменение записи в БД
	$ins_r = mysqli_query($link, "DELETE FROM `users` WHERE `id` = '".$data['id']."'");

	//Отправка сообщения по завершению кода
	echo json_encode(["message" => "Пользователь удалён"]);

?>