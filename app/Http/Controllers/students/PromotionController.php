<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Repository\StudentPromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $promotion;
    public function __construct(StudentPromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }

    public function index()
    {
        return $this->promotion->index();
    }

    public function create()
    {
        return $this->promotion->create();
    }

    public function store(Request $request)
    {
        return $this->promotion->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        return $this->promotion->destroy($request);
    }
}
