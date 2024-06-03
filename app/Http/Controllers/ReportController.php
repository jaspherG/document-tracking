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

class ReportController extends Controller
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportService(Request $request) 
    {
        $data = $this->serviceReportData($request);
        return response()->json(['data'=> $data->tableData, 'title'=> $data->title, 'year'=> $data->year]);
    }

    public function generateReport(Request $request) {
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
            $data = $this->serviceReportData($request);
        }
        // $description =  $data->year;
        // $title =  $data->title;
        // $tableData =  $data->tableData;

        $title =  $data->title;
        $tableData =  $data->tableData;
        $description =  "Academic Year: ".$data->year;
        return view('print.report', compact('tableData', 'title', 'description'))->with('_page', 'print report');
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
        $data->title = ucfirst($service->service_name);
        $data->year = $year;

        return $data;
    }
}
