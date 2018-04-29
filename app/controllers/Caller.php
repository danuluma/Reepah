<?php
namespace App;
/**
 * CurlWrapper - Flexible wrapper class for PHP cURL extension
 *
 * @author Leonid Svyatov <leonid@svyatov.ru>
 * @copyright 2010-2011, 2014 Leonid Svyatov
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 * @version 1.3.0
 * @link http://github.com/svyatov/CurlWrapper
 */
class Caller
{
    /**
     * @var resource cURL handle
     */
    protected static $ch = null;
    /**
     * @var string Filename of a writable file for cookies storage
     */
    protected static $cookieFile = '';
    /**
     * @var array Cookies to send
     */
    protected static $cookies = array();
    /**
     * @var array Headers to send
     */
    protected static $headers = array();
    /**
     * @var array cURL options
     */
    protected static $options = array();
    /**
     * @var array Predefined user agents. The 'chrome' value is used by default
     */
    protected static static $predefinedUserAgents = array(
        // IE 11
        'ie'       => 'Mozilla/5.0 (compatible; MSIE 11.0; Windows NT 6.1; WOW64; Trident/6.0)',
        // Firefox 29
        'firefox'  => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
        // Opera 20
        'opera'    => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.46 Safari/537.36 OPR/20.0.1387.24 (Edition Next)',
        // Chrome 32
        'chrome'   => 'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1667.0 Safari/537.36',
        // Google Bot
        'bot'      => 'Googlebot/2.1 (+http://www.google.com/bot.html)',
    );
    /**
     * @var array GET/POST params to send
     */
    protected static $requestParams = array();
    /**
     * @var string cURL response data
     */
    protected static $response = '';
    /**
     * @var array cURL transfer info
     */
    protected static $transferInfo = array();
    /**
     * Initiates the cURL handle
     *
     * @throws CallerCurlException
     */
    public static function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new CallerException('cURL extension is not loaded.');
        }
        self::$ch = curl_init();
        if (!self::$ch) {
            throw new CallerCurlException(self::$ch);
        }
        self::$setDefaults();
    }
    /**
     * Closes and frees the cURL handle
     */
    public static function __destruct()
    {
        if (is_resource(self::$ch)) {
            curl_close(self::$ch);
        }
        self::$ch = null;
    }
    /**
     * Adds a cookie for a cURL transfer
     *
     * Examples:
     * $curl->addCookie('user', 'admin');
     * $curl->addCookie(array('user'=>'admin', 'test'=>1));
     *
     * @param string|array $name Name of cookie or array of cookies (name=>value)
     * @param string $value Value of cookie
     */
    public static function addCookie($name, $value = null)
    {
        if (is_array($name)) {
            self::$cookies = $name + self::$cookies;
        } else {
            self::$cookies[$name] = $value;
        }
    }
    /**
     * Adds a header for a cURL transfer
     *
     * Examples:
     * $curl->addHeader('Accept-Charset', 'utf-8;q=0.7,*;q=0.7');
     * $curl->addHeader('Pragma', '');
     * $curl->addHeader(array('Accept-Charset'=>'utf-8;q=0.7,*;q=0.7', 'Pragma'=>''));
     *
     * @param string|array $header Header or array of headers (header=>value)
     * @param string $value Value of header
     */
    public static function addHeader($header, $value = null)
    {
        if (is_array($header)) {
            self::$headers = $header + self::$headers;
        } else {
            self::$headers[$header] = $value;
        }
    }
    /**
     * Adds an option for a cURL transfer (@see http://php.net/manual/en/function.curl-setopt.php)
     *
     * @param integer|array $option CURLOPT_XXX predefined constant or associative array of constants (constant=>value)
     * @param mixed $value Value of option
     */
    public static function addOption($option, $value = null)
    {
        if (is_array($option)) {
            self::$options = $option + self::$options;
        } else {
            self::$options[$option] = $value;
        }
    }
    /**
     * Adds a request (GET/POST) parameter for a cURL transfer
     *
     * Examples:
     * $curl->addRequestParam('param', 'test');
     * $curl->addRequestParam('param=test&otherparam=123');
     * $curl->addRequestParam(array('param'=>'test', 'otherparam'=>123));
     *
     * @param string|array $name Name of parameter, query string or array of parameters (name=>value)
     * @param string $value Value of parameter
     */
    public static function addRequestParam($name, $value = null)
    {
        if (is_array($name)) {
            self::$requestParams = $name + self::$requestParams;
        } elseif (is_string($name) && $value === null) {
            parse_str($name, $params);
            if (!empty($params)) {
                self::$requestParams = $params + self::$requestParams;
            }
        } else {
            self::$requestParams[$name] = $value;
        }
    }
    /**
     * Clears the cookies file
     */
    public static function clearCookieFile()
    {
        if (!is_writable(self::$cookieFile)) {
            throw new CallerException('Cookie file "'.(self::$cookieFile).'" is not writable or does\'n exists!');
        }
        file_put_contents(self::$cookieFile, '', LOCK_EX);
    }
    /**
     * Clears the cookies
     */
    public static function clearCookies()
    {
        self::$cookies = array();
    }
    /**
     * Clears the headers
     */
    public static function clearHeaders()
    {
        self::$headers = array();
    }
    /**
     * Clears the options
     */
    public static function clearOptions()
    {
        self::$options = array();
    }
    /**
     * Clears the request parameters
     */
    public static function clearRequestParams()
    {
        self::$requestParams = array();
    }
    /**
     * Makes the 'DELETE' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public static function delete($url, $requestParams = null)
    {
        return self::request($url, 'DELETE', $requestParams);
    }
    /**
     * Makes the 'GET' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public static function get($url, $requestParams = null)
    {
        return self::request($url, 'GET', $requestParams);
    }
    /**
     * Returns the last transfer's response data
     *
     * @return string
     */
    public static function getResponse()
    {
        return self::$response;
    }
    /**
     * Gets the information about the last transfer
     *
     * If $key is given, returns its value. Otherwise, returns an associative array with the following elements:
     * url                      - Last effective URL
     * content_type             - Content-Type: of downloaded object, NULL indicates server did not send valid Content-Type: header
     * http_code                - Last received HTTP code
     * header_size              - Total size of all headers received
     * request_size             - Total size of issued requests, currently only for HTTP requests
     * filetime                 - Remote time of the retrieved document, if -1 is returned the time of the document is unknown
     * ssl_verify_result        - Result of SSL certification verification requested by setting CURLOPT_SSL_VERIFYPEER
     * redirect_count           - Number of redirects it went through if CURLOPT_FOLLOWLOCATION was set
     * total_time               - Total transaction time in seconds for last transfer
     * namelookup_time          - Time in seconds until name resolving was complete
     * connect_time             - Time in seconds it took to establish the connection
     * pretransfer_time         - Time in seconds from start until just before file transfer begins
     * size_upload              - Total number of bytes uploaded
     * size_download            - Total number of bytes downloaded
     * speed_download           - Average download speed
     * speed_upload             - Average upload speed
     * download_content_length  - content-length of download, read from Content-Length:  field
     * upload_content_length    - Specified size of upload
     * starttransfer_time       - Time in seconds until the first byte is about to be transferred
     * redirect_time            - Time in seconds of all redirection steps before final transaction was started
     * certinfo                 - There is official description for this field yet
     * request_header           - The request string sent. For this to work, add the CURLINFO_HEADER_OUT option
     *
     * @param string $key @see http://php.net/manual/en/function.curl-getinfo.php
     * @throws CallerException
     * @return array|string
     */
    public static function getTransferInfo($key = null)
    {
        if (empty(self::$transferInfo)) {
            throw new CallerException('There is no transfer info. Did you do the request?');
        }
        if ($key === null) {
            return self::$transferInfo;
        }
        if (isset(self::$transferInfo[$key])) {
            return self::$transferInfo[$key];
        }
        throw new CallerException('There is no such key: '.$key);
    }
    /**
     * Makes the 'HEAD' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public static function head($url, $requestParams = null)
    {
        return self::request($url, 'HEAD', $requestParams);
    }
    /**
     * Makes the 'POST' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public static function post($url, $requestParams = null)
    {
        return self::request($url, 'POST', $requestParams);
    }
    /**
     * Makes the 'PUT' request to the $url with an optional $requestParams
     *
     * @param string $url
     * @param array $requestParams
     * @return string
     */
    public static function put($url, $requestParams = null)
    {
        return self::request($url, 'PUT', $requestParams);
    }
    /**
     * Makes the 'POST' request to the $url with raw $data
     * Use this method to send raw JSON, etc.
     *
     * @param string $url
     * @param string $data
     * @return string
     */
    public static function rawPost($url, $data)
    {
        self::$prepareRawPayload($data);
        return self::request($url, 'RAW_POST');
    }
    /**
     * Makes the 'PUT' request to the $url with raw $data
     * Use this method to send raw JSON, etc.
     *
     * @param string $url
     * @param string $data
     * @return string
     */
    public static function rawPut($url, $data)
    {
        self::$prepareRawPayload($data);
        return self::request($url, 'PUT');
    }
    /**
     * Removes the cookie for next cURL transfer
     *
     * @param string $name Name of cookie
     */
    public static function removeCookie($name)
    {
        if (isset(self::$cookies[$name])) {
            unset(self::$cookies[$name]);
        }
    }
    /**
     * Removes the header for next cURL transfer
     *
     * @param string $header
     */
    public static function removeHeader($header)
    {
        if (isset(self::$headers[$header])) {
            unset(self::$headers[$header]);
        }
    }
    /**
     * Removes the option for next cURL transfer
     *
     * @param integer $option CURLOPT_XXX predefined constant
     */
    public static function removeOption($option)
    {
        if (isset(self::$options[$option])) {
            unset(self::$options[$option]);
        }
    }
    /**
     * Removes the request parameter for next cURL transfer
     *
     * @param string $name
     */
    public static function removeRequestParam($name)
    {
        if (isset(self::$requestParams[$name])) {
            unset(self::$requestParams[$name]);
        }
    }
    /**
     * Makes the request of the specified $method to the $url with an optional $requestParams
     *
     * @param string $url
     * @param string $method
     * @param array $requestParams
     * @throws CallerCurlException
     * @return string
     */
    public static function request($url, $method = 'GET', $requestParams = null)
    {
        self::setURL($url);
        self::setRequestMethod($method);
        if (!empty($requestParams)) {
            self::addRequestParam($requestParams);
        }
        self::$initOptions();
        self::$response = curl_exec(self::$ch);
        if (self::$response === false) {
            throw new CallerCurlException(self::$ch);
        }
        self::$transferInfo = curl_getinfo(self::$ch);
        return self::$response;
    }
    /**
     * Reinitiates the cURL handle
     * IMPORTANT: headers, options, request parameters, cookies and cookies file are remain untouched!
     */
    public static function reset()
    {
        self::__destruct();
        self::$transferInfo = array();
        self::__construct();
    }
    /**
     * Reinitiates the cURL handle and resets all data
     * Including headers, options, request parameters, cookies and cookies file
     */
    public static function resetAll()
    {
        self::clearHeaders();
        self::clearOptions();
        self::clearRequestParams();
        self::clearCookies();
        self::clearCookieFile();
        self::reset();
    }
    /**
     * Sets the number of seconds to wait while trying to connect, use 0 to wait indefinitely
     *
     * @param integer $seconds
     */
    public static function setConnectTimeOut($seconds)
    {
        self::addOption(CURLOPT_CONNECTTIMEOUT, $seconds);
    }
    /**
     * Sets the filename to store cookies
     *
     * @param string $filename
     * @throws CallerException
     */
    public static function setCookieFile($filename)
    {
        if (!is_writable($filename)) {
            throw new CallerException('Cookie file "'.$filename.'" is not writable or does\'n exists!');
        }
        self::$cookieFile = $filename;
    }
    /**
     * Sets the default headers
     */
    public static function setDefaultHeaders()
    {
        self::$headers = array(
            'Accept'          => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Charset'  => 'utf-8;q=0.7,*;q=0.7',
            'Accept-Language' => 'en-US,en;q=0.8',
            'Accept-Encoding' => 'gzip,deflate',
            'Keep-Alive'      => '300',
            'Connection'      => 'keep-alive',
            'Cache-Control'   => 'max-age=0',
            'Pragma'          => ''
        );
    }
    /**
     * Sets the default options
     */
    public static function setDefaultOptions()
    {
        self::$options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_ENCODING       => 'gzip,deflate',
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 30,
        );
    }
    /**
     * Sets default headers, options and user agent if $userAgent is given
     *
     * @param string $userAgent Some predefined user agent name (ie, firefox, opera, etc.) or any string you want
     */
    public static function setDefaults($userAgent = null)
    {
        self::setDefaultHeaders();
        self::setDefaultOptions();
        if (!empty($userAgent)) {
            self::setUserAgent($userAgent);
        } else {
            self::setUserAgent('chrome');
        }
    }
    /**
     * If $value is true sets CURLOPT_FOLLOWLOCATION option to follow any "Location: " header that the server
     * sends as part of the HTTP header (note this is recursive, PHP will follow as many "Location: " headers
     * that it is sent, unless CURLOPT_MAXREDIRS option is set).
     *
     * @param boolean $value
     */
    public static function setFollowRedirects($value)
    {
        self::addOption(CURLOPT_FOLLOWLOCATION, $value);
    }
    /**
     * Sets the contents of the "Referer: " header to be used in a HTTP request
     *
     * @param string $referer
     */
    public static function setReferer($referer)
    {
        self::addOption(CURLOPT_REFERER, $referer);
    }
    /**
     * Sets the maximum number of seconds to allow cURL functions to execute
     *
     * @param integer $seconds
     */
    public static function setTimeout($seconds)
    {
        self::addOption(CURLOPT_TIMEOUT, $seconds);
    }
    /**
     * Sets the contents of the "User-Agent: " header to be used in a HTTP request
     * You can use CurlWrapper's predefined shortcuts: 'ie', 'firefox', 'opera' and 'chrome'
     *
     * @param string $userAgent
     */
    public static function setUserAgent($userAgent)
    {
        if (isset(self::$predefinedUserAgents[$userAgent])) {
            self::addOption(CURLOPT_USERAGENT, self::$predefinedUserAgents[$userAgent]);
        } else {
            self::addOption(CURLOPT_USERAGENT, $userAgent);
        }
    }
    /**
     * Sets the HTTP Authentication type.
     *
     * Defaults to CURLAUTH_BASIC.
     *
     * @param int $type
     */
    public static function setAuthType($type = CURLAUTH_BASIC) {
        self::addOption(CURLOPT_HTTPAUTH, $type);
    }
    /**
     * Sets the username and password for HTTP Authentication.
     *
     * @param string $username
     * @param string $password
     */
    public static function setAuthCredentials($username, $password) {
        self::addOption(CURLOPT_USERPWD, "$username:$password");
    }
    /**
     * Sets the value of cookieFile to empty string
     */
    public static function unsetCookieFile()
    {
        self::$cookieFile = '';
    }
    /**
     * Builds url from associative array produced by parse_str() function
     *
     * @param array $parsedUrl
     * @return string
     */
    protected static function buildUrl($parsedUrl)
    {
        return (isset($parsedUrl['scheme'])   ?     $parsedUrl["scheme"].'://' : '').
               (isset($parsedUrl['user'])     ?     $parsedUrl["user"].':'     : '').
               (isset($parsedUrl['pass'])     ?     $parsedUrl["pass"].'@'     : '').
               (isset($parsedUrl['host'])     ?     $parsedUrl["host"]         : '').
               (isset($parsedUrl['port'])     ? ':'.$parsedUrl["port"]         : '').
               (isset($parsedUrl['path'])     ?     $parsedUrl["path"]         : '').
               (isset($parsedUrl['query'])    ? '?'.$parsedUrl["query"]        : '').
               (isset($parsedUrl['fragment']) ? '#'.$parsedUrl["fragment"]     : '');
    }
    /**
     * Sets the final options and prepares request params, headers and cookies
     *
     * @throws CallerCurlException
     */
    protected static function initOptions()
    {
        if (!empty(self::$requestParams)) {
            if (isset(self::$options[CURLOPT_HTTPGET])) {
                self::prepareGetParams();
            } else {
                self::addOption(CURLOPT_POSTFIELDS, http_build_query(self::$requestParams));
            }
        }
        if (!empty(self::$headers)) {
            self::addOption(CURLOPT_HTTPHEADER, self::$prepareHeaders());
        }
        if (!empty(self::$cookieFile)) {
            self::addOption(CURLOPT_COOKIEFILE, self::$cookieFile);
            self::addOption(CURLOPT_COOKIEJAR, self::$cookieFile);
        }
        if (!empty(self::$cookies)) {
            self::addOption(CURLOPT_COOKIE, self::prepareCookies());
        }
        if (!curl_setopt_array(self::$ch, self::$options)) {
            throw new CallerCurlException(self::$ch);
        }
    }
    /**
     * Converts the cookies array to the correct string format
     *
     * @return string
     */
    protected static function prepareCookies()
    {
        $cookiesString = '';
        foreach (self::$cookies as $cookie => $value) {
            $cookiesString .= $cookie.'='.$value.'; ';
        }
        return $cookiesString;
    }
    /**
     * Converts request parameters to the query string and adds it to the request url
     */
    protected static function prepareGetParams()
    {
        $parsedUrl = parse_url(self::$options[CURLOPT_URL]);
        $query = http_build_query(self::$requestParams);
        if (isset($parsedUrl['query'])) {
            $parsedUrl['query'] .= '&'.$query;
        } else {
            $parsedUrl['query'] = $query;
        }
        self::setUrl(self::buildUrl($parsedUrl));
    }
    /**
     * Sets up options for POST/PUT request with raw $data
     *
     * @param string $data
     */
    protected static function prepareRawPayload($data)
    {
        self::clearRequestParams();
        self::addHeader('Content-Length', strlen($data));
        self::addOption(CURLOPT_POSTFIELDS, $data);
    }
    /**
     * Converts the headers array to the cURL's option format array
     *
     * @return array
     */
    protected static function prepareHeaders()
    {
        $headers = array();
        foreach (self::$headers as $header => $value) {
            $headers[] = $header.': '.$value;
        }
        return $headers;
    }
    /**
     * Sets the HTTP request method
     *
     * @param string $method
     */
    protected static function setRequestMethod($method)
    {
        // Preventing request methods collision
        self::removeOption(CURLOPT_NOBODY);
        self::removeOption(CURLOPT_HTTPGET);
        self::removeOption(CURLOPT_POST);
        self::removeOption(CURLOPT_CUSTOMREQUEST);
        switch (strtoupper($method)) {
            case 'HEAD':
                self::addOption(CURLOPT_NOBODY, true);
            break;
            case 'GET':
                self::addOption(CURLOPT_HTTPGET, true);
            break;
            case 'POST':
                self::addOption(CURLOPT_POST, true);
            break;
            case 'RAW_POST':
                self::addOption(CURLOPT_CUSTOMREQUEST, 'POST');
            break;
            default:
                self::addOption(CURLOPT_CUSTOMREQUEST, $method);
        }
    }
    /**
     * Sets the request url
     *
     * @param string $url Request URL
     */
    protected static function setUrl($url)
    {
        self::addOption(CURLOPT_URL, $url);
    }
}
/**
 * CurlWrapper Exceptions class
 */
class CallerException extends Exception
{
    /**
     * @param string $message
     */
    public static function __construct($message)
    {
        self::$message = $message;
    }
}
/**
 * CurlWrapper cURL Exceptions class
 */
class CallerCurlException extends CallerException
{
    /**
     * @param resource $curlHandler
     */
    public static function __construct($curlHandler)
    {
        self::$message = curl_error($curlHandler);
        self::$code = curl_errno($curlHandler);
    }
}