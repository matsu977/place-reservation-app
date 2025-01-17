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
                    <div class="guide-text mb-3 text-lg">
                        ①「＋新しい部屋を登録」をクリック
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step1.png') }}" 
                             alt="バーコードスキャンの説明" 
                             class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3 text-lg">
                        ②部屋名、部屋の幅、奥行きを入力
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step2.png') }}" 
                             alt="履歴確認画面" 
                             class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3 text-lg">
                        ③「荷物置き場を追加」をクリックし、荷物置き場を設置
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step3.png') }}" 
                             alt="管理画面の説明" 
                             class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3 text-lg">
                        ④荷物置き場の番号を設定、「保存」をクリック
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step4.png') }}" 
                             alt="バーコードスキャンの説明" 
                                class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3 text-lg">
                        ⑤「予約画面を開く」をクリック
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step5.png') }}" 
                             alt="バーコードスキャンの説明" 
                                class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3 text-lg">
                        ⑥予約したい場所をクリック
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step6.png') }}" 
                             alt="バーコードスキャンの説明" 
                                class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3 text-lg">
                        ⑦予約したい場所をクリック
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step7.png') }}" 
                             alt="バーコードスキャンの説明" 
                             class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-section mb-5">
            <div class="bg-white rounded shadow">
                <div class="p-6">
                    <div class="guide-text mb-3 text-lg">
                        ⑧予約完了！
                    </div>
                    <div class="guide-image flex justify-center">
                        <img src="{{ asset('images/guide/step8.png') }}" 
                             alt="バーコードスキャンの説明" 
                             class="rounded w-full max-w-4xl object-contain h-96">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection