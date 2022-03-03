@if(isset($showAlert) && $showAlert == 1)
<div class="">
      <div class="col-md-12 mt-2 mb-2 h6" style="font-size: 12px;">
          @if (count($errors) > 0)
          <div class="text-left alert alert-danger alert-dismissible" role="alert">
            @foreach ($errors->all() as $error)
              {{ $error }}<br />
            @endforeach
          </div>
          @endif

          @if(session('message'))
          <div class="alert alert-success alert-dismissible" role="alert" style="background:#98FB98;">
             {!! session('message') !!}
          </div>
          @endif

          @if(session('success'))
          <div class="alert alert-success alert-dismissible" role="alert" style="background:#98FB98;">
             {!! session('success') !!}
          </div>
          @endif

          @if(session('info'))
          <div class="alert alert-info alert-dismissible" role="alert">
             {!! session('info') !!}
          </div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger alert-dismissible" role="alert">
             {!! session('error') !!}
          </div>
          @endif

          @if(session('warning'))
          <div class="alert alert-warning alert-dismissible" role="alert">
             {!! session('warning') !!}
          </div>
          @endif

          @if(session('danger'))
          <div class="alert alert-danger alert-dismissible" role="alert">
             {!! session('danger') !!}
          </div>
          @endif
      </div>
</div>
@endif
