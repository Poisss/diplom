<?php

namespace App\Http\Controllers;

use App\Exports\FormExport;
use App\Http\Requests\Form\CreateRequest;
use App\Models\Answer;
use App\Models\Form;
use App\Models\Page;
use App\Models\Questionnaire;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class FormController extends Controller
{

    public function index()
    {
        $form=Form::orderBy('created_at','desc')->paginate(1);
        $data=[
            'naw'=>true,
            'active'=>'form',
            'form'=>$form->map(function($item) {
                return[
                    'id'=>$item->id,
                    'title'=>$item->title,
                    'author'=>$item->user->first_name.' '.$item->user->last_name,
                    'background'=>$item->theme->image->path,
                    'access'=>$item->access,
                    'created_at'=>$item->created_at,
                ];
            }),
            'paginate'=>$form
        ];
        return view('admin.index')->with('data',$data);
    }

    public function store(CreateRequest $request)
    {
        $theme=Theme::first();
        $path=$request->file('preview')->store('/','public');
        if($form=Form::create(["theme_id"=>$theme->id,"preview"=>$path,"user_id"=>Auth::user()->id]+$request->validated())){
            Page::create(["form_id" => $form->id]);
            return redirect()->route('edit',['form' => $form->id]);
        }
        return redirect()->route('index')->with('error','Не удалось форму пользователя!');

    }

    public function show(Form $form)
    {
        $data=[
            'naw'=>true,
            'title'=> $form->title,
            'questionnaires'=> $form->questionnaire->map(function($item) {
                return [
                    'id' => $item->id,
                    'answers'=>$item->answer->map(function($item1) {
                        return[
                            'answer'=>$item1->answer,
                            'question'=>$item1->question->question
                        ];
                    })
                ];
            })
        ];
        return view('admin.show')->with('data',$data);
    }

    public function edit(Form $form)
    {

        $data=[
            'naw'=>true,
            'id' => $form->id,
            'title' => $form->title,
            'page'=>$form->page->map(function($item) {
                return[
                    'id'=>$item->id,
                    'questions' => $item->question->map(function($item1) {
                        return [
                            'id' => $item1->id,
                            'question' => $item1->question,
                            'image' => $item1->image,
                            'required' => $item1->required,
                            'comment' => $item1->comment,
                            'type' => $item1->type,
                            'option'=>$item1->option->map(function($item2) {
                                return $item2->option;
                            })
                        ];
                    })
                ];
            })

        ];
        return view('admin.update')->with('data',$data);
    }

    public function updatequestion(Request $request, Form $form)
    {
        return redirect()->route('index')->with('success','Опрос был успешно изменен!');
    }

    public function updateform(Request $request, Form $form)
    {
        //все делать в этом контролере (доступ тему тайтл и тд)
        return redirect()->route('index')->with('success','Опрос был успешно изменен!');
    }

    public function destroypage(Page $page){
        if($page->delete()){
            return redirect()->back()->with('success','Страница была удалена!');
        }
        return redirect()->back()->with('error','Не удалось удалить страницу!');
    }

    public function storepage(Request $request){
        if(Page::create($request->all())){
            return redirect()->back()->with('success','Страница была удалена!');
        }
        return redirect()->back()->with('error','Не удалось удалить страницу!');
    }

    public function patch(Request $request,Form $form){
        if($form->update(['access'=>$request->access])){
            return redirect()->route('index')->with('success','Доступ был успешно изменен!');
        }
        return redirect()->route('index')->with('error','Не удалось измененить доступ!');
    }

    public function destroy(Form $form)
    {
        Storage::disk('public')->delete($form->preview);
        if($form->delete()){
            return redirect()->route('index')->with('success','Опрос был успешно удален!');
        }
        return redirect()->route('index')->with('error','Не удалось удалить опрос!');
    }

    public function indexfrom()
    {
        $form=Form::where('access', 'доступен')->paginate(1);
        $data=[
            'naw'=>true,
            'footer'=>true,
            'form'=>$form->map(function($item) {
                return[
                    'id'=>$item->id,
                    'title'=>$item->title,
                    'preview'=>$item->preview,
                    'description'=>$item->description,
                ];
            }),
            'paginate'=>$form
        ];
        return view('user.index')->with('data',$data);
    }

    public function showform(Form $form)
    {
        if($form->access=='недоступен'){
            return abort(403,'На данный момент опрос недоступен');
        }
        $data=[
            'footer'=>true,
            'id' => $form->id,
            'title' => $form->title,
            'page'=>$form->page->map(function($item) {
                return[
                    'questions' => $item->question->map(function($item1) {
                        return [
                            'id' => $item1->id,
                            'question' => $item1->question,
                            'image' => $item1->image,
                            'required' => $item1->required,
                            'comment' => $item1->comment,
                            'type' => $item1->type,
                            'option'=>$item1->option->map(function($item2) {
                                return $item2->option;
                            })
                        ];
                    })
                ];
            })

        ];
        return view('user.form')->with('data',$data);
    }
    public function questionnaire(Request $request){
        if(Auth::check()){
            $questionnaire=Questionnaire::create(["form_id"=>$request->id,"user_id"=>Auth::user()->id]);
        }else{
            $questionnaire=Questionnaire::create(["form_id"=>$request->id]);
        }
        foreach($request->question as $key => $value){
            $answer='';
            if(isset($value['value'])){
                foreach($value['value'] as $key1 => $value1){
                    $answer.=($key1==0?$value1:'|'.$value1);
                }
            }
            Answer::create(["questionnaire_id"=>$questionnaire->id,"question_id"=>$value['id'],"answer"=>$answer]);
        }
        return redirect()->route('successform',['form' => $request->id]);
    }
    public function successform(Form $form){
        if($form->access=='недоступен'){
            return abort(403,'На данный момент опрос недоступен');
        }
        $data=[
            'id' => $form->id,
            'image'=>$form->preview,
            'title' => 'Спасибо!',
            'background' => $form->theme->image->path,
        ];
        return view('user.successform')->with('data',$data);
    }
    public function export(Form $form)
    {
        return Excel::download(new FormExport($form), $form->title.'.xlsx');
    }
}
