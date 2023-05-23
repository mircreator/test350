<?php
/**
 * Подкючение к базе данных
 */
const DB_SERVER = 'localhost';// сервер базы данных
const DB_USERNAME = 'root';// имя пользователя базы данных
const DB_PASSWORD = '';// пароль пользователя базы данных
const DB_NAME = 'test350';// имя базы данных
const DB_PORT     = 3306;
const DB_CHARSET = 'utf8mb4';// кодировка подключения

// Соединяемся с базой
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME,DB_PORT);

// В случае неудачного соединения показываем ошибку
if ($conn->connect_error)
{
    die('Ошибка соединения БД (' . $conn->connect_errno . ') ' . $conn->connect_error);
}
// Задаем кодировку содединения
$conn->set_charset(DB_CHARSET);
// Преобразуем столбцы типов integer и float к числам PHP
$conn->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);