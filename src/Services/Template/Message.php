<?php

namespace Viviniko\Mail\Services\Template;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $html;

    /**
     * @var array
     */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $html
     * @param string $from
     * @param array $data
     */
    public function __construct($subject, $html, $from, array $data = null) {
        $this->subject = $subject;
        $this->html = $html;
        if (!empty($from)) {
            if (is_array($from)) {
                $this->from(...$from);
            } else {
                $this->from($from);
            }
        }
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view(preg_match('/^\s*<!DOCTYPE\s+html/i', $this->html) ? 'mail-empty' : 'mail',
                           array_merge($this->data, ['content' => $this->html]));
    }

}
