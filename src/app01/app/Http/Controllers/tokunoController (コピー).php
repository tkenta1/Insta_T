<?php

namespace App\Http\Controllers;

use App\Model\tokuno;#使用するモデムの選択
use Illuminate\Http\Request;

class tokunoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tokuno');#tokunoというviewを実行する
    }


    /**
     * ファイルアップロード処理
     */
    public function upload(Request $request)#uploadボタンが押された際にpost処理で以下の処理を実行する。validateは正しい画像化のチェック
    {
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            $path = $request->file->store('public');
            return view('tokuno')->with('filename', basename($path));
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors();

        }
    }

}


