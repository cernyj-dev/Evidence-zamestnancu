<?php

namespace App;

use Twig\Environment;

class Router
{
    private readonly StaticDatabase $database;

    public function __construct(
        private readonly Environment $twig,
    ) {
        $this->database = new StaticDatabase();
    }

    public function process(array $params): string
    {
        switch ($params['page'] ?? null) {
            case null:
                return $this->renderIndex();
            case 'employees':
                return $this->renderEmployees();
            case 'employee_details':
                return $this->handleEmployeeDetails($params);
            case 'employee_account_details':
                return $this->handleEmployeeAccountDetails($params);
            case 'error_page':
                return $this->renderError('Error Page');
            default:
                return $this->renderError('ERROR');
        }
    }

    /**
     * @return string
     */
    public function renderIndex(): string
    {
        $template = $this->twig->load('title_page.html.twig');

        return $template->render([
            'title' => 'Titulní stránka',
            'employees' => $this->database->getEmployees(),
        ]);
    }


    /**
     * @return string
     */
    public function renderEmployees(): string
    {
        $template = $this->twig->load('employees.html.twig');

        return $template->render([
            'title' => 'Seznam zaměstnanců',
            'employees' => $this->database->getEmployees(),
        ]);
    }

    /**
     * @param array $params
     * @return string
     */

    public function handleEmployeeDetails(array $params): string
    {
        if (!array_key_exists('id', $params)) {
            return $this->renderError('NOT FOUND');
        }

        $template = $this->twig->load('employee_details.html.twig');
        $employee = $this->database->getEmployeeById((int)$params['id']);

        if ($employee === null) {
            return $this->renderError('NOT FOUND');
        }

        return $template->render([
            'title' => "Detail: {$employee->name}",
            'employee' => $employee,
        ]);
    }


    /**
     * @param array $params
     * @return string
     */
    public function handleEmployeeAccountDetails(array $params): string
    {
        if (!array_key_exists('id', $params)) {
            return $this->renderError('NOT FOUND');
        }

        $template = $this->twig->load('account_details.html.twig');
        $employee = $this->database->getEmployeeById((int)$params['id']);

        if ($employee === null) {
            return $this->renderError('NOT FOUND');
        }

        return $template->render([
            'title' => "{$employee->name}'s Account Details",
            'employee' => $employee,
        ]);
    }

    /**
     * @param string $message
     * @return string
     */
    public function renderError(string $message): string
    {
        $template = $this->twig->load('error.html.twig');

        return $template->render([
            'title' => $message,
            'message' => $message,
        ]);
    }
}