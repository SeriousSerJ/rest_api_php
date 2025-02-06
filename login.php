<?php
	
	//Подключение БД
	require 'db.php';

	//Получаем введенные данные
	$data = json_decode(file_get_contents("php://input"), true);

	//Проверяем данные на заполненность
	if (!$data['email'] || !$data['password'])
	{
		//Отправляем код ошибки
		http_response_code(400);

		//Отправляем сообщение с текстом ошибки
		echo json_encode(["message" => "Не все поля заполнены"]);

		//Завершаем код
		exit;
	}

	//Запрашиваем информацию по пользователю
	$get_r = mysqli_query($link, "SELECT * FROM `users` WHERE `email` = '".$data['email']."'");
	$get_f = mysqli_fetch_assoc($get_r);

	//Проверяем, нашелся ли пользователь и верен ли введенный пароль
	if ($get_f['email'] && password_verify($data['password'], $get_f['password']))
	{
		//Отправляем результат
		echo json_encode(["message" => "Авторизация успешна", "user_id" => $get_f['id']]);
	}
	else
	{
		//Отправляем код ошибки
		http_response_code(401);

		//Отправляем сообщение с ошибкой
		echo json_encode(["message" => "Неверные данные"]);
	}

?>