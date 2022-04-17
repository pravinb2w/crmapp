

CREATE TABLE `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from leads',
  `deal_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from deals',
  `customer_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from leads',
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from users',
  `started_at` timestamp NULL DEFAULT NULL,
  `due_at` timestamp NULL DEFAULT NULL,
  `done_at` timestamp NULL DEFAULT NULL,
  `done_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'busy,free',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-inactive,1-active, 2-done',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_lead_id_foreign` (`lead_id`),
  KEY `activities_customer_id_foreign` (`customer_id`),
  KEY `activities_user_id_foreign` (`user_id`),
  KEY `activities_done_by_foreign` (`done_by`),
  KEY `activities_added_by_foreign` (`added_by`),
  KEY `activities_updated_by_foreign` (`updated_by`),
  KEY `activities_deal_id_foreign` (`deal_id`),
  CONSTRAINT `activities_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `activities_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `activities_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `activities_done_by_foreign` FOREIGN KEY (`done_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `activities_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `activities_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO activities VALUES("1","Recruriet","task","","2","","2","2","2022-03-13 19:34:00","2022-03-13 19:44:00","2022-03-13 10:22:32","2","","1","1","","","2022-03-13 10:01:09","2022-03-13 10:22:32");
INSERT INTO activities VALUES("2","teste","deadline","","","1","2","2","2022-03-13 19:15:00","2022-03-13 19:25:00","","","","1","2","","2022-03-14 02:59:59","2022-03-13 10:42:55","2022-03-14 02:59:59");
INSERT INTO activities VALUES("3","Checking durair","deadline","","3","","4","2","2022-03-14 10:41:00","2022-03-14 10:51:00","","","","1","1","","2022-03-14 03:10:21","2022-03-14 03:09:13","2022-03-14 03:10:21");
INSERT INTO activities VALUES("4","Home Clean","meeting","","3","","4","2","2022-03-14 10:42:00","2022-03-14 10:52:00","2022-03-14 03:11:45","1","","1","1","","","2022-03-14 03:10:58","2022-03-14 03:11:45");
INSERT INTO activities VALUES("5","Operating","task","","3","","4","2","2022-03-14 12:45:00","2022-03-14 12:55:00","","","","1","1","","2022-03-14 03:11:29","2022-03-14 03:11:23","2022-03-14 03:11:29");
INSERT INTO activities VALUES("6","Testin of the lead","email","","1","","1","2","2022-03-14 10:14:00","2022-03-14 10:24:00","","","","1","1","","2022-03-14 03:43:54","2022-03-14 03:43:35","2022-03-14 03:43:54");
INSERT INTO activities VALUES("7","dela activity","deadline","","","2","4","2","2022-03-14 09:18:00","2022-03-14 09:28:00","","","","1","1","","2022-03-14 03:48:48","2022-03-14 03:46:52","2022-03-14 03:48:48");
INSERT INTO activities VALUES("8","checktin gthe deal","task","","","2","4","2","2022-03-14 10:20:00","2022-03-14 10:30:00","","","","1","1","","2022-03-14 03:49:37","2022-03-14 03:47:43","2022-03-14 03:49:37");
INSERT INTO activities VALUES("9","Testing of activbity","task","","","2","4","3","2022-03-14 09:20:00","2022-03-14 09:30:00","","","","1","1","","2022-03-14 16:28:37","2022-03-14 03:49:25","2022-03-14 16:28:37");
INSERT INTO activities VALUES("10","te23343","email","","","2","4","2","2022-03-14 21:57:00","2022-03-14 22:07:00","2022-03-14 16:35:42","1","","1","1","","2022-03-14 16:38:45","2022-03-14 16:27:32","2022-03-14 16:38:45");
INSERT INTO activities VALUES("11","Durai testiging","deadline","","","2","4","2","2022-03-14 23:07:00","2022-03-14 23:17:00","","","","1","1","","2022-03-14 16:35:23","2022-03-14 16:35:11","2022-03-14 16:35:23");
INSERT INTO activities VALUES("12","fist stste","task","","","2","4","2","2022-03-14 00:12:00","2022-03-14 00:22:00","2022-03-21 14:32:55","1","","1","1","","","2022-03-14 16:40:12","2022-03-21 14:32:55");
INSERT INTO activities VALUES("13","DEak deal activity","email","","2","","4","3","2022-03-14 11:10:00","2022-03-14 11:20:00","2022-03-14 16:41:03","1","","1","1","1","2022-03-21 14:04:50","2022-03-14 16:40:29","2022-03-21 14:04:50");
INSERT INTO activities VALUES("14","#mail email acivity","email","","1","","1","2","2022-03-18 11:56:00","2022-03-18 12:06:00","","","","1","1","1","2022-03-18 17:51:10","2022-03-18 17:26:15","2022-03-18 17:51:10");
INSERT INTO activities VALUES("15","Lead activity for testing","task","","1","","1","2","2022-03-20 12:25:00","2022-03-20 12:35:00","2022-03-21 14:18:38","1","","1","1","1","","2022-03-20 04:54:06","2022-03-21 14:18:38");
INSERT INTO activities VALUES("16","Live in aCT","deadline","","","2","4","2","2022-03-21 08:35:00","2022-03-21 08:45:00","","","","1","1","1","2022-03-21 14:04:35","2022-03-21 13:04:01","2022-03-21 14:04:35");
INSERT INTO activities VALUES("17","NEW aCTIVITY opf ind","email","","","2","4","2","2022-03-21 08:37:00","2022-03-21 08:47:00","2022-03-21 14:32:16","1","","1","1","1","","2022-03-21 14:05:10","2022-03-21 14:33:17");
INSERT INTO activities VALUES("18","New of","task","","1","","1","2","2022-03-21 19:49:00","2022-03-21 19:59:00","2022-03-21 14:29:30","1","","1","1","","","2022-03-21 14:17:34","2022-03-21 14:29:30");
INSERT INTO activities VALUES("19","Durait estetin","lunch","","1","","1","3","2022-03-21 08:59:00","2022-03-21 09:09:00","2022-03-21 14:30:17","1","","1","1","1","","2022-03-21 14:30:02","2022-03-21 16:16:00");
INSERT INTO activities VALUES("20","Jest veet","meeting","teste","","","","3","2022-03-21 11:50:00","2022-03-21 12:00:00","","","","1","1","1","","2022-03-21 16:18:20","2022-03-21 16:18:45");
INSERT INTO activities VALUES("21","Manikroth","email","","","3","7","2","2022-04-17 09:29:00","2022-04-17 09:39:00","","","","1","1","","","2022-04-17 00:56:24","2022-04-17 00:56:24");
INSERT INTO activities VALUES("22","Hour Break","deadline","","","3","7","4","2022-04-17 08:30:00","2022-04-17 08:40:00","","","","1","1","","","2022-04-17 00:58:24","2022-04-17 00:58:24");



CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_staff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_my_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO announcements VALUES("1","New Offer","<p>Make it Simple, Buy one and get Three</p>","0","0","0","2022-04-17 00:37:10","2022-04-17 00:37:10");



