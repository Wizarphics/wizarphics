<?php

namespace wizarphics\wizarframework\traits;

use DateTime;
use DateTimeZone;
use RuntimeException;
use Throwable;
use wizarphics\wizarframework\exception\ForbiddenException;
use wizarphics\wizarframework\http\Cookie;
use wizarphics\wizarframework\http\CookieHolder;
use wizarphics\wizarframework\http\Request;
use wizarphics\wizarframework\http\Response;
use wizarphics\wizarframework\utilities\formatters\XMLFormatter;

/**
 * Response Trait
 *
 * Additional methods to make a PSR-7 Response class
 * compliant with the framework's own ResponseInterface.
 *
 * @property array $statusCodes
 *
 * @see https://github.com/php-fig/http-message/blob/master/src/ResponseInterface.php
 */
trait ResponseTrait
{
    /**
     * Type of format the body is in.
     * Valid: html, json, xml
     *
     * @var string
     * 
     */
    protected $bodyFormat = 'html';


    /**
     * CookieHolder instance.
     *
     * @var CookieHolder
     */
    protected $CookieHolder;

    /**
     * Return an instance with the specified status code and, optionally, reason phrase.
     *
     * If no reason phrase is specified, will default recommended reason phrase for
     * the response's status code.
     *
     * @see http://tools.ietf.org/html/rfc7231#section-6
     * @see http://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     *
     * @param int    $code   The 3-digit integer result code to set.
     * @param string $reason The reason phrase to use with the
     *                       provided status code; if none is provided, will
     *                       default to the IANA name.
     *
     * @return $this
     *
     * @throws RuntimeException For invalid status code arguments.
     */
    public function setStatusCode(int $code, string $reason = '', ?Throwable $prev = null)
    {
        if ($code < 100 || $code > 599) {
            throw new RuntimeException('Invalid status code: '. $code);
        }

        // Valid range?
        if ($code < 100 || $code > 599) {
            throw new RuntimeException(__('HTTP.invalidStatusCode', [$code]), 500, $prev);
        }

        // Unknown and no message?
        if (!array_key_exists($code, static::$statusCodes) && empty($reason)) {
            throw new RuntimeException(__('HTTP.unknownStatusCode', [$code]), 500, $prev);
        }

        $this->statusCode = $code;
        // http_response_code($code);

        $this->reason = !empty($reason) ? $reason : static::$statusCodes[$code];

        return $this;
    }

    // --------------------------------------------------------------------
    // Convenience Methods
    // --------------------------------------------------------------------

    /**
     * Sets the date header
     *
     * @return Response
     */
    public function setDate(DateTime $date)
    {
        $date->setTimezone(new DateTimeZone('UTC'));

        $this->setHeader('Date', $date->format('D, d M Y H:i:s') . ' GMT');

        return $this;
    }

    /**
     * Sets the Content Type header for this response with the mime type
     * and, optionally, the charset.
     *
     * @return Response
     */
    public function setContentType(string $mime, string $charset = 'UTF-8')
    {
        // add charset attribute if not already there and provided as parm
        if ((strpos($mime, 'charset=') < 1) && !empty($charset)) {
            $mime .= '; charset=' . $charset;
        }

        $this->removeHeader('Content-Type'); // replace existing content type
        $this->setHeader('Content-Type', $mime);

        return $this;
    }

    /**
     * Converts the $body into JSON and sets the Content Type header.
     *
     * @param array|string $body
     *
     * @return $this
     */
    public function setJSON($body, bool $unencoded = false)
    {
        $this->body = $this->formatBody($body, 'json' . ($unencoded ? '-unencoded' : ''));

        return $this;
    }

    /**
     * Returns the current body, converted to JSON is it isn't already.
     *
     * @return string|null
     *
     * @throws \InvalidArgumentException If the body property is not array.
     */
    public function getJSON()
    {
        $body = $this->body;

        if ($this->bodyFormat !== 'json') {
            $body = $this->formatJson($body);
        }

        return $body ?: null;
    }

    public function formatJson($data)
    {
        $options =  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
        $options = $options | JSON_PARTIAL_OUTPUT_ON_ERROR;
        $options = ENVIRONMENT === 'production' ? $options : $options | JSON_PRETTY_PRINT;
        $result = json_encode($data, $options, 512);

        if (!in_array(json_last_error(), [JSON_ERROR_NONE, JSON_ERROR_RECURSION], true)) {
            throw new RuntimeException(('Failed to parse json string, error: ' . json_last_error_msg() . '.'));
        }

        return $result;
    }

    public function formatXml($data)
    {
        return (new XMLFormatter())->format($data);
    }

    /**
     * Converts $body into XML, and sets the correct Content-Type.
     *
     * @param array|string $body
     *
     * @return $this
     */
    public function setXML($body)
    {
        $this->body = $this->formatBody($body, 'xml');

        return $this;
    }

