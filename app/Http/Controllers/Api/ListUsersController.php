<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListUsersController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::query()
            ->has('transactions')
            ->select(DB::raw('distinct users.id , users.*'))
            ->leftJoin('transactions', 'transactions.user_id', 'users.id')
            ->search($request)
            ->orderBy('users.id', 'desc')
            ->paginate($request->per_page ?? 15);

        return paginateResponse(data: UserResource::collection($users), collection: $users);
    }
}