CREATE TABLE `audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO audits VALUES("1","App\Models\User","1","updated","App\Models\CompanySettings","1","{"site_logo":null}","{"site_logo":"account\/9rOmtojZtQZ7xKxcaIqeVKuttdbjDaYYNkV3zuUH.png"}","http://127.0.0.1:8000/company/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:10:38","2022-03-13 09:10:38");
INSERT INTO audits VALUES("2","App\Models\User","1","created","App\Models\Customer","1","[]","{"status":1,"first_name":"Gopal","email":"gopal@yopmail.com","mobile_no":"9551706025","added_by":1,"id":1}","http://127.0.0.1:8000/enquiry","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:25:23","2022-03-13 09:25:23");
INSERT INTO audits VALUES("3","App\Models\User","1","created","App\Models\Lead","1","[]","{"customer_id":1,"status":1,"added_by":1,"lead_subject":"Test","lead_description":"tstetet","id":1}","http://127.0.0.1:8000/enquiry","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:25:24","2022-03-13 09:25:24");
INSERT INTO audits VALUES("4","App\Models\User","1","created","App\Models\Organization","1","[]","{"name":"Godreg","added_by":1,"status":1,"id":1}","http://127.0.0.1:8000/autocomplete_org_save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:26:59","2022-03-13 09:26:59");
INSERT INTO audits VALUES("5","App\Models\User","1","updated","App\Models\Customer","1","{"organization_id":null}","{"organization_id":"1"}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:27:03","2022-03-13 09:27:03");
INSERT INTO audits VALUES("6","App\Models\User","1","created","App\Models\LeadType","1","[]","{"status":1,"type":"Hot","description":"hot","added_by":1,"id":1}","http://127.0.0.1:8000/leadstage/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:42:10","2022-03-13 09:42:10");
INSERT INTO audits VALUES("7","App\Models\User","1","created","App\Models\LeadType","2","[]","{"status":1,"type":"Warm","description":"description","added_by":1,"id":2}","http://127.0.0.1:8000/leadstage/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:42:21","2022-03-13 09:42:21");
INSERT INTO audits VALUES("8","App\Models\User","1","created","App\Models\LeadType","3","[]","{"status":1,"type":"Cold","description":"descripiot","added_by":1,"id":3}","http://127.0.0.1:8000/leadstage/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:42:34","2022-03-13 09:42:34");
INSERT INTO audits VALUES("9","App\Models\User","1","updated","App\Models\LeadType","3","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/leadstage/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:42:42","2022-03-13 09:42:42");
INSERT INTO audits VALUES("10","App\Models\User","1","updated","App\Models\LeadType","3","{"status":0}","{"status":"1"}","http://127.0.0.1:8000/leadstage/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:42:56","2022-03-13 09:42:56");
INSERT INTO audits VALUES("11","App\Models\User","1","updated","App\Models\LeadType","3","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/leadstage/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:43:24","2022-03-13 09:43:24");
INSERT INTO audits VALUES("12","App\Models\User","1","updated","App\Models\LeadType","3","{"status":0}","{"status":"1"}","http://127.0.0.1:8000/leadstage/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:43:29","2022-03-13 09:43:29");
INSERT INTO audits VALUES("13","App\Models\User","1","created","App\Models\LeadSource","1","[]","{"status":1,"source":"Internet","description":"testing","added_by":1,"id":1}","http://127.0.0.1:8000/leadsource/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:45:35","2022-03-13 09:45:35");
INSERT INTO audits VALUES("14","App\Models\User","1","created","App\Models\LeadSource","2","[]","{"status":1,"source":"Call","description":"of the mateh","added_by":1,"id":2}","http://127.0.0.1:8000/leadsource/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:45:48","2022-03-13 09:45:48");
INSERT INTO audits VALUES("15","App\Models\User","1","updated","App\Models\LeadSource","2","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/leadsource/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:45:52","2022-03-13 09:45:52");
INSERT INTO audits VALUES("16","App\Models\User","1","updated","App\Models\LeadSource","2","{"status":0}","{"status":"1"}","http://127.0.0.1:8000/leadsource/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:45:56","2022-03-13 09:45:56");
INSERT INTO audits VALUES("17","App\Models\User","1","updated","App\Models\LeadSource","2","{"description":"of the mateh"}","{"description":"of the mateh incret"}","http://127.0.0.1:8000/leadsource/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:46:10","2022-03-13 09:46:10");
INSERT INTO audits VALUES("18","App\Models\User","1","created","App\Models\LeadSource","3","[]","{"status":0,"source":"stete","description":null,"added_by":1,"id":3}","http://127.0.0.1:8000/leadsource/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:46:26","2022-03-13 09:46:26");
INSERT INTO audits VALUES("19","App\Models\User","1","deleted","App\Models\LeadSource","3","{"id":3,"company_id":null,"source":"stete","description":null,"status":0,"added_by":1}","[]","http://127.0.0.1:8000/leadsource/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:46:30","2022-03-13 09:46:30");
INSERT INTO audits VALUES("20","App\Models\User","1","created","App\Models\Role","1","[]","{"status":1,"role":"Admin","description":"admin roles","added_by":1,"id":1}","http://127.0.0.1:8000/settings/roles/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:47:46","2022-03-13 09:47:46");
INSERT INTO audits VALUES("21","App\Models\User","1","created","App\Models\Role","2","[]","{"status":1,"role":"Staff","description":"staff of the matching","added_by":1,"id":2}","http://127.0.0.1:8000/settings/roles/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:48:01","2022-03-13 09:48:01");
INSERT INTO audits VALUES("22","App\Models\User","1","created","App\Models\Role","3","[]","{"status":1,"role":"SalesExecutive","description":"test","added_by":1,"id":3}","http://127.0.0.1:8000/settings/roles/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:48:28","2022-03-13 09:48:28");
INSERT INTO audits VALUES("23","App\Models\User","1","created","App\Models\Role","4","[]","{"status":1,"role":"Manager","description":"manager","added_by":1,"id":4}","http://127.0.0.1:8000/settings/roles/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:48:44","2022-03-13 09:48:44");
INSERT INTO audits VALUES("24","App\Models\User","1","created","App\Models\User","2","[]","{"status":1,"name":"Durai","last_name":"raj","mobile_no":"9551202020","role_id":"1","email":"durai@yopmail.com","lead_limit":"30","deal_limit":"30","password":"$2y$10$Z7yLXiWI2d\/vIHc5OBFXbeSUBRmJvm5IGE5C3u.CaBp\/3B50eSF2O","id":2}","http://127.0.0.1:8000/settings/users/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:49:36","2022-03-13 09:49:36");
INSERT INTO audits VALUES("25","App\Models\User","1","created","App\Models\User","3","[]","{"status":1,"name":"Kumar","last_name":"k","mobile_no":"9551456123","role_id":"3","email":"kumar@yopmail.com","lead_limit":"20","deal_limit":"20","password":"$2y$10$YZgjgMstKu8yIdFDErdG7eJuuouxkWBy2eCMOiO8lyX4ql\/G1KHOK","id":3}","http://127.0.0.1:8000/settings/users/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:50:23","2022-03-13 09:50:23");
INSERT INTO audits VALUES("26","App\Models\User","1","updated","App\Models\Lead","1","{"lead_value":null,"lead_type_id":null,"lead_source_id":null,"assigned_to":null,"assinged_by":null}","{"lead_value":"120","lead_type_id":"1","lead_source_id":"1","assigned_to":"3","assinged_by":1}","http://127.0.0.1:8000/leads/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:52:31","2022-03-13 09:52:31");
INSERT INTO audits VALUES("27","App\Models\User","1","created","App\Models\Customer","2","[]","{"first_name":"Rajesh","added_by":1,"status":1,"id":2}","http://127.0.0.1:8000/autocomplete_customer_save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:52:57","2022-03-13 09:52:57");
INSERT INTO audits VALUES("28","App\Models\User","1","created","App\Models\Organization","2","[]","{"name":"Opera","added_by":1,"status":1,"id":2}","http://127.0.0.1:8000/autocomplete_org_save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:53:02","2022-03-13 09:53:02");
INSERT INTO audits VALUES("29","App\Models\User","1","updated","App\Models\Customer","2","{"organization_id":null}","{"organization_id":"2"}","http://127.0.0.1:8000/leads/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:53:21","2022-03-13 09:53:21");
INSERT INTO audits VALUES("30","App\Models\User","1","created","App\Models\Lead","2","[]","{"status":1,"lead_subject":"Innings Match","customer_id":"2","lead_type_id":"2","lead_source_id":"2","lead_value":"50","assinged_by":1,"assigned_to":"2","added_by":1,"id":2}","http://127.0.0.1:8000/leads/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 09:53:21","2022-03-13 09:53:21");
INSERT INTO audits VALUES("31","App\Models\User","1","created","App\Models\Activity","1","[]","{"status":1,"subject":"Recruriet","activity_type":"task","notes":null,"lead_id":"2","deal_id":null,"customer_id":2,"started_at":"2022-03-13 19:34:00","due_at":"2022-03-13 19:44:00","user_id":"2","added_by":1,"id":1}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:01:09","2022-03-13 10:01:09");
INSERT INTO audits VALUES("32","App\Models\User","1","updated","App\Models\User","3","{"lead_limit":20,"deal_limit":20}","{"lead_limit":"1","deal_limit":"1"}","http://127.0.0.1:8000/settings/users/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:13:25","2022-03-13 10:13:25");
INSERT INTO audits VALUES("33","App\Models\User","1","created","App\Models\Customer","3","[]","{"first_name":"Hemanth","added_by":1,"status":1,"id":3}","http://127.0.0.1:8000/autocomplete_customer_save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:20:52","2022-03-13 10:20:52");
INSERT INTO audits VALUES("34","App\Models\User","1","updated","App\Models\Customer","3","{"organization_id":null}","{"organization_id":"1"}","http://127.0.0.1:8000/leads/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:21:18","2022-03-13 10:21:18");
INSERT INTO audits VALUES("35","App\Models\User","1","created","App\Models\DealStage","1","[]","{"status":1,"stages":"Qualified","description":"teste","order_by":"1","added_by":1,"id":1}","http://127.0.0.1:8000/dealstages/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:28:53","2022-03-13 10:28:53");
INSERT INTO audits VALUES("36","App\Models\User","1","created","App\Models\DealStage","2","[]","{"status":1,"stages":"Clarifiy","description":"teset","order_by":"2","added_by":1,"id":2}","http://127.0.0.1:8000/dealstages/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:29:14","2022-03-13 10:29:14");
INSERT INTO audits VALUES("37","App\Models\User","1","created","App\Models\DealStage","3","[]","{"status":1,"stages":"Relational","description":"tested","order_by":"3","added_by":1,"id":3}","http://127.0.0.1:8000/dealstages/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:29:46","2022-03-13 10:29:46");
INSERT INTO audits VALUES("38","App\Models\User","1","created","App\Models\DealStage","4","[]","{"status":1,"stages":"Negote","description":"negotiation","order_by":"4","added_by":1,"id":4}","http://127.0.0.1:8000/dealstages/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:30:04","2022-03-13 10:30:04");
INSERT INTO audits VALUES("39","App\Models\User","1","created","App\Models\DealStage","5","[]","{"status":1,"stages":"Final","description":"Testign of the","order_by":"5","added_by":1,"id":5}","http://127.0.0.1:8000/dealstages/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:30:23","2022-03-13 10:30:23");
INSERT INTO audits VALUES("40","App\Models\User","1","created","App\Models\Product","1","[]","{"status":1,"product_name":"Buzz","product_code":"PD\/2022\/0001","description":null,"added_by":1,"id":1}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:32:01","2022-03-13 10:32:01");
INSERT INTO audits VALUES("41","App\Models\User","1","created","App\Models\Product","2","[]","{"status":1,"product_name":"Bluetooth","product_code":"PD\/2022\/0002","description":null,"added_by":1,"id":2}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:32:12","2022-03-13 10:32:12");
INSERT INTO audits VALUES("42","App\Models\User","1","created","App\Models\Product","3","[]","{"status":1,"product_name":"Cover point","product_code":"PD\/2022\/0003","description":null,"added_by":1,"id":3}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:32:29","2022-03-13 10:32:29");
INSERT INTO audits VALUES("43","App\Models\User","1","created","App\Models\Product","4","[]","{"status":1,"product_name":"DataTab","product_code":"PD\/2022\/0004","description":"test","added_by":1,"id":4}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 10:32:46","2022-03-13 10:32:46");
INSERT INTO audits VALUES("44","App\Models\User","2","created","App\Models\Deal","1","[]","{"status":1,"deal_title":"Innings Match","customer_id":"2","current_stage_id":"2","deal_value":"50","lead_id":"2","product_total":"175","expected_completed_date":"2022-04-08","assinged_by":2,"assigned_to":"2","added_by":2,"id":1}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:38:50","2022-03-13 10:38:50");
INSERT INTO audits VALUES("45","App\Models\User","2","updated","App\Models\Lead","2","{"status":1,"updated_by":null}","{"status":2,"updated_by":2}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:38:50","2022-03-13 10:38:50");
INSERT INTO audits VALUES("46","App\Models\User","2","created","App\Models\DealPipline","1","[]","{"deal_id":1,"stage_id":1,"status":"completed","completed_at":"2022-03-13 10:38:51","added_by":2,"id":1}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:38:51","2022-03-13 10:38:51");
INSERT INTO audits VALUES("47","App\Models\User","2","created","App\Models\DealPipline","2","[]","{"deal_id":1,"stage_id":2,"status":"pending","completed_at":null,"added_by":2,"id":2}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:38:51","2022-03-13 10:38:51");
INSERT INTO audits VALUES("48","App\Models\User","2","created","App\Models\Note","1","[]","{"status":1,"notes":"Direts notes","deal_id":"1","customer_id":2,"user_id":2,"added_by":2,"id":1}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:41:20","2022-03-13 10:41:20");
INSERT INTO audits VALUES("49","App\Models\User","2","created","App\Models\Activity","2","[]","{"status":1,"subject":"teste","activity_type":"deadline","notes":null,"deal_id":"1","customer_id":2,"started_at":"2022-03-13 19:15:00","due_at":"2022-03-13 19:25:00","user_id":"2","added_by":2,"id":2}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:42:55","2022-03-13 10:42:55");
INSERT INTO audits VALUES("50","App\Models\User","2","created","App\Models\DealDocument","1","[]","{"document":"deal\/tYJHKu9Pg623M5BuvPccwDQXDdPYNCIv6mnAb33C.pdf","deal_id":"1","added_by":2,"id":1}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:43:09","2022-03-13 10:43:09");
INSERT INTO audits VALUES("51","App\Models\User","2","created","App\Models\Invoice","1","[]","{"deal_id":"1","invoice_no":"INV\/2022\/0001","issue_date":"2022-03-13","due_date":"2022-04-08","customer_id":"2","address":"chennai of the center, second street, near cmbt","email":"test2@yopmail.com","total":"175.00","status":0,"added_by":2,"id":1}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 10:44:14","2022-03-13 10:44:14");
INSERT INTO audits VALUES("52","App\Models\User","1","updated","App\Models\Customer","2","{"email":null,"mobile_no":null}","{"email":"rajesh@yopmail.com","mobile_no":"6551202020"}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 11:03:53","2022-03-13 11:03:53");
INSERT INTO audits VALUES("53","App\Models\User","1","updated","App\Models\Customer","3","{"email":null,"mobile_no":null}","{"email":"hemanth@yopmail.com","mobile_no":"7852045620"}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 11:04:14","2022-03-13 11:04:14");
INSERT INTO audits VALUES("54","App\Models\User","2","updated","App\Models\Invoice","1","{"pending_at":null}","{"pending_at":"2022-03-13 11:07:10"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 11:07:10","2022-03-13 11:07:10");
INSERT INTO audits VALUES("55","App\Models\User","2","updated","App\Models\Invoice","1","{"pending_at":null}","{"pending_at":"2022-03-13 11:08:50"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 11:08:50","2022-03-13 11:08:50");
INSERT INTO audits VALUES("56","App\Models\User","2","updated","App\Models\Invoice","1","{"pending_at":null}","{"pending_at":"2022-03-13 11:11:08"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 11:11:09","2022-03-13 11:11:09");
INSERT INTO audits VALUES("57","App\Models\User","2","updated","App\Models\Invoice","1","{"pending_at":null}","{"pending_at":"2022-03-13 11:13:31"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.109 Safari/537.36 OPR/84.0.4316.31","","2022-03-13 11:13:31","2022-03-13 11:13:31");
INSERT INTO audits VALUES("58","App\Models\User","1","updated","App\Models\Invoice","1","{"approved_at":null}","{"approved_at":"2022-03-13 11:13:44"}","http://127.0.0.1:8000/approve/invoice/1","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-13 11:13:44","2022-03-13 11:13:44");
INSERT INTO audits VALUES("59","App\Models\User","1","created","App\Models\Organization","3","[]","{"name":"Company & Co","added_by":1,"status":1,"id":3}","http://127.0.0.1:8000/autocomplete_org_save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:26:47","2022-03-14 02:26:47");
INSERT INTO audits VALUES("60","App\Models\User","1","created","App\Models\Customer","4","[]","{"status":1,"first_name":"Customer","last_name":null,"email":"customer@yopmail.com","mobile_no":"9441302010","added_by":1,"id":4}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:27:09","2022-03-14 02:27:09");
INSERT INTO audits VALUES("61","App\Models\User","1","created","App\Models\Organization","4","[]","{"name":"Bytes","added_by":1,"status":1,"id":4}","http://127.0.0.1:8000/autocomplete_org_save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:28:37","2022-03-14 02:28:37");
INSERT INTO audits VALUES("62","App\Models\User","1","created","App\Models\Customer","5","[]","{"status":1,"first_name":"Kumar","last_name":"s","email":"kumar@yopmail.com","mobile_no":"7511205600","added_by":1,"id":5}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:29:30","2022-03-14 02:29:30");
INSERT INTO audits VALUES("63","App\Models\User","1","updated","App\Models\Customer","5","{"organization_id":null}","{"organization_id":"4"}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:30:23","2022-03-14 02:30:23");
INSERT INTO audits VALUES("64","App\Models\User","1","updated","App\Models\Customer","4","{"organization_id":null}","{"organization_id":"4"}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:38:13","2022-03-14 02:38:13");
INSERT INTO audits VALUES("65","App\Models\User","1","updated","App\Models\Customer","5","{"status":1}","{"status":0}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:40:55","2022-03-14 02:40:55");
INSERT INTO audits VALUES("66","App\Models\User","1","updated","App\Models\Customer","5","{"status":0}","{"status":1}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:41:02","2022-03-14 02:41:02");
INSERT INTO audits VALUES("67","App\Models\User","1","created","App\Models\Lead","3","[]","{"status":1,"lead_subject":"Dlea title","customer_id":"4","lead_type_id":"1","lead_source_id":"1","lead_value":"250","assinged_by":1,"assigned_to":"3","added_by":1,"id":3}","http://127.0.0.1:8000/leads/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:52:13","2022-03-14 02:52:13");
INSERT INTO audits VALUES("68","App\Models\User","1","created","App\Models\Note","2","[]","{"status":1,"notes":"Durai testing","lead_id":"3","customer_id":4,"user_id":1,"added_by":1,"id":2}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:59:48","2022-03-14 02:59:48");
INSERT INTO audits VALUES("69","App\Models\User","1","deleted","App\Models\Activity","2","{"id":2,"subject":"teste","activity_type":"deadline","notes":null,"lead_id":null,"deal_id":1,"customer_id":2,"user_id":2,"started_at":"2022-03-13 19:15:00","due_at":"2022-03-13 19:25:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":2,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 02:59:59","2022-03-14 02:59:59");
INSERT INTO audits VALUES("70","App\Models\User","1","deleted","App\Models\Note","2","{"id":2,"notes":"Durai testing","lead_id":3,"deal_id":null,"customer_id":4,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:08:34","2022-03-14 03:08:34");
INSERT INTO audits VALUES("71","App\Models\User","1","created","App\Models\Note","3","[]","{"status":1,"notes":"Testing of the match","lead_id":"3","customer_id":4,"user_id":1,"added_by":1,"id":3}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:08:45","2022-03-14 03:08:45");
INSERT INTO audits VALUES("72","App\Models\User","1","created","App\Models\Activity","3","[]","{"status":1,"subject":"Checking durair","activity_type":"deadline","notes":null,"lead_id":"3","deal_id":null,"customer_id":4,"started_at":"2022-03-14 10:41:00","due_at":"2022-03-14 10:51:00","user_id":"2","added_by":1,"id":3}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:09:13","2022-03-14 03:09:13");
INSERT INTO audits VALUES("73","App\Models\User","1","deleted","App\Models\Note","3","{"id":3,"notes":"Testing of the match","lead_id":3,"deal_id":null,"customer_id":4,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:09:21","2022-03-14 03:09:21");
INSERT INTO audits VALUES("74","App\Models\User","1","deleted","App\Models\Activity","3","{"id":3,"subject":"Checking durair","activity_type":"deadline","notes":null,"lead_id":3,"deal_id":null,"customer_id":4,"user_id":2,"started_at":"2022-03-14 10:41:00","due_at":"2022-03-14 10:51:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:10:21","2022-03-14 03:10:21");
INSERT INTO audits VALUES("75","App\Models\User","1","created","App\Models\Note","4","[]","{"status":1,"notes":"durai tesgin in the leads","lead_id":"3","customer_id":4,"user_id":1,"added_by":1,"id":4}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:10:32","2022-03-14 03:10:32");
INSERT INTO audits VALUES("76","App\Models\User","1","created","App\Models\Activity","4","[]","{"status":1,"subject":"Home Clean","activity_type":"meeting","notes":null,"lead_id":"3","deal_id":null,"customer_id":4,"started_at":"2022-03-14 10:42:00","due_at":"2022-03-14 10:52:00","user_id":"2","added_by":1,"id":4}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:10:58","2022-03-14 03:10:58");
INSERT INTO audits VALUES("77","App\Models\User","1","created","App\Models\Activity","5","[]","{"status":1,"subject":"Operating","activity_type":"task","notes":null,"lead_id":"3","deal_id":null,"customer_id":4,"started_at":"2022-03-14 12:45:00","due_at":"2022-03-14 12:55:00","user_id":"2","added_by":1,"id":5}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:11:23","2022-03-14 03:11:23");
INSERT INTO audits VALUES("78","App\Models\User","1","deleted","App\Models\Activity","5","{"id":5,"subject":"Operating","activity_type":"task","notes":null,"lead_id":3,"deal_id":null,"customer_id":4,"user_id":2,"started_at":"2022-03-14 12:45:00","due_at":"2022-03-14 12:55:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:11:29","2022-03-14 03:11:29");
INSERT INTO audits VALUES("79","App\Models\User","1","updated","App\Models\Activity","4","{"done_at":null,"done_by":null}","{"done_at":"2022-03-14 03:11:45","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:11:45","2022-03-14 03:11:45");
INSERT INTO audits VALUES("80","App\Models\User","1","created","App\Models\Deal","2","[]","{"status":1,"deal_title":"Dlea Deal title","customer_id":"4","current_stage_id":"1","deal_value":"250","lead_id":"3","product_total":"55","expected_completed_date":"2022-03-23","assinged_by":1,"assigned_to":"2","added_by":1,"id":2}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:16:28","2022-03-14 03:16:28");
INSERT INTO audits VALUES("81","App\Models\User","1","updated","App\Models\Lead","3","{"status":1,"updated_by":null}","{"status":2,"updated_by":1}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:16:28","2022-03-14 03:16:28");
INSERT INTO audits VALUES("82","App\Models\User","1","created","App\Models\DealPipline","3","[]","{"deal_id":2,"stage_id":1,"status":"pending","completed_at":null,"added_by":1,"id":3}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:16:29","2022-03-14 03:16:29");
INSERT INTO audits VALUES("83","App\Models\User","1","created","App\Models\Note","5","[]","{"status":1,"notes":"Deal testing notes","deal_id":"2","customer_id":4,"user_id":1,"added_by":1,"id":5}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:16:56","2022-03-14 03:16:56");
INSERT INTO audits VALUES("84","App\Models\User","1","created","App\Models\Note","6","[]","{"status":1,"notes":"testing  in","lead_id":"1","customer_id":1,"user_id":1,"added_by":1,"id":6}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:43:13","2022-03-14 03:43:13");
INSERT INTO audits VALUES("85","App\Models\User","1","deleted","App\Models\Note","6","{"id":6,"notes":"testing  in","lead_id":1,"deal_id":null,"customer_id":1,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:43:19","2022-03-14 03:43:19");
INSERT INTO audits VALUES("86","App\Models\User","1","created","App\Models\Activity","6","[]","{"status":1,"subject":"Testin of the lead","activity_type":"email","notes":null,"lead_id":"1","deal_id":null,"customer_id":1,"started_at":"2022-03-14 10:14:00","due_at":"2022-03-14 10:24:00","user_id":"2","added_by":1,"id":6}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:43:35","2022-03-14 03:43:35");
INSERT INTO audits VALUES("87","App\Models\User","1","created","App\Models\Note","7","[]","{"status":1,"notes":"Description of the match","lead_id":"1","customer_id":1,"user_id":1,"added_by":1,"id":7}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:43:47","2022-03-14 03:43:47");
INSERT INTO audits VALUES("88","App\Models\User","1","deleted","App\Models\Activity","6","{"id":6,"subject":"Testin of the lead","activity_type":"email","notes":null,"lead_id":1,"deal_id":null,"customer_id":1,"user_id":2,"started_at":"2022-03-14 10:14:00","due_at":"2022-03-14 10:24:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:43:54","2022-03-14 03:43:54");
INSERT INTO audits VALUES("89","App\Models\User","1","deleted","App\Models\Note","5","{"id":5,"notes":"Deal testing notes","lead_id":null,"deal_id":2,"customer_id":4,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:46:35","2022-03-14 03:46:35");
INSERT INTO audits VALUES("90","App\Models\User","1","created","App\Models\Activity","7","[]","{"status":1,"subject":"dela activity","activity_type":"deadline","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-14 09:18:00","due_at":"2022-03-14 09:28:00","user_id":"2","added_by":1,"id":7}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:46:52","2022-03-14 03:46:52");
INSERT INTO audits VALUES("91","App\Models\User","1","created","App\Models\Note","8","[]","{"status":1,"notes":"Testing of the match","deal_id":"2","customer_id":4,"user_id":1,"added_by":1,"id":8}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:47:04","2022-03-14 03:47:04");
INSERT INTO audits VALUES("92","App\Models\User","1","deleted","App\Models\Note","7","{"id":7,"notes":"Description of the match","lead_id":1,"deal_id":null,"customer_id":1,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:47:17","2022-03-14 03:47:17");
INSERT INTO audits VALUES("93","App\Models\User","1","created","App\Models\Activity","8","[]","{"status":1,"subject":"checktin gthe deal","activity_type":"task","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-14 10:20:00","due_at":"2022-03-14 10:30:00","user_id":"2","added_by":1,"id":8}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:47:43","2022-03-14 03:47:43");
INSERT INTO audits VALUES("94","App\Models\User","1","deleted","App\Models\Activity","7","{"id":7,"subject":"dela activity","activity_type":"deadline","notes":null,"lead_id":null,"deal_id":2,"customer_id":4,"user_id":2,"started_at":"2022-03-14 09:18:00","due_at":"2022-03-14 09:28:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:48:48","2022-03-14 03:48:48");
INSERT INTO audits VALUES("95","App\Models\User","1","created","App\Models\Activity","9","[]","{"status":1,"subject":"Testing of activbity","activity_type":"task","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-14 09:20:00","due_at":"2022-03-14 09:30:00","user_id":"3","added_by":1,"id":9}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:49:25","2022-03-14 03:49:25");
INSERT INTO audits VALUES("96","App\Models\User","1","deleted","App\Models\Activity","8","{"id":8,"subject":"checktin gthe deal","activity_type":"task","notes":null,"lead_id":null,"deal_id":2,"customer_id":4,"user_id":2,"started_at":"2022-03-14 10:20:00","due_at":"2022-03-14 10:30:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 03:49:37","2022-03-14 03:49:37");
INSERT INTO audits VALUES("97","App\Models\User","1","created","App\Models\Activity","10","[]","{"status":1,"subject":"te23343","activity_type":"email","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-14 21:57:00","due_at":"2022-03-14 22:07:00","user_id":"2","added_by":1,"id":10}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:27:33","2022-03-14 16:27:33");
INSERT INTO audits VALUES("98","App\Models\User","1","deleted","App\Models\Activity","9","{"id":9,"subject":"Testing of activbity","activity_type":"task","notes":null,"lead_id":null,"deal_id":2,"customer_id":4,"user_id":3,"started_at":"2022-03-14 09:20:00","due_at":"2022-03-14 09:30:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:28:37","2022-03-14 16:28:37");
INSERT INTO audits VALUES("99","App\Models\User","1","created","App\Models\Activity","11","[]","{"status":1,"subject":"Durai testiging","activity_type":"deadline","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-14 23:07:00","due_at":"2022-03-14 23:17:00","user_id":"2","added_by":1,"id":11}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:35:11","2022-03-14 16:35:11");
INSERT INTO audits VALUES("100","App\Models\User","1","deleted","App\Models\Activity","11","{"id":11,"subject":"Durai testiging","activity_type":"deadline","notes":null,"lead_id":null,"deal_id":2,"customer_id":4,"user_id":2,"started_at":"2022-03-14 23:07:00","due_at":"2022-03-14 23:17:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:35:23","2022-03-14 16:35:23");
INSERT INTO audits VALUES("101","App\Models\User","1","deleted","App\Models\Note","8","{"id":8,"notes":"Testing of the match","lead_id":null,"deal_id":2,"customer_id":4,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:35:32","2022-03-14 16:35:32");
INSERT INTO audits VALUES("102","App\Models\User","1","updated","App\Models\Activity","10","{"done_at":null,"done_by":null}","{"done_at":"2022-03-14 16:35:42","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:35:42","2022-03-14 16:35:42");
INSERT INTO audits VALUES("103","App\Models\User","1","deleted","App\Models\Activity","10","{"id":10,"subject":"te23343","activity_type":"email","notes":null,"lead_id":null,"deal_id":2,"customer_id":4,"user_id":2,"started_at":"2022-03-14 21:57:00","due_at":"2022-03-14 22:07:00","done_at":"2022-03-14 16:35:42","done_by":1,"available":null,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:38:45","2022-03-14 16:38:45");
INSERT INTO audits VALUES("104","App\Models\User","1","created","App\Models\Note","9","[]","{"status":1,"notes":"Dduari dateste","deal_id":"2","customer_id":4,"user_id":1,"added_by":1,"id":9}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:38:54","2022-03-14 16:38:54");
INSERT INTO audits VALUES("105","App\Models\User","1","created","App\Models\Activity","12","[]","{"status":1,"subject":"fist stste","activity_type":"task","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-14 00:12:00","due_at":"2022-03-14 00:22:00","user_id":"2","added_by":1,"id":12}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:40:12","2022-03-14 16:40:12");
INSERT INTO audits VALUES("106","App\Models\User","1","created","App\Models\Activity","13","[]","{"status":1,"subject":"second testing","activity_type":"email","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-14 23:10:00","due_at":"2022-03-14 23:20:00","user_id":"3","added_by":1,"id":13}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:40:29","2022-03-14 16:40:29");
INSERT INTO audits VALUES("107","App\Models\User","1","updated","App\Models\Activity","13","{"done_at":null,"done_by":null}","{"done_at":"2022-03-14 16:41:03","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:41:03","2022-03-14 16:41:03");
INSERT INTO audits VALUES("108","App\Models\User","1","created","App\Models\DealDocument","2","[]","{"document":"deal\/mpy4BYRIS6ysf350gRiQg0l28vUXwqhFNkqSBWBR.png","deal_id":"2","added_by":1,"id":2}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:42:07","2022-03-14 16:42:07");
INSERT INTO audits VALUES("109","App\Models\User","1","deleted","App\Models\DealDocument","2","{"id":2,"deal_id":2,"document":"deal\/mpy4BYRIS6ysf350gRiQg0l28vUXwqhFNkqSBWBR.png","document_name":null,"status":1,"added_by":1}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:42:18","2022-03-14 16:42:18");
INSERT INTO audits VALUES("110","App\Models\User","1","created","App\Models\Invoice","2","[]","{"deal_id":"2","invoice_no":"INV\/2022\/0002","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":"4","address":"test","email":"customer@yopmail.com","total":"55.00","status":0,"added_by":1,"id":2}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:44:10","2022-03-14 16:44:10");
INSERT INTO audits VALUES("111","App\Models\User","1","deleted","App\Models\Invoice","2","{"id":2,"deal_id":2,"invoice_no":"INV\/2022\/0002","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":4,"address":"test","email":"customer@yopmail.com","subtotal":null,"tax":null,"discount":null,"total":"55.00","status":0,"approved_at":null,"rejected_at":null,"pending_at":null,"approved_by":null,"rejected_by":null,"reject_reason":null,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/invoice/unlink","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:44:23","2022-03-14 16:44:23");
INSERT INTO audits VALUES("112","App\Models\User","1","updated","App\Models\DealPipline","3","{"status":"pending","completed_at":null}","{"status":"completed","completed_at":"2022-03-14 16:46:07"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:46:07","2022-03-14 16:46:07");
INSERT INTO audits VALUES("113","App\Models\User","1","updated","App\Models\Deal","2","{"current_stage_id":1}","{"current_stage_id":"2"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:46:07","2022-03-14 16:46:07");
INSERT INTO audits VALUES("114","App\Models\User","1","created","App\Models\DealPipline","4","[]","{"deal_id":"2","stage_id":2,"status":"pending","completed_at":null,"added_by":1,"id":4}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:46:08","2022-03-14 16:46:08");
INSERT INTO audits VALUES("115","App\Models\User","1","created","App\Models\Customer","6","[]","{"status":1,"first_name":"anu","last_name":"vinth","organization_id":"1","email":null,"mobile_no":null,"added_by":1,"id":6}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-14 16:47:31","2022-03-14 16:47:31");
INSERT INTO audits VALUES("116","App\Models\User","1","created","App\Models\Task","1","[]","{"status":1,"task_name":"Test Task","assigned_to":"2","description":"Duria tsting","added_by":1,"id":1}","http://127.0.0.1:8000/tasks/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-15 01:48:50","2022-03-15 01:48:50");
INSERT INTO audits VALUES("117","App\Models\User","1","created","App\Models\Invoice","3","[]","{"deal_id":"2","invoice_no":"INV\/2022\/0002","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":"4","address":"Duria testing address","email":"customer@yopmail.com","total":"410","status":0,"added_by":1,"id":3}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-15 02:09:49","2022-03-15 02:09:49");
INSERT INTO audits VALUES("118","App\Models\User","1","updated","App\Models\Invoice","3","{"pending_at":null}","{"pending_at":"2022-03-15 02:11:22"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-15 02:11:22","2022-03-15 02:11:22");
INSERT INTO audits VALUES("119","App\Models\User","1","updated","App\Models\Invoice","3","{"pending_at":null}","{"pending_at":"2022-03-15 02:14:51"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-15 02:14:51","2022-03-15 02:14:51");
INSERT INTO audits VALUES("120","App\Models\User","1","updated","App\Models\CompanySettings","1","{"smtp_host":null,"smtp_port":null,"smtp_user":null,"smtp_password":null}","{"smtp_host":"smtp.mailtrap.io","smtp_port":"2525","smtp_user":"4d9e7f3c7586fc","smtp_password":"b2173a30a89eaf"}","http://127.0.0.1:8000/company/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-15 02:23:08","2022-03-15 02:23:08");
INSERT INTO audits VALUES("121","App\Models\User","1","updated","App\Models\CompanySettings","1","{"mailer":null,"mail_encryption":null}","{"mailer":"smtp","mail_encryption":"tls"}","http://127.0.0.1:8000/company/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-15 02:44:51","2022-03-15 02:44:51");
INSERT INTO audits VALUES("122","App\Models\User","1","updated","App\Models\Invoice","3","{"pending_at":null}","{"pending_at":"2022-03-15 02:46:31"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-15 02:46:31","2022-03-15 02:46:31");
INSERT INTO audits VALUES("123","App\Models\User","1","created","App\Models\Note","10","[]","{"status":1,"notes":"Durairaj testing notes of the match","lead_id":"1","customer_id":1,"user_id":1,"added_by":1,"id":10}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-18 17:17:49","2022-03-18 17:17:49");
INSERT INTO audits VALUES("124","App\Models\User","1","created","App\Models\Note","11","[]","{"status":1,"notes":"Second note testing of the match is the worst player of the match oin the world","lead_id":"1","customer_id":1,"user_id":1,"added_by":1,"id":11}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-18 17:24:52","2022-03-18 17:24:52");
INSERT INTO audits VALUES("125","App\Models\User","1","created","App\Models\Activity","14","[]","{"status":1,"subject":"Testein lead of","activity_type":"email","notes":null,"lead_id":"1","deal_id":null,"customer_id":1,"started_at":"2022-03-18 23:56:00","due_at":"2022-03-18 00:06:00","user_id":"2","added_by":1,"id":14}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-18 17:26:15","2022-03-18 17:26:15");
INSERT INTO audits VALUES("126","App\Models\User","1","updated","App\Models\Activity","14","{"subject":"Testein lead of","started_at":"2022-03-18 23:56:00","due_at":"2022-03-18 00:06:00","updated_by":null}","{"subject":"#mail email acivity","started_at":"2022-03-18 11:56:00","due_at":"2022-03-18 12:06:00","updated_by":1}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-18 17:42:28","2022-03-18 17:42:28");
INSERT INTO audits VALUES("127","App\Models\User","1","deleted","App\Models\Note","11","{"id":11,"notes":"Second note testing of the match is the worst player of the match oin the world","lead_id":1,"deal_id":null,"customer_id":1,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-18 17:51:02","2022-03-18 17:51:02");
INSERT INTO audits VALUES("128","App\Models\User","1","deleted","App\Models\Activity","14","{"id":14,"subject":"#mail email acivity","activity_type":"email","notes":null,"lead_id":1,"deal_id":null,"customer_id":1,"user_id":2,"started_at":"2022-03-18 11:56:00","due_at":"2022-03-18 12:06:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":1}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-18 17:51:10","2022-03-18 17:51:10");
INSERT INTO audits VALUES("129","App\Models\User","1","created","App\Models\Activity","15","[]","{"status":1,"subject":"Lead activity","activity_type":"task","notes":null,"lead_id":"1","deal_id":null,"customer_id":1,"started_at":"2022-03-20 12:25:00","due_at":"2022-03-20 12:35:00","user_id":"2","added_by":1,"id":15}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-20 04:54:06","2022-03-20 04:54:06");
INSERT INTO audits VALUES("130","App\Models\User","1","updated","App\Models\DealPipline","4","{"status":"pending","completed_at":null}","{"status":"completed","completed_at":"2022-03-20 05:02:56"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-20 05:02:56","2022-03-20 05:02:56");
INSERT INTO audits VALUES("131","App\Models\User","1","updated","App\Models\Deal","2","{"current_stage_id":2}","{"current_stage_id":"3"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-20 05:02:56","2022-03-20 05:02:56");
INSERT INTO audits VALUES("132","App\Models\User","1","created","App\Models\DealPipline","5","[]","{"deal_id":"2","stage_id":3,"status":"pending","completed_at":null,"added_by":1,"id":5}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-20 05:02:57","2022-03-20 05:02:57");
INSERT INTO audits VALUES("133","App\Models\User","1","created","App\Models\Note","12","[]","{"status":1,"notes":"duearitestet","lead_id":"1","customer_id":1,"user_id":1,"added_by":1,"id":12}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 12:56:43","2022-03-21 12:56:43");
INSERT INTO audits VALUES("134","App\Models\User","1","created","App\Models\Note","13","[]","{"status":1,"notes":"Durai testig note ain a deals","deal_id":"2","customer_id":4,"user_id":1,"added_by":1,"id":13}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 12:59:04","2022-03-21 12:59:04");
INSERT INTO audits VALUES("135","App\Models\User","1","created","App\Models\Note","14","[]","{"status":1,"notes":"Wold cup at 293","deal_id":"2","customer_id":4,"user_id":1,"added_by":1,"id":14}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 12:59:38","2022-03-21 12:59:38");
INSERT INTO audits VALUES("136","App\Models\User","1","created","App\Models\Activity","16","[]","{"status":1,"subject":"Live in activiy","activity_type":"deadline","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-21 20:35:00","due_at":"2022-03-21 20:45:00","user_id":"2","added_by":1,"id":16}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 13:04:01","2022-03-21 13:04:01");
INSERT INTO audits VALUES("137","App\Models\User","1","created","App\Models\DealDocument","3","[]","{"document":"deal\/E4NCQ3yMRMgxogbVLKnVihawP6s5wHjJpdMBOzrQ.png","deal_id":"2","added_by":1,"id":3}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 13:10:02","2022-03-21 13:10:02");
INSERT INTO audits VALUES("138","App\Models\User","1","deleted","App\Models\Note","14","{"id":14,"notes":"Wold cup at 293","lead_id":null,"deal_id":2,"customer_id":4,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 13:15:43","2022-03-21 13:15:43");
INSERT INTO audits VALUES("139","App\Models\User","1","updated","App\Models\Activity","13","{"subject":"second testing","lead_id":null,"deal_id":2,"started_at":"2022-03-14 23:10:00","due_at":"2022-03-14 23:20:00","updated_by":null}","{"subject":"DEak deal activity","lead_id":"2","deal_id":null,"started_at":"2022-03-14 11:10:00","due_at":"2022-03-14 11:20:00","updated_by":1}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 13:54:15","2022-03-21 13:54:15");
INSERT INTO audits VALUES("140","App\Models\User","1","updated","App\Models\Activity","16","{"subject":"Live in activiy","started_at":"2022-03-21 20:35:00","due_at":"2022-03-21 20:45:00","updated_by":null}","{"subject":"Live in aCT","started_at":"2022-03-21 08:35:00","due_at":"2022-03-21 08:45:00","updated_by":1}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:00:50","2022-03-21 14:00:50");
INSERT INTO audits VALUES("141","App\Models\User","1","deleted","App\Models\Activity","16","{"id":16,"subject":"Live in aCT","activity_type":"deadline","notes":null,"lead_id":null,"deal_id":2,"customer_id":4,"user_id":2,"started_at":"2022-03-21 08:35:00","due_at":"2022-03-21 08:45:00","done_at":null,"done_by":null,"available":null,"status":1,"added_by":1,"updated_by":1}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:04:35","2022-03-21 14:04:35");
INSERT INTO audits VALUES("142","App\Models\User","1","deleted","App\Models\DealDocument","3","{"id":3,"deal_id":2,"document":"deal\/E4NCQ3yMRMgxogbVLKnVihawP6s5wHjJpdMBOzrQ.png","document_name":null,"status":1,"added_by":1}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:04:43","2022-03-21 14:04:43");
INSERT INTO audits VALUES("143","App\Models\User","1","deleted","App\Models\Activity","13","{"id":13,"subject":"DEak deal activity","activity_type":"email","notes":null,"lead_id":2,"deal_id":null,"customer_id":4,"user_id":3,"started_at":"2022-03-14 11:10:00","due_at":"2022-03-14 11:20:00","done_at":"2022-03-14 16:41:03","done_by":1,"available":null,"status":1,"added_by":1,"updated_by":1}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:04:50","2022-03-21 14:04:50");
INSERT INTO audits VALUES("144","App\Models\User","1","created","App\Models\Activity","17","[]","{"status":1,"subject":"NEW aCTIVITY","activity_type":"email","notes":null,"deal_id":"2","customer_id":4,"started_at":"2022-03-21 20:37:00","due_at":"2022-03-21 20:47:00","user_id":"2","added_by":1,"id":17}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:05:10","2022-03-21 14:05:10");
INSERT INTO audits VALUES("145","App\Models\User","1","created","App\Models\DealDocument","4","[]","{"document":"deal\/1rSgRDLfBAJEfhFLhvyQvshkGq42X1J4bTqsGqck.png","deal_id":"2","added_by":1,"id":4}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:05:25","2022-03-21 14:05:25");
INSERT INTO audits VALUES("146","App\Models\User","1","created","App\Models\DealDocument","5","[]","{"document":"deal\/0qJ5RFPWZEkQFrdsGrIiC7j0Ny6ykes61L9jE7pu.png","deal_id":"2","added_by":1,"id":5}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:07:53","2022-03-21 14:07:53");
INSERT INTO audits VALUES("147","App\Models\User","1","created","App\Models\DealDocument","6","[]","{"document":"deal\/xIP1rWxne8VTa0IWxkFJLMJnVu69IGiwHLsoCK1A.png","deal_id":"2","added_by":1,"id":6}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:08:33","2022-03-21 14:08:33");
INSERT INTO audits VALUES("148","App\Models\User","1","created","App\Models\DealDocument","7","[]","{"document":"deal\/DicCFqUcL584bo6CxJMIFbkVLTNzYcUqueno2mFj.png","deal_id":"2","added_by":1,"id":7}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:10:56","2022-03-21 14:10:56");
INSERT INTO audits VALUES("149","App\Models\User","1","created","App\Models\DealDocument","8","[]","{"document":"deal\/LD0eOnZAHFTQ6ULncj8jcvKxs8M23IEO0F8TyX97.png","deal_id":"2","added_by":1,"id":8}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:11:32","2022-03-21 14:11:32");
INSERT INTO audits VALUES("150","App\Models\User","1","deleted","App\Models\DealDocument","4","{"id":4,"deal_id":2,"document":"deal\/1rSgRDLfBAJEfhFLhvyQvshkGq42X1J4bTqsGqck.png","document_name":null,"status":1,"added_by":1}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:11:42","2022-03-21 14:11:42");
INSERT INTO audits VALUES("151","App\Models\User","1","deleted","App\Models\DealDocument","5","{"id":5,"deal_id":2,"document":"deal\/0qJ5RFPWZEkQFrdsGrIiC7j0Ny6ykes61L9jE7pu.png","document_name":null,"status":1,"added_by":1}","[]","http://127.0.0.1:8000/deals/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:11:50","2022-03-21 14:11:50");
INSERT INTO audits VALUES("152","App\Models\User","1","created","App\Models\Note","15","[]","{"status":1,"notes":"Durair tsting notes","deal_id":"2","customer_id":4,"user_id":1,"added_by":1,"id":15}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:12:09","2022-03-21 14:12:09");
INSERT INTO audits VALUES("153","App\Models\User","1","created","App\Models\Note","16","[]","{"status":1,"notes":"Duair tesitng","lead_id":"1","customer_id":1,"user_id":1,"added_by":1,"id":16}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:12:42","2022-03-21 14:12:42");
INSERT INTO audits VALUES("154","App\Models\User","1","deleted","App\Models\Note","12","{"id":12,"notes":"duearitestet","lead_id":1,"deal_id":null,"customer_id":1,"user_id":1,"status":1,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/leads/activity/delete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:12:49","2022-03-21 14:12:49");
INSERT INTO audits VALUES("155","App\Models\User","1","updated","App\Models\Activity","15","{"subject":"Lead activity","updated_by":null}","{"subject":"Lead activity for testing","updated_by":1}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:13:07","2022-03-21 14:13:07");
INSERT INTO audits VALUES("156","App\Models\User","1","created","App\Models\Activity","18","[]","{"status":1,"subject":"New of","activity_type":"task","notes":null,"lead_id":"1","deal_id":null,"customer_id":1,"started_at":"2022-03-21 19:49:00","due_at":"2022-03-21 19:59:00","user_id":"2","added_by":1,"id":18}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:17:34","2022-03-21 14:17:34");
INSERT INTO audits VALUES("157","App\Models\User","1","updated","App\Models\Activity","15","{"done_at":null,"done_by":null}","{"done_at":"2022-03-21 14:18:38","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:18:38","2022-03-21 14:18:38");
INSERT INTO audits VALUES("158","App\Models\User","1","updated","App\Models\Activity","18","{"done_at":null,"done_by":null}","{"done_at":"2022-03-21 14:29:30","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:29:30","2022-03-21 14:29:30");
INSERT INTO audits VALUES("159","App\Models\User","1","created","App\Models\Activity","19","[]","{"status":1,"subject":"Durait estetin","activity_type":"lunch","notes":null,"lead_id":"1","deal_id":null,"customer_id":1,"started_at":"2022-03-21 20:59:00","due_at":"2022-03-21 21:09:00","user_id":"3","added_by":1,"id":19}","http://127.0.0.1:8000/leads/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:30:02","2022-03-21 14:30:02");
INSERT INTO audits VALUES("160","App\Models\User","1","updated","App\Models\Activity","19","{"done_at":null,"done_by":null}","{"done_at":"2022-03-21 14:30:17","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:30:17","2022-03-21 14:30:17");
INSERT INTO audits VALUES("161","App\Models\User","1","updated","App\Models\Activity","17","{"done_at":null,"done_by":null}","{"done_at":"2022-03-21 14:32:16","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:32:16","2022-03-21 14:32:16");
INSERT INTO audits VALUES("162","App\Models\User","1","updated","App\Models\Activity","12","{"done_at":null,"done_by":null}","{"done_at":"2022-03-21 14:32:55","done_by":1}","http://127.0.0.1:8000/activities/mark_as_done","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:32:55","2022-03-21 14:32:55");
INSERT INTO audits VALUES("163","App\Models\User","1","updated","App\Models\Activity","17","{"subject":"NEW aCTIVITY","started_at":"2022-03-21 20:37:00","due_at":"2022-03-21 20:47:00","updated_by":null}","{"subject":"NEW aCTIVITY opf ind","started_at":"2022-03-21 08:37:00","due_at":"2022-03-21 08:47:00","updated_by":1}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 14:33:17","2022-03-21 14:33:17");
INSERT INTO audits VALUES("164","App\Models\User","1","updated","App\Models\User","3","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/settings/users/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:41:22","2022-03-21 15:41:22");
INSERT INTO audits VALUES("165","App\Models\User","1","updated","App\Models\User","3","{"last_name":"k"}","{"last_name":"ks"}","http://127.0.0.1:8000/settings/users/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:41:30","2022-03-21 15:41:30");
INSERT INTO audits VALUES("166","App\Models\User","1","created","App\Models\User","4","[]","{"status":1,"name":"Agav","last_name":"kr","mobile_no":"9551706025","role_id":"1","email":"agav@yopmail.com","lead_limit":"20","deal_limit":"20","password":"$2y$10$uy\/eUjBbzlPHDJqFIUPUiO2l5WVjwiYX0nmA2COxKdLaZ\/HT1GUDu","id":4}","http://127.0.0.1:8000/settings/users/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:42:49","2022-03-21 15:42:49");
INSERT INTO audits VALUES("167","App\Models\User","1","created","App\Models\Role","5","[]","{"status":1,"role":"Guest","description":"Teste","added_by":1,"id":5}","http://127.0.0.1:8000/settings/roles/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:44:13","2022-03-21 15:44:13");
INSERT INTO audits VALUES("168","App\Models\User","1","updated","App\Models\Role","5","{"description":"Teste"}","{"description":"Tested"}","http://127.0.0.1:8000/settings/roles/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:44:27","2022-03-21 15:44:27");
INSERT INTO audits VALUES("169","App\Models\User","1","created","App\Models\Team","1","[]","{"status":1,"team_name":"Sunday","team_limit":"10","description":"Testign user","added_by":1,"id":1}","http://127.0.0.1:8000/settings/teams/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:46:55","2022-03-21 15:46:55");
INSERT INTO audits VALUES("170","App\Models\User","1","created","App\Models\Country","1","[]","{"status":1,"country_name":"India","dial_code":"+91","country_code":"IN","currency":"INR","description":null,"added_by":1,"id":1}","http://127.0.0.1:8000/settings/country/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:48:17","2022-03-21 15:48:17");
INSERT INTO audits VALUES("171","App\Models\User","1","created","App\Models\Country","2","[]","{"status":1,"country_name":"USA","dial_code":"+1","country_code":"USA","currency":"USD","description":null,"added_by":1,"id":2}","http://127.0.0.1:8000/settings/country/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:48:51","2022-03-21 15:48:51");
INSERT INTO audits VALUES("172","App\Models\User","1","created","App\Models\Subscription","1","[]","{"status":1,"subscription_name":"Platinum","subscription_period":"1-Y","no_of_clients":"20","no_of_employees":"30","no_of_leads":"20","no_of_deals":"60","no_of_pages":"80","no_of_email_templates":"15","bulk_import":"on","database_backup":"on","work_automation":null,"telegram_bot":null,"sms_integration":null,"payment_gateway":null,"business_whatsapp":null,"amount":"5200","added_by":1,"id":1}","http://127.0.0.1:8000/settings/subscriptions/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:51:27","2022-03-21 15:51:27");
INSERT INTO audits VALUES("173","App\Models\User","1","created","App\Models\Subscription","2","[]","{"status":1,"subscription_name":"Free","subscription_period":"15-D","no_of_clients":"20","no_of_employees":"50","no_of_leads":"30","no_of_deals":"20","no_of_pages":"50","no_of_email_templates":"12","bulk_import":"on","database_backup":"on","work_automation":null,"telegram_bot":null,"sms_integration":null,"payment_gateway":"on","business_whatsapp":null,"amount":"3000","added_by":1,"id":2}","http://127.0.0.1:8000/settings/subscriptions/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:52:17","2022-03-21 15:52:17");
INSERT INTO audits VALUES("174","App\Models\User","1","updated","App\Models\Subscription","2","{"status":1,"updated_by":null}","{"status":0,"updated_by":1}","http://127.0.0.1:8000/settings/subscriptions/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:52:36","2022-03-21 15:52:36");
INSERT INTO audits VALUES("175","App\Models\User","1","updated","App\Models\Subscription","2","{"status":0}","{"status":1}","http://127.0.0.1:8000/settings/subscriptions/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:53:10","2022-03-21 15:53:10");
INSERT INTO audits VALUES("176","App\Models\User","1","created","App\Models\CompanySubscription","1","[]","{"status":1,"company_id":"1","subscription_id":"1","startAt":"2022-03-01","endAt":"2023-03-01","total_amount":"3000","description":"testing","id":1}","http://127.0.0.1:8000/settings/company-subscriptions/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:53:42","2022-03-21 15:53:42");
INSERT INTO audits VALUES("177","App\Models\User","1","created","App\Models\Organization","5","[]","{"name":"DevOpes","added_by":1,"status":1,"id":5}","http://127.0.0.1:8000/autocomplete_org_save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:57:06","2022-03-21 15:57:06");
INSERT INTO audits VALUES("178","App\Models\User","1","created","App\Models\Customer","7","[]","{"status":1,"first_name":"Kimmiko","last_name":"k","organization_id":"5","email":"devops@yopmail.com","mobile_no":"9441306025","added_by":1,"id":7}","http://127.0.0.1:8000/customers/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:58:15","2022-03-21 15:58:15");
INSERT INTO audits VALUES("179","App\Models\User","1","updated","App\Models\Organization","5","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/organizations/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:58:34","2022-03-21 15:58:34");
INSERT INTO audits VALUES("180","App\Models\User","1","updated","App\Models\Organization","5","{"status":0}","{"status":"1"}","http://127.0.0.1:8000/organizations/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 15:58:40","2022-03-21 15:58:40");
INSERT INTO audits VALUES("181","App\Models\User","1","created","App\Models\Organization","6","[]","{"status":1,"name":"Saravana stoers","email":"saravanastores@yopmail.com","mobile_no":"5623145612","address":"Testing","added_by":1,"id":6}","http://127.0.0.1:8000/organizations/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:01:23","2022-03-21 16:01:23");
INSERT INTO audits VALUES("182","App\Models\User","1","updated","App\Models\Product","4","{"hsn_no":null,"updated_by":null}","{"hsn_no":"9999","updated_by":1}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:12:43","2022-03-21 16:12:43");
INSERT INTO audits VALUES("183","App\Models\User","1","updated","App\Models\Product","3","{"hsn_no":null,"updated_by":null}","{"hsn_no":"9618","updated_by":1}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:12:53","2022-03-21 16:12:53");
INSERT INTO audits VALUES("184","App\Models\User","1","updated","App\Models\Product","2","{"hsn_no":null,"updated_by":null}","{"hsn_no":"7210","updated_by":1}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:13:02","2022-03-21 16:13:02");
INSERT INTO audits VALUES("185","App\Models\User","1","created","App\Models\Product","5","[]","{"status":1,"product_name":"Lapton","product_code":"PD\/2022\/0005","hsn_no":"8945","description":"tste","added_by":1,"id":5}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:14:54","2022-03-21 16:14:54");
INSERT INTO audits VALUES("186","App\Models\User","1","updated","App\Models\Product","1","{"hsn_no":null,"updated_by":null}","{"hsn_no":"4510","updated_by":1}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:15:03","2022-03-21 16:15:03");
INSERT INTO audits VALUES("187","App\Models\User","1","updated","App\Models\Activity","19","{"started_at":"2022-03-21 20:59:00","due_at":"2022-03-21 21:09:00","updated_by":null}","{"started_at":"2022-03-21 08:59:00","due_at":"2022-03-21 09:09:00","updated_by":1}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:16:00","2022-03-21 16:16:00");
INSERT INTO audits VALUES("188","App\Models\User","1","created","App\Models\Activity","20","[]","{"status":1,"subject":"Jest veet","activity_type":"meeting","notes":"teste","lead_id":null,"deal_id":null,"customer_id":null,"started_at":"2022-03-21 23:50:00","due_at":"2022-03-21 00:00:00","user_id":"3","added_by":1,"id":20}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:18:20","2022-03-21 16:18:20");
INSERT INTO audits VALUES("189","App\Models\User","1","updated","App\Models\Activity","20","{"started_at":"2022-03-21 23:50:00","due_at":"2022-03-21 00:00:00","updated_by":null}","{"started_at":"2022-03-21 11:50:00","due_at":"2022-03-21 12:00:00","updated_by":1}","http://127.0.0.1:8000/activities/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:18:45","2022-03-21 16:18:45");
INSERT INTO audits VALUES("190","App\Models\User","1","created","App\Models\Task","2","[]","{"status":1,"task_name":"Mobile update","assigned_to":"3","description":null,"added_by":1,"id":2}","http://127.0.0.1:8000/tasks/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:20:52","2022-03-21 16:20:52");
INSERT INTO audits VALUES("191","App\Models\User","1","updated","App\Models\Task","1","{"updated_by":null}","{"updated_by":1}","http://127.0.0.1:8000/tasks/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:21:07","2022-03-21 16:21:07");
INSERT INTO audits VALUES("192","App\Models\User","1","created","App\Models\Note","17","[]","{"status":1,"lead_id":null,"customer_id":null,"user_id":"2","notes":"test","added_by":1,"id":17}","http://127.0.0.1:8000/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:23:31","2022-03-21 16:23:31");
INSERT INTO audits VALUES("193","App\Models\User","1","updated","App\Models\Note","16","{"customer_id":1,"user_id":1,"updated_by":null}","{"customer_id":null,"user_id":"3","updated_by":1}","http://127.0.0.1:8000/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:25:56","2022-03-21 16:25:56");
INSERT INTO audits VALUES("194","App\Models\User","1","created","App\Models\Lead","4","[]","{"status":1,"lead_subject":"Led test title","customer_id":"7","lead_type_id":"1","lead_source_id":"2","lead_value":"20","assinged_by":1,"assigned_to":"2","added_by":1,"id":4}","http://127.0.0.1:8000/leads/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:30:05","2022-03-21 16:30:05");
INSERT INTO audits VALUES("195","App\Models\User","1","created","App\Models\Note","18","[]","{"status":1,"notes":"duriar tal","lead_id":"4","customer_id":7,"user_id":1,"added_by":1,"id":18}","http://127.0.0.1:8000/leads/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:30:30","2022-03-21 16:30:30");
INSERT INTO audits VALUES("196","App\Models\User","1","created","App\Models\LeadSource","4","[]","{"status":1,"source":"SMs","description":"teste","added_by":1,"id":4}","http://127.0.0.1:8000/leadsource/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:34:57","2022-03-21 16:34:57");
INSERT INTO audits VALUES("197","App\Models\User","1","updated","App\Models\LeadSource","4","{"source":"SMs"}","{"source":"SMS"}","http://127.0.0.1:8000/leadsource/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:35:07","2022-03-21 16:35:07");
INSERT INTO audits VALUES("198","App\Models\User","1","created","App\Models\LeadType","4","[]","{"status":1,"type":"Tooo","description":null,"added_by":1,"id":4}","http://127.0.0.1:8000/leadstage/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:35:28","2022-03-21 16:35:28");
INSERT INTO audits VALUES("199","App\Models\User","1","updated","App\Models\LeadType","4","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/leadstage/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:36:24","2022-03-21 16:36:24");
INSERT INTO audits VALUES("200","App\Models\User","1","created","App\Models\LeadType","5","[]","{"status":1,"type":"Welth","description":null,"added_by":1,"id":5}","http://127.0.0.1:8000/leadstage/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:36:34","2022-03-21 16:36:34");
INSERT INTO audits VALUES("201","App\Models\User","1","updated","App\Models\LeadType","5","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/leadstage/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:36:41","2022-03-21 16:36:41");
INSERT INTO audits VALUES("202","App\Models\User","1","created","App\Models\Deal","3","[]","{"status":1,"deal_title":"Jimmi Test","customer_id":"7","current_stage_id":"1","deal_value":"5200","lead_id":null,"product_total":null,"expected_completed_date":"2022-03-24","added_by":1,"id":3}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:38:40","2022-03-21 16:38:40");
INSERT INTO audits VALUES("203","App\Models\User","1","created","App\Models\DealPipline","6","[]","{"deal_id":3,"stage_id":1,"status":"pending","completed_at":null,"added_by":1,"id":6}","http://127.0.0.1:8000/deals/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:38:40","2022-03-21 16:38:40");
INSERT INTO audits VALUES("204","App\Models\User","1","created","App\Models\Note","19","[]","{"status":1,"notes":"online rewoarek comping of the table onth int he","deal_id":"3","customer_id":7,"user_id":1,"added_by":1,"id":19}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-21 16:40:32","2022-03-21 16:40:32");
INSERT INTO audits VALUES("205","App\Models\User","1","updated","App\Models\DealPipline","6","{"status":"pending","completed_at":null}","{"status":"completed","completed_at":"2022-03-22 16:33:32"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-22 16:33:33","2022-03-22 16:33:33");
INSERT INTO audits VALUES("206","App\Models\User","1","updated","App\Models\Deal","3","{"current_stage_id":1}","{"current_stage_id":"2"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-22 16:33:34","2022-03-22 16:33:34");
INSERT INTO audits VALUES("207","App\Models\User","1","created","App\Models\DealPipline","7","[]","{"deal_id":"3","stage_id":2,"status":"pending","completed_at":null,"added_by":1,"id":7}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-22 16:33:35","2022-03-22 16:33:35");
INSERT INTO audits VALUES("208","App\Models\User","1","created","App\Models\Task","3","[]","{"status":1,"task_name":"Lead test","assigned_to":"2","description":"For testing","added_by":1,"id":3}","http://127.0.0.1:8000/tasks/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-23 02:16:11","2022-03-23 02:16:11");
INSERT INTO audits VALUES("209","App\Models\User","1","updated","App\Models\CompanySettings","1","{"invoice_terms":null}","{"invoice_terms":"1. Acceptance and Contract. SELLER\u2019S ACCEPTANCE OF THIS ORDER IS EXPRESSLY\r\nCONDITIONED UPON BUYER\u2019S ACCEPTANCE OF ALL TERMS AND CONDITIONS HEREOF. The terms and conditions\r\nhereof shall constitute the binding contract between Seller and Buyer concerning the goods sold hereunder. Neither party shall claim\r\nany amendment, modification, waiver or release form any provisions hereof unless the same is in writing and signed by both Buyer\r\nand Seller.\r\n2. Selling Terms. All goods sold hereunder are F.O.B. Seller\u2019s facility unless otherwise stated herein, but Seller retains a\r\nsecurity interest in the goods until payment is received. All claims for shipping loss or damage are Buyer\u2019s responsibility. Delivery\r\ndates are not guaranteed and Seller has no liability for damages that may be incurred due to any delay in shipment of goods hereunder.\r\nTaxes are excluded unless otherwise stated.\r\n3. Payment. Payment terms are cash on delivery, unless credit terms are established Seller\u2019s sole discretion. Buyer agrees\r\nto pay Seller cost of collection of overdue invoices, including reasonable attorney\u2019s fees."}","http://127.0.0.1:8000/company/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-23 02:34:31","2022-03-23 02:34:31");
INSERT INTO audits VALUES("210","App\Models\User","1","created","App\Models\Product","6","[]","{"status":1,"product_name":"Melbour","product_code":"PD\/2022\/0006","hsn_no":"9505","cgst":"9","sgst":"9","igst":null,"description":"tstet","added_by":1,"id":6}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36","","2022-03-24 03:00:33","2022-03-24 03:00:33");
INSERT INTO audits VALUES("211","App\Models\User","1","updated","App\Models\Product","6","{"cgst":"0.00","sgst":"0.00","updated_by":null}","{"cgst":"6","sgst":"6","updated_by":1}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 07:59:41","2022-03-26 07:59:41");
INSERT INTO audits VALUES("212","App\Models\User","1","updated","App\Models\Product","5","{"cgst":"0.00","sgst":"0.00","updated_by":null}","{"cgst":"9","sgst":"9","updated_by":1}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 07:59:49","2022-03-26 07:59:49");
INSERT INTO audits VALUES("213","App\Models\User","1","updated","App\Models\Product","4","{"cgst":"0.00","sgst":"0.00"}","{"cgst":"7","sgst":"7"}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 07:59:56","2022-03-26 07:59:56");
INSERT INTO audits VALUES("214","App\Models\User","1","updated","App\Models\Product","2","{"igst":"0.00"}","{"igst":"12"}","http://127.0.0.1:8000/products/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 08:00:05","2022-03-26 08:00:05");
INSERT INTO audits VALUES("215","App\Models\User","1","created","App\Models\Invoice","4","[]","{"deal_id":"3","invoice_no":"INV\/2022\/0003","issue_date":"2022-03-21","due_date":"2022-03-24","customer_id":"7","address":"Testing of the address","email":"devops@yopmail.com","total":"563.39625","status":0,"added_by":1,"id":4}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 08:01:42","2022-03-26 08:01:42");
INSERT INTO audits VALUES("216","App\Models\User","1","created","App\Models\Invoice","5","[]","{"deal_id":"3","invoice_no":"INV\/2022\/0004","issue_date":"2022-03-21","due_date":"2022-03-24","customer_id":"7","address":"address of the matching","email":"devops@yopmail.com","total":"3410.62","status":0,"added_by":1,"id":5}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 09:38:06","2022-03-26 09:38:06");
INSERT INTO audits VALUES("217","App\Models\User","1","updated","App\Models\CompanySettings","1","{"site_phone":null,"address":null}","{"site_phone":"9551402025","address":"23\/10, 1st floor, Aiwng, 3rd main road, Kasturi Nagar, Adyar, chennai, Tamil nadu -600020"}","http://127.0.0.1:8000/company/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 09:55:58","2022-03-26 09:55:58");
INSERT INTO audits VALUES("218","App\Models\User","1","updated","App\Models\CompanySettings","1","{"invoice_terms":"1. Acceptance and Contract. SELLER\u2019S ACCEPTANCE OF THIS ORDER IS EXPRESSLY\r\nCONDITIONED UPON BUYER\u2019S ACCEPTANCE OF ALL TERMS AND CONDITIONS HEREOF. The terms and conditions\r\nhereof shall constitute the binding contract between Seller and Buyer concerning the goods sold hereunder. Neither party shall claim\r\nany amendment, modification, waiver or release form any provisions hereof unless the same is in writing and signed by both Buyer\r\nand Seller.\r\n2. Selling Terms. All goods sold hereunder are F.O.B. Seller\u2019s facility unless otherwise stated herein, but Seller retains a\r\nsecurity interest in the goods until payment is received. All claims for shipping loss or damage are Buyer\u2019s responsibility. Delivery\r\ndates are not guaranteed and Seller has no liability for damages that may be incurred due to any delay in shipment of goods hereunder.\r\nTaxes are excluded unless otherwise stated.\r\n3. Payment. Payment terms are cash on delivery, unless credit terms are established Seller\u2019s sole discretion. Buyer agrees\r\nto pay Seller cost of collection of overdue invoices, including reasonable attorney\u2019s fees."}","{"invoice_terms":"1. Acceptance and Contract. SELLER\u2019S ACCEPTANCE OF THIS ORDER IS EXPRESSLY\r\nCONDITIONED UPON BUYER\u2019S ACCEPTANCE OF ALL TERMS AND CONDITIONS HEREOF. The terms and conditions\r\nhereof shall constitute the binding contract between Seller and Buyer concerning the goods sold hereunder. Neither party shall claim\r\nany amendment, modification, waiver or release form any provisions hereof unless the same is in writing and signed by both Buyer\r\nand Seller."}","http://127.0.0.1:8000/company/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 11:47:44","2022-03-26 11:47:44");
INSERT INTO audits VALUES("219","App\Models\User","1","created","App\Models\Invoice","6","[]","{"deal_id":"2","invoice_no":"INV\/2022\/0005","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":"4","address":"Filter oth the match","email":"customer@yopmail.com","total":"108.62","status":0,"added_by":1,"id":6}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:11:03","2022-03-26 12:11:03");
INSERT INTO audits VALUES("220","App\Models\User","1","created","App\Models\Invoice","7","[]","{"deal_id":"2","invoice_no":"INV\/2022\/0006","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":"4","address":"Welcoem toht teh matchens","email":"customer@yopmail.com","total":"864.15","status":0,"added_by":1,"id":7}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:13:10","2022-03-26 12:13:10");
INSERT INTO audits VALUES("221","App\Models\User","1","created","App\Models\Invoice","8","[]","{"deal_id":"2","invoice_no":"INV\/2022\/0006","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":"4","address":"Welcoem toht teh matchens","email":"customer@yopmail.com","total":"864.15","status":0,"added_by":1,"id":8}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:14:38","2022-03-26 12:14:38");
INSERT INTO audits VALUES("222","App\Models\User","1","created","App\Models\Invoice","9","[]","{"deal_id":"2","invoice_no":"INV\/2022\/0006","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":"4","address":"Welcoem toht teh matchens","email":"customer@yopmail.com","total":"864.15","status":0,"added_by":1,"id":9}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:15:31","2022-03-26 12:15:31");
INSERT INTO audits VALUES("223","App\Models\User","1","deleted","App\Models\Invoice","8","{"id":8,"deal_id":2,"invoice_no":"INV\/2022\/0006","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":4,"address":"Welcoem toht teh matchens","email":"customer@yopmail.com","subtotal":null,"tax":null,"tax_included":"no","discount":null,"total":"864.15","status":0,"approved_at":null,"rejected_at":null,"pending_at":null,"approved_by":null,"rejected_by":null,"reject_reason":null,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/invoice/unlink","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:17:44","2022-03-26 12:17:44");
INSERT INTO audits VALUES("224","App\Models\User","1","deleted","App\Models\Invoice","6","{"id":6,"deal_id":2,"invoice_no":"INV\/2022\/0005","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":4,"address":"Filter oth the match","email":"customer@yopmail.com","subtotal":null,"tax":null,"tax_included":"no","discount":null,"total":"108.62","status":0,"approved_at":null,"rejected_at":null,"pending_at":null,"approved_by":null,"rejected_by":null,"reject_reason":null,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/invoice/unlink","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:22:25","2022-03-26 12:22:25");
INSERT INTO audits VALUES("225","App\Models\User","1","deleted","App\Models\Invoice","7","{"id":7,"deal_id":2,"invoice_no":"INV\/2022\/0006","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":4,"address":"Welcoem toht teh matchens","email":"customer@yopmail.com","subtotal":null,"tax":null,"tax_included":"no","discount":null,"total":"864.15","status":0,"approved_at":null,"rejected_at":null,"pending_at":null,"approved_by":null,"rejected_by":null,"reject_reason":null,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/invoice/unlink","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:22:32","2022-03-26 12:22:32");
INSERT INTO audits VALUES("226","App\Models\User","1","deleted","App\Models\Invoice","3","{"id":3,"deal_id":2,"invoice_no":"INV\/2022\/0002","issue_date":"2022-03-14","due_date":"2022-03-23","customer_id":4,"address":"Duria testing address","email":"customer@yopmail.com","subtotal":null,"tax":null,"tax_included":"no","discount":null,"total":"410.00","status":0,"approved_at":null,"rejected_at":null,"pending_at":"2022-03-15 02:46:31","approved_by":null,"rejected_by":null,"reject_reason":null,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/invoice/unlink","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-26 12:22:43","2022-03-26 12:22:43");
INSERT INTO audits VALUES("227","App\Models\User","1","updated","App\Models\Invoice","9","{"pending_at":null}","{"pending_at":"2022-03-27 05:27:32"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-27 05:27:32","2022-03-27 05:27:32");
INSERT INTO audits VALUES("228","App\Models\User","1","updated","App\Models\Invoice","9","{"pending_at":null}","{"pending_at":"2022-03-27 05:31:50"}","http://127.0.0.1:8000/deals/invoice/submit","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-27 05:31:50","2022-03-27 05:31:50");
INSERT INTO audits VALUES("229","App\Models\User","1","updated","App\Models\Invoice","9","{"approved_at":null}","{"approved_at":"2022-03-27 05:32:05"}","http://127.0.0.1:8000/approve/invoice/9","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-27 05:32:05","2022-03-27 05:32:05");
INSERT INTO audits VALUES("230","App\Models\User","1","updated","App\Models\DealPipline","7","{"status":"pending","completed_at":null}","{"status":"completed","completed_at":"2022-03-27 06:06:11"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-27 06:06:11","2022-03-27 06:06:11");
INSERT INTO audits VALUES("231","App\Models\User","1","updated","App\Models\Deal","3","{"current_stage_id":2}","{"current_stage_id":"3"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-27 06:06:11","2022-03-27 06:06:11");
INSERT INTO audits VALUES("232","App\Models\User","1","created","App\Models\DealPipline","8","[]","{"deal_id":"3","stage_id":3,"status":"pending","completed_at":null,"added_by":1,"id":8}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-27 06:06:11","2022-03-27 06:06:11");
INSERT INTO audits VALUES("233","App\Models\User","1","created","App\Models\Note","20","[]","{"status":1,"lead_id":null,"customer_id":null,"user_id":"2","notes":"This is test notes for testing","added_by":1,"id":20}","http://127.0.0.1:8000/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 01:57:15","2022-03-29 01:57:15");
INSERT INTO audits VALUES("234","App\Models\User","1","created","App\Models\Task","4","[]","{"status":1,"task_name":"Kept Bownloer","assigned_to":"2","description":"Be a part of this","added_by":1,"id":4}","http://127.0.0.1:8000/tasks/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 02:03:43","2022-03-29 02:03:43");
INSERT INTO audits VALUES("235","App\Models\User","2","updated","App\Models\Note","20","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/notes/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 02:09:06","2022-03-29 02:09:06");
INSERT INTO audits VALUES("236","App\Models\User","2","updated","App\Models\Note","20","{"status":0}","{"status":"1"}","http://127.0.0.1:8000/notes/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 02:09:11","2022-03-29 02:09:11");
INSERT INTO audits VALUES("237","App\Models\User","2","updated","App\Models\Product","6","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/products/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 02:53:22","2022-03-29 02:53:22");
INSERT INTO audits VALUES("238","App\Models\User","2","updated","App\Models\Product","6","{"status":0}","{"status":"1"}","http://127.0.0.1:8000/products/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 02:53:28","2022-03-29 02:53:28");
INSERT INTO audits VALUES("239","App\Models\User","2","updated","App\Models\Lead","4","{"status":1}","{"status":"0"}","http://127.0.0.1:8000/leads/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 16:48:06","2022-03-29 16:48:06");
INSERT INTO audits VALUES("240","App\Models\User","2","updated","App\Models\Lead","4","{"status":0}","{"status":"1"}","http://127.0.0.1:8000/leads/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.82 Safari/537.36","","2022-03-29 16:48:11","2022-03-29 16:48:11");
INSERT INTO audits VALUES("241","App\Models\User","1","updated","App\Models\DealPipline","5","{"status":"pending","completed_at":null}","{"status":"completed","completed_at":"2022-04-05 10:35:30"}","http://127.0.0.1:8000/deals/stage/complete/pipeline","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 10:35:31","2022-04-05 10:35:31");
INSERT INTO audits VALUES("242","App\Models\User","1","updated","App\Models\Deal","2","{"current_stage_id":3}","{"current_stage_id":4}","http://127.0.0.1:8000/deals/stage/complete/pipeline","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 10:49:22","2022-04-05 10:49:22");
INSERT INTO audits VALUES("243","App\Models\User","1","created","App\Models\DealPipline","9","[]","{"deal_id":"2","stage_id":4,"status":"pending","completed_at":null,"added_by":1,"id":9}","http://127.0.0.1:8000/deals/stage/complete/pipeline","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 10:49:22","2022-04-05 10:49:22");
INSERT INTO audits VALUES("244","App\Models\User","1","updated","App\Models\DealPipline","2","{"status":"pending","completed_at":null}","{"status":"completed","completed_at":"2022-04-05 10:50:40"}","http://127.0.0.1:8000/deals/stage/complete/pipeline","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 10:50:40","2022-04-05 10:50:40");
INSERT INTO audits VALUES("245","App\Models\User","1","updated","App\Models\Deal","1","{"current_stage_id":2}","{"current_stage_id":3}","http://127.0.0.1:8000/deals/stage/complete/pipeline","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 10:50:40","2022-04-05 10:50:40");
INSERT INTO audits VALUES("246","App\Models\User","1","created","App\Models\DealPipline","10","[]","{"deal_id":"1","stage_id":3,"status":"pending","completed_at":null,"added_by":1,"id":10}","http://127.0.0.1:8000/deals/stage/complete/pipeline","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 10:50:40","2022-04-05 10:50:40");
INSERT INTO audits VALUES("247","App\Models\User","1","updated","App\Models\Task","4","{"status":1}","{"status":2}","http://127.0.0.1:8000/tasks/complete/status","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 11:13:39","2022-04-05 11:13:39");
INSERT INTO audits VALUES("248","App\Models\User","1","created","App\Models\Task","5","[]","{"status":1,"task_name":"Upload file","assigned_to":"2","description":"Tsting ofht eh match","added_by":1,"id":5}","http://127.0.0.1:8000/tasks/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-05 11:36:52","2022-04-05 11:36:52");
INSERT INTO audits VALUES("249","App\Models\User","1","created","App\Models\Invoice","10","[]","{"deal_id":"2","invoice_no":"INV\/2022\/0007","issue_date":"2022-03-14","due_date":"2022-04-28","customer_id":"4","address":"Bo: f7899, Main street, album street, chennai - 600052","email":"customer@yopmail.com","total":"87.40","status":0,"added_by":1,"id":10}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-06 02:56:50","2022-04-06 02:56:50");
INSERT INTO audits VALUES("250","App\Models\User","1","deleted","App\Models\Invoice","5","{"id":5,"deal_id":3,"invoice_no":"INV\/2022\/0004","issue_date":"2022-03-21","due_date":"2022-03-24","due_days":null,"customer_id":7,"address":"address of the matching","email":"devops@yopmail.com","currency":null,"subtotal":null,"tax":null,"tax_included":"no","discount":null,"total":"3410.62","status":0,"approved_at":null,"rejected_at":null,"pending_at":null,"approved_by":null,"rejected_by":null,"reject_reason":null,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/invoice/unlink","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-06 03:38:31","2022-04-06 03:38:31");
INSERT INTO audits VALUES("251","App\Models\User","1","deleted","App\Models\Invoice","4","{"id":4,"deal_id":3,"invoice_no":"INV\/2022\/0003","issue_date":"2022-03-21","due_date":"2022-03-24","due_days":null,"customer_id":7,"address":"Testing of the address","email":"devops@yopmail.com","currency":null,"subtotal":null,"tax":null,"tax_included":"no","discount":null,"total":"563.40","status":0,"approved_at":null,"rejected_at":null,"pending_at":null,"approved_by":null,"rejected_by":null,"reject_reason":null,"added_by":1,"updated_by":null}","[]","http://127.0.0.1:8000/deals/invoice/unlink","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-06 03:38:38","2022-04-06 03:38:38");
INSERT INTO audits VALUES("252","App\Models\User","1","created","App\Models\Invoice","11","[]","{"deal_id":"3","invoice_no":"INV\/2022\/0008","issue_date":"2022-03-21","due_date":"2022-05-05","customer_id":"7","address":"Box:9009, Veiltset coik stree, near park statuin, check with the time.","email":"devops@yopmail.com","total":"1065.00","status":0,"added_by":1,"id":11}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-06 03:50:00","2022-04-06 03:50:00");
INSERT INTO audits VALUES("253","App\Models\User","1","created","App\Models\Invoice","12","[]","{"deal_id":"3","invoice_no":"INV\/2022\/0009","issue_date":"2022-03-21","due_date":"2022-04-10","customer_id":"7","address":"Bpo:no:12, Second date Number, Post Mask, India","email":"devops@yopmail.com","total":"1417.50","status":0,"added_by":1,"id":12}","http://127.0.0.1:8000/deals/insert/invoice","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-06 16:52:36","2022-04-06 16:52:36");
INSERT INTO audits VALUES("254","App\Models\User","1","created","App\Models\DealStage","6","[]","{"status":1,"stages":"Close","description":"testet","order_by":"6","added_by":1,"id":6}","http://127.0.0.1:8000/dealstages/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-13 02:15:26","2022-04-13 02:15:26");
INSERT INTO audits VALUES("255","App\Models\User","1","created","App\Models\Note","21","[]","{"status":1,"notes":"Durai testing ofthe match","deal_id":"3","customer_id":7,"user_id":1,"added_by":1,"id":21}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-13 02:50:00","2022-04-13 02:50:00");
INSERT INTO audits VALUES("256","App\Models\User","1","created","App\Models\Note","22","[]","{"status":1,"notes":"Final testing","deal_id":"3","customer_id":7,"user_id":1,"added_by":1,"id":22}","http://127.0.0.1:8000/deals/notes/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-13 03:05:38","2022-04-13 03:05:38");
INSERT INTO audits VALUES("257","App\Models\User","1","created","App\Models\Activity","21","[]","{"status":1,"subject":"Manikroth","activity_type":"email","notes":null,"deal_id":"3","customer_id":7,"started_at":"2022-04-17 09:29:00","due_at":"2022-04-17 09:39:00","user_id":"2","added_by":1,"id":21}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-17 00:56:25","2022-04-17 00:56:25");
INSERT INTO audits VALUES("258","App\Models\User","1","created","App\Models\Activity","22","[]","{"status":1,"subject":"Hour Break","activity_type":"deadline","notes":null,"deal_id":"3","customer_id":7,"started_at":"2022-04-17 08:30:00","due_at":"2022-04-17 08:40:00","user_id":"4","added_by":1,"id":22}","http://127.0.0.1:8000/deals/activity/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-17 00:58:24","2022-04-17 00:58:24");
INSERT INTO audits VALUES("259","App\Models\User","1","created","App\Models\DealDocument","9","[]","{"document":"deal\/seA3vi9GuDQ6hwr2VZR9TQyjQftNO6Mx3hGxdpUQ.pdf","deal_id":"3","added_by":1,"id":9}","http://127.0.0.1:8000/deals/files/save","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-17 01:00:47","2022-04-17 01:00:47");
INSERT INTO audits VALUES("260","App\Models\User","1","updated","App\Models\DealPipline","8","{"status":"pending","completed_at":null}","{"status":"completed","completed_at":"2022-04-17 01:10:53"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-17 01:10:53","2022-04-17 01:10:53");
INSERT INTO audits VALUES("261","App\Models\User","1","updated","App\Models\Deal","3","{"current_stage_id":3}","{"current_stage_id":"4"}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-17 01:10:54","2022-04-17 01:10:54");
INSERT INTO audits VALUES("262","App\Models\User","1","created","App\Models\DealPipline","11","[]","{"deal_id":"3","stage_id":4,"status":"pending","completed_at":null,"added_by":1,"id":11}","http://127.0.0.1:8000/deals/stage/complete","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36","","2022-04-17 01:10:54","2022-04-17 01:10:54");



CREATE TABLE `cms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `page_id` bigint(20) unsigned NOT NULL COMMENT 'from page_type',
  `header_section` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_section` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `banners` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cms_page_id_foreign` (`page_id`),
  KEY `cms_added_by_foreign` (`added_by`),
  KEY `cms_company_id_foreign` (`company_id`),
  CONSTRAINT `cms_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `cms_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `cms_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `page_types` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `company_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from company subscriptions',
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstin_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_favicon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aws_access_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aws_secret_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_port` int(11) DEFAULT NULL,
  `smtp_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyrights` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_terms` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive, 1-active',
  PRIMARY KEY (`id`),
  KEY `company_settings_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `company_settings_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `company_subscriptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO company_settings VALUES("1","1","PhoenixCRM","","9551402025","23/10, 1st floor, Aiwng, 3rd main road, Kasturi Nagar, Adyar, chennai, Tamil nadu -600020","","","","account/9rOmtojZtQZ7xKxcaIqeVKuttdbjDaYYNkV3zuUH.png","","","","","","","","smtp","smtp.mailtrap.io","2525","4d9e7f3c7586fc","b2173a30a89eaf","tls","","1. Acceptance and Contract. SELLER’S ACCEPTANCE OF THIS ORDER IS EXPRESSLY
CONDITIONED UPON BUYER’S ACCEPTANCE OF ALL TERMS AND CONDITIONS HEREOF. The terms and conditions
hereof shall constitute the binding contract between Seller and Buyer concerning the goods sold hereunder. Neither party shall claim
any amendment, modification, waiver or release form any provisions hereof unless the same is in writing and signed by both Buyer
and Seller.","","2022-03-26 11:47:44","","1");



CREATE TABLE `company_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint(20) unsigned NOT NULL COMMENT 'from subscriptions',
  `company_id` bigint(20) unsigned NOT NULL COMMENT 'from company',
  `startAt` date NOT NULL,
  `endAt` date NOT NULL,
  `total_amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active,2-expired,3-cancelled',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_subscriptions_subscription_id_foreign` (`subscription_id`),
  KEY `company_subscriptions_company_id_foreign` (`company_id`),
  CONSTRAINT `company_subscriptions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `company_subscriptions_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO company_subscriptions VALUES("1","1","1","2022-03-01","2023-03-01","3000","testing","1","","2022-03-21 15:53:42","2022-03-21 15:53:42");



