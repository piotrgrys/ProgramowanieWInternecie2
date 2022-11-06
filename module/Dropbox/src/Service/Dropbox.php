<?php

namespace Dropbox\Service;

use Laminas\Http\Client;
use Laminas\Json\Json;
use Laminas\Session\Container;

class Dropbox
{
    const API_URL = 'https://api.dropboxapi.com/2/';
    const CONTENT_URL='https://content.dropboxapi.com/2/';
    const REDIRECT_URI = 'http://localhost:8080/pi2/Lab2/pi2/public/dropbox/finish';

    private Container $container;

    private array $config;

    public function __construct(array $config)
    {
        $this->container = new Container();
        $this->config = $config['dropbox'];
    }

    /**
     * Generates Dropbox authorization URL
     *
     * @return string
     */
    public function generateAuthorizationUrl(): string
    {
        return sprintf(
            "https://www.dropbox.com/oauth2/authorize?client_id=%s&redirect_uri=%s&response_type=code",
            $this->config['key'],
            self::REDIRECT_URI
        );
    }

    /**
     * Checks wheather user has Dropbox access token
     *
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return isset($this->container->access_token);
    }

    /**
     * Gets Dropbox access token
     *
     * @param $authorizationCode
     * @return bool
     * @throws \Exception
     */
    public function getAccessToken($authorizationCode): bool
    {
        $client = new Client('https://api.dropboxapi.com/oauth2/token');
        $client->setMethod('post');
        $client->setParameterPost([
            'code' => $authorizationCode,
            'grant_type' => 'authorization_code',
            'client_id' => $this->config['key'],
            'client_secret' => $this->config['secret'],
            'redirect_uri' => self::REDIRECT_URI
        ]);

        $response = $client->send();

        if ($response->isSuccess()) {
            $data = Json::decode($response->getBody());

            if (!empty($data->access_token)) {
                $this->container->access_token = $data->access_token;

                return true;
            }
        }

        throw new \Exception($response->getBody());
    }

    /**
     * Gets file list from a specified directory
     *
     * @param string $path
     * @return array
     * @throws \Exception
     */
    public function getFileList(string $path): array
    {
        $files = $this->sendRequest(self::API_URL,'/files/list_folder', ['path' => $path]);

        return $files['entries'];
    }

    public function addFile($data)
    {
        $path = tempnam(sys_get_temp_dir(), 'prefix');
        $handle = fopen($path, "w");
        fwrite($handle, $data->FileContent);
        fclose($handle);
        $param= array('autorename'=>false,
        'mode'=> 'add',
        'mute'=> false,
        'path'=> '/'.$data->FileName.'.txt',
        'strict_conflict'=> false);
        $this->sendRequestWithDropboxParams('/files/upload',$path, $param);
    }
    public function deleteFile($fileName)
    {
        $response=$this->sendRequest(self::API_URL,'/files/delete_v2', ['path' => $fileName]);
    }
    public function getFile($fileName)
    {
        return $this->getFileContent('files/download', ['path' => $fileName]);
    }
    /**
     * Sends a request to Dropbox API
     *
     * @param string $function
     * @param array  $parameters
     * @return array
     * @throws \Exception
     */
    private function sendRequest(string $path,string $function, array $parameters = []): array
    {
        $client = new Client($path . $function);
        $client->setMethod('post');
        $client->setHeaders([
            'Authorization' => 'Bearer ' . $this->container->access_token,
            'Content-Type' => 'application/json'
        ]);
        $client->setRawBody(Json::encode($parameters));
        //dd($client);
        $response = $client->send();

        if ($response->isSuccess()) {
            return Json::decode($response->getBody(), Json::TYPE_ARRAY);
        } else {
            throw new \Exception($response->getContent());
        }
    }
    private function sendRequestWithDropboxParams(string $function,  string $fileName,array $dropboxApiParams = []): array
    {
        $client = new Client(self::CONTENT_URL . $function);
        $client->setMethod('post');
        $client->setHeaders([
            'Authorization' => 'Bearer ' . $this->container->access_token,
            'Dropbox-API-Arg'=>Json::encode($dropboxApiParams),
            'Content-Type' => 'application/octet-stream' 
        ]);
        $client->setFileUpload($fileName,'tt'); //setRawBody(Json::encode($parameters));
        //dd($client);
        $response = $client->send();

        if ($response->isSuccess()) {
            return Json::decode($response->getBody(), Json::TYPE_ARRAY);
        } else {
            throw new \Exception($response->getContent());
        }
        
    }
    private function getFileContent(string $function, array $dropboxApiParams = []): string
    {
        $client = new Client(self::CONTENT_URL . $function,
        [
            'adapter' => 'Laminas\Http\Client\Adapter\Curl',
        ]);
        $client->setMethod('post');
        $client->setHeaders([
            'Authorization' => 'Bearer ' . $this->container->access_token,
            'Dropbox-API-Arg'=>Json::encode($dropboxApiParams),
            'Content-Type'=>'text/plain'
        ]);
        $response = $client->send();
        return $response->getBody();
        if ($response->isSuccess()) {
            return Json::decode($response->getBody(), Json::TYPE_ARRAY);
        } else {
            throw new \Exception($response->getContent());
        }
        
    }
}
