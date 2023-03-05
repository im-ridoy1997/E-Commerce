@php 
    $member = \App\Models\Member::where('is_deleted', 0)->where('id', $id)->first();
@endphp
<p>This is an online inquiry list, which was sent at {{$time}} on {{$date}} by:</p>
<p>Registration: Level C @if($member->approve != null) approved since {{$member->approve}}@endif</p>
<div class="row">
    <div class="col-md-6">
        <p>Name: {{$member->name}}</p>
    </div>
    <div class="col-md-6">
        <p>Year of Establishment: {{$member->year}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>Company Name: {{$member->company_name}}</p>
    </div>
    <div class="col-md-6">
        <p>Email: {{$member->email}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>Website: {{$member->website}}</p>
    </div>
    <div class="col-md-6">
        <p>Country: {{$member->country}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>Skype: {{$member->skype}}</p>
    </div>
    <div class="col-md-6">
        <p>Whatsapp: {{$member->whatsapp}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>Address: {{$member->address_one}} {{$member->address_two}}</p>
    </div>
    <div class="col-md-6">
        <p>Province / State: {{$member->state}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>City: {{$member->city}}</p>
    </div>
    <div class="col-md-6">
        <p>Tel:: {{$member->phone}}</p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p>Fax: {{$member->fax}}</p>
    </div>
</div>
<br><br><hr><br>
<div class="row">
    <div class="col-md-12">
        <p>Message:</p>
        <p>{{$member->message}}</p>
    </div>
</div>