CREATE TABLE `contact_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `contact_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_types_company_id_foreign` (`company_id`),
  KEY `contact_types_added_by_foreign` (`added_by`),
  KEY `contact_types_updated_by_foreign` (`updated_by`),
  CONSTRAINT `contact_types_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `contact_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `contact_types_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dial_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_added_by_foreign` (`added_by`),
  CONSTRAINT `countries_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO countries VALUES("1","India","+91","IN","","INR","","1","1","","2022-03-21 15:48:17","2022-03-21 15:48:17");
INSERT INTO countries VALUES("2","USA","+1","USA","","USD","","1","1","","2022-03-21 15:48:51","2022-03-21 15:48:51");



CREATE TABLE `custom_forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `field_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type_id` bigint(20) unsigned NOT NULL COMMENT 'from page type',
  `field_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_mandatory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'yes,no',
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_forms_company_id_foreign` (`company_id`),
  KEY `custom_forms_page_type_id_foreign` (`page_type_id`),
  KEY `custom_forms_added_by_foreign` (`added_by`),
  KEY `custom_forms_updated_by_foreign` (`updated_by`),
  CONSTRAINT `custom_forms_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `custom_forms_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `custom_forms_page_type_id_foreign` FOREIGN KEY (`page_type_id`) REFERENCES `page_types` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `custom_forms_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `customer_mobile` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_type_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from contact_types',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from customers',
  PRIMARY KEY (`id`),
  KEY `customer_mobile_company_id_foreign` (`company_id`),
  KEY `customer_mobile_added_by_foreign` (`added_by`),
  KEY `customer_mobile_updated_by_foreign` (`updated_by`),
  KEY `customer_mobile_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_mobile_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `customer_mobile_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `customer_mobile_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `customer_mobile_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `organization_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from organizations',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from countries',
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_company_id_foreign` (`company_id`),
  KEY `customers_country_id_foreign` (`country_id`),
  KEY `customers_added_by_foreign` (`added_by`),
  KEY `customers_updated_by_foreign` (`updated_by`),
  KEY `customers_organization_id_foreign` (`organization_id`),
  CONSTRAINT `customers_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `customers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `customers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `customers_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `customers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customers VALUES("1","","1","Gopal","","","","gopal@yopmail.com","9551706025","","","1","1","","","2022-03-13 09:25:23","2022-03-13 09:27:03");
INSERT INTO customers VALUES("2","","2","Rajesh","","","","rajesh@yopmail.com","6551202020","","","1","1","","","2022-03-13 09:52:56","2022-03-13 11:03:53");
INSERT INTO customers VALUES("3","","1","Hemanth","","","","hemanth@yopmail.com","7852045620","","","1","1","","","2022-03-13 10:20:51","2022-03-13 11:04:14");
INSERT INTO customers VALUES("4","","4","Customer","","","","customer@yopmail.com","9441302010","","","1","1","","","2022-03-14 02:27:09","2022-03-14 02:38:13");
INSERT INTO customers VALUES("5","","4","Kumar","s","","","kumar@yopmail.com","7511205600","","","1","1","","","2022-03-14 02:29:30","2022-03-14 02:41:02");
INSERT INTO customers VALUES("6","","1","anu","vinth","","","","","","","1","1","","","2022-03-14 16:47:30","2022-03-14 16:47:30");
INSERT INTO customers VALUES("7","","5","Kimmiko","k","","","devops@yopmail.com","9441306025","","","1","1","","","2022-03-21 15:58:15","2022-03-21 15:58:15");



CREATE TABLE `custor_email` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_type_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from contact_types',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from customers',
  PRIMARY KEY (`id`),
  KEY `custor_email_company_id_foreign` (`company_id`),
  KEY `custor_email_added_by_foreign` (`added_by`),
  KEY `custor_email_updated_by_foreign` (`updated_by`),
  KEY `custor_email_customer_id_foreign` (`customer_id`),
  CONSTRAINT `custor_email_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `custor_email_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `custor_email_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `custor_email_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `dashboard_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO dashboard_orders VALUES("1","mytask","left","","","");
