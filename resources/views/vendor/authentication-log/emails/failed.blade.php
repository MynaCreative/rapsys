@inject('parser', hisorange\BrowserDetect\Parser::class)
@component('mail::message')
# @lang('Hello!')

@lang('There has been a failed login attempt to your :app account.', ['app' => config('app.name')])

|                |                                                                                              |
| -------------- | -------------------------------------------------------------------------------------------- |
| **Account**    | {{ $account->email }}                                                                        |
| **Time**       | {{ $time->toCookieString() }}                                                                |
| **Browser**    | {{ $parser->parse($browser)->browserName() }}                                                |
| **Platform**   | {{ $parser->parse($browser)->platformName() }}                                               |
| **IP Address** | {{ $ipAddress }}                                                                             |
@if ($location && $location['default'] === false)
| **Location**   | {{ $location['city'] ?? __('Unknown City') }}, {{ $location['state'], __('Unknown State') }} |
@endif

<br/>
@lang('If this was you, you can ignore this alert. If you suspect any suspicious activity on your account, please change your password.')

@lang('Regards,')<br/>
{{ config('app.name') }}
@endcomponent
