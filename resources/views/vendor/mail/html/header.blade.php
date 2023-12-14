@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'BitCritic')
<img src="https://bitcritic.es/img/BitCritic-Logo-View-Game-Review-Community.png" class="logo" alt="BitCritic Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
