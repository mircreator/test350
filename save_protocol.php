<?php

// Подключение к базе данных
require_once 'db_connect.php';

// Если номер протокола не число
if(!is_numeric($_POST["protocol_number"]))
{
    echo "<script>alert('Номер протокола должен быть цифрой'); window.location.href = 'protocol.php';</script>";
    exit();
}
$protocol_number = intval($_POST["protocol_number"]);
// Проверка наличия записи с указанным номером протокола
$sql = 'SELECT * FROM PROTOCOL_TABLE WHERE protocol_number=?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $protocol_number);
$stmt->execute();
$result_check = $stmt->get_result();

if ($result_check->num_rows > 0)
{
    // Вывод сообщения об ошибке при наличии записи с указанным номером протокола
    echo "<script>alert('Запись с этим номером протокола уже существует'); window.location.href = 'protocol.php';</script>";
    exit();
}
else
{
    // Сохранение данных в таблицу PROTOCOL_TABLE
    // Проверяем корректность даты
    preg_match('/^(\d{4})-(\d{2})-(\d{2})$/i',$_POST["issue_date"],$machdate);
    if(!$machdate)
    {
        echo "<script>alert('Некорректная дата'); window.location.href = 'protocol.php';</script>";
        exit();
    }
    if(!checkdate($machdate[2], $machdate[3], $machdate[1]))
    {
        echo "<script>alert('Некорректная дата'); window.location.href = 'protocol.php';</script>";
        exit();
    }
    // Проверяем параметр соответствия
    if(!in_array($_POST["compliance"],['Да','Нет'])){
        echo "<script>alert('Некорректный параметр соответствия'); window.location.href = 'protocol.php';</script>";
        exit();
    }
    // Проверяем ФИО
    if (!preg_match("/^[a-zа-яёіїґє'-]{3,60}\s[a-zа-яёіїґє'-]{3,60}\s[a-zа-яёіїґє'-]{3,60}$/ui",$_POST["responsible"])) {
        echo "<script>alert('Некорректные ФИО'); window.location.href = 'protocol.php';</script>";
        exit();
    }
    $issue_date = $conn->real_escape_string($_POST["issue_date"]);
    $responsible = mb_convert_case($conn->real_escape_string($_POST["responsible"]),MB_CASE_TITLE);
    $compliance = mb_convert_case($conn->real_escape_string($_POST["compliance"]),MB_CASE_TITLE);
    $sql = 'INSERT INTO PROTOCOL_TABLE (protocol_number, issue_date, responsible, compliance)
        VALUES (?,?,?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isss', $protocol_number, $issue_date, $responsible, $compliance);
    $sql_insert = $stmt->execute();

    if ($sql_insert)
    {
        // Если запись успешна, возвращаемся в таблицу протоколов
        header('Location: protocol.php');
    }
    else
    {
        // Иначе выводим ошибку
        echo "<script>alert('Ошибка записи в БД: $sql_insert $conn->error'); window.location.href = 'protocol.php';</script>";
    }

    exit();
}