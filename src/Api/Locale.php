<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\PhraseApp\Api;

use FAPI\PhraseApp\Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 */
class Locale extends HttpApi
{
    /**
     * Download a locale.
     *
     * @param string $projectKey
     * @param string $localeId
     * @param string $ext
     * @param array  $params
     *
     * @throws Exception
     *
     * @return string|ResponseInterface
     */
    public function download(string $projectKey, string $localeId, string $ext, array $params = [])
    {
        $params['file_format'] = $ext;

        $response = $this->httpGet(sprintf('/api/v2/projects/%s/locales/%s/download', $projectKey, $localeId), $params);

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return (string) $response->getBody();
    }

    /**
     * @param string $projectKey
     * @param string $localeId
     * @param array $params
     *
     * @throws Exception\DomainException
     *
     * @return ResponseInterface|string
     */
    public function delete(string $projectKey, string $localeId, array $params = [])
    {
        $response = $this->httpDelete(sprintf('/api/v2/projects/%s/locales/%s', $projectKey, $localeId), $params);

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return (string) $response->getBody();
    }

    /**
     * @param string $projectKey
     * @param array $params
     * @return ResponseInterface|string
     * @throws Exception\DomainException
     */
    public function list(string $projectKey, array $params = [])
    {
        $response = $this->httpGet(sprintf('/api/v2/projects/%s/locales', $projectKey), $params);

        if (!$this->hydrator) {
            return $response;
        }

        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return (string) $response->getBody();
    }
}
