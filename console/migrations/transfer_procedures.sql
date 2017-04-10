DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateUsers $$
CREATE PROCEDURE MigrateUsers ()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE user_p_id, user_status INT;
  DECLARE user_c, user_u DATETIME;
  DECLARE user_login, user_password_hash, user_auth_key, user_reset_token VARCHAR(255);

  DECLARE cur1 CURSOR FOR SELECT
                            n_id_user,
                            login,
                            IFNULL(password_hash, MD5(n_id_user+RAND())),
                            status_user,
                            MD5(n_id_user+RAND()),
                            MD5(n_id_user+RAND()),
                            IFNULL(created_at, NOW()),
                            IFNULL(updated_at, NOW())
                          FROM tracking_users;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur1;

  read_loop: LOOP
    FETCH cur1 INTO user_p_id, user_login, user_password_hash, user_status, user_auth_key, user_reset_token, user_c, user_u;

    IF done THEN
      LEAVE read_loop;
    END IF;

    INSERT zzr_user (id, login, password_hash, status, auth_key, password_reset_token, created_at, updated_at)
    VALUES (user_p_id, user_login, user_password_hash, user_status, user_auth_key, user_reset_token, user_c, user_u);

  END LOOP;

  CLOSE cur1;
END$$
DELIMITER ;
#-----------------------------------------------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateUserInfo $$
CREATE PROCEDURE MigrateUserInfo ()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE user_p_id INT;
  DECLARE user_c, user_u DATETIME;
  DECLARE user_login, user_skype, user_language, user_utm_source VARCHAR(255);

  DECLARE cur2 CURSOR FOR SELECT
                            n_id_user,
                            login,
                            skype,
                            language,
                            utm_source,
                            NOW(),
                            NOW()
                          FROM tracking_users;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur2;

  read_loop: LOOP
    FETCH cur2 INTO user_p_id, user_login, user_skype, user_language, user_utm_source, user_c, user_u;

    IF done THEN
      LEAVE read_loop;
    END IF;

    INSERT zzr_user_info (user_id, username, skype, language, utm_source, created_at, updated_at)
    VALUES (user_p_id, user_login, user_skype, user_language, user_utm_source, user_c, user_u);

  END LOOP;

  CLOSE cur2;
END$$
DELIMITER ;
#-----------------------------------------------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateAffiliates $$
CREATE PROCEDURE MigrateAffiliates ()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE user_p_id, aff_id, aff_team_id INT;
  DECLARE aff_c, aff_u DATETIME;
  DECLARE aff_name VARCHAR(255);

  DECLARE cur3 CURSOR FOR SELECT
                            id_affiliate,
                            (SELECT n_id_user
                             FROM tracking_users
                             WHERE affiliate_id = tracking_affiliates.id_affiliate
                            ) as n_id_user,
                            name_affiliate,
                            team_id,
                            NOW(),
                            NOW()
                          FROM tracking_affiliates;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur3;

  read_loop: LOOP
    FETCH cur3 INTO aff_id, user_p_id, aff_name, aff_team_id, aff_c, aff_u;

    IF done THEN
      LEAVE read_loop;
    END IF;

    INSERT zzr_affiliate (id, user_id, name, team_id, created_at, updated_at)
    VALUES (aff_id, user_p_id, aff_name, aff_team_id, aff_c, aff_u);

  END LOOP;

  CLOSE cur3;
END$$
DELIMITER ;
#-----------------------------------------------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateUnique $$
CREATE PROCEDURE MigrateUnique ()
BEGIN
  INSERT zzr_unique (id, created_at, updated_at)
    SELECT id, IFNULL(created_at, NOW()), NOW() FROM tracking_unique;
END$$
DELIMITER ;
#-----------------------------------------------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateDevice $$
CREATE PROCEDURE MigrateDevice ()
BEGIN
  INSERT zzr_device (id, is_mobile, is_tablet, is_bot, is_desktop, os, os_version, client_type, client_name, client_version, brand, model, created_at, updated_at)
  SELECT id, is_mobile, is_tablet, is_bot, is_desktop, os, os_version, client_type, client_name, client_version, brand, model, NOW(), NOW() FROM tracking_device;
END$$
DELIMITER ;
#-----------------------------------------------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateReferrer $$
CREATE PROCEDURE MigrateReferrer ()
BEGIN
  INSERT zzr_referrer (id, host, url, created_at, updated_at)
  SELECT id, host, host, NOW(), NOW() FROM tracking_refhost;
END$$
DELIMITER ;
#-----------------------------------------------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateVisit $$
CREATE PROCEDURE MigrateVisit ()
BEGIN
  INSERT zzr_visit (id, parent_id, type, unique_id, url_query_id, device_id, referrer_id, geo_code, user_agent, headers, created_at, updated_at)
  SELECT
    id,
    0,
    1,
    unique_id,
    (
      INSERT zzr_url_query (created_at, updated_at) VALUES (NOW(), NOW())
      SELECT LAST_INSERT_ID()
    ) as url_query_id,
    (SELECT device_id FROM tracking_unique WHERE tracking_unique.id = tracking_visit.unique_id LIMIT 1) as device_id,
    referer_id,
    geo_code,
    null,
    null,
    created_at,
    NOW()
  FROM tracking_visit;
END$$
DELIMITER ;
#-----------------------------------------------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE IF EXISTS MigrateVisitUrl $$
CREATE PROCEDURE MigrateVisitUrl ()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE visit_id INT;

  DECLARE cur1 CURSOR FOR SELECT id FROM zzr_visit;

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur1;

  read_loop: LOOP
    FETCH cur1 INTO visit_id;

    IF done THEN
      LEAVE read_loop;
    END IF;

    INSERT INTO zzr_url_query (created_at, updated_at) VALUES (NOW(), NOW());
    UPDATE zzr_visit SET url_query_id = LAST_INSERT_ID() WHERE id = visit_id;

  END LOOP;

  CLOSE cur1;
END$$
DELIMITER ;