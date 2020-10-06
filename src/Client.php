<?php

namespace DialogBoxStudio\KdClient;

use DialogBoxStudio\KdClient\Entity\Authorization;
use DialogBoxStudio\KdClient\Entity\Marketing;
use DialogBoxStudio\KdClient\Entity\OrderStatus;
use DialogBoxStudio\KdClient\Entity\SeasonalStorageStatus;
use DialogBoxStudio\KdClient\Entity\Services;
use DialogBoxStudio\KdClient\Entity\Working;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Exception;

class Client
{
    /**
     * Base URL API kolesa-darom.ru
     */
    public string $baseUrl = 'https://www.kolesa-darom.ru/ajax/telegram/api/1/';

    /**
     * Test URL API kolesa-darom.ru
     */
    public string $testUrl = 'https://www.kolesa-darom.ru/ajax/telegram/api/1/';

    /**
     * HTTP client
     */
    private ClientInterface $httpClient;

    /**
     * Access token
     */
    private string $token;

    /**
     * Базовые опции http запроса к API
     */
    private array $options = [
        'headers' => [
            'User-Agent' => 'kolesa-darom api-php-client/1.0',
            'Content-Type' => 'application/json',
        ],
    ];

    /**
     * Список доступных методов
     */
    private array $methodList = [
        'authorization',
        'services',
        'marketing',
        'working',
        'order/status',
        'seasonal_storage/status'
    ];

    /**
     * Client constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        $this->httpClient = new \GuzzleHttp\Client();
    }

    /**
     * Получить http клиент.
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new \GuzzleHttp\Client();
        }
        return $this->httpClient;
    }

    /**
     * Установить http клиент.
     * @param ClientInterface $httpClient
     * @return Client
     */
    public function setHttpClient(ClientInterface $httpClient): Client
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Запрос к API.
     *
     * @param string $method
     * @param array $params
     * @throws Exception
     * @throws GuzzleException
     */
    public function query(string $method, array $params): ResponseInterface
    {
        if (in_array($method, $this->methodList)) {
            $url = $this->baseUrl . $method . '/';
            $params = $params + ['access_token' => $this->token];
            try {
                return $this->getHttpClient()->request('POST', $url, ['form_params' => $params]);
            } catch (RequestException $e) {
            }
        } else {
            throw new Exception('Not method');
        }
    }

    public function authorization(string $phone): Authorization
    {
        $params = ['phone' => $phone];
        return new Authorization($this->query('authorization', $params));

    }

    public function services(string $city): Services
    {
        $params = ['city' => $city];
        return new Services($this->query('services', $params));
    }

    public function marketing(string $city): Marketing
    {
        $params = ['city' => $city];
        return new Marketing($this->query('marketing', $params));
    }

    public function working(string $city): Working
    {
        $params = ['city' => $city];
        return new Working($this->query('working', $params));
    }

    public function orderStatus(int $order): OrderStatus
    {
        $params = ['id' => $order];
        return new OrderStatus($this->query('order/status', $params));
    }

    public function seasonalStorageStatus(string $numAuto): SeasonalStorageStatus
    {
        $params = ['number' => $numAuto];
        return new seasonalStorageStatus($this->query('seasonal_storage/status', $params));
    }

}