<?php

namespace Viviniko\Mail\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;

interface MailService
{
    /**
     * Make message.
     *
     * @param $template
     * @param array $data
     * @return Mailable
     */
    public function make($template, array $data = []);

    /**
     * Send mail.
     *
     * @param mixed $to
     * @param string $template  Email template or content.
     * @param array|Model $data
     */
    public function send($to, $template, $data = []);

    /**
     * Send multi mail by third party.
     *
     * @param array|Collection $all
     * @param $template
     * @param array $data
     */
    public function sendAll($all, $template, array $data = []);
}