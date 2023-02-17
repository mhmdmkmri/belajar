<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Dummy;

class DummyController extends BaseController
{
    private Dummy $dummy;

    public function __construct()
    {
        $this->dummy = new Dummy;
    }

    public function index()
    {
        //
        
        if ($this->request->isAJAX()) {

            $start = $this->request->getGet('start') ?? date('Y-m-d', strtotime("-7 day"));;
            $end = $this->request->getGet('end') ?? date("Y-m-d");
    
            $dummy = $this->dummy->select("*");
    
            if ($start && $end) {
                $dummy->where('created_at >=', $start);
                $dummy->where('created_at <=', $end);
            }
    
            $dum = $dummy->orderBy('created_at', 'ASC')->findAll();

            return $this->response->setJSON(['data' => $dum]);
        }

        return view('index');
    }
}