<!DOCTYPE html>
<html>
<head>
    <title>Добавить протокол</title>
</head>
<body>
<form action="save_protocol.php" method="post">
    <label for="protocol_number">Номер протокола:</label>
    <input type="text" id="protocol_number" name="protocol_number" required>
    <br><br>
    <label for="issue_date">Дата выдачи:</label>
    <input type="date" id="issue_date" name="issue_date" required>
    <br><br>
    <label for="responsible">Ответственный (ФИО):</label>
    <input type="text" id="responsible" name="responsible" required>
    <br><br>
    <label for="compliance">Соответствие:</label>
    <select id="compliance" name="compliance" required>
        <option value="Да">Да</option>
        <option value="Нет">Нет</option>
    </select>
    <br><br>
    <input type="submit" value="Сохранить">
</form>
</body>
</html>