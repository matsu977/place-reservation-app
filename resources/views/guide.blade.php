@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="mb-4 flex items-center justify-between">
        <h1 class="text-2xl">アプリの使い方</h1>
        <a href="{{ route('dashboard') }}" 
           class="text-blue-500 hover:text-blue-600 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            戻る
        </a>
    </div>

    <div class="guide-sections">
        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3">
                        貸出・返却を行う際は、まずバーコードスキャナーで番号を読み取ります。
                        手動での入力も可能です。
                    </div>
                    <div class="guide-image">
                        <img src="{{ asset('images/guide/step1.png') }}" alt="バーコードスキャンの説明" class="rounded">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3">
                        貸出・返却履歴は一覧画面で確認できます。
                        検索機能を使って特定の履歴を素早く見つけることができます。
                    </div>
                    <div class="guide-image">
                        <img src="{{ asset('images/guide/step2.png') }}" alt="履歴確認画面" class="rounded">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3">
                        バンチの管理画面では、新規登録や情報の編集が可能です。
                        在庫状況も一目で確認できます。
                    </div>
                    <div class="guide-image">
                        <img src="{{ asset('images/guide/step3.png') }}" alt="管理画面の説明" class="rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection