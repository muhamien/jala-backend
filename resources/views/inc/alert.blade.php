@if (Session::has('notif'))
@php
if (Session::get('notif_status') == '1') {
$notif_class = 'success';
} else if (Session::get('notif_status') == '0') {
$notif_class = 'danger';
} else {
$notif_class = 'warning';
}
@endphp 
<div class="alert alert-{{ $notif_class }}" role="alert">
    {{ Session::get('notif') }}
</div>
@endif