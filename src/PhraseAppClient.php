<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\PhraseApp;

use FAPI\PhraseApp\Hydrator\Hydrator;
use FAPI\PhraseApp\Hydrator\ModelHydrator;
use Http\Client\HttpClient;

/**
 * @author Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 */
final class PhraseAppClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * The constructor accepts already configured HTTP clients.
     * Use the configure method to pass a configuration to the Client and create an HTTP Client.
     *
     * @param HttpClient          $httpClient
     * @param Hydrator|null       $hydrator
     * @param RequestBuilder|null $requestBuilder
     */
    public function __construct(
        HttpClient $httpClient,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ) {
        $this->httpClient = $httpClient;
        $this->hydrator = $hydrator ?: new ModelHydrator();
        $this->requestBuilder = $requestBuilder ?: new RequestBuilder();
    }

    /**
     * @param HttpClientConfigurator $httpClientConfigurator
     * @param Hydrator|null          $hydrator
     * @param RequestBuilder|null    $requestBuilder
     *
     * @return PhraseAppClient
     */
    public static function configure(
        HttpClientConfigurator $httpClientConfigurator,
        Hydrator $hydrator = null,
        RequestBuilder $requestBuilder = null
    ): self {
        $httpClient = $httpClientConfigurator->createConfiguredClient();

        return new self($httpClient, $hydrator, $requestBuilder);
    }

    public function upload(): Api\Upload
    {
        return new Api\Upload($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    public function locale(): Api\Locale
    {
        return new Api\Locale($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    public function translation(): Api\Translation
    {
        return new Api\Translation($this->httpClient, $this->hydrator, $this->requestBuilder);
    }

    public function key(): Api\Key
    {
        return new Api\Key($this->httpClient, $this->hydrator, $this->requestBuilder);
    }
}
