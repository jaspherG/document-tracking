<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Program;
use App\Models\Service;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\RequirementDocument;
use App\Models\RequirementRemark;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    // public function dashboardReport(Request $request, string $status) {
    //     $user = Auth::user();
    //     $programs = Program::all();
    //     $services = Service::select('id', 'service_name')->get();
    //     $academic_years = Requirement::distinct()->pluck('academic_year');
    //     $service = Service::with(['requirements' => function($q) use($status) {
    //         if(isset($status)) {
    //             $q->where('status', ucfirst($status));
    //         }
    //     }])
    //         ->where('id', 1);
       
    //     $service = $service->first();
           
    //     // Prepare headers
    //     $header_rows = ['Student Number', 'Student Name'];
    //     if ($service->requirements->isNotEmpty()) {
    //         $documents = $service->requirements->first()->requirement_documents;
    //         foreach($documents as $document) {
    //             $header_rows[] =  $document->document->document_name;
    //         }
    //     }

    //     // Prepare data rows
    //     $table_data = $this->reportformattedRequirements($service->requirements);
        
    //     return view('reports', compact(['user', 'services', 'academic_years', 'table_data', 'header_rows', 'programs']))->with('_page', 'reports');
    // }

    public function dashboardReport(Request $request, string $status) {
        $id = $request->id ?? 'All';
        if($id == 'All') {
           $id = 0; 
        } else {
            $s_program = Program::where('program_name', $id)->first();
            $id = $s_program->id;
        }

        $documents = Document::all();
        $programs = Program::all();
        $services = Service::all();
        
    
        $user = Auth::user();
        $serviceData = $this->getServiceStudentRequirements($id, $status, '', '', '', $status);
        
        return view('requirement-list', compact(['user', 'serviceData', 'documents', 'programs', 'services']))->with('_page', ucfirst($status))->with('_program', $id)->with('status', $status);
    }

    public function overallStudent() {
        $user = Auth::user();
        $programs = Program::all();
        $students = User::where('type', 'Student')->get();
        return view('overallstudent', compact(['user', 'students', 'programs']))->with('_page', 'Overall Student')->with('_program', 0);
    }

    public function filterOverallStudent(string $program) {
        $user = Auth::user();
        $programs = Program::all();
        $students = User::where('type', 'Student');
        if(isset($program)) {
            $progID = 0;
            if($program != 'All'){
                $prog = Program::where('program_name', $program)->first();
                $progID = $prog->id;
                $students->where('program_id', $prog->id);
            }
        }
        $students = $students->get();
        return view('overallstudent', compact(['user', 'students', 'programs']))->with('_page', 'Overall Student')->with('_program',  $progID);
    }

    public function report()
    {
        $user = Auth::user();
        $programs = Program::all();
        $services = Service::select('id', 'service_name')->get();
        $academic_years = Requirement::distinct()->pluck('academic_year');
        $service = Service::with(['requirements.user_student', 'requirements.requirement_documents.document'])
                          ->where('id', 1)
                          ->first();
        // Prepare headers
        $header_rows = ['Student Number', 'Student Name'];
        if ($service->requirements->isNotEmpty()) {
            $documents = $service->requirements->first()->requirement_documents;
            foreach($documents as $document) {
                $header_rows[] =  $document->document->document_name;
            }
        }

        // Prepare data rows
        $table_data = $this->reportformattedRequirements($service->requirements);
        
        return view('reports', compact(['user', 'services', 'academic_years', 'table_data', 'header_rows', 'programs']))->with('_page', 'reports');
    }

    private function studentReportData($request) {
        $service = Service::with(['requirements.user_student', 'requirements.requirement_documents.document']);
        if(!empty($request->academic_year)){
            $service->with(['requirements' => function($q) use ($request) {
                $q->where('academic_year', $request->academic_year);
            }]);
            $year = $request->academic_year;
        } else {
            $year = 'All';
        }
        $service = $service->where('id', $request->service_id)->first();

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        } 

        $data = new \stdClass();

        $data->tableData = $this->reportformattedRequirements($service->requirements);
        $data->title = "List of ".ucfirst($service->service_name);
        $data->year = $year;

        return $data;
    }

    private function reportformattedRequirements(&$requirements) {
        foreach ($requirements as $requirement) {
            $completedDocumentsCount = 0;
            $deficientDocumentsCount = 0;
            
            foreach ($requirement->requirement_documents as $document) {
                if ($document->status == 1) {
                    $completedDocumentsCount++;
                } else if ($document->status == 0) {
                    $deficientDocumentsCount++;
                }
            }
    
            $requirement->deficientDocumentsCount = $deficientDocumentsCount;
            $requirement->completedDocumentsCount = $completedDocumentsCount;
        }
    
        return $requirements;
    }


    public function viewDashboard(){
        $user = Auth::user();
        if($user->type == 'Admission'){
            $dashboardData = $this->dashboardData();
            $serviceData = $this->getServiceStudentRequirements();
            return view('dashboard', compact(['user', 'dashboardData', 'serviceData']))->with('_page', 'dashboard');
        } else if($user->type == 'Registrar'){ 
            $programs = Program::all();
            $dashboardData = $this->registrarDashboardData();
            return view('registrar-dashboard', compact(['user', 'programs', 'dashboardData']))->with('_page', 'dashboard');
        } else {
            abort(404);
        }
    }

    public function program(Request $request, string $id){
        $user = Auth::user();
        $programs = Program::all();
        $programData = Program::with('students')->where('program_name', $id)->first();

        return view('registrar-program', compact(['user', 'programs', 'programData' ]))->with('_page', $id);
    }

    private function registrarDashboardData(){
       // Fetch the programs with the count of active students
        $programs = Program::withCount(['students' => function($query) {
            $query->where('status', 'ACTIVE')->where('deleted_flag', 0);
        }])->get();

        // Prepare the data for the pie chart
        $pie_categories = [];
        $pie_data = [];

        foreach ($programs as $program) {
            $pie_categories[] = $program->program_name;
            $pie_data[] = $program->students_count;
        }
        
        $requirements = Requirement::where('deleted_flag', 0)->count();
        $documents = RequirementDocument::where('status', 1)->count();
        $students = User::where('type', 'Student')->where('status', 'Active')->where('deleted_flag', 0)->count();

        $data = new \stdClass();
        $data->requirements = $requirements;
        $data->documents = $documents;
        $data->student_count = $students;
        $data->pie_data = $pie_data;
        $data->pie_categories = $pie_categories;

        return $data;
    }

    private function dashboardData() {
        // Retrieve data
        $allRequirement = Requirement::with(['user_student', 'service', 'requirement_documents'])
        ->whereHas('user_student', function($q) {
            $q->where('status', 'ACTIVE');
            $q->where('deleted_flag', 0);
        })->get();

        $categoriesID = [1, 2, 3, 4];
       
        $deficientData = [];
        $completedData = [];
        foreach ($categoriesID as $category) {
            $completedCount = $allRequirement->where('service_id', $category)->where('status', 'Completed')->count();
            $deficientCount = $allRequirement->where('service_id', $category)->where('status', 'Deficiency')->count();
            $deficientData[] = $deficientCount;
            $completedData[] = $completedCount;
        }

        $students = User::where('type', 'Student')->where('status', 'Active')->where('deleted_flag', 0)->count();
        $registrars = User::where('type', 'Registrar')->where('status', 'Active')->where('deleted_flag', 0)->count();
        $admissions = User::where('type', 'Admission')->where('status', 'Active')->where('deleted_flag', 0)->count();
        $requirements = Requirement::where('deleted_flag', 0)->count();
        $documents = RequirementDocument::where('status', 1)->count();

        $program_student_counts = Program::withCount(['students' => function ($query) {
            $query->where('type', 'Student');
        }])->get();


        $requirementsPerService = Requirement::with('service')
        ->select('service_id', DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = "deficient" THEN 1 ELSE 0 END) as deficient_count'),
            DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_count'))
        ->whereHas('user_student', function($q) {
            $q->where('status', 'ACTIVE');
            $q->where('deleted_flag', 0);
        })
        ->groupBy('service_id')
        ->get();

        // $requirementsPerServiceSub = Requirement::with('service')
        //     ->select('service_id', DB::raw('COUNT(*) as total'),
        //         DB::raw('SUM(CASE WHEN status = "deficient" THEN 1 ELSE 0 END) as deficient_count'),
        //         DB::raw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_count'),
        //         DB::raw('SUM(CASE WHEN requirement_documents.id IS NOT NULL THEN 1 ELSE 0 END) as submitted_count'),
        //         DB::raw('SUM(CASE WHEN requirement_documents.id IS NULL THEN 1 ELSE 0 END) as not_submitted_count'))
        //     ->leftJoin('requirement_documents', 'requirements.id', '=', 'requirement_documents.requirement_id')
        //     ->whereHas('user_student', function($q) {
        //         $q->where('status', 'ACTIVE');
        //         $q->where('deleted_flag', 0);
        //     })
        //     ->groupBy('service_id')
        //     ->get();

        $data = new \stdClass();
        $data->requirementsPerService = $requirementsPerService;
        $data->program_student_counts = $program_student_counts;
        $data->deficient_data = $deficientData;
        $data->completed_data = $completedData;
        $data->admission_count = $admissions;
        $data->registrar_count = $registrars;
        $data->student_count = $students;
        $data->requirement_count = $requirements;
        $data->document_count = $documents;

        return $data;
    }

    public function profile(){
        $user = Auth::user();
        return view('profile', compact(['user']))->with('_page', 'profile');
    }

    // public function StudentManagement(){
    //     $user = Auth::user();
    //     $academic_years = Requirement::distinct()->pluck('academic_year');
    //     $documents = Document::all();
    //     $programs = Program::all();
    //     $serviceData = $this->getServiceStudentRequirements();
    //     return view('StudentManagement', compact(['user', 'serviceData', 'academic_years', 'documents', 'programs']))->with('_page', 'Student Management')->with('_service', 0)->with('_completed', 1)->with('_deficiency', 1)->with('service', 'All');
    // }

    public function StudentManagement(){
        $user = Auth::user();
        $academic_years = Requirement::distinct()->pluck('academic_year');
        $documents = Document::all();
        $programs = Program::all();
        $services = Service::all();
        $serviceData = $this->getServiceStudentRequirements();
        return view('StudentManagement', compact(['user', 'serviceData', 'academic_years', 'documents', 'programs', 'services']))->with('_page', 'Student Management')->with('_program', 0)->with('_completed', 1)->with('_deficiency', 1)->with('service', 'All');
    }

    public function showServiceManagement(Request $request, string $id){
        $service = $id;
        if($id == 'All') {
           $id = 0; 
        } else {
            $s_program = Program::where('program_name', $id)->first();
            $id = $s_program->id;
        }

        $documents = Document::all();
        $programs = Program::all();
        $services = Service::all();
        
        $completed = 1;
        $deficiency = 1;
        $status = '';
        if(isset($request->status)){
            $completed = $request->status == 'completed' ? 1 : 0;
            $deficiency = $request->status == 'deficiency' ? 1 : 0;
            $status = $request->status == 'completed' ? 'Completed' : 'Deficiency';
        }
        $user = Auth::user();
        $academic_years = Requirement::distinct()->pluck('academic_year');
        $serviceData = $this->getServiceStudentRequirements($id, $status);
        return view('StudentManagement', compact(['user', 'serviceData', 'academic_years', 'documents', 'programs', 'services']))->with('_page', 'Student Management')->with('_program', $id)->with('_completed', $completed)->with('_deficiency', $deficiency)->with('service', $service);
    }

    private function getServiceStudentRequirements($serviceId='', $status='', $filter_text='', $academic_year='', $document='', $document_status='', $program='') {
        $allRequirement = Requirement::with(['user_student', 'service', 'requirement_documents'])
        ->whereHas('user_student', function($q) {
            $q->where('status', 'ACTIVE');
            $q->where('deleted_flag', 0);
        });

        $requirement = Requirement::with(['user_student', 'service', 'requirement_documents'])
        ->whereHas('user_student', function($q) {
            $q->where('status', 'ACTIVE');
            $q->where('deleted_flag', 0);
        });
        if(!empty($serviceId)  ) {
            $requirement->where('program_id', $serviceId);
            $allRequirement->where('program_id', $serviceId);
        }
        if(!empty($status)) {
            $requirement->where('status', $status);
        }
        if(!empty($filter_text)) {
            $filterText = '%' . $filter_text . '%';
            $requirement->whereHas('user_student', function($query) use ($filterText) {
                $query->where('name', 'like', $filterText)
                      ->orWhere('student_number', 'like', $filterText)
                      ->orWhere('class_year', 'like', $filterText)
                      ->orWhere('course', 'like', $filterText);
            });
        }
        if(!empty($academic_year)) {
            $requirement->where('academic_year', $academic_year);
        }
        if(!empty($program)) {
            $requirement->where('service_id', $program);
        }
        
        if (!empty($document) && !empty($document_status)) {
            $requirement->whereHas('requirement_documents', function($query) use ($document, $document_status) {
                $query->where('document_id', $document);
                $query->where('status', $document_status);
            });
        }
        $requirement = $requirement->orderByDesc('updated_at')
        ->get();

        $allRequirement = $allRequirement->orderBy('created_at', 'ASC')
        ->get();

        // Initialize counters
        $completedCount = 0;
        $deficiencyCount = 0;

        // Count the occurrences of each status
        foreach ($allRequirement as $req) {
            if ($req->status === 'Completed') {
                $completedCount++;
            } elseif ($req->status === 'Deficiency') {
                $deficiencyCount++;
            }
        }

        // Calculate percentages
        $totalCount = $completedCount + $deficiencyCount;
        $completedPercentage = ($totalCount > 0) ? ($completedCount / $totalCount) * 100 : 0;
        $deficiencyPercentage = ($totalCount > 0) ? ($deficiencyCount / $totalCount) * 100 : 0;
        $serviceData = new \stdClass();
        $serviceData->completedCount = $completedCount;
        $serviceData->deficiencyCount = $deficiencyCount;
        $serviceData->completedPercentage = $this->formattedPercentage($completedPercentage);
        $serviceData->deficiencyPercentage = $this->formattedPercentage($deficiencyPercentage);
        $serviceData->requirements = $this->formattedRequirements($requirement);

        return $serviceData;
    }

    private function formattedRequirements(&$requirements) {
        foreach ($requirements as $requirement) {
            $completedDocumentsCount = 0;
            $totalDocumentsCount = $requirement->requirement_documents->count();
            
            // Count the number of completed requirement documents
            foreach ($requirement->requirement_documents as $document) {
                if ($document->status == 1) {
                    $completedDocumentsCount++;
                }
            }
    
            // Compute the completion percentage
            $completionPercentage = ($totalDocumentsCount > 0) ? ($completedDocumentsCount / $totalDocumentsCount) * 100 : 0;
            // Assign the completion percentage to the requirement object
            $requirement->totalDocumentsCount = $totalDocumentsCount;
            $requirement->completedDocumentsCount = $completedDocumentsCount;
            $requirement->completionPercentage = $completionPercentage;
            $requirement->completionPercentageFormatted = $this->formattedPercentage($completionPercentage);
            
        }
    
        return $requirements;
    }

    private function formattedPercentage($percentage) {
         // Format the percentage to two decimal places
         $formattedPercentage = number_format($percentage, 0);
         return $formattedPercentage;
    }
    

    public function StudentList(){
        $user = Auth::user();
        $students = User::where('type', 'Student')->get();
        return view('Student-List', compact(['user', 'students']))->with('_page', 'Student List');
    }

    public function editStudent(Request $request) {
        $user = Auth::user();
        $formData = User::findOrFail($request->id);
        if($formData){
            return view('student-edit-form', compact(['user', 'formData']))->with('_page', 'Edit Student');
        }
        abort(404);
    }

    public function CrossEnroll(Request $request){
        $user = Auth::user();
        $formData = $this->emptyFormData($request->student_id);
        $programs = Program::all();
        $admission = Service::findOrFail(4); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('cross-enroll', compact(['user', 'formData', 'documents', 'programs']))->with('_title', '')->with('_page', 'cross-enroll');
    }

    public function editCrossEnroll(string $id){
        $user = Auth::user();
        $programs = Program::all();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 4)->first();
        if($formData){
            $academic_year = explode('-', $formData->academic_year);
            $formData->academic_year_1 = $academic_year[0];
            $formData->academic_year_2 = $academic_year[1];

            $admission = Service::findOrFail(4); // 1 = admission
            if ($admission) {
                $documentIds = json_decode($admission->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }
            return view('cross-enroll', compact(['user', 'formData', 'documents','programs']))->with('_title', 'Edit')->with('_page', 'cross-enroll');
        } 
        abort(404);
    }


    public function transferee(Request $request){
        $user = Auth::user();
        $formData = $this->emptyFormData($request->student_id);
        $programs = Program::all();
        $admission = Service::findOrFail(3); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('transferee', compact(['user', 'formData', 'documents', 'programs']))->with('_title', '')->with('_page', 'Transferee');
    }

    public function editTransferee(string $id){
        $user = Auth::user();
        $programs = Program::all();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 3)->first();
        if($formData){
            $academic_year = explode('-', $formData->academic_year);
            $formData->academic_year_1 = $academic_year[0];
            $formData->academic_year_2 = $academic_year[1];

            $admission = Service::findOrFail(3); // 3 = admission
            if ($admission) {
                $documentIds = json_decode($admission->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }
            return view('transferee', compact(['user', 'formData', 'documents', 'programs']))->with('_title', 'Edit')->with('_page', 'Transferee');
        } 
        abort(404);
    }

    public function freshmen(Request $request){
        $user = Auth::user();
        $formData = $this->emptyFormData($request->student_id);
        $programs = Program::all();
        $admission = Service::findOrFail(1); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        $serviceData = $this->getServiceStudentRequirements(1);
        return view('admission', compact(['user', 'formData', 'documents', 'programs', 'serviceData']))->with('_title', '')->with('_page', 'Admission');
    }

    public function newstudent(Request $request){
        $user = Auth::user();
        $formData = $this->emptyFormData($request->student_id);
        $programs = Program::all();
        $admission = Service::findOrFail(1); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('newstudent', compact(['user', 'formData', 'documents', 'programs']))->with('_title', '')->with('_page', 'Admission');
    }

    public function completed(Request $request){
        $user = Auth::user();
        $formData = $this->emptyFormData($request->student_id);
        $programs = Program::all();
        $admission = Service::findOrFail(1); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('completed', compact(['user', 'formData', 'documents', 'programs']))->with('_title', '')->with('_page', 'dashboard');
    }

    public function deficiency(Request $request){
        $user = Auth::user();
        $formData = $this->emptyFormData($request->student_id);
        $programs = Program::all();
        $admission = Service::findOrFail(1); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('deficiency', compact(['user', 'formData', 'documents', 'programs']))->with('_title', '')->with('_page', 'dashboard');
    }

    // public function overallstudent(Request $request){
    //     $user = Auth::user();
    //     $formData = $this->emptyFormData($request->student_id);
    //     $programs = Program::all();
    //     $admission = Service::findOrFail(1); // 1 = admission
    //     if ($admission) {
    //         $documentIds = json_decode($admission->document_ids);
    //         $documents = Document::whereIn('id', $documentIds)->get();
    //     } else {
    //         $documents = [];
    //     }
    //     return view('overallstudent', compact(['user', 'formData', 'documents', 'programs']))->with('_title', '')->with('_page', 'dashboard');
    // }

    public function editFreshmen(string $id){
        $user = Auth::user();
        $programs = Program::all();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 1)->first();
        if($formData){
            $academic_year = explode('-', $formData->academic_year);
            $formData->academic_year_1 = $academic_year[0];
            $formData->academic_year_2 = $academic_year[1];

            $freshman = Service::findOrFail(1); // 1 = freshman
            if ($freshman) {
                $documentIds = json_decode($freshman->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }

            return view('admission', compact(['user', 'formData', 'documents', 'programs']))->with('_title', 'Edit')->with('_page', 'Admission');
        } 
        abort(404);
    }

    public function reAdmission(Request $request){
        $user = Auth::user();
        $formData = $this->emptyFormData($request->student_id);
        $programs = Program::all();
        $admission = Service::findOrFail(2); // 1 = admission
        if ($admission) {
            $documentIds = json_decode($admission->document_ids);
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = [];
        }
        return view('Re-admission', compact(['user', 'formData', 'documents', 'programs']))->with('_title', '')->with('_page', 'Returnee');
    }

    public function editReAdmission(string $id){
        $user = Auth::user();
        $programs = Program::all();
        $formData = Requirement::with(['user_student', 'service', 'requirement_documents'])->where('id', $id)->where('service_id', 2)->first();
        if($formData){
            $academic_year = explode('-', $formData->academic_year);
            $formData->academic_year_1 = $academic_year[0];
            $formData->academic_year_2 = $academic_year[1];

            $admission = Service::findOrFail(2); // 1 = admission
            if ($admission) {
                $documentIds = json_decode($admission->document_ids);
                $documents = Document::whereIn('id', $documentIds)->get();
            } else {
                $documents = [];
            }

            return view('Re-admission', compact(['user', 'formData', 'documents','programs']))->with('_title', 'Edit')->with('_page', 'Returnee');
        } 
        abort(404);
    }

    public function storeRequirement(Request $request) {
        $user = Auth::user();
        $validated = $request->validate([
            'service_id' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email|string',
            'phone_number' => 'nullable|string|max:11',
            'address' => 'nullable|string',
            'course' => 'required|exists:programs,id',
            'class_year' => 'required|string',
            'academic_year_1' => 'required|numeric',
            'academic_year_2' => 'required|numeric',
            'lrn_number' => 'nullable|string',
            'student_number' => 'required|string',
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
        $student = User::where('student_number', $validated['student_number'])
                    ->orWhere('email', $validated['email'])
                    ->first();

        $program = Program::findOrFail($validated['course']);
        $validated['program_id'] = $validated['course'];
        $validated['course'] = $program->program_name;
        $validated['academic_year'] = $validated['academic_year_1'].'-'.$validated['academic_year_2'];

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
                $new_requirement->academic_year = $validated['academic_year'];
                $new_requirement->course = $validated['course'];
                $new_requirement->program_id = $validated['program_id'];
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
            $new_requirement->academic_year = $validated['academic_year'];
            $new_requirement->course = $validated['course'];
            $new_requirement->program_id = $validated['program_id'];
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
            session()->flash('success', ucfirst($service->service_name).' save successfully!');
        }
    
        $route_name = $request->input('route_name');
        if( $route_name == 'freshmen') {
            return redirect()->route('freshmen')->with('_title', '');
        } else if ( $route_name == 'returnee') {
            return redirect()->route('returnee')->with('_title', '');
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
            'phone_number' => 'nullable|string|max:11',
            'address' => 'nullable|string',
            'course' => 'required|exists:programs,id',
            'class_year' => 'required|string',
            'academic_year_1' => 'required|numeric',
            'academic_year_2' => 'required|numeric',
            'lrn_number' => 'nullable|string',
            'student_number' => 'required|string',
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

        $program = Program::findOrFail($validated['course']);
        $validated['program_id'] = $validated['course'];
        $validated['course'] = $program->program_name;
        $validated['academic_year'] = $validated['academic_year_1'].'-'.$validated['academic_year_2'];
        
        
        // Check if the user with the same LRN or email already exists
        $student = User::findOrFail($validated['student_id']);
        if($student) {
            // Update the existing user if found
            $student->update($validated);

            $res_requirement = Requirement::findOrFail($validated['requirement_id']);
            $res_requirement->class_year = $validated['class_year'];
            $res_requirement->academic_year = $validated['academic_year'];
            $res_requirement->course = $validated['course'];
            $res_requirement->program_id = $validated['program_id'];
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
            session()->flash('success', ucfirst($service->service_name).' update successfully!');
        }
        $route_name = $request->input('route_name');
        if( $route_name == 'freshmen') {
            return redirect()->route('edit.freshmen', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else if ( $route_name == 'returnee') {
            return redirect()->route('edit.returnee', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else if ( $route_name == 'transferee') {
            return redirect()->route('edit.transferee', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else if ( $route_name == 'cross-enroll') {
            return redirect()->route('edit.cross-enroll', ['id'=>$request->requirement_id])->with('_title', 'Edit');
        } else {
            return redirect()->route('dashboard');
        }
       
    }

    public function htmlFunctions(Request $request, string $id) {
        $user = Auth::user();
        if ($request->ajax()) {
            if ($id === 'get-filtered-student-list') {
                $students = User::where('type', 'Student');
                if(isset($request->filter_text)) {
                    $filterText = '%' . $request->filter_text . '%';
                    $students->where(function($query) use ($filterText) {
                        $query->where('name', 'like', $filterText)
                              ->orWhere('email', 'like', $filterText)
                              ->orWhere('course', 'like', $filterText);
                    });
                }
                $students =  $students->get();
                return view('components.filter-student-list', compact('students'))->render();
            } else if ($id === 'get-filtered-student-management-list') {
                $status = '';
                if($request->filter_completed != 1){
                    $status = 'Deficiency';
                }
                if($request->filter_deficient != 1){
                    $status = 'Completed';
                }
                $user = Auth::user();
                $serviceData = $this->getServiceStudentRequirements($request->filter_service, $status, $request->filter_text, $request->filter_academic_year,  $request->filter_document, $request->filter_document_status, $request->filter_program);
                $requirements = $serviceData->requirements;
                return view('components.filter-student-management-list', compact('requirements'))->render();
            } else if ($id === 'get-student-requirements-data') {
                $data = User::with('student_requirements')->with(['requirement_documents' => function($q) {
                    $q->where('status', 1);
                }])->where('type', 'Student')->where('id', $request->student_id)->first();
                $data->student_requirements = $this->formattedRequirements($data->student_requirements);
                return view('components.view-student-requirements-documents', compact('data'))->render();
            } else if ($id === 'get-filtered-program-student-list') {
                $students = User::where('type', 'Student')->where('program_id', $request->filter_program);
                if(isset($request->filter_text)) {
                    $filterText = '%' . $request->filter_text . '%';
                    $students->where(function($query) use ($filterText) {
                        $query->where('name', 'like', $filterText)
                              ->orWhere('email', 'like', $filterText)
                              ->orWhere('course', 'like', $filterText);
                    });
                }
                $students =  $students->get();
                return view('components.filter-program-student-list', compact('students'))->render();
            } else if ($id === 'get-filtered-report-data') {
                
                $service = Service::with(['requirements.user_student', 'requirements.requirement_documents.document']);
                $service->with(['requirements' => function($q) use ($request) {
                    if(!empty($request->academic_year)){
                        $q->where('academic_year', $request->academic_year);
                    }
                    if(!empty($request->program_id)){
                        $q->where('program_id', $request->program_id);
                    }
                    if(!empty($request->remarks)){
                        $q->where('status', $request->remarks);
                    }
                }]);
                $service = $service->where('id', $request->service_id)->first();

                $table_data = $this->reportformattedRequirements($service->requirements);


                return view('components.filtered-report-table-data', compact('table_data'))->render();
            }
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

    private function emptyFormData($student_id=''){
        $requirement = Requirement::latest()->first();

        $formData = new \stdClass();
        $formData->course = '';
        $formData->program_id = '';
        $formData->class_year = '';
        $formData->academic_year_1 = '';
        $formData->academic_year_2 = '';
        $formData->class_year = '';

        if($requirement){
            $academic_year = explode('-', $requirement->academic_year);
            $formData->academic_year_1 = $academic_year[0];
            $formData->academic_year_2 = $academic_year[1];
        }


        $user_data = new \stdClass();
        $user_data->name = '';
        $user_data->email = '';
        $user_data->phone_number = '';
        $user_data->address = '';
        $user_data->lrn_number = '';
        $user_data->student_number = '';
       

        if(!empty($student_id)){
            $student = User::where('type', 'Student')->where('id', $student_id)->first(); 
            $user_data->name = $student->name;
            $user_data->email = $student->email;
            $user_data->phone_number = $student->phone_number;
            $user_data->address = $student->address;
            $user_data->lrn_number = $student->lrn_number;
            $user_data->student_number = $student->student_number;

            $formData->course = $student->course;
            $formData->program_id = $student->program_id;
            $formData->class_year = $student->class_year;
        }

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

