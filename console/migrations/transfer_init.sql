TRUNCATE TABLE zzr_user;
TRUNCATE TABLE zzr_user_info;
TRUNCATE TABLE zzr_affiliate;
TRUNCATE TABLE zzr_unique;
TRUNCATE TABLE zzr_device;
TRUNCATE TABLE zzr_referrer;
TRUNCATE TABLE zzr_visit;
TRUNCATE TABLE zzr_url_query;

CALL MigrateUsers();
CALL MigrateUserInfo();
CALL MigrateAffiliates();
CALL MigrateUnique();
CALL MigrateDevice();
CALL MigrateReferrer();
CALL MigrateVisit();
CALL MigrateVisitUrl();