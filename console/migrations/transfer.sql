TRUNCATE TABLE zzr_user;
TRUNCATE TABLE zzr_user_info;
TRUNCATE TABLE zzr_affiliate;
TRUNCATE TABLE zzr_unique;
TRUNCATE TABLE zzr_device;
TRUNCATE TABLE zzr_referrer;
TRUNCATE TABLE zzr_visit;

INSERT zzr_user (id, login, password_hash, status, auth_key, password_reset_token, created_at, updated_at)
  SELECT n_id_user, login, IFNULL(password_hash, MD5(n_id_user+RAND())), status_user, MD5(n_id_user+RAND()), MD5(n_id_user+RAND()), IFNULL(created_at, NOW()), IFNULL(updated_at, NOW()) FROM tracking_users;

INSERT zzr_user_info (user_id, username, skype, language, utm_source)
  SELECT n_id_user, login, skype, language, utm_source FROM tracking_users;

INSERT zzr_affiliate (id, user_id, name, team_id)
  SELECT id_affiliate, (SELECT n_id_user FROM tracking_users WHERE affiliate_id = tracking_affiliates.id_affiliate) as user_id, name_affiliate, team_id FROM tracking_affiliates;

INSERT zzr_unique (id, created_at, updated_at)
    SELECT id, IFNULL(created_at, NOW()), NOW() FROM tracking_unique;

INSERT zzr_device (id, is_mobile, is_tablet, is_bot, is_desktop, os, os_version, client_type, client_name, client_version, brand, model, created_at, updated_at)
  SELECT id, is_mobile, is_tablet, is_bot, is_desktop, os, os_version, client_type, client_name, client_version, brand, model, NOW(), NOW() FROM tracking_device;

INSERT zzr_referrer (id, host, url, created_at, updated_at)
  SELECT id, host, host, NOW(), NOW() FROM tracking_refhost;

INSERT zzr_visit (id, parent_id, type, unique_id, device_id, referrer_id, geo_code, ip, user_agent, headers, created_at, updated_at)
  SELECT
    id,
    0,
    1,
    unique_id,
    (SELECT device_id FROM tracking_unique WHERE tracking_unique.id = tracking_visit.unique_id LIMIT 1) as device_id,
    referer_id,
    geo_code,
    (SELECT tracking_ip.ip FROM tracking_ip LEFT JOIN tracking_click ON tracking_click.ip_id = tracking_ip.id WHERE tracking_click.visit_id = tracking_visit.id LIMIT 1) as ip,
    null,
    null,
    created_at,
    NOW()
  FROM tracking_visit;



CREATE TABLE bar (m INT) SELECT n FROM foo;
SELECT LAST_INSERT_ID();
SET @last_id_in_table = LAST_INSERT_ID();


