<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminController extends Controller
{
    public function createCategory(Request $request)
    {
        try {
            $name = $request->input('name');
            $type = $request->input('type');
            $icon_url = $request->input('icon_url');
            
            $newCategory = Category::create([
                'name'=> $name,
                'type'=>$type,
                'icon_url'=>$icon_url
            ]);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category created successfully",
                    "data" => $newCategory
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error creating category"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getAllUsers(Request $request)
    {
        try {
            $users = User::query()->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Users retrieved successfully",
                    "data" => $users
                ],
                Response::HTTP_OK
            );  
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all users"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function inactivateUser(Request $request,$id)
    {
        try{
            $user=User::query()->findOrFail($id);
            if($user->is_active===false){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "User is already inactive"
                    ],
                    Response::HTTP_OK
                );
            }
            $user->is_active = false;
            $user->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Inactivated user"
                ],
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "User not found"
                ]
                ,
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error inactivating user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
         }
    }

    public function activateUser(Request $request, $id)
    {
        try{
            $user=User::query()->findOrFail($id);
            if($user->is_active===true){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "User is already active"
                    ],
                    Response::HTTP_OK
                );
            }
            $user->is_active = true;
            $user->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "User activated successfully"
                ],
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "User not found"
                ]
                ,
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error activated user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
         }
    }

    public function getAllCategories(Request $request)
    {
        try {
            $categories = Category::query()->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "All categories retrieved successfully",
                    "data" => $categories
                ],
                Response::HTTP_OK
            );  
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all categories"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function deleteCategoryById(Request $request, $id)
    {
        try {
            Category::destroy($id);
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category deleted successfully"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            $errorCode = $th->errorInfo[1];
            if ($errorCode == 1451) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Cannot delete the category. It is referenced in another table."
                    ],
                    Response::HTTP_CONFLICT
                );
            }
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error deleting category"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function editUserRole(Request $request, $id)
    {
        try {
            $userToEdit = User::query()
                ->findOrFail($id);

            $newRole = $request->input('role');

            $userToEdit->role = $newRole;
            $userToEdit->save();

            return response()->json(
                [
                    "success" => true,
                    'message' => 'Role updated successfully',
                    'data'=> $userToEdit
                ],
                Response::HTTP_OK
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json(
                [
                    "success" => false,
                    "message" => "User not found"
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error updating role"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function inactivateCategory(Request $request,$id)
    {
        try{
            $category=Category::query()->findOrFail($id);
            if($category->is_active==false){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Category is already inactive"
                    ],
                    Response::HTTP_OK
                );
            }
            $category->is_active = false;
            $category->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Inactivated category"
                ],
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Category not found"
                ]
                ,
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error inactivating category"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
         }
    }

    public function activateCategory(Request $request, $id)
    {
        try{
            $category=Category::query()->findOrFail($id);
            if($category->is_active==true){
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Category is already active"
                    ],
                    Response::HTTP_OK
                );
            }
            $category->is_active = true;
            $category->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category activated successfully"
                ],
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Category not found"
                ]
                ,
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error activated category"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
         }
    }
}
