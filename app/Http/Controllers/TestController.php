<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $path = public_path('files');
        $files = File::allFiles($path);
        $name_arr = [];
        collect($files)->each(function ($item,$key) use (&$name_arr) {
            if ( $item->getExtension() == 'mp4' ) {
                $name_arr[] = $item->getRelativePathname();
            }
        });
        $movies = Movie::all();
        $movie_path = [];
        $movies->each(static function ($item) use (&$movie_path) {
            $movie_path[] = $item->path;
        });

        $diff = collect($name_arr)->diff($movie_path);
        //dd($diff);
        $insert_data = [];
        $diff->each(function ($item) use(&$insert_data) {
            preg_match('/([\w]+)(\/)([\s\S]*)(.mp4)/', $item, $matches);
            if (isset($matches[1])) {
                [$path, , ,$name] = $matches;
                $insert_data[] = [
                    'name' => $name,
                    'cover' => $name . '.png',
                    'path' =>  $path,
                    'enabled' =>  1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        });

        DB::table('movies')->insert($insert_data);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
