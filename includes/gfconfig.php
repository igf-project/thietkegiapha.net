<?php
//defined('ISHOME') or die('Can not acess this page, please come back!');
// define path to dirs
define('ROOTHOST','http://'.$_SERVER['HTTP_HOST'].'/thietkegiapha.net/');
define('ROOTHOST_ADMIN','http://'.$_SERVER['HTTP_HOST'].'/thietkegiapha.net/admincp/');
define('BASEVIRTUAL0',ROOTHOST.'images/');
define('ROOT_PATH',''); 
define('TEM_PATH',ROOT_PATH.'templates/');
define('COM_PATH',ROOT_PATH.'components/');
define('MOD_PATH',ROOT_PATH.'modules/');
define('INC_PATH',ROOT_PATH.'includes/');
define('LAG_PATH',ROOT_PATH.'languages/');
define('EXT_PATH',ROOT_PATH.'extensions/');
define('EDI_PATH',EXT_PATH.'editor/');
define('DOC_PATH',ROOT_PATH.'documents/');
define('DAT_PATH',ROOT_PATH.'databases/');
define('IMG_PATH',ROOT_PATH.'images/');
define('MED_PATH',ROOT_PATH.'media/');
define('LIB_PATH',ROOT_PATH.'libs/');
define('JSC_PATH',ROOT_PATH.'js/');
define('LOG_PATH',ROOT_PATH.'logs/');

define('MAX_ROWS','50');
define('MAX_ROWS_NEWS','12');
define('MAX_ROWS_GALLERY','18');
define('MAX_ITEM','20'); // số bản ghi trên 1 trang
define('TIMEOUT_LOGIN','60');
define('URL_REWRITE','1');
define('MAX_ROWS_INDEX',40);

define('THUMB_WIDTH',285);
define('THUMB_HEIGHT',285);
define('PATH_THUMB','uploads/thumb/');/* ding nghia url upload*/
define('PATH_GALLERY','uploads/gallery/');/* ding nghia url upload*/
define('PATH_FILE','uploads/file/');/* ding nghia url upload file*/
define('THUMB_DEFAULT','images/no_image.jpg');/* ding nghia ảnh mặc định khi khong load được ảnh*/
define('THUMB_DEFAULT_NEWS','images/no_image.jpg');/* ding nghia ảnh mặc định khi khong load được ảnh*/
define('AVATAR_DEFAULT','images/avatar_default.png');/* ding nghia ảnh mặc định khi khong load được ảnh*/
define('THUMB_MAP','images/map.png');
$LANG_CODE='vi';

define('SMTP_SERVER','smtp.gmail.com');
define('SMTP_PORT','465');
define('SMTP_USER','xuanhuan2812@gmail.com');
define('SMTP_PASS','xuanhuantb');
define('SMTP_MAIL','xuanhuan2812@gmail.com');
// define('IGF_LICENSE','77667050813dd94a49756d59de5cea88');

define('SHOP_CODE','TD');//hàng tiêu dùng
define('SITE_NAME','seogoogle.com');
define('SITE_TITLE','');
define('SITE_DESC','');
define('SITE_KEY','');
define('COM_NAME','Copyright &copy; by Web DXPRO');
define('COM_CONTACT','');
// define('ARR_LOCATION','Cơ sở 1 - 58, Đường 19/5, Văn Quán, Hà Đông, Hà Nội;Cơ sở 2 - Số 8, Chùa Bộc, Đống Đa, Hà Nội; Cơ sở 3 - 51 Đại Cồ Việt ');
?>