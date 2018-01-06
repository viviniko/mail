<?php

namespace Viviniko\Mail\Services;

class SendGridApi
{
    protected $variableTag = ['{{', '}}'];

    public function getTemplates()
    {
        $response = $this->client()->templates()->get();
        return collect($this->getResponseData($response)['templates']);
    }

    public function getTemplate($templateId)
    {
        $response = $this->client()->templates()->_($templateId)->get();
        return $this->getResponseData($response, false);
    }

    public function getVariablesFromTemplate($template)
    {
        if (!is_object($template)) {
            $template = $this->getTemplate($template);
        }

        $variables = [];
        foreach ($template->versions as $version) {
            preg_match_all(sprintf('/%s\s*(\w+)\s*%s/', $this->variableTag[0], $this->variableTag[1]), $version->html_content, $matches);
            $variables = array_merge($variables, array_combine($matches[0], $matches[1]));
        }

        return array_unique($variables);
    }

    public function sendMail($mail)
    {
        $response = $this->client()->mail()->send()->post($mail);
        if ($response->statusCode() != 202) {
            dd($response);
            return false;
        }

        return true;
    }

    public function makeMail($customers, array $options = [])
    {
        $mail = new \stdClass();
        // subject
        if (!empty($options['subject'])) {
            $mail->subject = $options['subject'];
        }
        // content
        if (!empty($options['content'])) {
            $mail->content = [];
            $content = new \stdClass();
            $content->type = 'text/html';
            $content->value = $options['content'];
            $mail->content[] = $content;
        }
        // category
        if (!empty($options['categories'])) {
            $mail->categories = $options['categories'];
        }
        // from
        $mail->from = new \stdClass();
        if (!empty($options['from'])) {
            if (is_array($options['from'])) {
                $mail->from->email = trim(data_get($options['from'], 'address'));
                $mail->from->name = trim(data_get($options['from'], 'name'));
            } else {
                $mail->from->email = $options['from'];
            }
            if (!$mail->from->name) {
                $mail->from->name = title_case(explode('@', $mail->from->email)[0]);
            }
        } else {
            $mail->from->email = config('mail.from.address');
            $mail->from->name = config('mail.from.name');
        }
        // send at
        if (!empty($options['send_at'])) {
            $mail->send_at = $options['send_at'];
        }
        // template
        $templateVariables = null;
        if (!empty($options['template_id'])) {
            $mail->template_id = $options['template_id'];
            $templateVariables = $this->getVariablesFromTemplate($mail->template_id);
        }
        // personalizations
        $mail->personalizations = [];
        foreach ($customers as $customer) {
            $personalization = new \stdClass();
            // to
            $personalization->to = [];
            $to = new \stdClass();
            $to->email = $customer->email;
            $to->name = $customer->first_name . ' ' . $customer->last_name;
            if (empty(trim($to->name))) {
                $to->name = title_case(explode('@', $to->email)[0]);
            }
            $personalization->to[] = $to;
            // custom_args
            if (!empty($templateVariables)) {
                $substitutions = new \stdClass();
                foreach ($templateVariables as $originVariable => $variable) {
                    if ($customer instanceof Customer && in_array($variable, ['firstname', 'lastname'])) {
                        $variable = 'customer_' . $variable;
                    }
                    $substitutions->$originVariable = data_get($customer, $variable);
                }
                $personalization->substitutions = $substitutions;
            }


            $mail->personalizations[] = $personalization;
        }

        return $mail;
    }

    protected function getResponseData($response, $assoc = true)
    {
        if ($response->statusCode() == 200) {
            return json_decode($response->body(), $assoc);
        }

        throw new SendGridException($response->body(), $response->statusCode());
    }

    /**
     * @return \SendGrid\Client
     */
    public function client()
    {
        return (new \SendGrid(env('SENDGRID_API_KEY')))->client;
    }
}