<?php

declare(strict_types=1);

namespace Core;

use Throwable;

class Controller
{

    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Execute controller action with centralized error handling.
     */
    public function executeAction(string $action): void
    {
        try {
            $this->{$action}();
        } catch (Throwable $e) {
            Logger::error('Controller action failed', [
                'controller' => static::class,
                'action' => $action,
                'message' => $e->getMessage()
            ]);

            if (class_exists(Session::class)) {
                Session::flash('msg', 'Da co loi xay ra, vui long thu lai.');
                Session::flash('msg_type', 'danger');
            }

            if (!headers_sent() && function_exists('redirect')) {
                redirect('/');
                return;
            }

            http_response_code(500);
            if (defined('APP_DEBUG') && APP_DEBUG === true) {
                echo '<pre>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
            } else {
                echo 'Something went wrong. Please try again later.';
            }
        }
    }
}
