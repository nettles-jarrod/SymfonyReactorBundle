<?php

namespace Blackshawk\SymfonyReactorBundle\Reactor;

use React\Http\Request;
use React\Http\Response;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\Config\Loader\LoaderInterface;

class Kernel extends \AppKernel
{
    public function __invoke(Request $request, Response $response)
    {
        $this->loadClassCache();
        $result = $this->handle($this->buildSymfonyRequest($request, $response));

        $response->writeHead($result->getStatusCode());
        $response->end($result->getContent());
    }

    private function buildSymfonyRequest(Request $request, Response $response)
    {
        return SymfonyRequest::create($request->getPath(), $request->getMethod());
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    public function getRootDir()
    {
        return KERNEL_ROOT;
    }
}
