<?php

namespace Viviniko\Mail\Providers;

use Illuminate\Mail\TransportManager;
use Illuminate\Support\ServiceProvider;
use Swift_Mailer;
use Swift_SmtpTransport as SmtpTransport;

class SendgridServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend('swift.transport', function(TransportManager $manager) {
            $this->app->singleton('sendgrid.swift.mailer', function($app) {
                return new Swift_Mailer($app['swift.transport']->driver('sendgrid'));
            });

            $manager->extend('sendgrid', function() {
                $config = $this->app['config']['mail'];
                $config = array_merge($config, is_array($config['sendgrid']) ? $config['sendgrid'] : []);

                $transport = new SmtpTransport($config['host'], $config['port']);

                if (isset($config['encryption'])) {
                    $transport->setEncryption($config['encryption']);
                }

                if (isset($config['username'])) {
                    $transport->setUsername($config['username']);
                    $transport->setPassword($config['password']);
                }

                return $transport;
            });

            return $manager;
        });
    }
}
