<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Email
{
    /** @var \CodeIgniter\Email\Email */
    protected $email;

    public function __construct(array $config = [])
    {
        $this->email = \Config\Services::email();
        if (!empty($config)) {
            $this->initialize($config);
        }
    }

    public function initialize(array $config = []): self
    {
        $this->email->initialize($config);
        return $this;
    }

    public function set_mailtype(string $type = 'text'): self
    {
        $this->email->setMailType($type);
        return $this;
    }

    public function from(string $from, string $name = '', ?string $returnPath = null): self
    {
        $this->email->setFrom($from, $name, $returnPath);
        return $this;
    }

    public function to($to): self
    {
        $this->email->setTo($to);
        return $this;
    }

    public function cc($cc): self
    {
        $this->email->setCC($cc);
        return $this;
    }

    public function bcc($bcc, ?string $limit = null): self
    {
        $this->email->setBCC($bcc, $limit);
        return $this;
    }

    public function subject(string $subject): self
    {
        $this->email->setSubject($subject);
        return $this;
    }

    public function message(string $message): self
    {
        $this->email->setMessage($message);
        return $this;
    }

    public function attach(string $filename, string $disposition = '', ?string $newname = null, string $mime = ''): self
    {
        $this->email->attach($filename, $disposition, $newname, $mime);
        return $this;
    }

    public function send(bool $autoClear = true): bool
    {
        return $this->email->send($autoClear);
    }

    public function clear(bool $clearAttachments = false): self
    {
        $this->email->clear($clearAttachments);
        return $this;
    }

    public function print_debugger(array $include = ['headers', 'subject', 'body']): string
    {
        return $this->email->printDebugger($include);
    }
}
