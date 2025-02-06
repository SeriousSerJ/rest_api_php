<?php
	
	$host = 'localhost'; //Адрес хоста
	$dbname = 'test_db'; //Имя базы данных
	$username = 'root'; //Имя пользователя
	$password = ''; //Пароль пользователя

	//Вызываем подключение к БД
	$link = mysqli_connect($host, $username, $password, $dbname);

	//Меняем кодировку у подключения
	mysqli_set_charset($link, 'utf8');

?>