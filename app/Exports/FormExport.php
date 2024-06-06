<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromCollection;

class FormExport implements FromCollection
{
    protected $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function collection()
    {

        $data=[
            'question'=>$this->form->page->flatMap(function($page) {
                return $page->question->map->only('question');
            }),
            'questionnaires'=> $this->form->questionnaire->map(function($item) {
                return [
                    'answers'=>$item->answer->map(function($item1) {
                        return[
                            'answer'=>$item1->answer,
                            'question'=>$item1->question->question
                        ];
                    })
                ];
            })
        ];

        $exportData = [];

        $exportRow = [];
        foreach($data['question'] as $question) {
            $exportRow[] =$question['question'];
        }
        $exportData[] = $exportRow;

        foreach($data['questionnaires'] as $questionnaire) {
            $exportRow = [];

            foreach($questionnaire['answers'] as $answer) {
                $exportRow[] = $answer['answer'];
            }

            $exportData[] = $exportRow;
        }

        return collect($exportData);
    }
}
