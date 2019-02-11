<?php

namespace Notoro\framework\middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (\strlen($request->getUri()->getPath()) > 1 && substr($request->getUri()->getPath(), -1) == "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($request->getUri()->getPath(), 0, -1));
        }
        return $handler->handle($request);
    }
}
