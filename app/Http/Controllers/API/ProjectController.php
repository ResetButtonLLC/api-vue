<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Responses\DeleteResponse;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function all()
    {
        return ProjectResource::collection(
            Project::with('profiles')->paginate()
        );
    }

    public function index()
    {
        return ProjectResource::collection(
            auth()->user()->load('projects.profiles')->projects
        );
    }

    public function view(Project $project)
    {
        return new ProjectResource($project->load('profiles'));
    }

    public function create(CreateRequest $request)
    {
        /* @var Project $project */
        $project = Project::factory($request->validated())->create();
        $project->users()->attach(auth()->user()->id); //Прикрепляем созданного клиента к юзеру его создавшего

        return new ProjectResource($project);
    }

    public function update(Project $project, UpdateRequest $request)
    {
        $project->fill($request->validated())->save();

        return new ProjectResource($project);
    }


    public function delete(Project $project)
    {
        /* @var Project $project */
        $project->profiles()->delete();
        $project->users()->detach();
        $project->delete();

        return new DeleteResponse();
    }
}
