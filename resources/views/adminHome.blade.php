@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <a href="admin/member" class="row">Manage Member</a>
                    <a href="admin/team" class="row">Manage Team</a>
                    <a href="admin/match" class="row">Manage Match</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
