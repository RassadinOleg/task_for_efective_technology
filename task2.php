<?php
	echo("Задание 2 <br> <br>");

	
	//Подключение к mysql-серверу
	#Адрес сервера
	$adress = "localhost";
	#Логин и пароль пользователя mysql
	$login = "root";
	$passwd = "";
	$link = mysql_connect( $adress, $login, $passwd);
	if (!$link) {
    	die('<p style="color:red">'.mysql_connect_errno().' - '.mysql_connect_error().'</p>');
	}	
	echo("Произведено подключение к mysql <br> <br>");
	
	
	//Создание БД
	$query = "create database library";
	if (mysql_query($query, $link)) {
		echo("Создана БД 'library' <br>");
	}else{
		exit("Ошибка при создании БД");
	}
	//Выбор БД
	$query = "use library";
	if (mysql_query($query, $link)) {
		echo("Выбрана БД 'library' <br>");
	}else{
		exit("Ошибка при выборе БД 'library'");
	}
	//Создание таблицы 'authors'
	$query = "create table authors(
				id smallint primary key,
				a_name varchar(150) not null)
				engine=InnoDB
				default charset=cp1251";
	if (mysql_query($query, $link)) {
		echo("Создана таблица 'authors' <br>");
	}else{
		exit("Ошибка при создании таблицы 'authors'");
	}
	//Создание таблицы 'books'
	$query = "create table books(
				id smallint primary key,
				b_name varchar(150) not null)
				engine=InnoDB
				default charset=cp1251";
	if (mysql_query($query, $link)) {
		echo("Создана таблица 'books' <br>");
	}else{
		exit("Ошибка при создании таблицы 'books'");
	}
	//Создание таблицы 'authors_books'
	$query = "create table authors_books(
				a_id smallint not null,
				b_id smallint not null,
				foreign key(a_id) references authors(id),
				foreign key(b_id) references books(id))
				engine=InnoDB
				default charset=cp1251";
	if (mysql_query($query, $link)) {
		echo("Создана таблица 'authors_books' <br>");
	}else{
		exit("Ошибка при создании таблицы 'authors_books'");
	}
	//Вставка данных
	$query = "insert into authors(id, a_name)
			  values(1, \"Joanne Rowling\"),
			  (2, \"Mark Twain\"),
			  (3, \"John Black\"),
			  (4, \"Ivan Petrov\")";
	if (!mysql_query($query, $link)) {
		exit("Ошибка при вставке данных в таблицу 'authors'");
	}
	$query = "insert into books(id, b_name)
			  values(1, \"Harry Potter and the Philosophers Stone\"),
			  (2, \"Harry Potter and Chamber of Secrets\"),
			  (3, \"Harry Potter and the Prisoner of Azkaban\"),
			  (4, \"Harry Potter and the Goblet of Fire\"),
			  (5, \"Harry Potter and the Orden of the Phoenix\"),
			  (6, \"Harry Potter and the Half-Blood Prince\"),
			  (7, \"Harry Potter and the Deathly Hallows\"),
			  (8, \"The Adventures of Tom Sawyer\"),
			  (9, \"The Adventures of Huckleberry Finn\"),
			  (10, \"Fantastic book\")";
	if (!mysql_query($query, $link)) {
		exit("Ошибка при вставке данных в таблицу 'books'");
	}
	$query = "insert into authors_books(a_id, b_id)
			  values(1, 1),
			  (1, 2),
			  (1, 3),
			  (1, 4),
			  (1, 5),
			  (1, 6),
			  (1, 7),
			  (2, 8),
			  (2, 9),
			  (3, 10),
			  (4, 10)";
	if (!mysql_query($query, $link)) {
		exit("Ошибка при вставке данных в таблицу 'authors_books'");
	}
	echo("В БД занесены данные <br>");
	//Вывод результата запроса
	$query = "select a_name from
				authors join authors_books on id=a_id
				group by(id)
				having count(*)<7";
	$mysql_res = mysql_query($query, $link);
	if (!$mysql_res){
		exit("Ошибка выполнения запроса");
	}else{
		echo("Результат выполнения запроса: <br>");
		while ($row = mysql_fetch_assoc($mysql_res)) {
			echo($row["a_name"]); echo("<br>");
		}
	}
	//Освобождение ресурса
	mysql_free_result($mysql_res);
	
	
	//Завершение соединения с mysql
	mysql_close($link);
	echo("<br>Завершение соединения с mysql");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
</body>
</html>
