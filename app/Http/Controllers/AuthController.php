<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    // use PasswordValidationRules;

    public function login(Request $request)
    {

        try {

            $validate = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'status'    => 'error',
                    'msg'       => 'Validators error',
                    'errors'    =>  $validate->errors(),
                    'content'   =>  null,
                ];
                // dd($response);
                return response()->json($response, 500);
            } else {
                $credential = request(['email', 'password']);
                // $credential     = Arr::add($credential, 'status', 'aktif');

                // dd($credential);

                if (!Auth::attempt($credential)) {

                    $response = [
                        'status'    => 'error',
                        'msg'       => 'Unauthorized',
                        'errors'    =>  'null',
                        'content'   =>  'null',
                    ];
                    return response()->json($response, 401);
                }
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new Exception('error in login');
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $response = [
                'status'    => 'success',
                'msg'       => 'Login Succesfully',
                'errors'    =>  'null',
                'content'   =>  [
                    'status_code'   => '200',
                    'access_token'  => $tokenResult,
                    'token_type'    => 'Bearer'
                ],
            ];

            return response()->json($response, 200);
        } catch (\Throwable $error) {
            $response = [
                'status'    => 'success',
                'msg'       => 'something wen wrong',
                'errors'    =>  $error,
                'content'   =>  ''
            ];

            return response()->json($response, 500);
        }
    }



    // public function registrasi(Request $request) 
    public function registrasi(Request $request)
    {

        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'status' => ['required', 'string', 'max:255'],
                'password' => ['required','string'],
            ]);

            $user = User::create([
                'name' =>$data['name'],
                'email' => $data['email'],
                'status' => $data['status'],
                'password' => Hash::make($request->password),
                'created_at' => now(),
            ]);


            $tokenResult = $user->createToken('authToken')->plainTextToken;
            $response = [
                'status'    => 'success',
                'msg'       => 'Register Succesfully',
                'errors'    =>  'null',
                'content'   =>  [
                    'status_code'   => '200',
                    'access_token'  => $tokenResult,
                    'token_type'    => 'Bearer'
                ],
            ];
            return response()->json($response, 520);

        } catch (Exception $error) {
            $response = [
                'status'    => 'success',
                'msg'       => 'something wen wrong',
                'errors'    =>  $error,
                'content'   =>  ''
            ];

            return response()->json($response, 500);
        }

    }


    public function fetch(Request $request)
    {

        $response = [
            'status'    => 'success',
            'msg'       => 'successfully',
            'errors'    =>  null,
            'content'   =>  [$request->user()]
        ];

        return response()->json($response, 200);
    }
    
    public function updateProfilePut(Request $request,$id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required','string'],
        ]);

        // dd($id);

        $dataUser=User::find($id);
        if($dataUser){
            $dataUser->name = $data['name'];
            $dataUser->status = $data['status'];
            $dataUser->update();
            return response()->json(["message"=>"update succesfully"],200);
        } else {
            return response()->json(["message"=>"User not found"],404);
        }
    }

    public function updateProfilePost(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'int', 'max:10'],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required','string'],
        ]);

        // dd($data);

        $dataUser=User::find($data['id']); 
        // dd( $dataUser );

        if($dataUser){
            $dataUser->name = $data['name'];
            $dataUser->status = $data['status'];
            $dataUser->update();
            return response()->json(["message"=>"update succesfully"],200);
        } else {
            return response()->json(["message"=>"User not found"],404);
        }
    }

    public function destroy($id){
        $data = User::find($id);
        if($data){
            $data->delete();
            return response()->json(["message"=>"Delete succesfully"],200);
        } else {
            return response()->json(["message"=>"User not found"],404);
        }
    }

}
