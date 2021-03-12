<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\ClientRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store a client request.
     *
     * @param StoreClientRequest $request
     * @return view
     */
    public function store(StoreClientRequest $request)
    {
        $input = $request->input();

        try {
            $response = ClientRequest::addRequest($input['email'], $input['first_name'], $input['last_name']);
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['msg' => $exception->getMessage()]);
        }

        return redirect()->back()->with('message', 'Message has been succesfully send');
    }
}
