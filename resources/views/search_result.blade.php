<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
@include('templates.parts.header')
<style>
    .body-container {
        min-height: 96vh;
    }
    .search-result-holder .title {
        text-transform: uppercase;
        font-size: 14px;
    }
    .search-result-detail {
        font-size: 15px;
        margin: 10px 0 20px 0;
    }
    .search-result-detail span {
        text-transform: uppercase;
        color: #ED1B24;
    }
</style>
<div class="body-container">
    <div class="container search-result-container">

        <div class="title-section">
            <div class="title"><h4>SEARCH RESULT</h4></div>
            <span class="small-border"></span>
        </div>

        <div class="search-result-detail">
            Search Result for: <span>{{$keyword}}</span>
        </div>
        <br/>
        @if($search_result != false)
            @foreach($search_result as $listResult)
                <div class="search-result-holder">
                    <div class="title">
                        <a href="{{route($listResult['route'], $listResult['permalink'])}}">{!! $listResult['name'] !!}</a>
                    </div>
                    <div class="description">{!! $listResult['description'] !!}...</div>
                </div>
                <br/>
            @endforeach
            {!! $search_result->setPath('')->appends(['keyword'=>$keyword])->render() !!}
        @endif
    </div>
</div>

@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>