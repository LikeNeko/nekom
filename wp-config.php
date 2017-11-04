<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
//define('WP_ALLOW_REPAIR', true);
/** WordPress数据库的名称 */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/data/wwwroot/www.nekomiao.cn/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'neko');

/** MySQL数据库用户名 */
define('DB_USER', 'nekomiao');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'shibaoA1');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

// 开启https
define('FORCE_SSL_LOGIN', true);
define('FORCE_SSL_ADMIN', true);
/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'g [F+]Z?T,Ivia{uDme4ZNq!qu-ssS7o}vo@wKz?${,-2/kONxye#GI|WYo?wKj_');
define('SECURE_AUTH_KEY',  'Yex O7XF^}qg3]K#d7#W{6sa4,hO1;!kdf+ oo^m!S!rAW~{xG7WVGJ/UBs]W)3M');
define('LOGGED_IN_KEY',    '<f>ge%9O<7)>$0Q2(-kHrrfq^Bkp8pX,rx!xWMWw ?wPk>J/w>l$#G<xu`ULE~oR');
define('NONCE_KEY',        'vN{s<GXG5!_u_9QkjxZ^BK4P|yi^=P$[/<:/q%a0Qpj>D8)Fts[<7r+(OEFyTYkk');
define('AUTH_SALT',        'vJRgcN8;<[ptZ%Ny,3w?bN}0$C[6BvwLWl}Y]4D|6&^RtRypS*tN`I+qp4cxQ::1');
define('SECURE_AUTH_SALT', '2~obO4Ws>u.]Wq_?KpxYp3AZ{?^: WM@_FG$+CbZHnPa#mnTV#XvNB#er$I]As<M');
define('LOGGED_IN_SALT',   'g(+g56:;|n030=3S341wMb).E0*i]nIs.O<=K`3-sh8HLG,I*e[mS%BrliV==1Xh');
define('NONCE_SALT',       '`WZ6X{+5g6Pp/vDID5Q8QK@Jbc(Co/TDqR<od*zhB{!=Xa%hbM<&{S]@m6+80E@o');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
//ini_set('log_errors','On');
//ini_set('display_errors','On');
//ini_set('error_reporting', E_ALL );
//define('WP_DEBUG_LOG', true);
//define('WP_DEBUG_DISPLAY', true);
/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');



/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