INSERT INTO dashboard_orders VALUES("2","alltask","bottom-left","","","");
INSERT INTO dashboard_orders VALUES("3","closingweek","right","","","");
INSERT INTO dashboard_orders VALUES("4","mytask","bottom-right","","","");



CREATE TABLE `data_base_backups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `deal_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `deal_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from deals',
  `document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0-inactive, 1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deal_documents_deal_id_foreign` (`deal_id`),
  KEY `deal_documents_added_by_foreign` (`added_by`),
  CONSTRAINT `deal_documents_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deal_documents_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deal_documents VALUES("1","1","deal/tYJHKu9Pg623M5BuvPccwDQXDdPYNCIv6mnAb33C.pdf","","1","2","2022-03-13 10:43:09","2022-03-13 10:43:09");
INSERT INTO deal_documents VALUES("6","2","deal/xIP1rWxne8VTa0IWxkFJLMJnVu69IGiwHLsoCK1A.png","","1","1","2022-03-21 14:08:32","2022-03-21 14:08:32");
INSERT INTO deal_documents VALUES("7","2","deal/DicCFqUcL584bo6CxJMIFbkVLTNzYcUqueno2mFj.png","","1","1","2022-03-21 14:10:56","2022-03-21 14:10:56");
INSERT INTO deal_documents VALUES("8","2","deal/LD0eOnZAHFTQ6ULncj8jcvKxs8M23IEO0F8TyX97.png","","1","1","2022-03-21 14:11:32","2022-03-21 14:11:32");
INSERT INTO deal_documents VALUES("9","3","deal/seA3vi9GuDQ6hwr2VZR9TQyjQftNO6Mx3hGxdpUQ.pdf","","1","1","2022-04-17 01:00:47","2022-04-17 01:00:47");



