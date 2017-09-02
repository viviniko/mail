<?php

namespace Viviniko\Mail\Services\Template;

use Viviniko\Mail\Contracts\TemplateService;
use Viviniko\Mail\Exceptions\MailTemplateNotFoundException;
use Viviniko\Mail\Models\Template;
use Viviniko\Mail\Repositories\Template\TemplateRepository;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Str;

class TemplateServiceImpl implements TemplateService
{
    /**
     * @var TemplateRepository
     */
    protected $templates;

    /**
     * @var \Twig\Environment
     */
    protected $twig;

    /**
     * TemplateManager constructor.
     * @param TemplateRepository $templates
     */
    public function __construct(TemplateRepository $templates) {
        $this->templates = $templates;
        $this->twig = new \Twig\Environment(new \Twig\Loader\ArrayLoader());
        $this->twig->setLexer(new \Twig\Lexer($this->twig, ['tag_block' => ['<!--', '-->']]));
    }

    /**
     * Get mail message.
     *
     * @param  mixed  $key
     * @param  array  $data
     * @return  null|Mailable
     * @throws MailTemplateNotFoundException
     */
    public function makeMail($key, $data) {
        $template = $key instanceof Template ? $key : (preg_match('/^[.\w]+$/', $key) ? $this->get($key) : $key);

        if (!$template) {
            throw new MailTemplateNotFoundException();
        }

        return new Message(...$this->render($template, $data));
    }

    /**
     * Get mail template.
     *
     * @param mixed $idOrKey
     * @return Template|null
     */
    public function get($idOrKey) {
        return is_numeric($idOrKey) ? $this->templates->find($idOrKey) : $this->templates->findByKey($idOrKey);
    }

    /**
     * Get templates by group => [id => name].
     *
     * @return array
     */
    public function groupPluck() {
        return $this->templates->all()->map(function($item) {
            if (empty($item->group)) {
                $item->group = '*';
            }
            return $item;
        })->groupBy('group')->map(function($items) {
            return $items->pluck('name', 'id');
        })->toArray();
    }

    /**
     * Mail template render.
     *
     * @param mixed $template
     * @param $data
     * @return array
     */
    protected function render($template, $data) {
        if ($template instanceof Template) {
            $subject = $this->renderHtml($template->subject, $data);
            $content = $this->renderHtml($template->content, $data);
            $from = $this->parseFrom($template->from, $data);
        } else {
            $content = $this->renderHtml($template, $data);
            $subject = Str::words(strip_tags($content), 20);
            $from = null;
        }

        return [$subject, $content, $from, $data];
    }

    /**
     * Replace { name }.
     *
     * @param string $html
     * @param array $data
     * @return string
     */
    protected function parseHtml($html, $data) {
        if (preg_match_all(sprintf('/{\s*(\w+)\s*}(\r?\n)?/s', '', '', ''), $html, $matches) > 0) {
            return str_replace($matches[0], array_map(function($name) use ($data) {
                return data_get($data, $name);
            }, $matches[1]), $html);
        }

        return $html;
    }

    protected function renderHtml($html, $data) {
        return $this->twig->createTemplate($html)->render($data);
    }

    protected function parseFrom($from, $data) {
        $config = config('mail.from');
        $name = $config['name'];
        $address = $config['address'];
        $domain = $data['domain'] ?? (explode('@', $address, 2)[1]);
        $from = trim($from);

        if (!empty($from)) {
            if (strpos($from, ',') !== false) {
                list($name, $address) = preg_split('/\s*,\s*/', $from, 2);
            } else {
                $name = $from;
            }
        }

        if (strpos($address, '@') === false) {
            $address .= "@{$domain}";
        }

        return [$address ?? $config['name'], $name ?? $config['name']];
    }

    public function __call($method, $parameters) {
        if (method_exists($this->templates, $method)) {
            return $this->templates->$method(...$parameters);
        }

        throw new \BadMethodCallException("Method [{$method}] does not exist.");
    }
}