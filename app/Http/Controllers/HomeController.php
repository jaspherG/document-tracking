<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\RequirementDocument;
use App\Models\RequirementRemark;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function viewDashboard(){
        $user = Auth::user();
        if($user->type == 'Admission'){
            return view('dashboard', compact(['user']))->with('_page', 'dashboard');
        } else if($user->type == 'Registrar'){ 
            return view('registrar-dashboard', compact(['user']))->with('_page', 'dashboard');
        } else {
            abort(404);
        }
    }

    public function samplePageRegistrar(){
        $user = Auth::user();
        return view('sample-page', compact(['user']))->with('_page', 'sample page');
    }

    public function profile(){
        $user = Auth::user();
        return view('profile', compact(['user']))->with('_page', 'profile');
    }

    public function StudentManagement(){
        $user = Auth::user();
        return view('StudentManagement', compact(['user']))->with('_page', 'Student Management');
    }

    public function StudentList(){
        $user = Auth::user();
        $students = User::where('type', 'Student')->get();
        return view('Student-List', compact(['user', 'students']))->with('_page', 'Student List');
    }

    public function editStudent(string $id) {
        $user = Auth::user();
        $formData = User::findOrFail($id);
        if($formData){
            return view('student-edit-form', compact(['user', 'formData']))->with('_page', 'Edit Student');
        }
        abort(404);
    }

    public function Shiftee(){
        $user = Auth::user();
        return view('Shiftee', compact(['user']))->with('_page', 'Shiftee');
    }

    public function CrossEnroll(){
        $user = Auth::user();
        $formData = $this->emptyFormData();
        $admission = Service::findOrFail(4); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('Cross-Enroll', compact(['user', 'formData', 'documents']))->with('_title', '')->with('_page', 'Cross-enroll');
    }

    public function editCrossEnroll(string $id){
        $user = Auth::user();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 4)->first();
        if($formData){
            $admission = Service::findOrFail(4); // 1 = admission
            if ($admission) {
                $documentIds = json_decode($admission->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }
            return view('Cross-Enroll', compact(['user', 'formData', 'documents']))->with('_title', 'Edit')->with('_page', 'Cross-enroll');
        } 
        abort(404);
    }


    public function transferee(){
        $user = Auth::user();
        $formData = $this->emptyFormData();
        $admission = Service::findOrFail(3); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('session.transferee', compact(['user', 'formData', 'documents']))->with('_title', '')->with('_page', 'Transferee');
    }

    public function editTransferee(string $id){
        $user = Auth::user();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 3)->first();
        if($formData){
            $admission = Service::findOrFail(3); // 3 = admission
            if ($admission) {
                $documentIds = json_decode($admission->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }
            return view('session.transferee', compact(['user', 'formData', 'documents']))->with('_title', 'Edit')->with('_page', 'Transferee');
        } 
        abort(404);
    }

    public function admission(){
        $user = Auth::user();
        $formData = $this->emptyFormData();
        $admission = Service::findOrFail(1); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('admission', compact(['user', 'formData', 'documents']))->with('_title', '')->with('_page', 'Admission');
    }

    public function editAdmission(string $id){
        $user = Auth::user();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 1)->first();
        if($formData){
            $admission = Service::findOrFail(1); // 1 = admission
            if ($admission) {
                $documentIds = json_decode($admission->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }

            return view('admission', compact(['user', 'formData', 'documents']))->with('_title', 'Edit')->with('_page', 'Admission');
        } 
        abort(404);
    }

    public function reAdmission(){
        $user = Auth::user();
        $formData = $this->emptyFormData();
        $admission = Service::findOrFail(2); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('laravel-examples.Re-admission', compact(['user', 'formData', 'documents']))->with('_title', '')->with('_page', 'Returnee');
    }

    public function editReAdmission(string $id){
        $user = Auth::user();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 2)->first();
        if($formData){
            $admission = Service::findOrFail(2); // 1 = admission
            if ($admission) {
                $documentIds = json_decode($admission->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }

            return view('laravel-examples.Re-admission', compact(['user', 'formData', 'documents']))->with('_title', 'Edit')->with('_page', 'Returnee');
        } 
        abort(404);
    }

    public function storeRequirement(Request $request) {
        $user = Auth::user();
        $validated = $request->validate([
            'service_id' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email|string',
            'phone_number' => 'required|string|max:11',
            'address' => 'required|string',
            'course' => 'required|string',
            'class_year' => 'required|string',
            'lrn_number' => 'required|string',
            'remarks_name' => 'required|string',
            'remarks_email' => 'required|email|string',
        ]);
    
        // Handle documents
        $documents = $request->input('documents', []);
        $total_documents = count($documents);
        $service = Service::findOrFail($validated['service_id']);
        $documentIds = json_decode($service->document_ids);
        $service_documents = Document::whereIn('id', $documentIds)->get();
        $requirement_status =  $total_documents == count($documentIds) ? 'Completed' : 'Deficiency';
    
        // Check if the user with the same LRN or email already exists
        $student = User::where('lrn_number', $validated['lrn_number'])
                    ->orWhere('email', $validated['email'])
                    ->first();
    
        if (!$student) {
            // Create a new user if no user with the same LRN or email is found
            $validated['password'] = bcrypt(uniqid());
            $validated['type'] = 'Student';
            $student = User::create($validated);
            if($student){
                $new_requirement = new Requirement;
                $new_requirement->service_id = $validated['service_id'];
                $new_requirement->user_id = $user->id;
                $new_requirement->student_id = $student->id;
                $new_requirement->class_year = $validated['class_year'];
                $new_requirement->course = $validated['course'];
                $new_requirement->status = $requirement_status;
                $new_requirement->save();
                
                if($new_requirement->save()){
                    $new_remark = new RequirementRemark;
                    $new_remark->requirement_id = $new_requirement->id;
                    $new_remark->service_id = $validated['service_id'];
                    $new_remark->user_id = $user->id;
                    $new_remark->type = 'store';
                    $new_remark->name =  $request->input('remarks_name');
                    $new_remark->email =  $request->input('remarks_email');
                    $new_remark->save();

                    foreach ($service_documents as $key => $document) {
                        $new_document = new RequirementDocument;
                        $new_document->requirement_id = $new_requirement->id;
                        $new_document->service_id = $validated['service_id'];
                        $new_document->student_id = $student->id;
                        $new_document->document_id = $document->id;
                        $new_document->status = in_array($document->id, $documents) ? 1 : 0;
                        $new_document->save();
                    
                        if ($request->hasFile('file_id_' . $document->id)) {
                            $relativePath = $this->saveImage($request->file('file_id_' . $document->id), $service->service_name);
                            if ($relativePath) {
                                $new_document->image = $relativePath;
                                $new_document->save();
                            } 
                        }
                    }
                }
            }
            session()->flash('success', 'Information save successfully!');
        } else {
            // Update the existing user if found
            $student->update($validated);

            $new_requirement = new Requirement;
            $new_requirement->service_id = $validated['service_id'];
            $new_requirement->user_id = $user->id;
            $new_requirement->student_id = $student->id;
            $new_requirement->class_year = $validated['class_year'];
            $new_requirement->course = $validated['course'];
            $new_requirement->status = $requirement_status;
            $new_requirement->save();
            
            if($new_requirement->save()){
                $new_remark = new RequirementRemark;
                $new_remark->requirement_id = $new_requirement->id;
                $new_remark->service_id = $validated['service_id'];
                $new_remark->user_id = $user->id;
                $new_remark->type = 'store';
                $new_remark->name =  $request->input('remarks_name');
                $new_remark->email =  $request->input('remarks_email');
                $new_remark->save();

                foreach ($service_documents as $key => $document) {
                    $new_document = new RequirementDocument;
                    $new_document->requirement_id = $new_requirement->id;
                    $new_document->service_id = $validated['service_id'];
                    $new_document->student_id = $student->id;
                    $new_document->document_id = $document->id;
                    $new_document->status = in_array($document->id, $documents) ? 1 : 0;
                    $new_document->save();
                
                    if ($request->hasFile('file_id_' . $document->id)) {
                        $relativePath = $this->saveImage($request->file('file_id_' . $document->id), $service->service_name);
                        if ($relativePath) {
                            $new_document->image = $relativePath;
                            $new_document->save();
                        } 
                    }
                }
            }
            session()->flash('success', 'Information save successfully!');
        }
    
        $route_name = $request->input('route_name');
        if( $route_name == 'admission') {
            return redirect()->route('admission')->with('_title', '');
        } else if ( $route_name == 'returnee') {
            return redirect()->route('re-admission')->with('_title', '');
        } else if ( $route_name == 'transferee') {
            return redirect()->route('transferee')->with('_title', '');
        } else if ( $route_name == 'cross-enroll') {
            return redirect()->route('cross-enroll')->with('_title', '');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function updateRequirement(Request $request) {
        $user = Auth::user();
        $validated = $request->validate([
            'student_id' => 'exists:users,id',
            'requirement_id' => 'exists:requirements,id',
            'service_id' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email|string',
            'phone_number' => 'required|string|max:11',
            'address' => 'required|string',
            'course' => 'required|string',
            'class_year' => 'required|string',
            'lrn_number' => 'required|string',
            'remarks_name' => 'required|string',
            'remarks_email' => 'required|email|string',
        ]);
    
        // Handle documents
        $documents = $request->input('documents', []);
        $total_documents = count($documents);
        $service = Service::findOrFail($validated['service_id']);
        $documentIds = json_decode($service->document_ids);
        $service_documents = Document::whereIn('id', $documentIds)->get();
        $requirement_status = $total_documents == count($documentIds) ? 'Completed' : 'Deficiency';
        
        // Check if the user with the same LRN or email already exists
        $student = User::findOrFail($validated['student_id']);
        if($student) {
            // Update the existing user if found
            $student->update($validated);

            $res_requirement = Requirement::findOrFail($validated['requirement_id']);
            $res_requirement->class_year = $validated['class_year'];
            $res_requirement->course = $validated['course'];
            $res_requirement->status = $requirement_status;
            
            if($res_requirement->save()){
                $new_remark = new RequirementRemark;
                $new_remark->requirement_id = $res_requirement->id;
                $new_remark->service_id = $validated['service_id'];
                $new_remark->user_id = $user->id;
                $new_remark->type = 'update';
                $new_remark->name =  $request->input('remarks_name');
                $new_remark->email =  $request->input('remarks_email');
                $new_remark->save();

                $res_document = RequirementDocument::where('requirement_id', $validated['requirement_id'])->get();
                if(count($res_document) > 0) {
                    foreach($res_document as $key => $document) {
                        $old_image = $document->image;
                        $document->status = in_array($document->document_id, $documents) ? 1 : 0;
                        $document->save();

                        if ($request->hasFile('file_id_' . $document->document_id)) {
                            $relativePath = $this->saveImage($request->file('file_id_' . $document->document_id), $service->service_name);
                            if ($relativePath) {
                                $document->image = $relativePath;
                                $document->save();
                            } 

                            if (!empty($old_image)) {
                                $absolutePath = 'images/'.$service->service_name;
                                $this->deleteImage($absolutePath,$old_image);
                            }
                        }
                    }
                }
                
            }
            session()->flash('success', 'Information update successfully!');
        }
        $route_name = $request->input('route_name');
        if( $route_name == 'admission') {
            return redirect()->route('edit.admission', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else if ( $route_name == 'returnee') {
            return redirect()->route('edit.re-admission', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else if ( $route_name == 'transferee') {
            return redirect()->route('edit.transferee', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else if ( $route_name == 'cross-enroll') {
            return redirect()->route('edit.cross-enroll', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else {
            return redirect()->route('dashboard');
        }
       
    }

    private function saveImage($image, $folderpath) {
        $folder = 'images/'.$folderpath;
        $filename = uniqid() . '_' . time();
        
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0777, true); // Recursively create directory
        }
        $extension = $image->getClientOriginalExtension();
        $filenameWithExtension = $filename . '.' . $extension;
        $file = $image;
        $file-> move(public_path($folder), $filenameWithExtension);
        return $filenameWithExtension;
    }

    private function emptyFormData(){
        $user_data = new \stdClass();
        $user_data->name = '';
        $user_data->email = '';
        $user_data->phone_number = '';
        $user_data->course = '';
        $user_data->class_year = '';
        $user_data->address = '';
        $user_data->lrn_number = '';
        $formData = new \stdClass();
        $formData->user_student = $user_data;
        $formData->requirement_documents = [];

        return $formData;
    }

    private function deleteImage($folderpath, $image){
        $filePath = public_path($folderpath . '/' . $image);
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
        return false;
    }


    
}

