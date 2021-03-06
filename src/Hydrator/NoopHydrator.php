<?php

declare(strict_types=1);

/*
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace FAPI\PhraseApp\Hydrator;

use Psr\Http\Message\ResponseInterface;

/**
 * Do not hydrate to any object at all.
 *
 * @author Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 */
final class NoopHydrator implements Hydrator
{
    /**
     * @param ResponseInterface $response
     * @param string            $class
     *
     * @throws \LogicException
     */
    public function hydrate(ResponseInterface $response, string $class)
    {
        throw new \LogicException('The Noop Hydrator should never be called');
    }
}
