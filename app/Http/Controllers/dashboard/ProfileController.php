<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit(){
        $user = Auth::user();
        return view('dashboard.profile.edit',[
            'user' => $user,
            'countries' => Countries::getNames(),
            'locales' => Languages::getNames()
        ]);
    }


    public function update(Request $request)
    {

        $request->validate([
            'first_name' => ['required' , 'string ', 'max:255'],
            'last_name'  => ['required ', 'string ', 'max:255'],
            'country'    => ['string', 'required', 'size:2'],
            'gender'     => ['in:male,female'],
            'birthday'   => ['date', 'before:today', 'nullable']

        ]);

        $user = $request->user();
        $user->profile->fill($request->all())->save();
        return redirect()->route('dashboard.profile.edit')
        ->with('success', 'profile updated');
    }

//     public function update(Request $request)
// {
//     $request->validate([
//         'first_name' => ['required', 'string', 'max:255'],
//         'last_name'  => ['required', 'string', 'max:255'],
//         'country'    => ['string', 'required', 'size:2'],
//         'gender'     => ['in:male,female'],
//         'birthday'   => ['date', 'before:today', 'nullable']
//     ]);

//     $user = $request->user();
//     $profile = $user->profile;

//     // تحديث الحقول بشكل صريح
//     $profile->first_name = $request->input('first_name');
//     $profile->last_name = $request->input('last_name');
//     $profile->country = $request->input('country');
//     $profile->gender = $request->input('gender');
//     $profile->birthday = $request->input('birthday');
//     // يمكنك إضافة المزيد من الحقول هنا إذا لزم الأمر

//     $profile->save();

//     return redirect()->route('dashboard.profile.edit')
//         ->with('success', 'Profile updated');
// }

}
