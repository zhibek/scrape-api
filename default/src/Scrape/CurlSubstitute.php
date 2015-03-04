<?php
namespace Scrape;

use WebDriver\Service\CurlServiceInterface;

class CurlSubstitute implements CurlServiceInterface
{

    public function execute($requestMethod, $url, $parameters = null, $extraOptions = array())
    {
//var_dump(__METHOD__, $requestMethod, $url, $parameters, $extraOptions);
        $customHeaders = array(
            'Content-Type: application/json;charset=UTF-8',
            'Accept: application/json;charset=UTF-8',
        );

        foreach ($extraOptions as $option => $value) {
            if ('CURLOPT_FOLLOWLOCATION' === $option) continue;
            $customHeaders[] = sprintf('%s: %s', $option, $value);
        }

        switch ($requestMethod) {
            case 'GET':
            case 'DELETE':
                $options = array(
                    'method' => $requestMethod,
                    'header' => implode("\r\n", $customHeaders),
                    'ignore_errors' => true,
                );
                break;

            case 'POST':
            case 'PUT':
                if ($parameters && is_array($parameters)) {
                    $content = json_encode($parameters);
                } else {
                    $customHeaders[] = 'Content-Length: 0';
                    $customHeaders[] = 'Expect:';
                    $content = null;
                }
                $options = array(
                    'method' => $requestMethod,
                    'header' => implode("\r\n", $customHeaders),
                    'ignore_errors' => true,
                    'content' => $content,
                );
                break;
        }

        //$info = curl_getinfo($curl);

        $options['protocol_version'] = 1.1;
        $options['timeout'] = 5;
        $options['max_redirects'] = 5;

        $context = stream_context_create(
                array(
                    'http' => $options,
                ));
        $result = file_get_contents($url, false, $context);

        $statusCode = (int)explode(' ', $http_response_header[0])[1];

        $rawResult = trim($result);
        $info = array(
            'url' => $url,
            'status' => $statusCode,
        );

//var_dump(__METHOD__, $options, $rawResult, $info);die;
        return array($rawResult, $info);
    }

}