    /**
     * Retrieves the current body into XML and returns it.
     *
     * @return mixed|string
     *
     * @throws \InvalidArgumentException If the body property is not array.
     */
    public function getXML()
    {
        $body = $this->body;

        if ($this->bodyFormat !== 'xml') {
            $body = $this->formatXml($body);
        }

        return $body;
    }

    /**
     * Handles conversion of the data into the appropriate format,
     * and sets the correct Content-Type header for our response.
     *
     * @param array|string $body
     * @param string       $format Valid: json, xml
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException If the body property is not string or array.
     */
    protected function formatBody($body, string $format)
    {
        $this->bodyFormat = ($format === 'json-unencoded' ? 'json' : $format);
        $mime             = "application/{$this->bodyFormat}";
        $this->setContentType($mime);

        // Nothing much to do for a string...
        if (!is_string($body) || $format === 'json-unencoded') {
            switch ($this->bodyFormat) {
                case 'json':
                    $body = $this->formatJson($body);
                    break;
                case 'xml':
                    $body = $this->formatXml($body);
            }
        }

        return $body;
    }

    /**
     * Sets the Last-Modified date header.
     *
     * $date can be either a string representation of the date or,
     * preferably, an instance of DateTime.
     *
     * @param DateTime|string $date
     *
     * @return Response
     */
    public function setLastModified($date)
    {
        if ($date instanceof DateTime) {
            $date->setTimezone(new DateTimeZone('UTC'));
            $this->setHeader('Last-Modified', $date->format('D, d M Y H:i:s') . ' GMT');
        } elseif (is_string($date)) {
            $this->setHeader('Last-Modified', $date);
        }

        return $this;
    }

    // --------------------------------------------------------------------
    // Output Methods
    // --------------------------------------------------------------------

    /**
     * Sends the output to the browser.
     *
     * @return Response
     */
    public function send()
    {

        $this->body = str_replace(['{csp-style-nonce}', '{csp-script-nonce}'], '', $this->body ?? '');

        $this->sendHeaders();
        $this->sendCookies();
        $this->sendBody();

        return $this;
    }

    /**
     * Returns the `CookieHolder` instance.
     *
     * @return CookieHolder
     */
    public function getCookieHolder()
    {
        return $this->CookieHolder;
    }

    /**
     * Checks to see if the Response has a specified cookie or not.
     */
    public function hasCookie(string $name, ?string $value = null, string $prefix = ''): bool
    {
        $prefix = $prefix ?: Cookie::setDefaults()['prefix']; // to retain BC

        return $this->CookieHolder->has($name, $prefix, $value);
    }

    /**
     * Returns the cookie
     *
     * @param string $prefix Cookie prefix.
     *                       '': the default prefix
     *
     * @return Cookie|Cookie[]|null
     */
    public function fetchCookie(?string $name = null, string $prefix = '')
    {
        if ((string) $name === '') {
            return $this->CookieHolder->display();
        }

        try {
            $prefix = $prefix ?: Cookie::setDefaults()['prefix']; // to retain BC

            return $this->CookieHolder->get($name, $prefix);
        } catch (RuntimeException $e) {
            log_message('error', (string) $e);

            return null;
        }
    }

    /**
     * Sets a cookie to be deleted when the response is sent.
     *
     * @return $this
     */
    public function unsetCookie(string $name = '', string $domain = '', string $path = '/', string $prefix = '')
    {
        if ($name === '') {
            return $this;
        }

        $prefix = $prefix ?: Cookie::setDefaults()['prefix']; // to retain BC

        $prefixed = $prefix . $name;
        $store    = $this->CookieHolder;
        $found    = false;

        /** @var Cookie $cookie */
        foreach ($store as $cookie) {
            if ($cookie->getPrefixedName() === $prefixed) {
                if ($domain !== $cookie->getDomain()) {
                    continue;
                }

                if ($path !== $cookie->getPath()) {
                    continue;
                }

                $cookie = $cookie->withValue('')->withExpired();
                $found  = true;

                $this->CookieHolder = $store->put($cookie);
                break;
            }
        }

        if (!$found) {
            $this->setCookie($name, '', '', $domain, $path, $prefix);
        }

        return $this;
    }

    /**
     * Returns all cookies currently set.
     *
     * @return Cookie[]
     */
    public function fetchCookies()
    {
        return $this->CookieHolder->display();
    }

    /**
     * Actually sets the cookies.
     */
    protected function sendCookies()
    {
        if ($this->pretend) {
            return;
        }

        $this->dispatchCookies();
    }

    private function dispatchCookies(): void
    {
        /** @var Request $request */
        $request = app('request');

        foreach ($this->CookieHolder->display() as $cookie) {
            if ($cookie->isSecure() && !$request->isSecure()) {
                throw new ForbiddenException('The action you requested is not allowed.');
            }

            $name    = $cookie->getPrefixedName();
            $value   = $cookie->getValue();
            $options = $cookie->getOptions();

            if ($cookie->isRaw()) {
                $this->doSetRawCookie($name, $value, $options);
            } else {
                $this->doSetCookie($name, $value, $options);
            }
        }

        $this->CookieHolder->clear();
    }

