<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ValidateProjectRequest;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('attributeValues.attribute')
          ->withFilters($request->filters)
          ->get();
        return response()->json($projects, 200);
    }


    public function store(ValidateProjectRequest $request)
    {
        $validatedData = $request->validated();

        //using transaction to ensure data integrity
        DB::transaction(function () use ($validatedData) {
            $project = Project::create([
                'name' => $validatedData['name'],
                'status' => $validatedData['status'],
            ]);

            //create project attributes
            if (isset($validatedData['attributes'])) {
                foreach ($validatedData['attributes'] as $attribute) {
                    AttributeValue::create([
                        'attribute_id' => $attribute['attribute_id'],
                        'entity_id' => $project->id,
                        'value' => $attribute['value'],
                    ]);
                }
            }



        });
        return response()->json([
            'message' => 'Project created successfully',
        ], 201);

    }

    public function show(Project $project)
    {
        return response()->json($project->load('attributeValues.attribute'), 200);
    }

    /*
    * Assign user to project
    */

    public function assignUserToProject(Project $project, User $user)
    {
        if (!$project->users->contains($user)) {
            $project->users()->attach($user);
            return response()->json([
                'message' => 'User assigned to project successfully',
                'data' => $project->load('users'),
            ], 201);
        } else {
            return response()->json([
                'message' => 'User already assigned to project',
                'data' => $project->load('users'),
            ], 409);
        }
    }

    /*
    * Unassign user from project
    */
    public function removeUserToProject(Project $project, User $user)
    {
        $project->users()->detach($user);
        return response()->json([
            'message' => 'User removed from project successfully',
            'data' => $project->load('users'),
        ], 201);
    }

    public function update(ValidateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated();

        DB::transaction(function () use ($validatedData, $project) {
            $project->update([
             'name' => $validatedData['name'] ?? $project->name,
             'status' => $validatedData['status'] ?? $project->status,
            ]);

            //create or update  project attributes
            if (isset($validatedData['attributes'])) {
                foreach ($validatedData['attributes'] as $attribute) {
                    AttributeValue::updateOrCreate([
                        'attribute_id' => $attribute['attribute_id'],
                        'entity_id' => $project->id,
                    ], [
                        'value' => $attribute['value'],
                    ]);
                }
            }
        });

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project->load('attributeValues'),
        ], 201);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        //delete all associated attribute values of the project
        AttributeValue::where('entity_id', $project->id)->delete();

        return response()->json([
           'message' => 'Project deleted successfully',
        ], 200);
    }


}
