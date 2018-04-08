<?php
return array (
  'db' => 
  array (
    'type' => 'pdo_mysql',
    'mysql' => 
    array (
      'master' => 
      array (
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => 'root',
        'name' => 'ci',
        'tablepre' => 'ci_sys_',
        'charset' => 'utf8',
        'engine' => 'myisam',
      ),
      'slaves' => 
      array (
      ),
    ),
    'pdo_mysql' => 
    array (
      'master' => 
      array (
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => 'root',
        'name' => 'ci',
        'tablepre' => 'ci_sys_',
        'charset' => 'utf8',
        'engine' => 'myisam',
      ),
      'slaves' => 
      array (
      ),
    ),
  ),
  'cache' => 
  array (
    'enable' => true,
    'type' => 'mysql',
    'memcached' => 
    array (
      'host' => 'localhost',
      'port' => '11211',
      'cachepre' => 'ci_sys_',
    ),
    'redis' => 
    array (
      'host' => 'localhost',
      'port' => '6379',
      'cachepre' => 'ci_sys_',
    ),
    'xcache' => 
    array (
      'cachepre' => 'ci_sys_',
    ),
    'yac' => 
    array (
      'cachepre' => 'ci_sys_',
    ),
    'apc' => 
    array (
      'cachepre' => 'ci_sys_',
    ),
    'mysql' => 
    array (
      'cachepre' => 'ci_sys_',
    ),
  ),
  'tmp_path' => './tmp/',
  'log_path' => './log/',
  'view_url' => 'view/',
  'upload_url' => 'upload/',
  'upload_path' => './upload/',
  'sitename' => '传承',
  'sitebrief' => '为方便《传承ROOT》公众号用户新建传记而建设的网站，你可以在这里新建你的传记
。',
  'timezone' => 'Asia/Shanghai',
  'lang' => 'zh-cn',
  'runlevel' => 3,
  'runlevel_reason' => 'The site is under maintenance, please visit later.',
  'cookie_domain' => '',
  'cookie_path' => '',
  'auth_key' => 'mlqct2jwdxex26x4b97pw5te7bwf2q0htv8sbo74wnzmer616gvm2po1fzoj39gu',
  'pagesize' => 20,
  'postlist_pagesize' => 100,
  'cache_thread_list_pages' => 10,
  'online_update_span' => 120,
  'online_hold_time' => 3600,
  'session_delay_update' => 0,
  'upload_image_width' => 927,
  'order_default' => 'lastpid',
  'attach_dir_save_rule' => 'Ym',
  'update_views_on' => 1,
  'user_create_email_on' => 0,
  'user_resetpw_on' => 1,
  'admin_bind_ip' => 0,
  'cdn_on' => 0,
  'url_rewrite_on' => 0,
  'disabled_plugin' => 0,
  'version' => '4.0',
  'static_version' => '?1.0',
  'installed' => 1,
);
?>