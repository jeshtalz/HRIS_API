<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\SalaryGrade;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreRequest;
use App\Models\QualificationStandard;
use App\Http\Resources\PositionResource;
use App\Http\Requests\StorePositionRequest;
use App\Http\Resources\SalaryGradeResource;
use App\Http\Resources\QualificationStandardResource;
use App\Http\Requests\StoreQualificationStandardRequest;

class PositionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return PositionResource::collection(
            Position::with('hasManyQualificationStandard', 'belongsToSalaryGrade')->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
            // validate input fields
            $request->validated($request->all());

            // validate user from database

            // $positionExist = Position::where('title', $request->title);

            // if ($positionExist) {
            //     return $this->error('', 'Duplicate Entry', 400);
            // }
    

            $positionQS = Position::create([
                "title" => $request->title,
                "salary_grade_id" => $request->salary_grade_id

            ]);
            
            QualificationStandard::create([
                'position_id' => $positionQS->id,
                "education" => $request->education,
                "training" => $request->training,
                "experience" => $request->experience,
                "eligibility" => $request->eligibility,
                "competency" => $request->competency,

                
            ]);

            // $position=new Position();
            // $position-> title=$request->title;
            // $position->save();
           
    
    
            // return message
            return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return PositionResource::collection(
            Position::where('id', $position->id)
                ->get()
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePositionRequest $request, Position $position)
    {
    
        // $positionId =  Position::where('title', $request->position_title)->pluck('id')->first();
            $position->title = $request->title;
            $position->salary_grade_id = $request->salary_grade_id;

            $qualificationStandard = QualificationStandard::where('position_id',$position->id);
            $qualificationStandard->education = $request->education;
            $qualificationStandard->training = $request->training;
            $qualificationStandard->experience = $request->experience;
            $qualificationStandard->eligibility = $request->eligibility;
            $qualificationStandard->competency = $request->competency   ;

            $position->save();
            // $qualificationStandard->save();

            return new PositionResource($position);

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Position $position, QualificationStandard $qualificationStandard)
    {

        $position->delete();
        //    $qualificationStandard->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }

    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $searchKeyword == null ? $searchKeyword = "" : $searchKeyword = $searchKeyword;
        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;

        $data = PositionResource::collection(
            Position::where("title", "like", "%" . $searchKeyword . "%")
                ->select("title","positions.id", "salary_grades.number","salary_grades.amount","qualification_standards.education","qualification_standards.training",
                        "qualification_standards.experience","qualification_standards.eligibility","qualification_standards.competency")
                ->join("qualification_standards", "qualification_standards.position_id","positions.id")
                ->join("salary_grades", "salary_grades.id", "positions.id")
                ->orWhere("qualification_standards.education", "like", "%" . $searchKeyword . "%")
                ->orWhere("qualification_standards.training", "like", "%" . $searchKeyword . "%")
                ->orWhere("qualification_standards.experience", "like", "%" . $searchKeyword . "%")
                ->orWhere("qualification_standards.eligibility", "like", "%" . $searchKeyword . "%")
                ->orWhere("qualification_standards.competency", "like", "%" . $searchKeyword . "%")
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->limit(10)
                ->get()
        );  

        $pages = Position::where("title", "like", "%" . $searchKeyword . "%")
        ->select("title","positions.id", "salary_grades.number","salary_grades.amount","qualification_standards.education","qualification_standards.training",
                "qualification_standards.experience","qualification_standards.eligibility","qualification_standards.competency")
        ->join("qualification_standards", "qualification_standards.position_id","positions.id")
        ->orWhere("qualification_standards.education", "like", "%" . $searchKeyword . "%")
        ->orWhere("qualification_standards.training", "like", "%" . $searchKeyword . "%")
        ->orWhere("qualification_standards.experience", "like", "%" . $searchKeyword . "%")
        ->orWhere("qualification_standards.eligibility", "like", "%" . $searchKeyword . "%")
        ->orWhere("qualification_standards.competency", "like", "%" . $searchKeyword . "%")
        ->count();

        return compact('pages', 'data');

        // dd(Position::where('title', 'like', '%'.$request->keyword.'%')
        // ->with(['hasManyQualificationStandard','belongsToSalaryGrade'])
        // ->limit(10)
        // ->get());
        return PositionResource::collection(
            Position::where('title', 'like', '%' . $request->keyword . '%')
                ->with(['hasManyQualificationStandard', 'belongsToSalaryGrade'])
                ->limit(10)
                ->get()
        );
    }
}