CREATE TABLE `deal_piplines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `deal_id` bigint(20) unsigned NOT NULL COMMENT 'from deals',
  `stage_id` bigint(20) unsigned NOT NULL COMMENT 'from deal_stages',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'completed,pending',
  `completed_at` timestamp NULL DEFAULT NULL,
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deal_piplines_deal_id_foreign` (`deal_id`),
  KEY `deal_piplines_stage_id_foreign` (`stage_id`),
  KEY `deal_piplines_added_by_foreign` (`added_by`),
  KEY `deal_piplines_updated_by_foreign` (`updated_by`),
  CONSTRAINT `deal_piplines_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deal_piplines_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deal_piplines_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `deal_stages` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deal_piplines_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deal_piplines VALUES("1","1","1","completed","2022-03-13 10:38:51","2","","","2022-03-13 10:38:51","2022-03-13 10:38:51");
INSERT INTO deal_piplines VALUES("2","1","2","completed","2022-04-05 10:50:40","2","","","2022-03-13 10:38:51","2022-04-05 10:50:40");
INSERT INTO deal_piplines VALUES("3","2","1","completed","2022-03-14 16:46:07","1","","","2022-03-14 03:16:29","2022-03-14 16:46:07");
INSERT INTO deal_piplines VALUES("4","2","2","completed","2022-03-20 05:02:56","1","","","2022-03-14 16:46:07","2022-03-20 05:02:56");
INSERT INTO deal_piplines VALUES("5","2","3","completed","2022-04-05 10:35:30","1","","","2022-03-20 05:02:57","2022-04-05 10:35:30");
INSERT INTO deal_piplines VALUES("6","3","1","completed","2022-03-22 16:33:32","1","","","2022-03-21 16:38:40","2022-03-22 16:33:32");
INSERT INTO deal_piplines VALUES("7","3","2","completed","2022-03-27 06:06:11","1","","","2022-03-22 16:33:34","2022-03-27 06:06:11");
INSERT INTO deal_piplines VALUES("8","3","3","completed","2022-04-17 01:10:53","1","","","2022-03-27 06:06:11","2022-04-17 01:10:53");
INSERT INTO deal_piplines VALUES("9","2","4","pending","","1","","","2022-04-05 10:49:22","2022-04-05 10:49:22");
INSERT INTO deal_piplines VALUES("10","1","3","pending","","1","","","2022-04-05 10:50:40","2022-04-05 10:50:40");
INSERT INTO deal_piplines VALUES("11","3","4","pending","","1","","","2022-04-17 01:10:54","2022-04-17 01:10:54");



CREATE TABLE `deal_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `deal_id` bigint(20) unsigned NOT NULL COMMENT 'from deals',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'from products',
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0-inactive, 1-active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deal_products_deal_id_foreign` (`deal_id`),
  KEY `deal_products_product_id_foreign` (`product_id`),
  CONSTRAINT `deal_products_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deal_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deal_products VALUES("1","1","2","","25.00","1","25.00","","","1","","2022-03-13 10:38:51","2022-03-13 10:38:51");
