<?php


namespace DialogBoxStudio\KdClient;


use DialogBoxStudio\KdClient\API\Authorization;
use DialogBoxStudio\KdClient\API\Marketing;
use DialogBoxStudio\KdClient\API\OrderStatus;
use DialogBoxStudio\KdClient\API\SeasonalStorageStatus;
use DialogBoxStudio\KdClient\API\Services;
use DialogBoxStudio\KdClient\API\Working;
use Exception;

class Client
{
    /**
     * @var string $access_token
     */
    private string $access_token;

    /**
     * @var string $base_url
     */
    private string $base_url = 'https://www.kolesa-darom.ru/ajax/telegram/api/1/';

    /**
     * @var object $http_client
     */
    private object $http_client;

    /**
     * @var string $test_url
     */
    private string $test_url = 'https://external.kolesa-darom.ru/ajax/telegram/api/1/';

    /**
     * @var array|string[]
     */
    private array $map = [
        'authorization' => Authorization::class,
        'marketing' => Marketing::class,
        'order/status' => OrderStatus::class,
        'seasonal_storage/status' => SeasonalStorageStatus::class,
        'services' => Services::class,
        'working' => Working::class
    ];

    /**
     * @var bool $test
     */
    public bool $test;

    /**
     * NewClient constructor.
     * @param string $access_token
     * @param object $http_client
     * @param bool $test
     */
    public function __construct(string $access_token, object $http_client, bool $test = false)
    {
        $this->access_token = $access_token;
        $this->http_client = $http_client;
        $this->test = $test;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->base_url;
    }

    /**
     * @return object
     */
    public function getHttpClient(): object
    {
        return $this->http_client;
    }

    /**
     * @return string
     */
    public function getTestUrl(): string
    {
        return $this->test_url;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @param string $base_url
     */
    public function setBaseUrl(string $base_url): void
    {
        $this->base_url = $base_url;
    }

    /**
     * @param object $http_client
     */
    public function setHttpClient(object $http_client): void
    {
        $this->http_client = $http_client;
    }

    /**
     * @param string $test_url
     */
    public function setTestUrl(string $test_url): void
    {
        $this->test_url = $test_url;
    }

    /**
     * @param string $method
     * @param array $params
     * @return object
     */
    public function request(string $method, array $params): object
    {
        $url = ($this->test === false) ? $this->base_url . $method . '/' : $this->test_url . $method . '/';
        $params = array_merge($params, ['access_token' => $this->access_token]);
        try {
            $response = $this->getHttpClient()->request('POST', $url, ['form_params' => $params]);
            $result = ($response->getStatusCode() == 200) ? $response->getBody()->getContents() : '{"error":{"code":1,"message":"Сервер недоступен"}}"';
            $result_decode = json_decode($result);
            return (isset($result_decode->error)) ? new $this->map[$method]($result_decode->error->message, true) : new $this->map[$method]($result);
        } catch (Exception $e) {
            return new $this->map[$method]('Ошибка при выполнении запроса', true);
        }
    }

    public function authorization(string $phone): Authorization
    {
        return $this->request('authorization', ['phone' => $phone]);
    }

    public function marketing(string $city): Marketing
    {
        return $this->request('marketing', ['city' => $city]);
    }

    public function orderStatus(int $id): OrderStatus
    {
        return $this->request('order/status', ['id' => $id]);
    }

    public function seasonalStorageStatus(string $auto): SeasonalStorageStatus
    {
        return $this->request('seasonal_storage/status', ['number' => $auto]);
    }


}