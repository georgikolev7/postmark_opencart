# Postmark PHP integration for Opencart 2.1.0.2 (without Composer)
Postmark PHP integration for Opencart 2.1.0.2

This is a integration of Postmark Official PHP Library for OpenCart 2.1.0.2, that can be use without <a href="https://getcomposer.org/">Composer</a>

<strong>How to install</strong>

1. Open your config.php and add define('POSTMARK_SERVER_API', your-postmark-server-api);
2. Upload <strong>vendors</strong> folder to OpenCart main directory (nothing will be replaced).
3. Make a backup of your mail.php file inside <strong>system/library/</strong> directory.
4. Upload the modified mail.php file to <strong>system/library/</strong>
5. Open your .htaccess file and add a new line "AddHandler application/x-httpd-php55 .php"