INSERT INTO deal_products VALUES("2","1","3","","30.00","5","150.00","","","1","","2022-03-13 10:38:51","2022-03-13 10:38:51");
INSERT INTO deal_products VALUES("3","2","2","","25.00","1","25.00","","","1","","2022-03-14 03:16:28","2022-03-14 03:16:28");
INSERT INTO deal_products VALUES("4","2","3","","30.00","1","30.00","","","1","","2022-03-14 03:16:28","2022-03-14 03:16:28");



CREATE TABLE `deal_stages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `stages` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deal_stages_added_by_foreign` (`added_by`),
  KEY `deal_stages_company_id_foreign` (`company_id`),
  CONSTRAINT `deal_stages_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deal_stages_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deal_stages VALUES("1","","Qualified","teste","1","1","1","","2022-03-13 10:28:52","2022-03-13 10:28:52");
INSERT INTO deal_stages VALUES("2","","Clarifiy","teset","2","1","1","","2022-03-13 10:29:14","2022-03-13 10:29:14");
INSERT INTO deal_stages VALUES("3","","Relational","tested","3","1","1","","2022-03-13 10:29:46","2022-03-13 10:29:46");
INSERT INTO deal_stages VALUES("4","","Negote","negotiation","4","1","1","","2022-03-13 10:30:04","2022-03-13 10:30:04");
INSERT INTO deal_stages VALUES("5","","Final","Testign of the","5","1","1","","2022-03-13 10:30:23","2022-03-13 10:30:23");
INSERT INTO deal_stages VALUES("6","","Close","testet","6","1","1","","2022-04-13 02:15:25","2022-04-13 02:15:25");



CREATE TABLE `deals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL COMMENT 'from customertable',
  `deal_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deal_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deal_value` double DEFAULT NULL,
  `deal_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from leads',
  `current_stage_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from deal_stages',
  `stage_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_completed_date` date DEFAULT NULL,
  `product_total` decimal(8,2) DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `assinged_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-inactive,1-active, 2-done',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `won_at` timestamp NULL DEFAULT NULL,
  `loss_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deals_customer_id_foreign` (`customer_id`),
  KEY `deals_lead_id_foreign` (`lead_id`),
  KEY `deals_current_stage_id_foreign` (`current_stage_id`),
  KEY `deals_assigned_to_foreign` (`assigned_to`),
  KEY `deals_assinged_by_foreign` (`assinged_by`),
  KEY `deals_added_by_foreign` (`added_by`),
  KEY `deals_updated_by_foreign` (`updated_by`),
  CONSTRAINT `deals_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deals_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deals_assinged_by_foreign` FOREIGN KEY (`assinged_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deals_current_stage_id_foreign` FOREIGN KEY (`current_stage_id`) REFERENCES `deal_stages` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deals_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deals_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `deals_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO deals VALUES("1","2","Innings Match","","50","","2","3","","2022-04-08","175.00","","2","2","1","2","","","2022-03-13 10:38:50","2022-04-05 10:50:40","","");
INSERT INTO deals VALUES("2","4","Dlea Deal title","","250","","3","4","","2022-03-23","55.00","","2","1","1","1","","","2022-03-14 03:16:28","2022-04-05 10:49:22","","");
INSERT INTO deals VALUES("3","7","Jimmi Test","","5200","","","4","","2022-03-24","","","","","1","1","","","2022-03-21 16:38:39","2022-04-17 01:10:53","","");



