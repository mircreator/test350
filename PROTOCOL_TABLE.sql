CREATE TABLE `PROTOCOL_TABLE` (
    `id` INT(10) NOT NULL AUTO_INCREMENT COMMENT 'Номер пункта',
    `protocol_number` INT(10) NOT NULL COMMENT 'Номер протокола',
    `issue_date` DATE NOT NULL COMMENT 'Дата выдачи',
    `responsible` VARCHAR(255) NOT NULL COMMENT 'Ответственный',
    `compliance` ENUM('Да', 'Нет') NOT NULL COMMENT 'Соответствие',
    PRIMARY KEY (`id`),
    UNIQUE KEY (`protocol_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;