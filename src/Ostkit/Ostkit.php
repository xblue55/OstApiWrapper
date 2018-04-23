<?php
namespace Ostkit;
use Curl\Curl as Curl;

class Ostkit
{
    public $apiUrl = '';
    public $apiKey = '';
    public $apiSecret = '';



    public function __construct($apiUrl = '', $apiKey = '', $apiSecret = '')
    {
        if ($apiUrl != '') {
            $this->apiUrl = $apiUrl;
        }
        if ($apiKey != '') {
            $this->apiKey = $apiKey;
        }
        if ($apiSecret != '') {
            $this->apiSecret = $apiSecret;
        }
    }

    public function userCreate($name)
    {
        $endPoint = '/users/create';

        $inputParams = [
          'name'=> $name
        ];
        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiKey,
            $requestTimestamp
        );
        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );
        //Request url
        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        
        $curl = new Curl();
        $result = $curl->post($requestParams['requestURL'], $requestParams['inputParams']);
        return $result->response;
    }


    public function userEdit($uuid, $name)
    {
        $endPoint = '/users/edit';

        $inputParams = [
            'uuid'=> $uuid,
            'name'=> $name
        ];

        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiUrl,
            $requestTimestamp
        );

        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );

        //Request url
        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        $curl = new Curl();
        $result = $curl->post($requestParams['requestURL'], $requestParams['inputParams']);

        return $result->response;
    }


    public function userList($pageNo = 1, $filter = 'all', $orderBy ='name', $order = 'desc')
    {
        $endPoint = '/users/list';
        $inputParams = [
            'page_no' => $pageNo,
            'filter' => $filter,
            'order_by' => $orderBy,
            'order' => $order,
        ];
        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiUrl,
            $requestTimestamp
        );

        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );

        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        $curl = new Curl();
        $result = $curl->get($requestParams['requestURL'], $requestParams['inputParams']);
        return $result->response;
    }

    public function transactionCreate($name, $kind, $currency_value, $commission_percent, $currency_type = 'USD')
    {
        $endPoint = '/transaction-types/create';
        $inputParams = [
            'name' => $name,
            'kind' => $kind,
            'currency_type' => $currency_type,
            'currency_value' => $currency_value,
            'commission_percent' => $commission_percent
        ];
        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiUrl,
            $requestTimestamp
        );

        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );

        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        $curl = new Curl();
        $result = $curl->post($requestParams['requestURL'], $requestParams['inputParams']);
        return $result->response;
    }


    public function transactionEdit($client_transaction_id, $name, $kind, $currency_value, $commission_percent, $currency_type = 'USD')
    {
        $endPoint = '/transaction-types/edit';
        $inputParams = [
            'client_transaction_id' => $client_transaction_id,
            'name' => $name,
            'kind' => $kind,
            'currency_type' => $currency_type,
            'currency_value' => $currency_value,
            'commission_percent' => $commission_percent
        ];
        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiUrl,
            $requestTimestamp
        );

        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );

        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        $curl = new Curl();
        $result = $curl->post($requestParams['requestURL'], $requestParams['inputParams']);
        return $result->response;
    }


    public function transactionList()
    {
        $endPoint = '/transaction-types/list';
        $inputParams = [];
        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiUrl,
            $requestTimestamp
        );

        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );

        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        $curl = new Curl();
        $result = $curl->get($requestParams['requestURL'], $requestParams['inputParams']);
        return $result->response;
    }

    public function transactionExec($from_uuid, $to_uuid, $transaction_kind)
    {
        $endPoint = '/transaction-types/list';
        $inputParams = [
            'from_uuid' => $from_uuid,
            'to_uuid' => $to_uuid,
            'transaction_kind' => $transaction_kind
        ];
        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiUrl,
            $requestTimestamp
        );

        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );

        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        $curl = new Curl();
        $result = $curl->post($requestParams['requestURL'], $requestParams['inputParams']);
        return $result->response;
    }


    public function transactionStatus($transaction_uuids = array())
    {
        $endPoint = '/transaction-types/list';
        $inputParams = [
            'transaction_uuids' => $transaction_uuids,
        ];
        $requestTimestamp = time();
        $queryString = $this->generateQueryString(
            $endPoint,
            $inputParams,
            $this->apiUrl,
            $requestTimestamp
        );

        $signature = $this->generateApiSignature(
            $queryString,
            $this->apiSecret
        );

        $requestParams = $this->generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp);
        $curl = new Curl();
        $result = $curl->post($requestParams['requestURL'], $requestParams['inputParams']);
        return $result->response;
    }

    public function generateRequestParams($endPoint, $inputParams, $signature, $requestTimestamp)
    {
        $inputParams['api_key'] = $this->apiKey;
        $inputParams['request_timestamp'] = $requestTimestamp;
        $inputParams['signature'] = $signature;
        return array(
            'requestURL' => $this->apiUrl . $endPoint,
            'inputParams' => $inputParams
        );
    }

    public function generateQueryString($endPoint, $inputParams, $apiKey, $requestTimestamp)
    {
        $inputParams["api_key"] = $apiKey;
        $inputParams["request_timestamp"] = $requestTimestamp;
        ksort($inputParams);
        $stringToSign = $endPoint . '?' . http_build_query($inputParams);
        // $stringToSign = str_replace('%20', '+', $stringToSign);
        return $stringToSign;
    }

    public function generateApiSignature($stringToSign, $apiSecret)
    {
        $hash = hash_hmac('sha256', $stringToSign, $apiSecret);
        return $hash;
    }
}
   