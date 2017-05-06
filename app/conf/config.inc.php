<?php
/*auth app username&password */
define("USERNAME","kasia");
define("PASSWORD","password");

/* HTTP status codes 2xx */
define ( "HTTPSTATUS_OK", 200 );
define ( "HTTPSTATUS_CREATED", 201 );
define ( "HTTPSTATUS_NOCONTENT", 204 );

/* HTTP status codes 3xx (with slim the output is not produced i.e. echo statements are not processed) */
define ( "HTTPSTATUS_NOTMODIFIED", 304 );

/* HTTP status codes 4xx */
define ( "HTTPSTATUS_BADREQUEST", 400 );
define ( "HTTPSTATUS_UNAUTHORIZED", 401 );
define ( "HTTPSTATUS_FORBIDDEN", 403 );
define ( "HTTPSTATUS_NOTFOUND", 404 );
define ( "HTTPSTATUS_REQUESTTIMEOUT", 408 );
define ( "HTTPSTATUS_TOKENREQUIRED", 499 );

/* HTTP status codes 5xx */
define ( "HTTPSTATUS_INTSERVERERR", 500 );


define ("DB_HOST", "localhost");
define ("DB_USERNAME", "root");
define ("DB_PASSWORD", "");
define ("DB_NAME", "cl_classroom_waa");
define ("DB_CHARSET", "utf8");
define ("DB_DEBUGMODE", "false");
define ("DB_VENDOR", "mysql");
define ("ACTION-RETRIEVE_USERS", 1);

?>