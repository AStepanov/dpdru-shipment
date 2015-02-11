<?php

namespace stp\dpd;

use stp\dpd\response\BaseResponse;
use stp\dpd\message\BaseMessage;
use SoapClient;


class DpdApi
{
    protected $testMode = true;

    /**
     * @var SoapClient
     */
    protected $soapClient; // SOAP-клиент

    protected $clientNumber = null;

    protected $clientKey = null;

    const _HOST = 'ws.dpd.ru/services/';
    const _HOST_TEST = 'wstest.dpd.ru/services/';

    const SERVICE_ORDER = 'order2';
    const METHOD_CREATE_ORDER = 'createOrder';
    const METHOD_GET_REGISTER_FILE = 'getRegisterFile';

    const SERVICE_TRACING = 'tracing';
    const METHOD_GET_STATE_CLIENT = 'getStatesByClientOrder';

    static $services = [
        self::METHOD_CREATE_ORDER => self::SERVICE_ORDER,
        self::METHOD_GET_REGISTER_FILE => self::SERVICE_ORDER,
        self::METHOD_GET_STATE_CLIENT => self::SERVICE_TRACING,
    ];

    /**
     * @param int $clientNumber клиентский номер в системе DPD
     * @param string $clientKey клиентский номер в системе DPD
     * @param bool $testMode
     */
    public function __construct($clientNumber, $clientKey, $testMode = true)
    {
        $this->clientNumber = $clientNumber;
        $this->clientKey = $clientKey;
        $this->testMode = $testMode;
    }

    /**
     * Список городов доставки
     *
     * @return \stdClass[]
     */
    public function getCityList()
    {
        $obj = $this->_getDpdData('getCitiesCashPay');
        return $obj->return;
    }

    public function getSeviceCost2($cityTo, $cityFrom, $weight, array $params)
    {
        $data['pickup'] = array(
            'cityId' => $cityFrom
        );
        $data['delivery'] = array(
            'cityId' => $cityTo
        );
        $data['weight'] = $weight;
        $data = array_merge($params, $data);
        $response = $this->_getDpdData('getServiceCost2', $data, true);

        return $response->return;
    }

    /**
     * Коннект с соответствующим сервисом
     *
     * @param string $serviceName имя сервиса свойства класса (see self::$services)
     * @throws \RuntimeException
     */
    protected function serviceConnect($serviceName)
    {
        $url = 'http://' . ($this->testMode ? self::_HOST_TEST : self::_HOST) . $serviceName . '?WSDL';
        $this->soapClient = new SoapClient($url);
        if (!$this->soapClient) {
            throw new \RuntimeException('Unable to connect');
        }
    }

    /**
     * Запрос данных в методе сервиса
     *
     * @param string $serviceName
     * @param array $data Массив параметров, передаваемых в метод
     * @param integer $isRequest флаг упаковки запроса в поле 'request'
     * @throws \RuntimeException
     * @return mixed Объект, полученный от сервиса
     */
    protected function _getDpdData($serviceName, $data = array(), $isRequest = 0)
    {
        $this->serviceConnect($serviceName);
        $data['auth'] = array(
            'clientNumber' => $this->clientNumber,
            'clientKey' => $this->clientKey);
        $isRequest ? $arRequest = array('request' => $data) : $arRequest = $data;
        $response = $this->soapClient->$serviceName($arRequest);
        if (!$response) {
            throw new \RuntimeException(sprintf('Error on call service %s', $serviceName));
        }

        return $response;
    }

    /**
     * @param string $methodName
     * @param BaseMessage $message
     * @return BaseResponse|BaseResponse[]
     */
    public function request($methodName, BaseMessage $message)
    {
        if (!isset(self::$services[$methodName])) {
            throw new \RuntimeException(sprintf('Unable to find service for method name "%s"', $methodName));
        }
        $this->serviceConnect(self::$services[$methodName]);
        $this->messageAuth($message);

        $data = [$message->getWrapperName() => $message->asArray()];

        $responseData = $this->soapClient->$methodName($data);
        if (!$responseData) {
            throw new \RuntimeException(sprintf('Error on call service %s', $methodName));
        }

        return $this->buildResponse($message, $responseData);
    }

    protected function buildResponse(BaseMessage $message, $responseData)
    {
        $responseClassName = $message->responseType();
        if ($message->isMulti()) {
            $response = [];
            foreach($responseData->return as $element) {
                $response[] = new $responseClassName((object)['return' => $element]);
            }
        } else {
            $response = new $responseClassName($responseData);
        }

        return $response;
    }

    protected function messageAuth(BaseMessage $message)
    {
        $message->auth_clientKey || $message->auth_clientKey = $this->clientKey;
        $message->auth_clientNumber || $message->auth_clientNumber = $this->clientNumber;
    }

}
