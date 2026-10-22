<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Agent
{
    protected $agent;

    public function __construct()
    {
        $request = service('request');
        if (method_exists($request, 'getUserAgent')) {
            $this->agent = $request->getUserAgent();
        } else {
            $this->agent = new \CodeIgniter\HTTP\UserAgent();
        }
    }

    public function browser(): string
    {
        return (string) $this->agent->getBrowser();
    }

    public function version(): string
    {
        return (string) $this->agent->getVersion();
    }

    public function platform(): string
    {
        return (string) $this->agent->getPlatform();
    }

    public function is_mobile(?string $key = null): bool
    {
        return (bool) $this->agent->isMobile($key);
    }

    public function is_robot(?string $key = null): bool
    {
        return (bool) $this->agent->isRobot($key);
    }

    public function is_referral(): bool
    {
        return (bool) $this->agent->isReferral();
    }

    public function referrer(): string
    {
        return (string) $this->agent->getReferrer();
    }

    public function agent_string(): string
    {
        return (string) $this->agent->getAgentString();
    }
}