    /**
     * Extracted call to `setrawcookie()` in order to run unit tests on it.
     *
     * @codeCoverageIgnore
     */
    private function doSetRawCookie(string $name, string $value, array $options): void
    {
        setrawcookie($name, $value, $options);
    }

    /**
     * Extracted call to `setcookie()` in order to run unit tests on it.
     *
     * @codeCoverageIgnore
     */
    private function doSetCookie(string $name, string $value, array $options): void
    {
        setcookie($name, $value, $options);
    }

    /**
     * Sends the headers of this HTTP response to the browser.
     *
     * @return Response
     */
    public function sendHeaders()
    {
        // Have the headers already been sent?
        if ($this->pretend || headers_sent()) {
            return $this;
        }

        // Per spec, MUST be sent with each request, if possible.
        // http://www.w3.org/Protocols/rfc2616/rfc2616-sec13.html
        if (!isset($this->headers['Date']) && PHP_SAPI !== 'cli-server') {
            $this->setDate(DateTime::createFromFormat('U', (string) time()));
        }

        // HTTP Status
        header(sprintf('HTTP/%s %s %s', $this->getProtocolVersion(), $this->getStatusCode(), $this->getReasonPhrase()), true, $this->getStatusCode());

        // Send all of our headers
        foreach (array_keys($this->headers()) as $name) {
            header($name . ': ' . $this->getHeaderLine($name), false, $this->getStatusCode());
        }

        return $this;
    }

    /**
     * Sends the Body of the message to the browser.
     *
     * @return Response
     */
    public function sendBody()
    {
        echo $this->body;

        return $this;
    }

    /**
     * Perform a redirect to a new URL, in two flavors: header or location.
     *
     * @param string $uri  The URI to redirect to
     * @param int    $code The type of redirection, defaults to 302
     *
     * @return $this
     *
     * @throws RuntimeException For invalid status code.
     */
    public function redirect(string $uri, string $method = 'auto', ?int $code = null)
    {
        // Assume 302 status code response; override if needed
        if (empty($code)) {
            $code = 302;
        }

        // IIS environment likely? Use 'refresh' for better compatibility
        if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== false) {
            $method = 'refresh';
        }

        // override status code for HTTP/1.1 & higher
        // reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
        if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $this->getProtocolVersion() >= 1.1 && $method !== 'refresh') {
            $code = ($_SERVER['REQUEST_METHOD'] !== 'GET') ? 303 : ($code === 302 ? 307 : $code);
        }

        switch ($method) {
            case 'refresh':
                $this->setHeader('Refresh', '0;url=' . $uri);
                break;

            default:
                $this->setHeader('Location', $uri);
                break;
        }

        $this->setStatusCode($code);

        return $this;
    }


    /**
     * Set a cookie
     *
     * Accepts an arbitrary number of binds (up to 7) or an associative
     * array in the first parameter containing all the values.
     *
     * @param array|Cookie|string $name     Cookie name / array containing binds / Cookie object
     * @param string              $value    Cookie value
     * @param string              $expire   Cookie expiration time in seconds
     * @param string              $domain   Cookie domain (e.g.: '.yourdomain.com')
     * @param string              $path     Cookie path (default: '/')
     * @param string              $prefix   Cookie name prefix ('': the default prefix)
     * @param bool|null           $secure   Whether to only transfer cookies via SSL
     * @param bool|null           $httponly Whether only make the cookie accessible via HTTP (no javascript)
     * @param string|null         $samesite
     *
     * @return $this
     */
    public function setCookie(
        $name,
        $value = '',
        $expire = '',
        $domain = '',
        $path = '/',
        $prefix = '',
        $secure = null,
        $httponly = null,
        $samesite = null
    ) {
        if ($name instanceof Cookie) {
            $this->CookieHolder = $this->CookieHolder->put($name);

            return $this;
        }

        if (is_array($name)) {
            // always leave 'name' in last place, as the loop will break otherwise, due to ${$item}
            foreach (['samesite', 'value', 'expire', 'domain', 'path', 'prefix', 'secure', 'httponly', 'name'] as $item) {
                if (isset($name[$item])) {
                    ${$item} = $name[$item];
                }
            }
        }

        if (is_numeric($expire)) {
            $expire = $expire > 0 ? time() + $expire : 0;
        }

        $cookie = new Cookie($name, $value, [
            'expires'  => $expire ?: 0,
            'domain'   => $domain,
            'path'     => $path,
            'prefix'   => $prefix,
            'secure'   => $secure,
            'httponly' => $httponly,
            'samesite' => $samesite ?? '',
        ]);

        $this->CookieHolder = $this->CookieHolder->put($cookie);

        return $this;
    }
}
