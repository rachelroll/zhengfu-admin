<?php

namespace App\Nova;

use Acme\StripeInspector\StripeInspector;
use App\Nova\Actions\SyncMovieFile;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;

use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Movie extends Resource
{
    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['category'];

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Movie';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'category',
    ];


    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            StripeInspector::make(),
            Text::make('电影名称', 'name'),
            Text::make('电影导演', 'director'),
            Text::make('电影主演', 'actors'),
            Text::make('电影编剧', 'editor'),
            Text::make('上映地区', 'region'),
            Text::make('语言', 'language'),
            Date::make('上映日期', 'date'),
            Textarea::make('电影简介', 'description'),
            //Image::make('封面图', 'cover')->disk('public')->hideFromIndex(),
            //Text::make('资源路径', 'path'),
            Text::make('备注', 'remark')->nullValues(['']),
            BelongsTo::make('类型', 'category', 'App\Nova\Category')->sortable(),

            Select::make('Name format', 'name_format')->options([
                0 => 'First Name',
                1 => 'First Name / Last Name',
                2 => 'Full Name'
            ])->displayUsingLabels(),

            NovaDependencyContainer::make([
                Text::make('First Name', 'first_name')
            ])->dependsOn('name_format', 0),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new SyncMovieFile(),

        ];
    }

    public static function label()
    {
        return '电影';
    }


}
