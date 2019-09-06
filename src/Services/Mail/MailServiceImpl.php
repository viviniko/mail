<?php

namespace Viviniko\Mail\Services\Mail;

use Viviniko\Mail\Services\MailService;
use Viviniko\Mail\Services\TemplateService;
use Viviniko\Mail\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class MailServiceImpl implements MailService
{
    protected $templateService;

    protected $driver;

    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    /**
     * Get new mailable.
     *
     * @param string|Template $template
     * @param array $data
     * @return \Illuminate\Contracts\Mail\Mailable|null
     */
    public function make($template, array $data = []) {
        return $this->templateService->makeMail($template, $data);
    }

    /**
     * Send mail.
     *
     * @param mixed $to
     * @param string $template  Email template or content.
     * @param array|Model $data
     * @param $driver
     */
    public function send($to, $template, $data = [], $driver = null) {
        $result = $this->parseMailTo($to);

        if (!$result['address']) {
            throw new \InvalidArgumentException('Need Email Address.');
        }

        $data = array_merge($result['data'], $this->parseMailData($data));

        Mail::to($result['address'])->send(empty($data) ? $template : $this->make($template, $data));
    }

    /**
     * Send multi mail by third party.
     *
     * @param array|Collection $all
     * @param $template
     * @param array $data
     * @param $driver
     */
    public function sendAll($all, $template, array $data = [], $driver = null) {
        foreach ($all as $to) {
            try {
                $this->send($to, $template, $data, $driver);
            } catch (\InvalidArgumentException $e) {
                // ignore
            }
        }
    }

    protected function parseMailTo($to) {
        $address = $to;
        $data = [];

        if ($to instanceof Model) {
            $address = $to->email;
            if ($address) {
                $data = $this->parseMailData($to);
            }
        }

        return [
            'address' => $address,
            'data' => $data,
        ];
    }

    protected function parseMailData($data) {
        $result = $data;

        if ($data instanceof Model) {
            $result = $data->toArray();
        }

        return is_array($result) ? $result : (array)$result;
    }
}