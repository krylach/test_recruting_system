<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Http\Requests\CandidateRequest;
use App\Http\Requests\SearchCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Entities\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Candidate $candidate)
    {
        return CandidateResource::collection($candidate->all());
    }

    public function search(SearchCandidateRequest $request, Candidate $candidate)
    {
        return CandidateResource::collection($candidate->search($request->search)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        $candidate = Candidate::create($request->only('name', 'email', 'status'));
        $candidate->skills()->syncWithoutDetaching($request->skills);

        return CandidateResource::collection([$candidate]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CandidateResource::collection(Candidate::find($id));
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
    public function update(UpdateCandidateRequest $request, $id)
    {
        try {
            Candidate::find($id)->update($request->only('name', 'email'));
            Candidate::find($id)->skills()->sync($request->skills);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['id' => 'This identifier does not exist.']], 422);
        }
        
        return CandidateResource::collection([Candidate::find($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $candidate = Candidate::find($id);
            $candidate->notes()->delete();
            $candidate->skills()->detach();
            $candidate->delete();
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['id' => 'This identifier does not exist.']], 422);
        }
    }
}
