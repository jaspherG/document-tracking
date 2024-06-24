<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Program;
use App\Models\Service;
use App\Models\Document;
use App\Models\Requirement;
use App\Models\RequirementDocument;
use App\Models\RequirementRemark;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportService(Request $request) 
    {
        $data = $this->studentReportDataExcel($request);
        return response()->json(['data'=> $data->tableData, 'title'=> $data->title, 'year'=> $data->year]);
    }

    public function generateReport(Request $request) {
        $user = Auth::user();

        $data = new \stdClass();
        $data->title = '';
        $data->tableData = [];
        $data->year = '';
        if(!isset($request->id)){
            abort(404);
        } else if($request->id === 'admin-service-report') {
            // $data = $this->serviceReportData($request);
            // $description =  $data->year;
            // $title =  $data->title;
            // $tableData =  $data->tableData;
            $data = $this->studentReportData($request);
        }
        // $description =  $data->year;
        // $title =  $data->title;
        // $tableData =  $data->tableData;

        $title =  $data->title;
        $tableData =  $data->tableData;
        $description =  "Academic Year: ".$data->year;
        return view('print.report', compact('tableData', 'title', 'description', 'user'))->with('_page', 'print report');
    }
    
    private function studentReportDataExcel($request){
        $service = Service::with(['requirements.user_student', 'requirements.requirement_documents.document']);
        $year = 'All';
        if(!empty($request->academic_year)){
            $year = $request->academic_year;
        }
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

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        } 

        $serviceData = $this->formattedRequirements($service->requirements);

        // Prepare headers
        $headerRow = ['No.', 'Student No.', 'Student Name', 'Program', 'Remarks'];

        $tableData = [$headerRow];
        $index = 1; // Initialize index for numbering

        foreach ($serviceData as $requirement) {
            $rowData = [
                $index,
                $requirement->user_student->student_number,
                $requirement->user_student->name,
                $requirement->program->program_name,  // Assuming there's a 'program' property
                $requirement->status,  // Assuming there's a 'remarks' property
            ];

            $tableData[] = $rowData;
            $index++;  // Increment index
        }

        $data = new \stdClass();

        $data->tableData = $tableData;
        $data->title = "List of " . ucfirst($service->service_name);
        $data->year = $year;

        return $data;

    }

    private function serviceReportData($request) {
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

        // Prepare headers
        $headerRow = ['Student Number', 'Student Name'];
        if ($service->requirements->isNotEmpty()) {
            $documents = $service->requirements->first()->requirement_documents;
            foreach($documents as $document) {
                $headerRow[] =  $document->document->document_name;
            }
        }

        // Prepare data rows
        $tableData = [$headerRow];
        foreach ($service->requirements as $requirement) {
            $rowData = [
                $requirement->user_student->student_number,
                $requirement->user_student->name
            ];

            foreach ($requirement->requirement_documents as $document) {
                $rowData[] = $document->status == 1 ? 'Complete' : '';
            }

            $tableData[] = $rowData;
        }

        $data = new \stdClass();

        $data->tableData = $tableData;
        $data->title = "List of ".ucfirst($service->service_name);
        $data->year = $year;

        return $data;
    }

    private function studentReportData($request) {
        $service = Service::with(['requirements.user_student', 'requirements.requirement_documents.document']);
        // if(!empty($request->academic_year)){
        //     $service->with(['requirements' => function($q) use ($request) {
        //         $q->where('academic_year', $request->academic_year);
        //     }]);
        //     $year = $request->academic_year;
        // } else {
        //     $year = 'All';
        // }
        $year = 'All';
        if(!empty($request->academic_year)){
            $year = $request->academic_year;
        }
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

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        } 

        // Prepare headers
        $headerRow = ['Student No', 'Student Name'];
        if ($service->requirements->isNotEmpty()) {
            $documents = $service->requirements->first()->requirement_documents;
            foreach($documents as $document) {
                $headerRow[] =  $document->document->document_name;
            }
        }

        $data = new \stdClass();

        $data->tableData = $this->formattedRequirements($service->requirements);
        $data->title = "List of ".ucfirst($service->service_name);
        $data->year = $year;

        return $data;
    }

    private function formattedRequirements(&$requirements) {
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
}
