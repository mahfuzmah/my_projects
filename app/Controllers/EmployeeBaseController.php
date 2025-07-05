<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class EmployeeBaseController extends Controller
{
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();

        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login')->send();
            exit;
        }
    }
}
