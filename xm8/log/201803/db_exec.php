<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_forumlist','{     \"1\": {         \"fid\": \"1\",         \"name\": \"传记\",         \"rank\": \"0\",         \"threads\": \"10\",         \"todayposts\": \"0\",         \"todaythreads\": \"0\",         \"brief\": \"默认版块介绍\",         \"announcement\": \"\",         \"accesson\": \"0\",         \"orderby\": \"0\",         \"create_date\": \"0\",         \"icon\": \"1516010029\",         \"moduids\": \"\",         \"seo_title\": \"\",         \"seo_keywords\": \"\",         \"digests\": \"0\",         \"create_date_fmt\": \"1970-1-1\",         \"icon_url\": \"upload/forum/1.png\",         \"accesslist\": [],         \"modlist\": []     } }','1520214678')
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_cron_lock_1','1','1520214628')
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	DELETE FROM ci_sys_session  WHERE `last_date`<1520211018 
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	DELETE FROM ci_sys_session_data  WHERE `last_date`<1520211018 
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_cron_lock_1' 
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_cron_lock_2','1','1520214628')
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	UPDATE ci_sys_forum SET `todayposts`='0',`todaythreads`='0'  WHERE `fid`=1 
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_forumlist' 
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	DELETE FROM ci_sys_queue  WHERE `expiry`<1520214618 
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	REPLACE INTO ci_sys_table_day (`year`,`month`,`day`,`create_date`,`table`,`maxid`,`count`) VALUES ('2018','3','5','1520185818','thread','134','10')
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	REPLACE INTO ci_sys_table_day (`year`,`month`,`day`,`create_date`,`table`,`maxid`,`count`) VALUES ('2018','3','5','1520185818','post','195','19')
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	REPLACE INTO ci_sys_table_day (`year`,`month`,`day`,`create_date`,`table`,`maxid`,`count`) VALUES ('2018','3','5','1520185818','user','7','7')
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_cron_lock_2' 
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:50:18	127.0.0.1	/SVN/xm8/?thread-4.htm	2	UPDATE ci_sys_session SET `uid`='2',`fid`='',`url`='?thread-4.htm',`last_date`='1520214618',`data`='',`ip`='2130706433',`useragent`='Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36',`bigdata`='0'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-05 09:50:23	127.0.0.1	/SVN/xm8/	0	INSERT INTO ci_sys_session (`sid`,`uid`,`fid`,`url`,`last_date`,`data`,`ip`,`useragent`,`bigdata`) VALUES ('kqprst20du6pacp0sn6khenpr4','0','0','','1520214623','','2130706433','Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.96 Safari/537.36','0')
<?php exit;?>	2018-03-05 09:50:23	127.0.0.1	/SVN/xm8/	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_forumlist','{     \"1\": {         \"fid\": \"1\",         \"name\": \"传记\",         \"rank\": \"0\",         \"threads\": \"10\",         \"todayposts\": \"0\",         \"todaythreads\": \"0\",         \"brief\": \"默认版块介绍\",         \"announcement\": \"\",         \"accesson\": \"0\",         \"orderby\": \"0\",         \"create_date\": \"0\",         \"icon\": \"1516010029\",         \"moduids\": \"\",         \"seo_title\": \"\",         \"seo_keywords\": \"\",         \"digests\": \"0\",         \"create_date_fmt\": \"1970-1-1\",         \"icon_url\": \"upload/forum/1.png\",         \"accesslist\": [],         \"modlist\": []     } }','1520214683')
<?php exit;?>	2018-03-05 09:50:23	127.0.0.1	/SVN/xm8/	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:50:23	127.0.0.1	/SVN/xm8/	2	UPDATE ci_sys_session SET `uid`='2'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-05 09:50:38	127.0.0.1	/SVN/xm8/	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:50:38	127.0.0.1	/SVN/xm8/	2	UPDATE ci_sys_session SET `last_date`='1520214638'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-05 09:50:41	127.0.0.1	/SVN/xm8/	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:50:41	127.0.0.1	/SVN/xm8/	2	UPDATE ci_sys_session SET `last_date`='1520214641'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-05 09:50:46	127.0.0.1	/SVN/xm8/	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:50:46	127.0.0.1	/SVN/xm8/	2	UPDATE ci_sys_session SET `last_date`='1520214646'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-05 09:50:47	127.0.0.1	/SVN/xm8/?thread-134.htm	2	UPDATE LOW_PRIORITY `ci_sys_thread` SET views=views+1 WHERE tid='134'
<?php exit;?>	2018-03-05 09:50:47	127.0.0.1	/SVN/xm8/?thread-134.htm	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:50:47	127.0.0.1	/SVN/xm8/?thread-134.htm	2	UPDATE ci_sys_session SET `fid`='1',`url`='?thread-134.htm',`last_date`='1520214647'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-05 09:51:05	127.0.0.1	/SVN/xm8/	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:51:05	127.0.0.1	/SVN/xm8/	2	UPDATE ci_sys_session SET `fid`='0',`url`='',`last_date`='1520214665'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-05 09:51:07	127.0.0.1	/SVN/xm8/?thread-129.htm	2	UPDATE LOW_PRIORITY `ci_sys_thread` SET views=views+1 WHERE tid='129'
<?php exit;?>	2018-03-05 09:51:07	127.0.0.1	/SVN/xm8/?thread-129.htm	2	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1520214618,     \"cron_2_last_date\": 1520179200,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-05 09:51:07	127.0.0.1	/SVN/xm8/?thread-129.htm	2	UPDATE ci_sys_session SET `fid`='1',`url`='?thread-129.htm',`last_date`='1520214667'  WHERE `sid`='kqprst20du6pacp0sn6khenpr4' 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_forumlist' 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_forumlist','{     \"1\": {         \"fid\": \"1\",         \"name\": \"传记\",         \"rank\": \"0\",         \"threads\": \"10\",         \"todayposts\": \"0\",         \"todaythreads\": \"0\",         \"brief\": \"默认版块介绍\",         \"announcement\": \"\",         \"accesson\": \"0\",         \"orderby\": \"0\",         \"create_date\": \"0\",         \"icon\": \"1516010029\",         \"moduids\": \"\",         \"seo_title\": \"\",         \"seo_keywords\": \"\",         \"digests\": \"0\",         \"create_date_fmt\": \"1970-1-1\",         \"icon_url\": \"upload/forum/1.png\",         \"accesslist\": [],         \"modlist\": []     } }','1522120168')
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_cron_lock_1','1','1522120118')
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_session  WHERE `last_date`<1522116507 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_session_data  WHERE `last_date`<1522116507 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_cron_lock_1' 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_cron_lock_2','1','1522120118')
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	UPDATE ci_sys_forum SET `todayposts`='0',`todaythreads`='0'  WHERE `fid`=1 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_forumlist' 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_queue  WHERE `expiry`<1522120107 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_table_day (`year`,`month`,`day`,`create_date`,`table`,`maxid`,`count`) VALUES ('2018','3','27','1522091307','thread','134','10')
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_table_day (`year`,`month`,`day`,`create_date`,`table`,`maxid`,`count`) VALUES ('2018','3','27','1522091307','post','195','19')
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_table_day (`year`,`month`,`day`,`create_date`,`table`,`maxid`,`count`) VALUES ('2018','3','27','1522091307','user','7','7')
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_cron_lock_2' 
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522120107,     \"cron_2_last_date\": 1522080000,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-27 11:08:28	127.0.0.1	/svn/xm8/	1	UPDATE ci_sys_session SET `uid`='1',`fid`='0',`url`='',`last_date`='1522120107',`data`='',`ip`='2130706433',`useragent`='Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',`bigdata`='0'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 11:08:30	127.0.0.1	/svn/xm8/?thread-134.htm	0	INSERT INTO ci_sys_session (`sid`,`uid`,`fid`,`url`,`last_date`,`data`,`ip`,`useragent`,`bigdata`) VALUES ('4vvu8jljggt3g8srsnhv9pem61','0','0','?thread-134.htm','1522120110','','2130706433','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36','0')
<?php exit;?>	2018-03-27 11:08:30	127.0.0.1	/svn/xm8/?thread-134.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_forumlist','{     \"1\": {         \"fid\": \"1\",         \"name\": \"传记\",         \"rank\": \"0\",         \"threads\": \"10\",         \"todayposts\": \"0\",         \"todaythreads\": \"0\",         \"brief\": \"默认版块介绍\",         \"announcement\": \"\",         \"accesson\": \"0\",         \"orderby\": \"0\",         \"create_date\": \"0\",         \"icon\": \"1516010029\",         \"moduids\": \"\",         \"seo_title\": \"\",         \"seo_keywords\": \"\",         \"digests\": \"0\",         \"create_date_fmt\": \"1970-1-1\",         \"icon_url\": \"upload/forum/1.png\",         \"accesslist\": [],         \"modlist\": []     } }','1522120170')
<?php exit;?>	2018-03-27 11:08:30	127.0.0.1	/svn/xm8/?thread-134.htm	1	UPDATE LOW_PRIORITY `ci_sys_thread` SET views=views+1 WHERE tid='134'
<?php exit;?>	2018-03-27 11:08:30	127.0.0.1	/svn/xm8/?thread-134.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522120107,     \"cron_2_last_date\": 1522080000,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-27 11:08:30	127.0.0.1	/svn/xm8/?thread-134.htm	1	UPDATE ci_sys_session SET `uid`='1',`fid`='1'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 11:08:37	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522120107,     \"cron_2_last_date\": 1522080000,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-27 11:08:37	127.0.0.1	/svn/xm8/	1	UPDATE ci_sys_session SET `fid`='0',`url`='',`last_date`='1522120117'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 11:08:43	127.0.0.1	/svn/xm8/?thread-134.htm	1	UPDATE LOW_PRIORITY `ci_sys_thread` SET views=views+1 WHERE tid='134'
<?php exit;?>	2018-03-27 11:08:43	127.0.0.1	/svn/xm8/?thread-134.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 9,     \"threads\": 10,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522120107,     \"cron_2_last_date\": 1522080000,     \"digests\": 0 }','0')
<?php exit;?>	2018-03-27 11:08:43	127.0.0.1	/svn/xm8/?thread-134.htm	1	UPDATE ci_sys_session SET `fid`='1',`url`='?thread-134.htm',`last_date`='1522120123'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_thread_digest  WHERE `tid`='134' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_user SET `digests`=digests-'1'  WHERE `uid`='1' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_forum SET `digests`=digests-'1'  WHERE `fid`='1' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_forumlist' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_post  WHERE `pid`='193' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_thread SET `posts`=posts-'1'  WHERE `tid`='134' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_user SET `posts`=posts-'1'  WHERE `uid`='1' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_post  WHERE `pid`='194' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_thread SET `posts`=posts-'1'  WHERE `tid`='134' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_user SET `posts`=posts-'1'  WHERE `uid`='1' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_attach  WHERE `aid`='33' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_post  WHERE `pid`='195' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_mythread  WHERE `uid`='1' AND `tid`='134' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	DELETE FROM ci_sys_thread  WHERE `tid`='134' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_forum SET `threads`=threads-'1'  WHERE `fid`='1' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_user SET `threads`=threads-'1'  WHERE `uid`='1' 
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 7,     \"threads\": 9,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522120107,     \"cron_2_last_date\": 1522080000,     \"digests\": -1 }','0')
<?php exit;?>	2018-03-27 11:08:47	127.0.0.1	/svn/xm8/?post-delete-193.htm	1	UPDATE ci_sys_session SET `url`='?post-delete-193.htm',`last_date`='1522120127'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 11:08:49	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_forumlist','{     \"1\": {         \"fid\": \"1\",         \"name\": \"传记\",         \"rank\": \"0\",         \"threads\": \"9\",         \"todayposts\": \"0\",         \"todaythreads\": \"0\",         \"brief\": \"默认版块介绍\",         \"announcement\": \"\",         \"accesson\": \"0\",         \"orderby\": \"0\",         \"create_date\": \"0\",         \"icon\": \"1516010029\",         \"moduids\": \"\",         \"seo_title\": \"\",         \"seo_keywords\": \"\",         \"digests\": \"0\",         \"create_date_fmt\": \"1970-1-1\",         \"icon_url\": \"upload/forum/1.png\",         \"accesslist\": [],         \"modlist\": []     } }','1522120189')
<?php exit;?>	2018-03-27 11:08:49	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 7,     \"threads\": 9,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522120107,     \"cron_2_last_date\": 1522080000,     \"digests\": -1 }','0')
<?php exit;?>	2018-03-27 11:08:49	127.0.0.1	/svn/xm8/	1	UPDATE ci_sys_session SET `fid`='0',`url`='',`last_date`='1522120129'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_forumlist' 
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_forumlist','{     \"1\": {         \"fid\": \"1\",         \"name\": \"传记\",         \"rank\": \"0\",         \"threads\": \"9\",         \"todayposts\": \"0\",         \"todaythreads\": \"0\",         \"brief\": \"默认版块介绍\",         \"announcement\": \"\",         \"accesson\": \"0\",         \"orderby\": \"0\",         \"create_date\": \"0\",         \"icon\": \"1516010029\",         \"moduids\": \"\",         \"seo_title\": \"\",         \"seo_keywords\": \"\",         \"digests\": \"0\",         \"create_date_fmt\": \"1970-1-1\",         \"icon_url\": \"upload/forum/1.png\",         \"accesslist\": [],         \"modlist\": []     } }','1522137776')
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_cron_lock_1','1','1522137726')
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_session  WHERE `last_date`<1522134116 
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_session_data  WHERE `last_date`<1522134116 
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_cron_lock_1' 
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 7,     \"threads\": 9,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522137716,     \"cron_2_last_date\": 1522080000,     \"digests\": -1 }','0')
<?php exit;?>	2018-03-27 16:01:56	127.0.0.1	/svn/xm8/	1	UPDATE ci_sys_session SET `last_date`='1522137716'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 16:01:58	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 7,     \"threads\": 9,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522137716,     \"cron_2_last_date\": 1522080000,     \"digests\": -1 }','0')
<?php exit;?>	2018-03-27 16:01:58	127.0.0.1	/svn/xm8/	1	UPDATE ci_sys_session SET `uid`='1',`fid`='0',`url`='',`last_date`='1522137718',`data`='',`ip`='2130706433',`useragent`='Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',`bigdata`='0'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 16:01:59	127.0.0.1	/svn/xm8/?forum-1.htm	0	INSERT INTO ci_sys_session (`sid`,`uid`,`fid`,`url`,`last_date`,`data`,`ip`,`useragent`,`bigdata`) VALUES ('4vvu8jljggt3g8srsnhv9pem61','0','0','?forum-1.htm','1522137719','','2130706433','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36','0')
<?php exit;?>	2018-03-27 16:01:59	127.0.0.1	/svn/xm8/?forum-1.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 7,     \"threads\": 9,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522137716,     \"cron_2_last_date\": 1522080000,     \"digests\": -1 }','0')
<?php exit;?>	2018-03-27 16:01:59	127.0.0.1	/svn/xm8/?forum-1.htm	1	UPDATE ci_sys_session SET `uid`='1',`fid`='1'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 16:02:00	127.0.0.1	/svn/xm8/	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 7,     \"threads\": 9,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522137716,     \"cron_2_last_date\": 1522080000,     \"digests\": -1 }','0')
<?php exit;?>	2018-03-27 16:02:00	127.0.0.1	/svn/xm8/	1	UPDATE ci_sys_session SET `fid`='0',`url`='',`last_date`='1522137720'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 
<?php exit;?>	2018-03-27 16:39:57	127.0.0.1	/svn/xm8/?thread-129.htm	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_forumlist' 
<?php exit;?>	2018-03-27 16:39:57	127.0.0.1	/svn/xm8/?thread-129.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_forumlist','{     \"1\": {         \"fid\": \"1\",         \"name\": \"传记\",         \"rank\": \"0\",         \"threads\": \"9\",         \"todayposts\": \"0\",         \"todaythreads\": \"0\",         \"brief\": \"默认版块介绍\",         \"announcement\": \"\",         \"accesson\": \"0\",         \"orderby\": \"0\",         \"create_date\": \"0\",         \"icon\": \"1516010029\",         \"moduids\": \"\",         \"seo_title\": \"\",         \"seo_keywords\": \"\",         \"digests\": \"0\",         \"create_date_fmt\": \"1970-1-1\",         \"icon_url\": \"upload/forum/1.png\",         \"accesslist\": [],         \"modlist\": []     } }','1522140057')
<?php exit;?>	2018-03-27 16:39:58	127.0.0.1	/svn/xm8/?thread-129.htm	1	UPDATE LOW_PRIORITY `ci_sys_thread` SET views=views+1 WHERE tid='129'
<?php exit;?>	2018-03-27 16:39:58	127.0.0.1	/svn/xm8/?thread-129.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_cron_lock_1','1','1522140008')
<?php exit;?>	2018-03-27 16:39:58	127.0.0.1	/svn/xm8/?thread-129.htm	1	DELETE FROM ci_sys_session  WHERE `last_date`<1522136397 
<?php exit;?>	2018-03-27 16:39:58	127.0.0.1	/svn/xm8/?thread-129.htm	1	DELETE FROM ci_sys_session_data  WHERE `last_date`<1522136397 
<?php exit;?>	2018-03-27 16:39:58	127.0.0.1	/svn/xm8/?thread-129.htm	1	DELETE FROM ci_sys_cache  WHERE `k`='ci_sys_cron_lock_1' 
<?php exit;?>	2018-03-27 16:39:58	127.0.0.1	/svn/xm8/?thread-129.htm	1	REPLACE INTO ci_sys_cache (`k`,`v`,`expiry`) VALUES ('ci_sys_runtime','{     \"users\": 7,     \"posts\": 7,     \"threads\": 9,     \"todayusers\": 0,     \"todayposts\": 0,     \"todaythreads\": 0,     \"onlines\": 1,     \"cron_1_last_date\": 1522139997,     \"cron_2_last_date\": 1522080000,     \"digests\": -1 }','0')
<?php exit;?>	2018-03-27 16:39:58	127.0.0.1	/svn/xm8/?thread-129.htm	1	UPDATE ci_sys_session SET `fid`='1',`url`='?thread-129.htm',`last_date`='1522139997'  WHERE `sid`='4vvu8jljggt3g8srsnhv9pem61' 