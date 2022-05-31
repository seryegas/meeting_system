<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Meeting;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentController extends Controller
{
    public function create_protocol($meeting_id)
    {
        $outputPath = Storage::path('public/protocols/') . $meeting_id . '.docx';
        $path = Storage::path('public/protocols/example_potocol.docx');
        $document = new TemplateProcessor($path);
        $document = self::minimal_work($meeting_id, $document);
        $listening_and_solutions = self::make_info_and_solution($meeting_id);
        $document->setComplexValue('listening_and_solutions', $listening_and_solutions);
        $document->saveAs($outputPath);
        self::download_file($outputPath, $meeting_id);
        return redirect(route('show_meeting', $meeting_id));
    }
    
    public function create_business_of_the_day($meeting_id)
    {
        $outputPath = Storage::path('public/botd/') . $meeting_id . '.docx';
        $path = Storage::path('public/botd/example_botd.docx');
        $document = new TemplateProcessor($path);
        $document = self::minimal_work($meeting_id, $document);
        $document->saveAs($outputPath);
        self::download_file($outputPath, $meeting_id);
        return redirect(route('show_meeting', $meeting_id));
    }

    public static function download_file($outputPath, $meeting_id)
    {
        $downdloadFile = $outputPath;


        $meeting_name = Meeting::find($meeting_id)->meeting_name;
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Content-Length: ".filesize($downdloadFile));
        header('Content-Disposition: attachment; filename="' . $meeting_name . ".docx" . '"');  
        header('Content-type: application/pdf', true);

        readfile($downdloadFile);
    }

    public static function minimal_work(int $meeting_id, TemplateProcessor $document) : TemplateProcessor
    {

        $meeting = Meeting::find($meeting_id);
        $company = Company::find($meeting->company_id);
        $supervisor = User::find($company->supervisor_id);
        $secretary = User::find($company->secretary_id);

        $document->setValue('company_name', $company->company_name);
        $document->setValue('city', 'Казань');
        $document->setValue('supervisor', $supervisor->name);
        $document->setValue('secretary', $secretary->name);
        $document->setValue('date', date('d.m.Y', strtotime($meeting->meeting_time)));

        $employees = self::make_employees_string($company->id);
        $document->setValue('employees', $employees);
        $povestka_dnya = self::make_business_of_the_day($meeting_id);
        $document->setComplexValue('povestka_dnya', $povestka_dnya);

        return $document;
    }

    public static function make_employees_string(int $company_id) : string
    {
        $employees_array = User::where('user_role', 1)->where('company_id', $company_id)->get();
        $employees_string = ' ';
        foreach($employees_array as $employee)
        {
            $employees_string .= $employee->name . ', ';
        }
        $employees_string = substr($employees_string, 0, -1);
        $employees_string[strlen($employees_string)-1] = '.';
        return $employees_string;
    }

    public static function make_business_of_the_day(int $meeting_id)
    {
        $botd = "";
        $questions = Question::where('meeting_id', $meeting_id)->get();
        $i = 1;

        foreach($questions as $question)
        {
            $botd .= $i . ". " . $question->question_name . "\n";
            $i++;
        }
        $textlines = explode("\n", $botd);
        $textrun = new TextRun();
        $textrun->addText(array_shift($textlines));
        foreach ($textlines as $line) 
        {
            $textrun->addTextBreak();
            $textrun->addText($line);
        }
        return $textrun;
    }

    public static function make_info_and_solution($meeting_id)
    {
        $questions = Question::with('solutions')->where('meeting_id', $meeting_id)->get();
        $string = "";
        $i = 1;
        foreach ($questions as $question)
        {
            $j = 1;
            $string .= $i . ". СЛУШАЛИ: \n" . $question->description . "\n";
            $string .= "РЕШИЛИ: \n";
            foreach($question->solutions as $solution)
            {
                $string .= $i . "." . $j . " " . $solution->solution_desc . "\n";
                $j++;
            }
            $i++;
            $string .= "\n";
        }
        $textlines = explode("\n", $string);
        $textrun = new TextRun();
        $textrun->addText(array_shift($textlines));
        foreach ($textlines as $line) 
        {
            $textrun->addTextBreak();
            $textrun->addText($line);
        }
        return $textrun;
    }
}