CREATE TABLE `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO email_templates VALUES("1","New Registration","Register successfull","Hi [name],

                            Welcome to [product or brand name]. We’re thrilled to see you here!
                            
                            We’re confident that [product/service] will help you [summary of key benefit or benefits of product/service].
                            
                            Get to know us in our [title] video. You’ll be guided through [name of service/product] by our [name of employee and what they do] to ensure you get the very best out of our service.
                            
                            You can also find more of our guides here to learn more about [product/service name].
                            
                            Take care!
                            [name]","0","Alexia","2022-03-29 16:26:53","2022-03-29 16:26:53");
INSERT INTO email_templates VALUES("2","Forgot Password","Set Password for forgot password","Hi [name],

                            Welcome to [product or brand name]. We’re thrilled to see you here!
                            
                            We’re confident that [product/service] will help you [summary of key benefit or benefits of product/service].
                            
                            Get to know us in our [title] video. You’ll be guided through [name of service/product] by our [name of employee and what they do] to ensure you get the very best out of our service.
                            
                            You can also find more of our guides here to learn more about [product/service name].
                            
                            Take care!
                            [name]","0","Alexia","2022-03-29 16:27:31","2022-03-29 16:27:31");



CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `invoice_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned NOT NULL COMMENT 'from invoices',
  `product_id` bigint(20) unsigned NOT NULL COMMENT 'from products',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` decimal(8,2) DEFAULT NULL,
  `unit_price` decimal(8,2) DEFAULT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `cgst` decimal(8,2) DEFAULT NULL,
  `sgst` decimal(8,2) DEFAULT NULL,
  `igst` decimal(8,2) DEFAULT NULL,
  `tax_group_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from tax_groups',
  `amount` decimal(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  KEY `invoice_items_product_id_foreign` (`product_id`),
  KEY `invoice_items_tax_group_id_foreign` (`tax_group_id`),
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `invoice_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `invoice_items_tax_group_id_foreign` FOREIGN KEY (`tax_group_id`) REFERENCES `tax_groups` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO invoice_items VALUES("1","1","2","testing","1.00","25.00","0.00","","","","","25.00","","2022-03-13 10:44:14","2022-03-13 10:44:14");
INSERT INTO invoice_items VALUES("2","2","2","","1.00","25.00","0.00","","","","","25.00","","2022-03-14 16:44:10","2022-03-14 16:44:10");
INSERT INTO invoice_items VALUES("3","3","2","Testin gof the match","8.00","25.00","0.00","","","","","200.00","","2022-03-15 02:09:49","2022-03-15 02:09:49");
INSERT INTO invoice_items VALUES("4","4","6","Tesign ","10.00","25.00","2.00","","","","","275.28","","2022-03-26 08:01:42","2022-03-26 08:01:42");
INSERT INTO invoice_items VALUES("5","5","6","Testing of the match","10.00","300.00","4.00","","","","","3235.97","","2022-03-26 09:38:06","2022-03-26 09:38:06");
INSERT INTO invoice_items VALUES("6","5","5","Welcome to the matching","5.00","30.00","2.00","","","","","174.65","","2022-03-26 09:38:06","2022-03-26 09:38:06");
INSERT INTO invoice_items VALUES("7","9","2","test","10.00","30.00","5.00","","","","","319.20","","2022-03-26 12:15:31","2022-03-26 12:15:31");
INSERT INTO invoice_items VALUES("8","9","6","Filter oth ematch","5.00","100.00","3.00","","","","","544.95","","2022-03-26 12:15:31","2022-03-26 12:15:31");
INSERT INTO invoice_items VALUES("9","10","1","Testing","2.00","30.00","1.00","9.00","9.00","0.00","","70.57","","2022-04-06 02:56:50","2022-04-06 02:56:50");
INSERT INTO invoice_items VALUES("10","10","3","Kimmitest","1.00","15.00","2.00","7.00","7.00","0.00","","16.83","","2022-04-06 02:56:50","2022-04-06 02:56:50");
INSERT INTO invoice_items VALUES("11","11","2","","1.00","100.00","0.00","10.00","10.00","0.00","","120.00","","2022-04-06 03:50:00","2022-04-06 03:50:00");
INSERT INTO invoice_items VALUES("12","11","4","testei","10.00","50.00","1.00","7.00","7.00","0.00","","570.00","","2022-04-06 03:50:00","2022-04-06 03:50:00");
INSERT INTO invoice_items VALUES("13","12","5","testing","5.00","50.00","3.00","9.00","9.00","0.00","","287.50","","2022-04-06 16:52:36","2022-04-06 16:52:36");
INSERT INTO invoice_items VALUES("14","12","2","Testing","10.00","100.00","1.00","7.00","7.00","0.00","","1130.00","","2022-04-06 16:52:37","2022-04-06 16:52:37");



CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `deal_id` bigint(20) unsigned NOT NULL COMMENT 'from deals',
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `due_days` int(11) DEFAULT NULL,
  `customer_id` bigint(20) unsigned NOT NULL COMMENT 'from customers',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `tax_included` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `discount` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-pending,1-approved',
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `pending_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from users',
  `rejected_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from users',
  `reject_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_deal_id_foreign` (`deal_id`),
  KEY `invoices_customer_id_foreign` (`customer_id`),
  KEY `invoices_added_by_foreign` (`added_by`),
  KEY `invoices_updated_by_foreign` (`updated_by`),
  KEY `invoices_approved_by_foreign` (`approved_by`),
  KEY `invoices_rejected_by_foreign` (`rejected_by`),
  CONSTRAINT `invoices_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `invoices_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `invoices_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `invoices_rejected_by_foreign` FOREIGN KEY (`rejected_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO invoices VALUES("1","1","INV/2022/0001","2022-03-13","2022-04-08","","2","chennai of the center, second street, near cmbt","test2@yopmail.com","","","","no","","175.00","0","2022-03-13 11:13:44","","2022-03-13 11:13:31","","","","2","","","2022-03-13 10:44:14","2022-03-13 11:13:44");
INSERT INTO invoices VALUES("2","2","INV/2022/0002","2022-03-14","2022-03-23","","4","test","customer@yopmail.com","","","","no","","55.00","0","","","","","","","1","","2022-03-14 16:44:23","2022-03-14 16:44:09","2022-03-14 16:44:23");
INSERT INTO invoices VALUES("3","2","INV/2022/0002","2022-03-14","2022-03-23","","4","Duria testing address","customer@yopmail.com","","","","no","","410.00","0","","","2022-03-15 02:46:31","","","","1","","2022-03-26 12:22:42","2022-03-15 02:09:48","2022-03-26 12:22:42");
INSERT INTO invoices VALUES("4","3","INV/2022/0003","2022-03-21","2022-03-24","","7","Testing of the address","devops@yopmail.com","","","","no","","563.40","0","","","","","","","1","","2022-04-06 03:38:38","2022-03-26 08:01:42","2022-04-06 03:38:38");
INSERT INTO invoices VALUES("5","3","INV/2022/0004","2022-03-21","2022-03-24","","7","address of the matching","devops@yopmail.com","","","","no","","3410.62","0","","","","","","","1","","2022-04-06 03:38:31","2022-03-26 09:38:06","2022-04-06 03:38:31");
INSERT INTO invoices VALUES("6","2","INV/2022/0005","2022-03-14","2022-03-23","","4","Filter oth the match","customer@yopmail.com","","","","no","","108.62","0","","","","","","","1","","2022-03-26 12:22:25","2022-03-26 12:11:03","2022-03-26 12:22:25");
INSERT INTO invoices VALUES("7","2","INV/2022/0006","2022-03-14","2022-03-23","","4","Welcoem toht teh matchens","customer@yopmail.com","","","","no","","864.15","0","","","","","","","1","","2022-03-26 12:22:32","2022-03-26 12:13:10","2022-03-26 12:22:32");
INSERT INTO invoices VALUES("8","2","INV/2022/0006","2022-03-14","2022-03-23","","4","Welcoem toht teh matchens","customer@yopmail.com","","","","no","","864.15","0","","","","","","","1","","2022-03-26 12:17:44","2022-03-26 12:14:38","2022-03-26 12:17:44");
INSERT INTO invoices VALUES("9","2","INV/2022/0006","2022-03-14","2022-03-23","","4","Welcoem toht teh matchens","customer@yopmail.com","","","","no","","864.15","0","2022-03-27 05:32:05","","2022-03-27 05:31:50","","","","1","","","2022-03-26 12:15:31","2022-03-27 05:32:05");
INSERT INTO invoices VALUES("10","2","INV/2022/0007","2022-03-14","2022-04-28","","4","Bo: f7899, Main street, album street, chennai - 600052","customer@yopmail.com","","","","no","","87.40","0","","","","","","","1","","","2022-04-06 02:56:49","2022-04-06 02:56:49");
INSERT INTO invoices VALUES("11","3","INV/2022/0008","2022-03-21","2022-05-05","","7","Box:9009, Veiltset coik stree, near park statuin, check with the time.","devops@yopmail.com","","","","no","","1065.00","0","","","","","","","1","","","2022-04-06 03:50:00","2022-04-06 03:50:00");
INSERT INTO invoices VALUES("12","3","INV/2022/0009","2022-03-21","2022-04-10","","7","Bpo:no:12, Second date Number, Post Mask, India","devops@yopmail.com","","","","no","","1417.50","0","","","","","","","1","","","2022-04-06 16:52:36","2022-04-06 16:52:36");



CREATE TABLE `landing_page_banner_sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO landing_page_banner_sliders VALUES("1","1","Responsive Theme Perfect for Downloding Your App!","Incredible","LandingPages/Banners/bg-2.jpg","Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.","","","");
INSERT INTO landing_page_banner_sliders VALUES("2","1","Responsive Theme Perfect for Downloding OUR CRM!","Incredible","LandingPages/Banners/bg.jpg","Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus.","","","");



CREATE TABLE `landing_page_features` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `icon` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `landing_page_form_inputs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `input_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_required` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO landing_page_form_inputs VALUES("1","1","fullname","1","","");
INSERT INTO landing_page_form_inputs VALUES("2","1","email","1","","");
INSERT INTO landing_page_form_inputs VALUES("3","1","mobile_no","1","","");
INSERT INTO landing_page_form_inputs VALUES("4","1","subject","0","","");
INSERT INTO landing_page_form_inputs VALUES("5","1","message","0","","");



CREATE TABLE `landing_page_social_medias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO landing_page_social_medias VALUES("1","1","Instagram","#","0","","","");
INSERT INTO landing_page_social_medias VALUES("2","1","Facebook","#","0","","","");
INSERT INTO landing_page_social_medias VALUES("3","1","YouTube","#","0","","","");



CREATE TABLE `landing_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `permalink` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_us` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_us` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_us` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `other_tags` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO landing_pages VALUES("1","Lead creation Page","LandingPages/Logos/cparS00eCtCIETaWaxSOYJc1EXy4czy75Irdw5MY.png","lead-page","","info@lead.gmail.com","9874561230","N0.30/234 New Road, city - 600028","1","","","","");



CREATE TABLE `lead_sources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lead_sources_added_by_foreign` (`added_by`),
  KEY `lead_sources_company_id_foreign` (`company_id`),
  CONSTRAINT `lead_sources_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `lead_sources_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO lead_sources VALUES("1","","Internet","testing","1","1","","2022-03-13 09:45:35","2022-03-13 09:45:35");
INSERT INTO lead_sources VALUES("2","","Call","of the mateh incret","1","1","","2022-03-13 09:45:48","2022-03-13 09:46:10");
INSERT INTO lead_sources VALUES("3","","stete","","0","1","2022-03-13 09:46:30","2022-03-13 09:46:26","2022-03-13 09:46:30");
INSERT INTO lead_sources VALUES("4","","SMS","teste","1","1","","2022-03-21 16:34:56","2022-03-21 16:35:07");



CREATE TABLE `lead_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lead_types_added_by_foreign` (`added_by`),
  KEY `lead_types_company_id_foreign` (`company_id`),
  CONSTRAINT `lead_types_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `lead_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO lead_types VALUES("1","","Hot","hot","1","1","","2022-03-13 09:42:09","2022-03-13 09:42:09");
INSERT INTO lead_types VALUES("2","","Warm","description","1","1","","2022-03-13 09:42:21","2022-03-13 09:42:21");
INSERT INTO lead_types VALUES("3","","Cold","descripiot","1","1","","2022-03-13 09:42:34","2022-03-13 09:43:29");
INSERT INTO lead_types VALUES("4","","Tooo","","0","1","","2022-03-21 16:35:28","2022-03-21 16:36:24");
INSERT INTO lead_types VALUES("5","","Welth","","0","1","","2022-03-21 16:36:34","2022-03-21 16:36:41");



CREATE TABLE `leads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL COMMENT 'from customertable',
  `lead_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_value` double DEFAULT NULL,
  `lead_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_type_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from lead_types',
  `lead_source_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from lead_sources',
  `assigned_at` timestamp NULL DEFAULT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `assinged_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `visible_to` bigint(20) unsigned DEFAULT NULL COMMENT 'from roles',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-inactive,1-active, 2-done',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_customer_id_foreign` (`customer_id`),
  KEY `leads_lead_type_id_foreign` (`lead_type_id`),
  KEY `leads_lead_source_id_foreign` (`lead_source_id`),
  KEY `leads_assigned_to_foreign` (`assigned_to`),
  KEY `leads_assinged_by_foreign` (`assinged_by`),
  KEY `leads_visible_to_foreign` (`visible_to`),
  KEY `leads_added_by_foreign` (`added_by`),
  KEY `leads_updated_by_foreign` (`updated_by`),
  CONSTRAINT `leads_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `leads_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `leads_assinged_by_foreign` FOREIGN KEY (`assinged_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `leads_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `leads_lead_source_id_foreign` FOREIGN KEY (`lead_source_id`) REFERENCES `lead_sources` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `leads_lead_type_id_foreign` FOREIGN KEY (`lead_type_id`) REFERENCES `lead_types` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `leads_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `leads_visible_to_foreign` FOREIGN KEY (`visible_to`) REFERENCES `roles` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO leads VALUES("1","1","","Test","tstetet","120","","1","1","","3","1","","1","1","","","2022-03-13 09:25:23","2022-03-13 09:52:31");
INSERT INTO leads VALUES("2","2","","Innings Match","","50","","2","2","","2","1","","2","1","2","","2022-03-13 09:53:21","2022-03-13 10:38:50");
INSERT INTO leads VALUES("3","4","","Dlea title","","250","","1","1","","3","1","","2","1","1","","2022-03-14 02:52:13","2022-03-14 03:16:28");
INSERT INTO leads VALUES("4","7","","Led test title","","20","","1","2","","2","1","","1","1","","","2022-03-21 16:30:05","2022-03-29 16:48:11");



CREATE TABLE `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_company_id_foreign` (`company_id`),
  KEY `logs_added_by_foreign` (`added_by`),
  CONSTRAINT `logs_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `logs_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("3","2019_08_19_000000_create_failed_jobs_table","1");
INSERT INTO migrations VALUES("4","2019_12_14_000001_create_personal_access_tokens_table","1");
INSERT INTO migrations VALUES("5","2022_01_29_064502_create_roles_table","1");
INSERT INTO migrations VALUES("6","2022_01_29_160134_add_mobile_to_users_table","1");
INSERT INTO migrations VALUES("7","2022_01_29_162020_create_company_settings_table","1");
INSERT INTO migrations VALUES("8","2022_01_29_163109_add_company_foreignkey_to_users_table","1");
INSERT INTO migrations VALUES("9","2022_01_29_163904_create_subscriptions_table","1");
INSERT INTO migrations VALUES("10","2022_01_30_042934_add_mobile_no_to_users_table","1");
INSERT INTO migrations VALUES("11","2022_01_31_134929_create_company_subscriptions_table","1");
INSERT INTO migrations VALUES("12","2022_01_31_140052_add_subscription_id_to_company_settings","1");
INSERT INTO migrations VALUES("13","2022_01_31_163221_add_null_updted_to_subscriptions_table","1");
INSERT INTO migrations VALUES("14","2022_02_03_181046_add_status_to_company_settings_table","1");
INSERT INTO migrations VALUES("15","2022_02_06_041646_create_page_type_table","1");
INSERT INTO migrations VALUES("16","2022_02_06_042110_create_lead_type_table","1");
INSERT INTO migrations VALUES("17","2022_02_06_042130_create_lead_source_table","1");
INSERT INTO migrations VALUES("18","2022_02_06_042255_create_deal_stages_table","1");
INSERT INTO migrations VALUES("19","2022_02_06_042308_create_county_table","1");
INSERT INTO migrations VALUES("20","2022_02_06_042330_create_organization_table","1");
INSERT INTO migrations VALUES("21","2022_02_06_042424_create_role_menu_table","1");
INSERT INTO migrations VALUES("22","2022_02_06_042443_create_team_table","1");
INSERT INTO migrations VALUES("23","2022_02_06_042531_create_cms_table","1");
INSERT INTO migrations VALUES("24","2022_02_06_121831_add_company_id_to_organizations_table","1");
INSERT INTO migrations VALUES("25","2022_02_06_122509_add_company_id_to_teams_table","1");
INSERT INTO migrations VALUES("26","2022_02_06_122831_add_company_id_to_deal_stages_table","1");
INSERT INTO migrations VALUES("27","2022_02_06_122905_add_company_id_to_lead_sources_table","1");
INSERT INTO migrations VALUES("28","2022_02_06_122923_add_company_id_to_lead_types_table","1");
INSERT INTO migrations VALUES("29","2022_02_06_123025_add_company_id_to_cms_table","1");
INSERT INTO migrations VALUES("30","2022_02_06_123214_add_company_id_to_roles_table","1");
INSERT INTO migrations VALUES("31","2022_02_06_123231_add_company_id_to_page_types_table","1");
INSERT INTO migrations VALUES("32","2022_02_06_125045_add_company_id_to_role_menus_table","1");
INSERT INTO migrations VALUES("33","2022_02_06_125412_create_custom_forms_table","1");
INSERT INTO migrations VALUES("34","2022_02_06_125434_create_user_permissions_table","1");
INSERT INTO migrations VALUES("35","2022_02_06_125454_create_logs_table","1");
INSERT INTO migrations VALUES("36","2022_02_06_132119_create_customers_table","1");
INSERT INTO migrations VALUES("37","2022_02_06_132150_create_products_table","1");
INSERT INTO migrations VALUES("38","2022_02_07_015908_create_customer_mobile_table","1");
INSERT INTO migrations VALUES("39","2022_02_07_015919_create_custor_email_table","1");
INSERT INTO migrations VALUES("40","2022_02_07_020236_create_contact_type_table","1");
INSERT INTO migrations VALUES("41","2022_02_08_033641_add_address_null_to_organizations_table","1");
INSERT INTO migrations VALUES("42","2022_02_08_034045_add_status_to_organizations_table","1");
INSERT INTO migrations VALUES("43","2022_02_10_162444_add_copyrights_to_company_settings_table","1");
INSERT INTO migrations VALUES("44","2022_02_12_045834_create_audits_table","1");
INSERT INTO migrations VALUES("45","2022_02_12_071912_add_status_to_users_table","1");
INSERT INTO migrations VALUES("46","2022_02_12_085430_add_email_to_company_settings","1");
INSERT INTO migrations VALUES("47","2022_02_12_140743_create_tasks_to_table","1");
INSERT INTO migrations VALUES("48","2022_02_14_065226_create_leads_table","1");
INSERT INTO migrations VALUES("49","2022_02_15_164411_create_activities_table","1");
INSERT INTO migrations VALUES("50","2022_02_19_140939_create_landing_pages_table","1");
INSERT INTO migrations VALUES("51","2022_02_19_152611_create_landing_page_social_medias_table","1");
INSERT INTO migrations VALUES("52","2022_02_19_190852_create_landing_page_banner_sliders_table","1");
INSERT INTO migrations VALUES("53","2022_02_20_022601_create_notes_table","1");
INSERT INTO migrations VALUES("54","2022_02_20_122058_add_foriengkey_to_customers","1");
INSERT INTO migrations VALUES("55","2022_02_21_030046_add_order_to_deal_stages","1");
INSERT INTO migrations VALUES("56","2022_02_21_165049_create_prefix_settings_table","1");
INSERT INTO migrations VALUES("57","2022_02_21_171212_add_customer_id_to_customers","1");
INSERT INTO migrations VALUES("58","2022_02_21_171657_add_customer_id_to_custor_email","1");
INSERT INTO migrations VALUES("59","2022_02_22_022328_add_lead_limit_to_users","1");
INSERT INTO migrations VALUES("60","2022_02_22_173144_create_role_permissions_table","1");
INSERT INTO migrations VALUES("61","2022_02_24_025021_create_role_permission_menu_table","1");
INSERT INTO migrations VALUES("62","2022_02_28_044357_add_is_export_to_role_permission_menu","1");
INSERT INTO migrations VALUES("63","2022_02_28_062020_create_deals_table","1");
INSERT INTO migrations VALUES("64","2022_02_28_062607_create_deal_products_table","1");
INSERT INTO migrations VALUES("65","2022_02_28_073819_add_deal_id_to_notes","1");
INSERT INTO migrations VALUES("66","2022_02_28_073833_add_deal_id_to_activities","1");
INSERT INTO migrations VALUES("67","2022_02_28_095054_create_deal_piplines_table","1");
INSERT INTO migrations VALUES("68","2022_03_01_165211_create_deal_documents_table","1");
INSERT INTO migrations VALUES("69","2022_03_07_080638_add_won_at_to_deals","1");
INSERT INTO migrations VALUES("70","2022_03_07_131856_create_invoices_table","1");
INSERT INTO migrations VALUES("71","2022_03_07_132021_create_invoice_items_table","1");
INSERT INTO migrations VALUES("72","2022_03_09_015048_create_landing_page_form_inputs_table","1");
INSERT INTO migrations VALUES("73","2022_03_12_064258_add_rejected_at_to_invoices","1");
INSERT INTO migrations VALUES("74","2022_03_15_022412_add_mail_encryption_to_company_settings","2");
INSERT INTO migrations VALUES("75","2022_03_19_083516_create_landing_page_features_table","3");
INSERT INTO migrations VALUES("76","2022_03_21_160613_add_hsn_no_to_products","4");
INSERT INTO migrations VALUES("77","2022_03_22_164539_create_tax_groups_table","5");
INSERT INTO migrations VALUES("78","2022_03_22_165304_create_taxes_table","6");
INSERT INTO migrations VALUES("79","2022_03_22_170024_add_tax_id_to_invoice_items","7");
INSERT INTO migrations VALUES("80","2022_03_22_170540_add_with_tax_to_invoices","8");
INSERT INTO migrations VALUES("81","2022_03_23_021840_add_terms_to_company_settings","9");
INSERT INTO migrations VALUES("84","2022_03_24_024021_add_gst_to_products","10");
INSERT INTO migrations VALUES("85","2022_03_26_074121_add_taxes_to_invoice_items","11");
INSERT INTO migrations VALUES("86","2022_03_27_054736_add_currency_to_invoices","11");
INSERT INTO migrations VALUES("87","2022_03_27_073216_create_email_templates_table","12");
INSERT INTO migrations VALUES("88","2022_03_27_110933_add_paid_to_users_table","12");
INSERT INTO migrations VALUES("90","2022_04_03_052548_create_dashboard_orders_table","13");
INSERT INTO migrations VALUES("91","2022_04_03_130032_add_due_days_to_invoices","14");
INSERT INTO migrations VALUES("92","2022_04_07_020058_add_gstin_no_to_company_settings","15");
INSERT INTO migrations VALUES("93","2022_04_09_035531_create_announcements_table","16");
INSERT INTO migrations VALUES("95","2022_04_17_014434_create_payments_table","17");
INSERT INTO migrations VALUES("96","2022_04_16_165118_add_user_dashboard_col_table","18");
INSERT INTO migrations VALUES("97","2022_04_17_084338_create_data_base_backups_table","18");



CREATE TABLE `notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from leads',
  `deal_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from deals',
  `customer_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from leads',
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from users',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-inactive,1-active, 2-done',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_lead_id_foreign` (`lead_id`),
  KEY `notes_customer_id_foreign` (`customer_id`),
  KEY `notes_user_id_foreign` (`user_id`),
  KEY `notes_added_by_foreign` (`added_by`),
  KEY `notes_updated_by_foreign` (`updated_by`),
  KEY `notes_deal_id_foreign` (`deal_id`),
  CONSTRAINT `notes_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `notes_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `notes_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `notes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO notes VALUES("1","Direts notes","","1","2","2","1","2","","","2022-03-13 10:41:20","2022-03-13 10:41:20");
INSERT INTO notes VALUES("2","Durai testing","3","","4","1","1","1","","2022-03-14 03:08:34","2022-03-14 02:59:47","2022-03-14 03:08:34");
INSERT INTO notes VALUES("3","Testing of the match","3","","4","1","1","1","","2022-03-14 03:09:21","2022-03-14 03:08:45","2022-03-14 03:09:21");
INSERT INTO notes VALUES("4","durai tesgin in the leads","3","","4","1","1","1","","","2022-03-14 03:10:32","2022-03-14 03:10:32");
INSERT INTO notes VALUES("5","Deal testing notes","","2","4","1","1","1","","2022-03-14 03:46:35","2022-03-14 03:16:56","2022-03-14 03:46:35");
INSERT INTO notes VALUES("6","testing  in","1","","1","1","1","1","","2022-03-14 03:43:19","2022-03-14 03:43:13","2022-03-14 03:43:19");
INSERT INTO notes VALUES("7","Description of the match","1","","1","1","1","1","","2022-03-14 03:47:17","2022-03-14 03:43:47","2022-03-14 03:47:17");
INSERT INTO notes VALUES("8","Testing of the match","","2","4","1","1","1","","2022-03-14 16:35:31","2022-03-14 03:47:04","2022-03-14 16:35:31");
INSERT INTO notes VALUES("9","Dduari dateste","","2","4","1","1","1","","","2022-03-14 16:38:54","2022-03-14 16:38:54");
INSERT INTO notes VALUES("10","Durairaj testing notes of the match","1","","1","1","1","1","","","2022-03-18 17:17:48","2022-03-18 17:17:48");
INSERT INTO notes VALUES("11","Second note testing of the match is the worst player of the match oin the world","1","","1","1","1","1","","2022-03-18 17:51:02","2022-03-18 17:24:51","2022-03-18 17:51:02");
INSERT INTO notes VALUES("12","duearitestet","1","","1","1","1","1","","2022-03-21 14:12:49","2022-03-21 12:56:42","2022-03-21 14:12:49");
INSERT INTO notes VALUES("13","Durai testig note ain a deals","","2","4","1","1","1","","","2022-03-21 12:59:04","2022-03-21 12:59:04");
INSERT INTO notes VALUES("14","Wold cup at 293","","2","4","1","1","1","","2022-03-21 13:15:43","2022-03-21 12:59:38","2022-03-21 13:15:43");
INSERT INTO notes VALUES("15","Durair tsting notes","","2","4","1","1","1","","","2022-03-21 14:12:09","2022-03-21 14:12:09");
INSERT INTO notes VALUES("16","Duair tesitng","1","","","3","1","1","1","","2022-03-21 14:12:41","2022-03-21 16:25:56");
INSERT INTO notes VALUES("17","test","","","","2","1","1","","","2022-03-21 16:23:31","2022-03-21 16:23:31");
INSERT INTO notes VALUES("18","duriar tal","4","","7","1","1","1","","","2022-03-21 16:30:30","2022-03-21 16:30:30");
INSERT INTO notes VALUES("19","online rewoarek comping of the table onth int he","","3","7","1","1","1","","","2022-03-21 16:40:32","2022-03-21 16:40:32");
INSERT INTO notes VALUES("20","This is test notes for testing","","","","2","1","1","","","2022-03-29 01:57:14","2022-03-29 02:09:11");
INSERT INTO notes VALUES("21","Durai testing ofthe match","","3","7","1","1","1","","","2022-04-13 02:50:00","2022-04-13 02:50:00");
INSERT INTO notes VALUES("22","Final testing","","3","7","1","1","1","","","2022-04-13 03:05:38","2022-04-13 03:05:38");



CREATE TABLE `organizations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-inactive,1-active',
  PRIMARY KEY (`id`),
  KEY `organizations_added_by_foreign` (`added_by`),
  KEY `organizations_company_id_foreign` (`company_id`),
  CONSTRAINT `organizations_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `organizations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO organizations VALUES("1","","Godreg","","","","","","","1","","2022-03-13 09:26:59","2022-03-13 09:26:59","1");
INSERT INTO organizations VALUES("2","","Opera","","","","","","","1","","2022-03-13 09:53:02","2022-03-13 09:53:02","1");
INSERT INTO organizations VALUES("3","","Company & Co","","","","","","","1","","2022-03-14 02:26:47","2022-03-14 02:26:47","1");
INSERT INTO organizations VALUES("4","","Bytes","","","","","","","1","","2022-03-14 02:28:37","2022-03-14 02:28:37","1");
INSERT INTO organizations VALUES("5","","DevOpes","","","","","","","1","","2022-03-21 15:57:06","2022-03-21 15:58:40","1");
INSERT INTO organizations VALUES("6","","Saravana stoers","5623145612","saravanastores@yopmail.com","Testing","","","","1","","2022-03-21 16:01:23","2022-03-21 16:01:23","1");



CREATE TABLE `page_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_types_added_by_foreign` (`added_by`),
  KEY `page_types_company_id_foreign` (`company_id`),
  CONSTRAINT `page_types_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `page_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'online, offline',
  `customer_id` bigint(20) unsigned NOT NULL COMMENT 'from customertable',
  `deal_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from dealtable',
  `amount` double NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cash, card, cheque, imps, upi',
  `cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upi_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'pending, paid, failed',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_customer_id_foreign` (`customer_id`),
  KEY `payments_deal_id_foreign` (`deal_id`),
  KEY `payments_added_by_foreign` (`added_by`),
  CONSTRAINT `payments_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `payments_deal_id_foreign` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `prefix_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from company',
  `prefix_field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prefix_settings_company_id_foreign` (`company_id`),
  CONSTRAINT `prefix_settings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO prefix_settings VALUES("1","1","Product","PD/2022/0000","1","","","");
INSERT INTO prefix_settings VALUES("2","1","Lead","LD/2022/0000","1","","","");
INSERT INTO prefix_settings VALUES("3","1","Invoice","INV/2022/0000","1","","","");



CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsn_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cgst` decimal(8,2) DEFAULT 0.00,
  `sgst` decimal(8,2) DEFAULT 0.00,
  `igst` decimal(8,2) DEFAULT 0.00,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_company_id_foreign` (`company_id`),
  KEY `products_added_by_foreign` (`added_by`),
  KEY `products_updated_by_foreign` (`updated_by`),
  CONSTRAINT `products_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `products_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","","Buzz","PD/2022/0001","4510","0.00","0.00","0.00","","","","1","1","1","","2022-03-13 10:32:00","2022-03-21 16:15:03");
INSERT INTO products VALUES("2","","Bluetooth","PD/2022/0002","7210","0.00","0.00","12.00","","","","1","1","1","","2022-03-13 10:32:12","2022-03-26 08:00:05");
INSERT INTO products VALUES("3","","Cover point","PD/2022/0003","9618","0.00","0.00","0.00","","","","1","1","1","","2022-03-13 10:32:29","2022-03-21 16:12:53");
INSERT INTO products VALUES("4","","DataTab","PD/2022/0004","9999","7.00","7.00","0.00","","test","","1","1","1","","2022-03-13 10:32:46","2022-03-26 07:59:56");
INSERT INTO products VALUES("5","","Lapton","PD/2022/0005","8945","9.00","9.00","0.00","","tste","","1","1","1","","2022-03-21 16:14:54","2022-03-26 07:59:49");
INSERT INTO products VALUES("6","","Melbour","PD/2022/0006","9505","6.00","6.00","0.00","","tstet","","1","1","1","","2022-03-24 03:00:33","2022-03-29 02:53:27");



CREATE TABLE `role_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_menus_added_by_foreign` (`added_by`),
  KEY `role_menus_company_id_foreign` (`company_id`),
  CONSTRAINT `role_menus_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `role_menus_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `role_permission_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) unsigned NOT NULL COMMENT 'from roles',
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_view` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'yes,no',
  `is_edit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'yes,no',
  `is_delete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'yes,no',
  `is_assign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'yes,no',
  `is_export` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `is_filter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permission_menu_permission_id_foreign` (`permission_id`),
  KEY `role_permission_menu_added_by_foreign` (`added_by`),
  KEY `role_permission_menu_updated_by_foreign` (`updated_by`),
  CONSTRAINT `role_permission_menu_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `role_permission_menu_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `role_permissions` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `role_permission_menu_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO role_permission_menu VALUES("244","6","dashboard","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("245","6","cms","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("246","6","notes","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("247","6","activities","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("248","6","leads","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("249","6","leadsource","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("250","6","leadstage","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("251","6","dealstages","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("252","6","deals","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("253","6","tasks","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("254","6","products","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("255","6","customers","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("256","6","users","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("257","6","invoices","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permission_menu VALUES("258","6","payments","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("259","6","activity_log","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("260","6","database_backup","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("261","6","email_template","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("262","6","reports","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("263","6","master_data","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("264","6","bulk_import","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("265","6","organizations","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:26","2022-03-29 02:47:26");
INSERT INTO role_permission_menu VALUES("266","7","dashboard","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("267","7","cms","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("268","7","notes","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("269","7","activities","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("270","7","leads","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("271","7","leadsource","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("272","7","leadstage","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("273","7","dealstages","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("274","7","deals","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permission_menu VALUES("275","7","tasks","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("276","7","products","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("277","7","customers","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("278","7","users","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("279","7","invoices","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("280","7","payments","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("281","7","activity_log","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("282","7","database_backup","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("283","7","email_template","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("284","7","reports","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("285","7","master_data","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("286","7","bulk_import","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("287","7","organizations","on","no","no","no","no","no","1","1","","","2022-03-29 02:47:41","2022-03-29 02:47:41");
INSERT INTO role_permission_menu VALUES("311","9","account","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("312","9","dashboard","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("313","9","notes","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("314","9","activities","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("315","9","leads","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("316","9","leadsource","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("317","9","leadstage","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("318","9","dealstages","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");
INSERT INTO role_permission_menu VALUES("319","9","deals","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("320","9","tasks","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("321","9","products","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("322","9","pages","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("323","9","customers","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("324","9","users","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("325","9","invoices","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("326","9","payments","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("327","9","activity_log","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("328","9","database_backup","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("329","9","email_template","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("330","9","reports","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("331","9","master_data","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("332","9","bulk_import","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");
INSERT INTO role_permission_menu VALUES("333","9","organizations","on","no","no","no","no","no","1","1","","","2022-03-29 03:06:09","2022-03-29 03:06:09");



CREATE TABLE `role_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL COMMENT 'from roles',
  `menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_added_by_foreign` (`added_by`),
  KEY `role_permissions_updated_by_foreign` (`updated_by`),
  CONSTRAINT `role_permissions_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `role_permissions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO role_permissions VALUES("6","4","","1","1","","","2022-03-29 02:47:25","2022-03-29 02:47:25");
INSERT INTO role_permissions VALUES("7","5","","1","1","","","2022-03-29 02:47:40","2022-03-29 02:47:40");
INSERT INTO role_permissions VALUES("9","1","","1","1","","","2022-03-29 03:06:08","2022-03-29 03:06:08");



CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_unique` (`role`),
  KEY `roles_added_by_foreign` (`added_by`),
  KEY `roles_company_id_foreign` (`company_id`),
  CONSTRAINT `roles_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `roles_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES("1","","Admin","admin roles","1","1","","2022-03-13 09:47:46","2022-03-13 09:47:46");
INSERT INTO roles VALUES("2","","Staff","staff of the matching","1","1","","2022-03-13 09:48:01","2022-03-13 09:48:01");
INSERT INTO roles VALUES("3","","SalesExecutive","test","1","1","","2022-03-13 09:48:28","2022-03-13 09:48:28");
INSERT INTO roles VALUES("4","","Manager","manager","1","1","","2022-03-13 09:48:44","2022-03-13 09:48:44");
INSERT INTO roles VALUES("5","","Guest","Tested","1","1","","2022-03-21 15:44:13","2022-03-21 15:44:27");



CREATE TABLE `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_clients` int(11) DEFAULT NULL,
  `no_of_employees` int(11) DEFAULT NULL,
  `no_of_leads` int(11) DEFAULT NULL,
  `no_of_deals` int(11) DEFAULT NULL,
  `no_of_pages` int(11) DEFAULT NULL,
  `no_of_email_templates` int(11) DEFAULT NULL,
  `bulk_import` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `database_backup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_automation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_bot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_integration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_added_by_foreign` (`added_by`),
  KEY `subscriptions_updated_by_foreign` (`updated_by`),
  CONSTRAINT `subscriptions_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `subscriptions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO subscriptions VALUES("1","Platinum","1-Y","20","30","20","60","80","15","on","on","","","","","","5200","1","1","","","2022-03-21 15:51:27","2022-03-21 15:51:27");
INSERT INTO subscriptions VALUES("2","Free","15-D","20","50","30","20","50","12","on","on","","","","on","","3000","1","1","1","","2022-03-21 15:52:17","2022-03-21 15:53:10");



CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-inactive,1-active, 2-done',
  `done_at` timestamp NULL DEFAULT NULL,
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_assigned_to_foreign` (`assigned_to`),
  KEY `tasks_added_by_foreign` (`added_by`),
  KEY `tasks_updated_by_foreign` (`updated_by`),
  CONSTRAINT `tasks_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `tasks_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tasks VALUES("1","Test Task","2","","","Duria tsting","1","","1","1","","2022-03-15 01:48:49","2022-03-21 16:21:07");
INSERT INTO tasks VALUES("2","Mobile update","3","","","","1","","1","","","2022-03-21 16:20:52","2022-03-21 16:20:52");
INSERT INTO tasks VALUES("3","Lead test","2","","","For testing","1","","1","","","2022-03-23 02:16:10","2022-03-23 02:16:10");
INSERT INTO tasks VALUES("4","Kept Bownloer","2","","","Be a part of this","2","","1","","","2022-03-29 02:03:42","2022-04-05 11:13:39");
INSERT INTO tasks VALUES("5","Upload file","2","","","Tsting ofht eh match","1","","1","","","2022-04-05 11:36:52","2022-04-05 11:36:52");



CREATE TABLE `tax_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tax_groups VALUES("1","GST 18%","cgst and sgst in ","1","","","");
INSERT INTO tax_groups VALUES("2","GST 24%","cgst and sgst in ","1","","","");
INSERT INTO tax_groups VALUES("3","GST 14%","cgst and sgst in ","1","","","");
INSERT INTO tax_groups VALUES("4","IGST 7%","cgst and sgst in ","1","","","");
INSERT INTO tax_groups VALUES("5","IGST 12%","cgst and sgst in ","1","","","");
INSERT INTO tax_groups VALUES("6","IGST 18%","cgst and sgst in ","1","","","");



CREATE TABLE `taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) unsigned NOT NULL COMMENT 'from tax_groups',
  `tax_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_percent` decimal(8,2) NOT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `taxes_group_id_foreign` (`group_id`),
  CONSTRAINT `taxes_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `tax_groups` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO taxes VALUES("1","1","cgst","9.00","","1","","","");
INSERT INTO taxes VALUES("2","1","sgst","9.00","","1","","","");
INSERT INTO taxes VALUES("3","2","cgst","12.00","","1","","","");
INSERT INTO taxes VALUES("4","2","sgst","12.00","","1","","","");
INSERT INTO taxes VALUES("5","3","cgst","7.00","","1","","","");
INSERT INTO taxes VALUES("6","3","sgst","7.00","","1","","","");
INSERT INTO taxes VALUES("7","4","igst","7.00","","1","","","");
INSERT INTO taxes VALUES("8","5","igst","12.00","","1","","","");
INSERT INTO taxes VALUES("9","6","igst","18.00","","1","","","");



CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `team_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_limit` int(11) NOT NULL DEFAULT 10,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_added_by_foreign` (`added_by`),
  KEY `teams_company_id_foreign` (`company_id`),
  CONSTRAINT `teams_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `teams_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO teams VALUES("1","","Sunday","10","Testign user","1","1","","2022-03-21 15:46:54","2022-03-21 15:46:54");



CREATE TABLE `user_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `role_id` bigint(20) unsigned NOT NULL COMMENT 'from roles',
  `role_menu_id` bigint(20) unsigned NOT NULL COMMENT 'from role menus',
  `is_view` int(11) NOT NULL DEFAULT 0 COMMENT '0-no, 1-yes',
  `is_edit` int(11) NOT NULL DEFAULT 0 COMMENT '0-no, 1-yes',
  `is_delete` int(11) NOT NULL DEFAULT 0 COMMENT '0-no, 1-yes',
  `is_export` int(11) NOT NULL DEFAULT 0 COMMENT '0-no, 1-yes',
  `is_print` int(11) NOT NULL DEFAULT 0 COMMENT '0-no, 1-yes',
  `status` int(11) NOT NULL COMMENT '0-inactive,1-active',
  `added_by` bigint(20) unsigned NOT NULL COMMENT 'from usertable',
  `updated_by` bigint(20) unsigned DEFAULT NULL COMMENT 'from usertable',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_permissions_company_id_foreign` (`company_id`),
  KEY `user_permissions_role_id_foreign` (`role_id`),
  KEY `user_permissions_role_menu_id_foreign` (`role_menu_id`),
  KEY `user_permissions_added_by_foreign` (`added_by`),
  KEY `user_permissions_updated_by_foreign` (`updated_by`),
  CONSTRAINT `user_permissions_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `user_permissions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `user_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `user_permissions_role_menu_id_foreign` FOREIGN KEY (`role_menu_id`) REFERENCES `role_menus` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `user_permissions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from companysettings',
  `role_id` bigint(20) unsigned DEFAULT NULL COMMENT 'from rolestable',
  `lead_limit` int(11) DEFAULT NULL,
  `deal_limit` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0-inactive,1-active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#00BFFF',
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#002269',
  `sorting_order` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_no_unique` (`mobile_no`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_company_id_foreign` (`company_id`),
  CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company_settings` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","Alexia","","admin@yopmail.com","","$2y$10$nsoAnGvRNvuAOSo.W1/aKOqq5fwmFx7iRmg0/oGJ1/j9Pusr2iNSq","","","1","","","","1","","","","","","#00BFFF","#002269","");
INSERT INTO users VALUES("2","Durai","raj","durai@yopmail.com","","$2y$10$Z7yLXiWI2d/vIHc5OBFXbeSUBRmJvm5IGE5C3u.CaBp/3B50eSF2O","9551202020","","","1","30","30","1","","2022-03-13 09:49:36","2022-03-13 09:49:36","","","#00BFFF","#002269","");
INSERT INTO users VALUES("3","Kumar","ks","kumar@yopmail.com","","$2y$10$YZgjgMstKu8yIdFDErdG7eJuuouxkWBy2eCMOiO8lyX4ql/G1KHOK","9551456123","","","3","1","1","0","","2022-03-13 09:50:23","2022-03-21 15:41:30","","","#00BFFF","#002269","");
INSERT INTO users VALUES("4","Agav","kr","agav@yopmail.com","","$2y$10$uy/eUjBbzlPHDJqFIUPUiO2l5WVjwiYX0nmA2COxKdLaZ/HT1GUDu","9551706025","","","1","20","20","1","","2022-03-21 15:42:49","2022-03-21 15:42:49","","","#00BFFF","#002269","");

