<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::query()->paginate(10);
        return view('admin.profiles.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $profile)
    {
        return view('admin.profiles.edit', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $profile)
    {
        $updated = $profile->fill($request->all())->save();

        if($updated){
            return redirect()->route('admin.profiles.index')
                ->with('success', 'Права успешно обновлены!');
        }

        return back()->with('error','Не удалось обновить права')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $profile)
    {
        try{
            $profile->delete();
            return response()->json('ok');
        }catch(\Exception $e) {
            \Log::error("Error delete users");
        }
    }
}
