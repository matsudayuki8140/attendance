@component('mail::message')
ボタンを押して、会員登録を完了してください。

@component('mail::button', ['url' => $verify_url])
Atteを開く
@endcomponent

----
もしこのメールに心当たりがない場合は破棄してください。

@endcomponent

