@extends('layout.layout')
@section('content')
    @include('layout.navegacion')
    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="ratio ratio-16x9">

                <iframe title="Report Section" 
                    src="https://app.powerbi.com/view?r=eyJrIjoiY2E4YjliMGMtMmE1OS00ZTY0LTk5NTMtZDA0MWYyMDczYjE3IiwidCI6Ijc4YzA1MmQwLTdhZDgtNGRlYi1hYTI5LWRlM2ZiZjk3YTM1YyJ9&pageName=ReportSection"
                    frameborder="0" allowFullScreen="true"></iframe>
            </div>
        </div>
    </main>
@endsection
