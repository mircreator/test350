<?php
// Подключение к базе данных
require_once 'db_connect.php';

// Запрос SELECT для получения данных из таблицы PROTOCOL_TABLE
$sql = "SELECT * FROM PROTOCOL_TABLE";
$result = $conn->query($sql);

// Создание таблицы HTML с полученными данными
if ($result->num_rows > 0) {
    echo "<table><tr><th>№ п\\п</th><th>Номер протокола</th><th>Дата выдачи</th><th>Ответственный</th><th>Соответствие</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["protocol_number"]. "</td><td>" . $row["issue_date"]. "</td><td>" . $row["responsible"]. "</td><td>" . $row["compliance"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Записей нет";
}
echo "<br><a href='add_protocol.php'><button>Добавить протокол</button></a>";
$conn->close();
