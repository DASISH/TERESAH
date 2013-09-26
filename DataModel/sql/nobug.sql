SET SESSION sql_mode='NO_AUTO_VALUE_ON_ZERO';
INSERT INTO `tools_registry`.`licence_type` (`type`) VALUES ('Unknown');
INSERT INTO `tools_registry`.`licence` (`licence_uid`, `text`, `issued_by`, `licence_type_uid`) VALUES (0, 'Unknown', NULL, 'Unknown');
INSERT INTO `tools_registry`.`user` (`user_uid`, `name`, `mail`, `login`, `password`) VALUES (0, 'Bot', 'dasish@dasish.com', '00--DASISH----BOT--00', '123456789');

