<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FAPI\PhraseApp\Api;

use FAPI\PhraseApp\Exception;
use FAPI\PhraseApp\Model\Export\Exported;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 */
class Export extends HttpApi
{
    /**
     * Export a locale.
     * {@link https://localise.biz/api/docs/export/exportlocale}.
     *
     * @param string $projectKey
     * @param string $localeId
     * @param string $ext
     * @param array  $params
     *
     * @return string|ResponseInterface
     *
     * @throws Exception
     */
    public function locale(string $projectKey, string $localeId, string $ext, array $params)
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
}