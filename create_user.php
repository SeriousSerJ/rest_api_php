<?php
	
	//Подключение БД
	require 'db.php';

	//Получаем введенные данные
	$data = json_decode(file_get_contents("php://input"), true);

	//Проверяем данные на заполненность
	if (!$data['name'] || !$data['email'] || !$data['password'])
	{
		//Отправляем код ошибки
		http_response_code(400);

		//Отправляем сообщение с текстом ошибки
		echo json_encode(["message" => "Не все поля заполнены"]);

		//Завершаем код
		exit;
	}

	//Шифруем пароль
	$passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

	//Добавление записи в БД
	$ins_r = mysqli_query($link, "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('".$data['name']."', '".$data['email']."', '".$passwordHash."')");

	//Отправка сообщения по завершению кода
	echo json_encode(["message" => "Пользователь создан"]);

?>