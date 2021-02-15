<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasFetchAllRenderCapabilities;
use App\Http\Requests\ActorRequest;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ActorController extends Controller
{

    use HasFetchAllRenderCapabilities;

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {

        $this->setGetAllBuilder(Actor::query());
        $this->setGetAllOrdering('name', 'asc');
        $this->parseRequestConditions($request);
        return new ResourceCollection($this->getAll()->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Actor
     */
    public function store(ActorRequest $request)
    {
        $actor = new Actor($request->validated());
        $actor->save();

        return $actor;
    }

    /**
     * Display the specified resource.
     *
     * @param Actor $actor
     * @return \App\Http\Resources\Actor
     */
    public function show(Actor $actor)
    {
        return new \App\Http\Resources\Actor($actor);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Http\Resources\Actor
     */
    public function update(\App\Models\Actor $actor, ActorRequest $request)
    {
        $actor->fill($request->validated());
        $actor->save();

        return new \App\Http\Resources\Actor($actor);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Actor $actor
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();

        return response()->noContent();
    }


    public function appearances($name)
    {

        $actor = Actor::where('name', $name)->first();

        if (! $actor){
            return response()->json([
                'error' => 'Actor not found.'],
                200
            );
        }

        $moviesByActor = Actor::find($actor->id)
                ->getMovies()
                ->get();

        if(! $moviesByActor){

            return response()->json([
                'error' => 'Data not found.'],
                200
            );

        }

        return response()->json($moviesByActor);
    }


    public function favoriteGenre($name)
    {

        $actor = Actor::where('name', $name)->first();

        if (! $actor){
            return response()->json([
                'error' => 'Actor not found.'],
                200
            );
        }

        $actorFavoriteGenre = Actor::getFavoriteGenre($actor->id);

        if (! $actor){
            return response()->json([
                'error' => 'Data not found.'],
                200
            );
        }

        $actorFavoriteGenre['name'] = $name;


        return response()->json($actorFavoriteGenre);

    }
}
