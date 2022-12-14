<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Responses\DeleteResponse;
use App\Models\Project;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('admin')) {
            return new ProjectResource($project->load('profiles','users'));
        }
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
        if ($request->validated("users")) {
            $project->users()->sync($request->validated("users"));
        }
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
