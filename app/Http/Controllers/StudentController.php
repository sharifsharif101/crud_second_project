<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;
 
class StudentController extends Controller
{
public function index(){
        return view('student.index');
     }
public function fetchstudent(){
         $student =Student::all();
         return response()->json([
            'student'=>$student,
         ]);
      }

public function store(Request $request){
         
               // 'name'=> 'required|max:191',
               // 'course'=>'required|max:191',
               // 'email'=>'required|email|max:191',
               // 'phone'=>'required|max:10|min:10',

                     $validator = Validator::make($request->all(), [
                           'name'=> 'required|max:191',
                           'course'=>'required|max:191',
                           'email'=>'required|max:191',
                           'phone'=>'required|max:500|min:1',
                     ]);

                        if($validator->fails()){
                           return response()->json([
                              'status'=>400,
                              'errors'=>$validator->messages(),
                           ]);
                        }
                     else
                        {
                           $student = new Student;
                           $student->name = $request->input('name');
                           $student->email = $request->input('email');
                           $student->course = $request->input('course');
                           $student->phone = $request->input('phone');
                           $student->save();
                           return response()->json([
                              'status'=>200,
                              'message'=>'Student Added Successfully.'
                           ]);
                     }

         }

public function edit($id){
      $student = Student::find($id);
      if($student){
         return response()->json([
         'status'=>200,
         'student'=>$student,
         ]);
      }
      else {
         return response()->json([
            'status'=>400,
            'message'=>'student Not found',
         ]);
      }

   }
      
 


   public function update(Request $request, $id)
   {
      $validator = Validator::make($request->all(), [
         'name'=> 'required|max:191',
         'course'=>'required|max:191',
         'email'=>'required|max:191',
         'phone'=>'required|max:500|min:1',
   ]);

       if($validator->fails())
       {
           return response()->json([
               'status'=>400,
               'errors'=>$validator->messages()
           ]);
       }
       else
       {
           $student = Student::find($id);
           if($student)
           {
               $student->name = $request->input('name');
               $student->course = $request->input('course');
               $student->email = $request->input('email');
               $student->phone = $request->input('phone');
               $student->update();
               return response()->json([
                   'status'=>200,
                   'message'=>'Student Updated Successfully.'
               ]);
           }
           else
           {
               return response()->json([
                   'status'=>404,
                   'message'=>'No Student Found.'
               ]);
           }

       }
   }

   public function destroy ($id){
      $student =Student::find($id);
      $student->delete();
      return response()->json([
         'status'=>200,
         'message'=>'  Student  Deleted Successfully.'
     ]);
      
   }



}



 