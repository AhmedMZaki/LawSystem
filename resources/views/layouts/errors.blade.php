@if (count($errors))
  <script>
            @foreach ($errors->all() as $error)
                toast("خطأ","{{$error}}","error");
            @endforeach
  </script>
@endif
