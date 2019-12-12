<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\SpokenLanguages;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function updateRole(Request $request){
        if(Auth::user()->id == User::find($request->userId)->id){
            return ["status" => "ERROR", "type" => "Permission non accordée", "message" => "Vous ne pouvez pas modifier vos propres droits" ];
        }else{
            $user = User::find($request->userId);
            $user->role = $request->role;
            $user->save();
            return ["status" => "SUCCESS", "type" => "", "message" => "" ];
        }
    }

    public function modifyPassword(Request $request){
        
        
        if (!(Hash::check($request->get('oldPassword'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("errorPswd","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('oldPassword'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("errorPswd","New Password cannot be same as your current password. Please choose a different password.");
        }
      
        $validatedData = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        //Change Password
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->back()->with("Passwordsuccess","Password changed successfully !");

    }
    public function modifyMail(Request $request){
        $mail = $request->email;
        // return Validator::make($request, [
            
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            
        // ]);

        try {
            $user = User::find(Auth::user()->id);
            $user->email=$mail;
           
            $user->save();
            
        }catch(QueryException $e){
           
           return redirect("modifyProfile")->withErrors(["email" => "E mail déjà utilisé"]);

        }
        return redirect('modifyProfile')->with('validEmail', 'succès');
       

    }
    public function modifyLanguages(Request $data){
    
        $user = User::find(Auth::user()->id);
        try {
            DB::beginTransaction();
            $cpt = 0;
            do {
                $spokenLanguage = new SpokenLanguages();
                $spokenLanguage->user_id = $user->id;
                $spokenLanguage->languageISO = $data['languages'][$cpt];
                $success = $spokenLanguage->save();
                $cpt++;
            } while ($success && $cpt < count($data['languages']));
            if (!$success) {
                DB::rollback();
            } else {
                DB::commit();
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["ErrorLanguages" => "Erreur lors de l'ajout de langue"]);
            DB::rollback();
        }
        return redirect()->back()->with('ValidAddLang', 'succès');


    }

    public function admin_credential_rules(Request $data){
         $messages = [
            'oldPassword.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'oldPassword' => 'required',
            'password' => 'required|same:password',
            'passwordConfirm' => 'required|same:password',     
        ], $messages);

        return $validator;
    }  
}
