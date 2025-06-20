<?php

namespace acaodireta\Services;

use acaodireta\Iugu;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

class BaseRequest
{
    /**
     * Parâmetros do cliente
     *
     * @var array
     */
    protected $params;

    /**
     * Response da chamada da API
     *
     * @var array
     */
    protected $response;

    public function __construct(private ClientInterface $http, private Iugu $iugu)
    {
    }

    /**
     * setParams
     *
     * @param array $value
     * @return self
     */
    protected function setParams($value)
    {
        $this->params = $value;
        return $this;
    }

    /**
     * fetchResponse
     *
     * Modifica o payload de retorno.
     *
     * @return array
     */
    protected function fetchResponse()
    {
        return $this->response;
    }

    /**
     * sendApiRequest
     *
     * @return void
     */
    protected function sendApiRequest($method, $path)
    {
        try {
            $requestParams = [];

            if (in_array($method, ['PUT', 'POST'])) {
                $requestParams = [
                    'json' => $this->params,
                ];
            }

            $request = $this->http->$method($path, $requestParams);

            $this->response = json_decode($request->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getCode() == 422) {
                $erros = json_decode($e->getResponse()->getBody()->getContents(), true);
                $formata_erros = '';
                $count = 1;

                foreach ($erros['errors'] as $key => $erro) {
                    $formata_erros .= 'Erro ' . $count . ' -  Campo: ' . $key . ' Mensagem: ' . $erro[0] . ' \\n \n <br> <b /> ';
                    $count++;
                }
                $this->response['erro'] = $formata_erros;
            } else {
                $this->response['erro'] = $e->getMessage();
            }
            $this->response['code'] = $e->getCode();

            return  $this->response;
        }
    }
}
