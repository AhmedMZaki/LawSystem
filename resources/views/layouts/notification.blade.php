
  @if (Session::has('notification'))
  <script>

    var type = "{{ Session::get('notification')['alert-type'] }}";
    switch(type){
        case 'info':
            toast("تنبية","{{ Session::get('notification')['message'] }}","info");
            break;

        case 'warning':
            toast("تحذير","{{ Session::get('notification')['message'] }}","warning");
            break;

        case 'success':
            toast("تم","{{ Session::get('notification')['message'] }}","success");
            break;

        case 'error':
            toast("خطأ","{{ Session::get('notification')['message'] }}","error");
            break;
    }
</script>
  {{Session::forget('notification')}}
@endif

  @if (count($errors))
      <script>
          @foreach ($errors->all() as $error)
          toast("خطأ", "{{$error}}", "error");
          @endforeach
      </script>
  @endif
